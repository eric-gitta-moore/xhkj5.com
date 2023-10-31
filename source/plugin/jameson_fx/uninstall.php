<?php
if(!defined('IN_ADMINCP') || !defined('IN_DISCUZ')){
	exit('Access Denied');
}

$sql = <<<EOF
DROP TABLE IF EXISTS `cdb_jamesonfx_fx`;
DROP TABLE IF EXISTS `cdb_jamesonfx_fxpor`;
DROP TABLE IF EXISTS `cdb_jamesonfx_day`;
EOF;
runquery($sql);
$finish = TRUE;