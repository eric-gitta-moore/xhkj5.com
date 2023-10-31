<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<EOF
DROP TABLE IF EXISTS `cdb_yinxingfei_thinfellpay_vip`;

EOF;
runquery($sql);
$finish = TRUE;