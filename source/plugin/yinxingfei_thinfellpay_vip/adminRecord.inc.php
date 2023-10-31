<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
$pluginName = 'yinxingfei_thinfellpay_vip';
global $_G;
//获取站点ID和站点密匙  如果没有配置 则使用积分充值的配置
$my_conf = $_G['cache']['plugin'][$pluginName];
//补单操作
if ($_GET['supplement'] == 'yes' && $_GET['bill_no'] && $_GET['formhash'] == formhash()) {

    $bill_no = daddslashes($_GET['bill_no']);
    $paytype = lang('plugin/' . $pluginName, 'houtaibudan');
    //获取订单
    //   $order = DB::fetch_first("SELECT * FROM ".DB::table($pluginName)." WHERE order_id = '".$bill_no."'");
    $orderID = $bill_no;
    $order = C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->fetch_buy_order_id($orderID);

    //获取用户信息
    $member = C::t('common_member')->fetch($order['uid'], false, 1);
    if (empty($member)) {
        $isinarchive = '';
    } else {
        $isinarchive = '_inarchive';
    }
    if ($order['group_id'] > 0 && $isinarchive !== '') {
        if (intval($order['expire']) == 0) {
            C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->update_by_order_id($bill_no, '', $_G['timestamp']);
        } elseif (is_numeric($order['expire']) && $order['expire'] > 0) {

            if ($order['group_id'] == $member['groupid']) {
                $groupexpiryTime = $member['groupexpiry'] + $order['expire'] * 24 * 3600;//计算时间为天数*24**3600转化成秒
            } else {
                //用户组为当前用户组的时候 直接添加时间；
                $groupexpiryTime = strtotime(date('Y-m-d H:i:s', strtotime("+$order[expire] day")));
            }
            //更新表common_member
            C::t('common_member')->update($order['uid'], array('groupid' => $order['group_id'], 'groupexpiry' => $groupexpiryTime, 'extgroupids' => ''));
            //更新表common_member_field_forum
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
        }
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
    } else {
        echo '用户或用户组已经删除！';
    }
}
//补单操作end
showtips(lang('plugin/' . $pluginName, 'tips'));
showtableheader(lang('plugin/' . $pluginName, 'tableheader'));
$limit = 10;
$num = C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->count();//所有记录数量
$page = max(1, intval($_GET['page']));
$start_limit = ($page - 1) * $limit;
$url = 'admin.php?action=plugins&operation=config&identifier=yinxingfei_thinfellpay_vip&pmod=adminRecord';
$multipage = multi($num, $limit, $page, $url);
////**********
showtablerow("", '', array(lang('plugin/' . $pluginName, 'order_id'), lang('plugin/' . $pluginName, 'order_status'), lang('plugin/' . $pluginName, 'username'), lang('plugin/' . $pluginName, 'order_group_name'), lang('plugin/' . $pluginName, 'order_valitidy'), lang('plugin/' . $pluginName, 'order_price'), lang('plugin/' . $pluginName, 'order_submitdate'), lang('plugin/' . $pluginName, 'order_confirmdate'), lang('plugin/' . $pluginName, 'budan')));
$alldata = C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->fetch_all_by_sql($start_limit, $limit);
foreach ($alldata as $value) {
    $expire = $value['expire'] == 0 ? lang('plugin/' . $pluginName, 'validityinfo') : $value['expire'];
    //是否付款-订单状态
    $order_status = $value['order_status'] == 2 ? lang('plugin/' . $pluginName, 'order_status_sucess') : lang('plugin/' . $pluginName, 'order_status_wait');
    //订单提交时间
    $adddate = $value['adddate'] == 0 ? 'N/A' : date('Y-m-d H:i:s', $value['adddate']);

    //订单付款时间
    $editdate = $value['editdate'] == 0 ? 'N/A' : date('Y-m-d H:i:s', $value['editdate']);
    //如果没有付款的显示补单按钮
    $budaninfo = $value['order_status'] == 1 ? '<a href="admin.php?action=plugins&operation=config&identifier=yinxingfei_thinfellpay_vip&pmod=adminRecord&supplement=yes&bill_no=' . $value['order_id'] . '&formhash=' . formhash() . '">' . lang('plugin/' . $pluginName, 'budan') . '</a>' : '-';


    showtablerow("", '', array($value['order_id'], $order_status, $value['username'], $value['group_name'], $expire, $value['price'], $adddate, $editdate, $budaninfo));
}


showtablerow('', array('colspan="99"'), array($multipage));
showtablefooter();
?>