<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$pluginName = 'yinxingfei_thinfellpay_client';

//获取传递参数
$bill_no 	= $_POST['bill_no']; 
$total_fee 	= $_POST['total_fee']/100;//分转换为元
$paytype = diconv($_POST['paytype'], 'UTF-8', CHARSET); 
$optional	= $_POST['optional'];    
$sign		= $_POST['sign'];  
$timestamp	= $_POST['timestamp'];

//获取配置参数
$set = $_G['cache']['plugin'][$pluginName];
$appid = $set['appid'];
$appsecret = $set['secret'];

//第一步:验证签名
if ($sign != md5($appid.$timestamp.$appsecret)) {
	// 签名不正确
    $result = array(
        'code' => 1000,
        'message' => "签名不正确"
    );
    echo json_encode($result);
    exit(0);
}

//获取订单
$order = DB::fetch_first("SELECT * FROM ".DB::table('a_'.$pluginName.'_order')." WHERE id = '".$bill_no."'");

//第二步:过滤重复
if($order['state'] != 0){
	//客户需要根据订单号进行判重，忽略已经处理过的订单, state:1为没处理，其他状态则为处理过
    $result = array(
        'code' => 200,
        'message' => 'success'
    );
    echo json_encode($result);
	exit();
}

//第三步:验证订单金额与购买的产品实际金额是否一致
$price=sprintf("%.2f", $order['fee']);
$total_fee=sprintf("%.2f", $total_fee);
if($total_fee != $price){
	//也就是验证返回的total_fee订单金额是否与客户服务端内部的数据库查询得到对应的产品的金额是否相同
    $result = array(
        'code' => 1001,
        'message' => "金额不正确"
    );
    echo json_encode($result);
    exit(0);
}

//第四步:处理业务逻辑和返回

/*更新订单信息*/
DB::query("UPDATE ".DB::table('a_'.$pluginName.'_order')." SET paytype = '".$paytype."', state = 1, finish_time = '".$_G['timestamp']."' WHERE id = '".$bill_no."'", 'UNBUFFERED');

/*更新用户积分*/
updatemembercount($order['uid'], array($order['extcredit'] => $order['number']), 1, 'AFD', $order['uid']);

/*发送通知*/
updatecreditbyaction($pluginName, $uid = 0, $extrasql = array(), $needle = '', $coef = 1, $update = 1, $fid = 0);
notification_add($order['uid'], 'credit', 'addfunds', array(
	'orderid' => $bill_no,
	'price' => $total_fee,
	'value' => $_G['setting']['extcredits'][$order['extcredit']]['title'].' '.$order['number'].' '.$_G['setting']['extcredits'][$order['extcredit']]['unit']
), 1);

$result = array(
	'code' => 200,
	'message' => 'success'
);

echo json_encode($result);
exit();
?>