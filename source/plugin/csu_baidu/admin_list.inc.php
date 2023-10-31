<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache('plugin');
$var = $_G['cache']['plugin']['csu_baidu'];
if(submitcheck('deletesubmit',1)){
	C::t('#csu_baidu#csu_baidu_connect')->update(dintval($_GET['uid']),array('token'=>'','info'=>'','sex'=>'','userid'=>'','username'=>'','status'=>0,'dateline'=>TIMESTAMP));
	cpmsg(lang('plugin/csu_baidu', '1'),dreferer());
}
$page = $_GET['page']>1? dintval($_GET['page']) : 1;
$list = C::t('#csu_baidu#csu_baidu_connect')->getbind('dateline',0,'DESC',$page);
$count = C::t('#csu_baidu#csu_baidu_connect')->getbind('dateline',1);

	showtableheader(lang('plugin/csu_baidu', '67'));
	showtablerow('class="header"','',array(lang('plugin/csu_baidu', '68'),lang('plugin/csu_baidu', '69'),lang('plugin/csu_baidu', '70'),lang('plugin/csu_baidu', '71'),lang('plugin/csu_baidu', '72'),lang('plugin/csu_baidu', '73')));
	foreach($list as $ls){
		$user = getuserbyuid($ls['uid']);
		switch ($ls['sex']){
			case 1:
				$sex = lang('plugin/csu_baidu', '74');
				break;
			case 2:
				$sex = lang('plugin/csu_baidu', '75');
				break;
			default:
				$sex = lang('plugin/csu_baidu', '76');
				break;
		}
		$token = dunserialize($ls['token']);
		$info = dunserialize($ls['info']);
		$access = $token->access_token;
		$ac = explode('.',$access);
		showtablerow('class="noborder" onmouseover="setfaq(this, \'faqff20\')"',array(),array($user['username'].'('.$user['uid'].')',$ls['username'].'<img src="http://tb.himg.baidu.com/sys/portrait/item/'.$info['portrait'].'" width="20px" />',dgmdate($ac[3],'dt'),$sex,dgmdate($ls['dateline'],'dt'),'<a href="admin.php?action=plugins&operation=config&do='.$do.'&identifier=csu_baidu&pmod=admin_list&uid='.$ls['uid'].'&formhash='.FORMHASH.'&deletesubmit=true" onclick="javascript:confirm(\''.lang('plugin/csu_baidu', '77').'\')"/>'.lang('plugin/csu_baidu', '78').'</a>'));
	}
	showtablefooter();
	echo $multi = multi($count, 20, $page, ADMINSCRIPT."?action=plugins&operation=config&do={$do}&identifier=csu_baidu&pmod=admin_list");
function objectToArray($obj){
    $arr = is_object($obj) ? get_object_vars($obj) : $obj;
    if(is_array($arr)){
        return array_map(__FUNCTION__, $arr);
    }else{
        return $arr;
    }
}
function getbind($uid){
	return C::t('#csu_baidu#csu_baidu_connect')->fetch($uid);
}
?>