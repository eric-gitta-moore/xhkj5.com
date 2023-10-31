<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


if(!$_G['uid']){
    header('Location: member.php?mod=logging&action=login&mobile=2');
}
$pluginName='yinxingfei_thinfellpay_vip';
global $_G;
$myConf = $_G['cache']['plugin'][$pluginName];
$appID = trim($myConf['appID']);
$appKey = trim($myConf['appKey']);
$navMenu = $_G['cache']['plugin'][$pluginName]['navMenu'];
$yinxingfei_thinfellpay_rule = handleryinxingfei_thinfellpay_rule(explode("\r\n", $myConf['rule']));
$yinxingfei_thinfellpay_note = explode("\r\n", $myConf['note']);
$yinxingfei_thinfellpay_isshow = $myConf['isshow'];

$myname = $_G['username'];
$uid = $_G['uid'];
$grouptitle = $_G['group']['grouptitle'];
$myweiwang = getuserprofile(extcredits1);
$mymoey = getuserprofile(extcredits2);
$mygongxian = getuserprofile(extcredits3);
$moneyname = $_G['setting']['extcredits']['2']['title'];
$weiwangname = $_G['setting']['extcredits']['1']['title'];
$gongxianname = $_G['setting']['extcredits']['3']['title'];

$mobile_nav =$_G['cache']['plugin']['yinxingfei_thinfellpay_vip']['mobile_nav'];

$mnav=array();
$mobile_nav_arr = explode("\n",$mobile_nav);
foreach($mobile_nav_arr as $k=>$v){
	$mobile_nav_item = explode("|",$v);
	$mnav[]=$mobile_nav_item;
}

if ($yinxingfei_thinfellpay_isshow == 1) {
    $order_completed_data = C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->fetch_ordercompleted_data();
    $ocdCount = count($order_completed_data);
    for ($i = 0; $i < $ocdCount; $i++) {
        $order_completed_data[$i]['adddate'] = date('Y-m-d H:i:s', $order_completed_data[$i]['adddate']);
    }
}


if("buytrue"==$_GET['action']){
    //判断当前用户是否处于登录状态
    if (!$_G['uid']) {
        showmessage(lang('plugin/yinxingfei_thinfellpay_vip', 'login_status'), NULL, array(), array());
    }

    //判断当前用户组是否有购买权限
    $setgroups = $myConf['allowBuy'];
    $setgroupsr = unserialize($setgroups);
    if(!in_array($_G['groupid'],$setgroupsr)){
        showmessage(lang('plugin/'.$pluginName, 'You do not have permission to use this function in the user group'),
            '/plugin.php?id=yinxingfei_thinfellpay_vip:m',
            array(),
            array('locationtime'=>true,'refreshtime'=>5,'showdialog'=>1,'showmsg'=>true));
        return;
    }

    //判断当前站点 id是否设置正确
    if($appID==""){
        showmessage(lang('plugin/yinxingfei_thinfellpay_vip:m', 'eccontractinfo'),
            array(),
            array('locationtime'=>true,'refreshtime'=>5,'showdialog'=>1,'showmsg'=>true));
        return;
    }
    if($appKey==""){
        showmessage(lang('plugin/yinxingfei_thinfellpay_vip:m', 'eccontractinfo'),
            array(),
            array('locationtime'=>true,'refreshtime'=>5,'showdialog'=>1,'showmsg'=>true));
        return;
    }


    $buyIdKey = $_GET['buyId'];

    //include template('common/header_ajax');
    echo '<form id="payform" name="payform" action="plugin.php?id=yinxingfei_thinfellpay_vip" method="post"><input type="hidden" value="writeData" name="action"><input type="hidden" value="'.$buyIdKey.'" name="IDKey"><input type="hidden" id="formhash" name="formhash" value="'.FORMHASH.'" ></form><script type="text/javascript" reload="1">document.forms[\'payform\'].submit();</script>';
   // include template('common/footer_ajax');
    exit(0);
}

include template('yinxingfei_thinfellpay_vip:m');

function handleryinxingfei_thinfellpay_rule($arrayrule)
{
    $rules = array();
    foreach($arrayrule as $value){
        $tmpArray = explode("||",$value);
        array_push($rules,$tmpArray);
    }
    return $rules;
}
?>