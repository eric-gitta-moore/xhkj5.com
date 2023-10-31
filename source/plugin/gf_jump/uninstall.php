<?php
/**
 *	[帖子重定向跳转链接(gf_jump.uninstall)] (C)2016-2099 Powered by 插件大王.
 *	Version: V1.0
 *	Date: 2016-1-4 21:07
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE IF EXISTS `cdb_gf_jump`;
EOF;

runquery($sql);
$finish = true;
?>