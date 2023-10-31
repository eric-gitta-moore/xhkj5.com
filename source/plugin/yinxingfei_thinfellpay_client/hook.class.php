<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_yinxingfei_thinfellpay_client {
	function common(){
		global $_G;
		$setreplace = $_G['cache']['plugin']['yinxingfei_thinfellpay_client']['replace'];
		if($setreplace == 1){
			if($_GET['mod'] == 'spacecp' && $_GET['ac'] == 'credit' && $_GET['op'] == 'buy'){
				$url = 'plugin.php?id=yinxingfei_thinfellpay_client:recharge';
				header("HTTP/1.1 301 Moved Permanently");
				dheader("location: $url");
			}
		}
	}
}

?>