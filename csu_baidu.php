<?php
define('APPTYPEID', 126);
define('CURSCRIPT', 'connect');
require_once './source/class/class_core.php';
require_once './source/function/function_home.php';
$discuz = C::app();
$mod = $discuz->var['mod'];
$discuz->init();
if(!in_array($mod, array('config', 'login'))) {
	showmessage('undefined_action');
}
define('CURMODULE', $mod);
runhooks();
require_once('source/plugin/csu_baidu/connect.func.php');
if($_G['uid']){
	if(!in_array($_G['groupid'],dunserialize($var['groups']))) 	showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']));
}
require_once libfile('connect/'.$mod, 'plugin/csu_baidu');
?>