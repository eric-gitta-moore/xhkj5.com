<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF
DROP TABLE IF EXISTS pre_yytd_vip;
EOF;
runquery($sql);
$finish = TRUE;