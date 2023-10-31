<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
function handleryytd_rule($arrayrule)
{
	$rules = array();
	foreach($arrayrule as $value){
		$tmpArray = explode("||",$value);
		array_push($rules,$tmpArray);
	}
	return $rules;
}

if(!$_G['uid']){
    header('Location: member.php?mod=logging&action=login&mobile=2');
}

$my_conf = $_G['cache']['plugin']['yytd_pay'];
$parter_id = trim($my_conf['parter_id']);
$parter_sign = trim($my_conf['parter_sign']);
//////
loadcache('plugin');
//获取站点ID和站点密匙  如果没有配置 则使用积分充值的配置
$my_conf = $_G['cache']['plugin']['yytd_vip'];
$parter_id = trim($my_conf['parter_id']);
$parter_sign = trim($my_conf['parter_sign']);
if ($parter_id==='' or $parter_sign===''){
    $pluginName = 'yinxingfei_thinfellpay_client';
    $set = $_G['cache']['plugin'][$pluginName];
    $parter_id = $set['appid'];;
    $parter_sign = $set['secret'];


}
//////

$navMenu = $_G['cache']['plugin']['yytd_vip']['yytd_navMenu'];


$setContent = $_G['cache']['plugin']['yytd_vip'];
$yytd_rule = handleryytd_rule(explode("\r\n", $setContent['yytd_rule']));
$yytd_note = explode("\r\n", $setContent['yytd_note']);
$yytd_isshow = $setContent['yytd_isshow'];

$myname = $_G['username'];
$uid = $_G['uid'];
$grouptitle = $_G['group']['grouptitle'];
$myweiwang = getuserprofile(extcredits1);
$mymoey = getuserprofile(extcredits2);
$mygongxian = getuserprofile(extcredits3);
$moneyname = $_G['setting']['extcredits']['2']['title'];
$weiwangname = $_G['setting']['extcredits']['1']['title'];
$gongxianname = $_G['setting']['extcredits']['3']['title'];

$mobile_nav =$_G['cache']['plugin']['yytd_vip']['mobile_nav'];

$mnav=array();
$mobile_nav_arr = explode("\n",$mobile_nav);
foreach($mobile_nav_arr as $k=>$v){
	$mobile_nav_item = explode("|",$v);
	$mnav[]=$mobile_nav_item;
}


if("buytrue"==$_GET['action']){
    //判断当前用户是否处于登录状态
    if (!$_G['uid']) {
        showmessage(lang('plugin/yytd_vip', 'login_status'), NULL, array(), array());
    }
    //判断当前站点 id是否设置正确
    if($parter_id==""){
        showmessage(lang('plugin/yytd_vip', 'eccontractinfo'), NULL, array(), array());
        return;
    }
    if($parter_sign==""){
        showmessage(lang('plugin/yytd_vip', 'eccontractinfo'), NULL, array(), array());
        return;
    }


    $buyIdKey = $_GET['buyId'];

    //include template('common/header_ajax');
    echo '<form id="payform" name="payform" action="plugin.php?id=yytd_vip" method="post"><input type="hidden" value="writeData" name="action"><input type="hidden" value="'.$buyIdKey.'" name="IDKey"><input type="hidden" id="formhash" name="formhash" value="'.FORMHASH.'" ></form><script type="text/javascript" reload="1">document.forms[\'payform\'].submit();</script>';
   // include template('common/footer_ajax');
    exit(0);
}

include template('yytd_vip:m');
?>