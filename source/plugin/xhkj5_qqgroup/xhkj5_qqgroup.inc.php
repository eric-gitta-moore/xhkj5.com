<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

global $_G;
$con = $_G['cache']['plugin']['xhkj5_qqgroup'];
$groups = dunserialize($_G['cache']['plugin']['xhkj5_qqgroup']['groupid']);
if(!$_G['uid'] && $con['uid']){
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}elseif(in_array($_G['groupid'],$groups)){
	showmessage($con['tips_uid'],null,array(),array('alert' => error));
}elseif($_G[groupid]=='8' && $con['y']){
	showmessage($con['tips_y'],null,array(),array('alert' => error));
}elseif($_G[groupid]=='20' && $con['qq']){
	showmessage($con['tips_qq'],null,array(),array('alert' => error));
}else{
	if($con['verify']){
		$verify = C::t('common_member_verify')->fetch($_G['uid']);
	}
	if($verify[$con['verify']] == 1 || !$con['verify']){
		$con['tips_ok'] =  str_replace('{uid}',$_G['uid'],$con['tips_ok']);
		$con['tips_ok'] =  str_replace('{group}',$_G['groupid'],$con['tips_ok']);
		showmessage($con['tips_ok'],null,array(),array('alert' => right));
	}else{
		//下面是未完成验证的提示信息 支持HTML
		showmessage($con['tips_verify'],null,array(),array('alert' => error));
	}
	
}


