<?php
if(!defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql = <<<EOF
DROP TABLE IF EXISTS `pre_nimba_linkhelper`;
EOF;
runquery($sql);
$finish = TRUE;

?>