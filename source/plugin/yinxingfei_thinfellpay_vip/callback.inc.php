<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
global $_G;
if ($_POST['bill_no']) {

//获取传递参数
    $bill_no = daddslashes($_POST['bill_no']);
    $total_fee = intval($_POST['total_fee']) / 100;//分转换为元
    $paytype = diconv($_POST['paytype'], 'UTF-8', CHARSET);
    $optional = $_POST['optional'];
    $sign = $_POST['sign'];
    $timestamp = $_POST['timestamp'];

    //获取站点ID和站点密匙  如果没有配置 则使用积分充值的配置
    $my_conf = $_G['cache']['plugin']['yinxingfei_thinfellpay_vip'];
    $appid = trim($my_conf['appID']);
    $appsecret = trim($my_conf['appKey']);

//获取订单
    $orderID = $bill_no;
    $order = C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->fetch_buy_order_id($orderID);
//第一步:验证签名
    if ($sign != md5($appid . $timestamp . $appsecret)) {
        // 签名不正确
        $result = array(
            'code' => 1000,
            'message' => "签名不正确"
        );
        echo json_encode($result);
        exit(0);
    }
    $price = sprintf("%.2f", $order['price']);
    $total_fee = sprintf("%.2f", $total_fee);

    if ($order && ($total_fee == $price)) {//验证订单金额与购买的产品实际金额是否一致
        if ($order['order_status'] == 1) {//客户需要根据订单号进行判重，忽略已经处理过的订单, state:1为没处理，其他状态则为处理过
            $member = C::t('common_member')->fetch($order['uid'], false, 1);
            if (empty($member)) {
                $isinarchive = '';

            } else {
                $isinarchive = '_inarchive';
            }
         //   C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->update_by_order_id($bill_no, '', $_G[timestamp]);

            if ($order['group_id'] > 0 && $isinarchive !==''){
                if ($order['expire'] == 0) {

                    C::t('common_member')->update($order['uid'], array('groupid' => $order['group_id'], 'groupexpiry' => 0, 'extgroupids' => ''));
                }          //设置用户组有效期 ，为永久
                elseif (is_numeric($order['expire']) && $order['expire'] > 0) {

                    if ($order['group_id'] == $member['groupid']) {
                        $groupexpiryTime = $member['groupexpiry'] + $order['expire'] * 24 * 3600;//计算时间为天数*24**3600转化成秒

                    } else {
                        //用户组为当前用户组的时候 直接添加时间；
                        $groupexpiryTime = strtotime(date('Y-m-d H:i:s', strtotime("+$order[expire] day")));

                    }
                    //更新表common_member
                    C::t('common_member')->update($order['uid'], array('groupid' => $order['group_id'], 'groupexpiry' => $groupexpiryTime, 'extgroupids' => ''));

                    $groupterms = array(
                        'main' => array(
                            'time' => $groupexpiryTime,
                            'adminid' => 0,
                            'groupid' => $my_conf['overDue'],
                        ),
                        'ext' => array(
                            $order['group_id'] => $groupexpiryTime,
                        ),
                    );
                    C::t('common_member_field_forum')->update($order['uid'], array('groupterms' => serialize($groupterms)));

                } //设置用户组有效期
             //赠送积分
                if ($order['extcredits'] != "" && $order['extcredits'] != "0") {
                    $tmpExt = explode(',', $order['extcredits']);
                    foreach ($tmpExt as $value) {
                        $extcredits = explode(':', $value);
                        //    updatemembercount($order['uid'], array($extcredits[0] => $extcredits[1]));
                        updatemembercount($order['uid'], array($extcredits[0] => $extcredits[1]), 1, 'AFD', $order['uid']);
                    }
                }
                //更新订单状态
                C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->update_by_order_id($bill_no, '', $_G['timestamp']);

            }
            else
            {
                $result = array(
                    'code' => 200,
                    'message' => '用户或用户组已经删除！',
                );
                echo json_encode($result);
                exit();
            }

      }
        $result = array(
            'code' => 200,
            'message' => 'success'
        );
    } else {
        $result = array(
            'code' => 1001,
            'message' => '金额不一致'
        );
    }
    echo json_encode($result);
    exit();
} else {
    $result = array(
        'code' => 1006,
        'message' => 'error'
    );
    echo json_encode($result);
    exit();

}