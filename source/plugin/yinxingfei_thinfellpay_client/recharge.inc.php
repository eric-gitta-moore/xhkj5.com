<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!$_G['uid']) {
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}
$do = $_GET['do'] ? $_GET['do'] : 'index' ;
$pluginName = 'yinxingfei_thinfellpay_client';
$set = $_G['cache']['plugin'][$pluginName];
$gate_way=$set['gateway'];
if($do == 'record'){
	$navtitle = lang('plugin/'.$pluginName, 'Recharge record');
	$setgroups = $set['groups'];
	$setgroupsr = unserialize($setgroups);
	if(!in_array($_G['groupid'],$setgroupsr)){
		showmessage(lang('plugin/'.$pluginName, 'You do not have permission to use this function in the user group'), NULL);
	}
		
	$setratio = $set['ratio'];
	$setextcredit = $set['extcredit'];
	$setmin = $set['min'];
	$setmax = $set['max'];
	$setextcredittitle = $_G['setting']['extcredits'][$setextcredit]['title'];
	$setextcreditunit = $_G['setting']['extcredits'][$setextcredit]['unit'];
		
	$limit = 10;
	$num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('a_yinxingfei_thinfellpay_client_order')." WHERE uid = '".$_G['uid']."' ");
	$page = max(1, intval($_GET['page']));
	$start_limit = ($page - 1) * $limit;
	$url = 'plugin.php?id=yinxingfei_thinfellpay_client:recharge&do=record';
	$multipage = multi($num, $limit, $page, $url,0,4);
	$sql = "SELECT * FROM ".DB::table('a_yinxingfei_thinfellpay_client_order')." WHERE uid = '".$_G['uid']."' ORDER BY creation_time DESC LIMIT ".$start_limit." ,".$limit;
	$query = DB::query($sql);
	$list = array();
	while ($value = DB::fetch($query)){
		$list[] = $value;
	}
	$stater = array(
		0 => '<font color=red>'.lang('plugin/'.$pluginName, 'Wait for payment').'</font>',
		1 => '<font color=green>'.lang('plugin/'.$pluginName, 'Recharge success').'</font>',
	);
}elseif($do == 'index'){
	$navtitle = lang('plugin/'.$pluginName, 'Integral recharge');
	$setgroups = $set['groups'];
	$setgroupsr = unserialize($setgroups);
	if(!in_array($_G['groupid'],$setgroupsr)){
		showmessage(lang('plugin/'.$pluginName, 'You do not have permission to use this function in the user group'), NULL);
	}

	$setratio = $set['ratio'];
	$setextcredit = $set['extcredit'];
	$setmin = $set['min'];
	$setmax = $set['max'];
	$setextcredittitle = $_G['setting']['extcredits'][$setextcredit]['title'];
	$setextcreditunit = $_G['setting']['extcredits'][$setextcredit]['unit'];

	if(submitcheck('tpaysubmit', 1)) {
			
		$number = intval($_POST['number']);
		$subject = lang('plugin/'.$pluginName, 'lang60').$_G['username'].lang('plugin/'.$pluginName, 'lang61').$setextcredittitle.$number.$setextcreditunit;//标题
		
		if($number < $setmin){
			showmessage(lang('plugin/'.$pluginName, 'Recharge amount can not be less than').$setmin, NULL);
		}
		if($number > $setmax){
			showmessage(lang('plugin/'.$pluginName, 'Recharge amount can not be greater than').$setmax, NULL);
		}
		
		//生成订单
		$fee = sprintf("%.2f", $number/$setratio);
		$rand = rand(10000,99999);
		$orderid = date("YmdHis",$_G['timestamp']).$rand;
		$post = array(
			'id' => $orderid,
			'creation_time' => $_G['timestamp'],
			'uid' => $_G['uid'],
			'number' => $number,
			'fee' => $fee,
			'extcredit' => $setextcredit,
			'state' => 0,
			'finish_time' => '0',
			'subject' => $subject,
			'paytype' => '0'		
		);
				
		if(DB::insert('a_yinxingfei_thinfellpay_client_order', $post)){
			
			$appid = $set['appid'];;
			$appsecret = $set['secret'];;
			$timestamp = $_G['timestamp'];
			$sign = md5($appid.$timestamp.$appsecret);
			$optional = array(
					'number' => $number,
					'extcredit' => $setextcredit,
			);
			$para = array(
				'sign' => $sign,
				'appid' => $appid,
				'timestamp' => $timestamp,
				'total_fee' => intval($fee*100),//单位分
				'bill_no' => $orderid,
				'title' => $subject,
				'optional' => json_encode($optional),
				'return_url' => urlencode($_G['siteurl'].'plugin.php?id=yinxingfei_thinfellpay_client:recharge&do=record'),
				'notify_url' => urlencode($_G['siteurl'].'plugin.php?id=yinxingfei_thinfellpay_client:notify'),
				'bill_timeout' => '3600',//单位为秒
			);
			
			$para_get = createLinkstring($para);
			$para_get = diconv($para_get, CHARSET, 'UTF-8');

            dheader('Location:'.trim($gate_way).'?'.$para_get);
		}
	}
}else{
	exit('Access Denied');
}
include template('yinxingfei_thinfellpay_client:'.$do);

function createLinkstring($para) {
	$arg  = "";
	while (list ($key, $val) = each ($para)) {
		$arg.=$key."=".$val."&";
	}
	//去掉最后一个&字符
	$arg = substr($arg,0,count($arg)-2);
	
	//如果存在转义字符，那么去掉转义
	if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
	
	return $arg;
}
?>