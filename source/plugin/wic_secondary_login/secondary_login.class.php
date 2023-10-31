<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_wic_secondary_login {
	
	function global_footer(){
		
		global $_G;
		
		$config = $return = array();
		
		$slogintxt = $slogin_register_color = $slogintext = $slogin_login_bgcolor = $slogin_login_bgcolorhover = $sloginqqtext = $slogin_qqlogin_bgcolor =  $slogin_qqlogin_bgcolorhover = $sloginwxtext = $slogin_wxlogin_bgcolor = $slogin_wxlogin_bgcolorhover ='';
		
		$config = $_G['cache']['plugin']['wic_secondary_login'];
		
		$slogintxt = $config['slogin_txt'];

		$slogin_register_color = $config['slogin_register_color'] ? $config['slogin_register_color'] : '#1499f8';
		
		$slogintext = $config['slogin_logintext'];
		
		$slogin_login_bgcolor = $config['slogin_login_bgcolor'] ? $config['slogin_login_bgcolor'] : '#1499f8';
		
		$slogin_login_bgcolorhover = $config['slogin_login_bgcolorhover'] ? $config['slogin_login_bgcolorhover'] : '#128ae0';
		
		$sloginqqtext = $config['slogin_qqlogintext'];
		
		$slogin_qqlogin_bgcolor = $config['slogin_qqlogin_bgcolor'] ? $config['slogin_qqlogin_bgcolor'] : '#177dbf';
		
		$slogin_qqlogin_bgcolorhover = $config['slogin_qqlogin_bgcolorhover'] ? $config['slogin_qqlogin_bgcolorhover'] : '#1575b3';
		
		$sloginwxtext = $config['slogin_wxlogintext'];
		
		$slogin_wxlogin_bgcolor = $config['slogin_wxlogin_bgcolor'] ? $config['slogin_wxlogin_bgcolor'] : '#3fbd0e';
		
		$slogin_wxlogin_bgcolorhover = $config['slogin_wxlogin_bgcolorhover'] ? $config['slogin_wxlogin_bgcolorhover'] : '#5fa423';
		
		include template('wic_secondary_login:slogin');
	
		return $return;
		
	}

}

?>