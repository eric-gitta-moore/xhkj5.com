<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if ($_POST['bill_no']) {

//获取传递参数
$bill_no 	= $_POST['bill_no']; 
$total_fee 	= intval($_POST['total_fee']) / 100;//分转换为元
$paytype = diconv($_POST['paytype'], 'UTF-8', CHARSET); 
$optional	= $_POST['optional'];    
$sign		= $_POST['sign'];  
$timestamp	= $_POST['timestamp'];

    //获取站点ID和站点密匙  如果没有配置 则使用积分充值的配置
    $my_conf = $_G['cache']['plugin']['yytd_vip'];
    $parter_id = trim($my_conf['parter_id']);
    $parter_sign = trim($my_conf['parter_sign']);



    $pluginName = 'yinxingfei_thinfellpay_client';
    if ($parter_id==='' or $parter_sign===''){
        $set = $_G['cache']['plugin'][$pluginName];
        $appid = $set['appid'];
        $appsecret = $set['secret'];

    }
    else
    {
        $appid = $parter_id;
        $appsecret = $parter_sign;
    }

//获取订单
    $orderID = $bill_no;
    $order = C::t('#yytd_vip#yytd_vip')->fetch_buy_order_id($orderID);
echo "estinfo";
//第一步:验证签名
    if ($sign != md5($appid.$timestamp.$appsecret)) {
        // 签名不正确
        dheader('location: '.$_G['siteurl'].'/home.php?mod=spacecp&ac=usergroup');
    }

    if ($order && (floatval($total_fee) == floatval($order['price']))) {//验证订单金额与购买的产品实际金额是否一致
        if ($order['order_status'] == 1) {//客户需要根据订单号进行判重，忽略已经处理过的订单, state:1为没处理，其他状态则为处理过
            $member = C::t('common_member')->fetch($order['uid'], false, 1);
            if (count($member) == 0) {
                $isinarchive = '_inarchive';
            }
            else {
                $isinarchive = '';
            }
            C::t('#yytd_vip#yytd_vip')->update_by_order_id($bill_no, '', $_G[timestamp]);


            if($order['group_id'] > 0){
                if ($order['expire'] == 0)
                {
                    C::t('common_member' . $isinarchive)->update($order['uid'], array('groupid' => $order['group_id'],'groupexpiry' => 0));
                }
                elseif (is_numeric($order['expire']) && $order['expire'] > 0)//
                {
                    if($order['group_id'] ==$member['groupid']){
                        $groupexpiryTime =$member['groupexpiry']+$order['expire']*24*3600;//计算时间为天数*24**3600转化成秒

                    }
                    else
                    {
                        //用户组为当前用户组的时候 直接添加时间；
                        $groupexpiryTime = strtotime(date('Y-m-d H:i:s', strtotime("+$order[expire] day")));

                    }
                    C::t('common_member' . $isinarchive)->update($order['uid'], array('groupid' => $order['group_id'], 'groupexpiry' => $groupexpiryTime));

                    $groupterms['main'] = array('time' => $groupexpiryTime);
                    $groupterms['ext'][$order['group_id']] = $groupexpiryTime;

                    C::t('common_member_field_forum' . $isinarchive)->update($order['uid'], array('groupterms' => serialize($groupterms)));

                }
            }


            if ($order['extcredits'] != "" && $order['extcredits'] != "0") {
                $tmpExt = explode(',', $order['extcredits']);
                foreach ($tmpExt as $value) {
                    $extcredits = explode(':', $value);
                    updatemembercount($order['uid'], array($extcredits[0] => $extcredits[1]));
                }
            }
        }
        dheader('location: '.$_G['siteurl'].'/home.php?mod=spacecp&ac=usergroup');
    }

    else
    {
        showmessage(lang('plugin/yytd_vip', 'TOTAL_FEE_ERROR'), NULL, array(), array());
    }

    dheader('location: '.$_G['siteurl'].'/home.php?mod=spacecp&ac=usergroup');
}

else {

    if (is_mobile()) {
        echo "<!doctype html><html><head><title></title>";
        echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />';
        echo "</head><body>";
        echo "<div><a href=" . $_G[' '] . "><img src='images/success.gif' alt=''/></a></div>";
        echo "</body></html>";
    } else {
        dheader('location: '.$_G['siteurl'].'plugin.php?id=yytd_vip');
    }
}
function is_mobile()
{
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = '0';
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;
    if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;
    if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;
    if (isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
        'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
        'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
        'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
        'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
        'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
        'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
        'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
        'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
    );
    if (in_array($mobile_ua, $mobile_agents))
        $mobile_browser++;
    if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
        $mobile_browser++;
    // Pre-final check to reset everything if the user is on Windows  
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
        $mobile_browser = 0;
    // But WP7 is also Windows, with a slightly different characteristic  
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
        $mobile_browser++;
    if ($mobile_browser > 0)
        return true;
    else
        return false;
}