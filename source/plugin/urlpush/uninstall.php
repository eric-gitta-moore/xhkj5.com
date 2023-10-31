<?php
/**
 *	[网站内容自动提交至百度(urlpush.uninstall)] (C)2016-2099 Powered by 安德兔：http://www.andetu.com.
 *	Version: 1.0
 *	Date: 2016-09-12 09:58
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
	DROP TABLE IF EXISTS pre_andetu_urlpush;
EOF;

runquery($sql);
$finish = true;
?>