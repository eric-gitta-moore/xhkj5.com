<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) exit('Access Denied!');

$sql = <<<EOF
DROP TABLE IF EXISTS cdb_csu_baidu_guest;
DROP TABLE IF EXISTS cdb_csu_baidu_connect;
EOF;

runquery($sql);

$finish = TRUE;
?>