<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once('connect.func.php');
$bind = getbind($_G['uid']);
if($bind['status']==1){
	$token = dunserialize($bind['token']);
	$at = explode('.',$token->access_token);
	if(submitcheck('refresh',1)){
		if((TIMESTAMP-$at[3]+$at[2])<86400){
			showmessage(lang('plugin/csu_baidu', '79'),dreferer(),array(),array('alert'=>'error'));
		}
		$token = refreshtoken($token->refresh_token);
		$token = json_decode($token);
		C::t('#csu_baidu#csu_baidu_connect')->update($_G['uid'],array('token'=>serialize($token),'dateline'=>TIMESTAMP));
		showmessage(lang('plugin/csu_baidu', '80'),dreferer(),array(),array('alert'=>'right'));
	}
	if(submitcheck('unbindsubmit')){
		C::t('#csu_baidu#csu_baidu_connect')->update($_G['uid'],array('token'=>'','info'=>'','sex'=>'','userid'=>'','username'=>'','status'=>0,'dateline'=>TIMESTAMP));
		showmessage(lang('plugin/csu_baidu', '1'),dreferer(),array(),array('alert'=>'right'));
	}
	$info = dunserialize($bind['info']);
}else{
	$count = C::t('#csu_baidu#csu_baidu_connect')->countbind();

}

?>