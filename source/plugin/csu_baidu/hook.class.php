<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_csu_baidu{
	function __construct(){
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($_G['uid']){
			$this->bind = C::t('#csu_baidu#csu_baidu_connect')->fetch($_G['uid']);
			$token = dunserialize($this->bind['token']);
			$at = explode('.',$token->access_token);
			if(in_array($_G['groupid'],dunserialize($var['groups']))){
				if($this->bind['status']==1){
					$remain = ceil(($at[3]-TIMESTAMP)/86400);
					$this->code = ($var['shu'] == 1||$var['shu'] == 3 ? '<span class="pipe">|</span>':'').'<a href="home.php?mod=spacecp&ac=plugin&id=csu_baidu:csu_baidu"><span class="xi1" style="background:url();overflow: visible;"><img align="absmiddle" src="source/plugin/csu_baidu/images/ico.png" />'.lang('plugin/csu_baidu', '81').$remain.lang('plugin/csu_baidu', '82').')</span></a>&nbsp;'.($var['shu'] == 2||$var['shu'] == 3 ? '<span class="pipe">|</span>':'');
				}else{
					$this->code = ($var['shu'] == 1||$var['shu'] == 3 ? '<span class="pipe">|</span>':'').'<a href="home.php?mod=spacecp&ac=plugin&id=csu_baidu:csu_baidu"  target="_blank" /><img class="qq_bind" align="absmiddle"  height="20px" src="source/plugin/csu_baidu/images/login-long.png" alt="'.lang('plugin/csu_baidu', '83').'" title="'.lang('plugin/csu_baidu', '83').'" /></a>&nbsp;'.($var['shu'] == 2||$var['shu'] == 3 ? '<span class="pipe">|</span>':'');
				}
			}else $this->code = '';
		}
	}
	function common(){
		global $_G;
		if($_G['uid']&&$this->bind['status']!=1){
			$var = $_G['cache']['plugin']['csu_baidu'];
			if(in_array($_G['groupid'],dunserialize($var['groups']))){
				//检测用户组权限
				$userid = getcookie('csu_baidu_userid');
				if($userid){
					$guest = C::t('#csu_baidu#csu_baidu_guest')->byuserid($userid);
					$cn = C::t('#csu_baidu#csu_baidu_connect')->getbyuserid($userid);
					C::t('#csu_baidu#csu_baidu_guest')->deletebyuserid($userid);
					dsetcookie('csu_baidu_userid','',TIMESTAMP-999);
					if($guest['userid']){
						if($cn['uid']!=$_G['uid']&&$cn['uid']){
							showmessage(lang('plugin/csu_baidu', '84'));
						}elseif($cn['uid']==$_G['uid']){
						}else{
							$info = dunserialize($guest['info']);
							$token = dunserialize($guest['token']);
							C::t('#csu_baidu#csu_baidu_connect')->insert(array('uid'=>$_G['uid'],'sex'=>$info['sex'],'userid'=>$info['userid'],'username'=>$info['username'],'info'=>serialize($info),'binded'=>1,'status'=>1,'token'=>serialize($token),'dateline'=>TIMESTAMP),0,1);
							dheader('Location:'.$guest['refer']);
						}
					}
				}
			}
		}
	}
	function global_header(){
		global $_G;
		if($_G['uid']){
			$var = $_G['cache']['plugin']['csu_baidu'];
			if($var['mustbind']){
				//强制绑定检测
				if(!$this->bind['status']==1){
					if(CURSCRIPT=='home'&&$_GET['ac']=='plugin'&&$_GET['id']=='csu_baidu:csu_baidu'){
						return ;
					}
					return '<script>showWindow(\'csu_baidu\', \'plugin.php?id=csu_baidu:needbind\')</script>';
				}
			}
		}
	}
	function global_usernav_extra1(){
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($var['loginshow'] == 'global_usernav_extra1'){
			return $this->code;
		}
	}
	function global_usernav_extra2(){
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($var['loginshow'] == 'global_usernav_extra2'){
			return $this->code;
		}
	}
	function global_usernav_extra3(){
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($var['loginshow'] == 'global_usernav_extra3'){
			return $this->code;
		}
	}
	function global_usernav_extra4(){
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($var['loginshow'] == 'global_usernav_extra4'){
			return $this->code;
		}
	}
	
	
	function global_login_extra() {
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($var['login_top']){
			$str= '<div class="fastlg_fm y" style="margin-right: 10px; padding-right: 10px">
	<p><a href="csu_baidu.php?mod=login&op=init"><img src="'.$var['loginpic'].'"  class="vm" ></a></p>
	<p class="hm xg1" style="padding-top: 2px;">'.$var['login_top_tip'].'</p>
	</div>';
			return $str;
		}
		
	}

	function global_login_text() {
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($var['login_text']){
			$str= '<a href="csu_baidu.php?mod=login&op=init"><img src="'.$var['loginpic'].'"  class="vm" ></a>';
			return $str;
		}
	}
}
class plugin_csu_baidu_member extends plugin_csu_baidu {
	public function register_bottom() {
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($var['register_input']&&!$_GET['defaultusername']){
			$str= '<div class="rfm">
		<table>
			<tr>
				<th></th>
				<td>
				<a href="csu_baidu.php?mod=login&op=init"><img src="'.$var['loginpic'].'"  class="vm" ></a></td>
			</tr>
		</table>
	</div>
';
			return $str;
		}
	}
	public function logging_input() {
		global $_G;
		$var = $_G['cache']['plugin']['csu_baidu'];
		if($var['logging_input']){
			$str= '<div class="rfm">
		<table>
			<tr>
				<th></th>
				<td>
				<a href="csu_baidu.php?mod=login&op=init"><img src="'.$var['loginpic'].'"  class="vm" ></a></td>
			</tr>
		</table>
	</div>';
			return $str;
		}
	}
}
?>