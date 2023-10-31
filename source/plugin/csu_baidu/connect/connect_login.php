<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$op = !empty($_GET['op']) ? $_GET['op'] : '';
if(!in_array($op, array('init', 'callback', 'change', 'info'))) {
	showmessage('undefined_action');
}
$referer = $_GET['refer'] ? daddslashes($_GET['refer']) : urlencode($_G['siteurl'].'index.php');

if($op == 'init') {
	dheader('Location:' . getAuth('csu_baidu.php?mod=login&op=callback&refer='.urlencode(dreferer())));
} elseif($op == 'callback') {
	if($_G['uid']){
		$bind = getbind($_G['uid']);
		$token = getToken(daddslashes($_GET['code']),'csu_baidu.php?mod=login&op=callback&refer='.urlencode($referer));
		$token = json_decode($token);
		$info = objectToArray(json_decode(getinfo($token->access_token)));
		$info = daddslashes(tochar($info));
		$check = C::t('#csu_baidu#csu_baidu_connect')->getbyuserid($info['userid']);
		if($bind['uid']){
			if($check['uid']!=$_G['uid']&&$check['uid']) showmessage(lang('plugin/csu_baidu', '86'));
			C::t('#csu_baidu#csu_baidu_guest')->deletebyuserid($info['userid']);
			C::t('#csu_baidu#csu_baidu_connect')->update($_G['uid'],array('token'=>serialize($token),'sex'=>$info['sex'],'userid'=>$info['userid'],'username'=>$info['username'],'info'=>serialize($info),'binded'=>1,'status'=>1,'dateline'=>TIMESTAMP));
		}else{
			if($check['uid']) showmessage(lang('plugin/csu_baidu', '87'));
			C::t('#csu_baidu#csu_baidu_guest')->deletebyuserid($info['userid']);
			C::t('#csu_baidu#csu_baidu_connect')->insert(array('uid'=>$_G['uid'],'sex'=>$info['sex'],'userid'=>$info['userid'],'username'=>$info['username'],'info'=>serialize($info),'binded'=>1,'status'=>1,'token'=>serialize($token),'dateline'=>TIMESTAMP));
		}
		if(!$bind['binded']) {
			if($var['reward']){
				updatemembercount($_G['uid'],array('extcredits'.$var['reward']=>$var['num']));
			}
		}
		showmessage(lang('plugin/csu_baidu', '88'),$referer,array(),array('alert'=>'right'));
	}else{
		$token = getToken(daddslashes($_GET['code']),'csu_baidu.php?mod=login&op=callback&refer='.urlencode($referer));
		$token = json_decode($token);
		$info = objectToArray(json_decode(getinfo($token->access_token)));
		$info = daddslashes(tochar($info));
		$check = C::t('#csu_baidu#csu_baidu_connect')->getbyuserid($info['userid']);
		if($check['uid']){
			C::t('#csu_baidu#csu_baidu_connect')->update($_G['uid'],array('token'=>serialize($token),'sex'=>$info['sex'],'userid'=>$info['userid'],'username'=>$info['username'],'info'=>serialize($info),'binded'=>1,'status'=>1,'dateline'=>TIMESTAMP));
			connect_login($check['uid']);
			showmessage(lang('plugin/csu_baidu', '89'),$referer);
		}else{
			C::t('#csu_baidu#csu_baidu_guest')->deletebyuserid($info['userid']);
			C::t('#csu_baidu#csu_baidu_guest')->insert(array('code'=>savecode(),'token'=>serialize($token),'userid'=>$info['userid'],'refer'=>$referer,'info'=>serialize($info),'dateline'=>TIMESTAMP),0,1);
			$_GET['defaultusername'] = dhtmlspecialchars(dstripslashes($info['username']));
			dsetcookie('csu_baidu_userid',$info['userid'],7200);
			dheader('Location:member.php?mod='.$_G['setting']['regname'].'&defaultusername='.$info['username']);
		}
	}
} 

function connect_login($uid) {
	global $_G;

	if(!($member = getuserbyuid($uid, 1))) {
		return false;
	} else {
		if(isset($member['_inarchive'])) {
			C::t('common_member_archive')->move_to_master($uid);
		}
	}

	require_once libfile('function/member');
	$cookietime = 1296000;
	setloginstatus($member, $cookietime);
	return true;
}

?>