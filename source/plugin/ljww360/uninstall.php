<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$settingfile = DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
if(file_exists($settingfile)){
	unlink($settingfile);
}
if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
	$settingfile = DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
	unlink($settingfile);
}
$sql = <<<EOF
drop table IF EXISTS `pre_plugin_ljwenwentype`;
drop table IF EXISTS `pre_plugin_lj_post`;
drop table IF EXISTS `pre_plugin_lj_thread`;
drop table IF EXISTS `pre_plugin_ljwenwen_ts`;
EOF;
runquery($sql);

$finish = TRUE;
?>