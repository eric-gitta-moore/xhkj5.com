<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

DROP TABLE cdb_drc_wakelog;

EOF;

runquery($sql);

$finish = TRUE;