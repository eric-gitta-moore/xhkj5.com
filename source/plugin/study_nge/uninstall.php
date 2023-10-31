<?php

/*

 * Install Uninstall Upgrade AutoStat System Code 20120717152gt30PCAp7

 * This is NOT a freeware, use is subject to license terms

 * From www.1314study.com

 */

if(!defined('IN_ADMINCP')) {

	exit('Access Denied');

}

$sql = <<<EOF

DROP TABLE IF EXISTS cdb_study_nge_recpost;

EOF;

runquery($sql);

$finish = TRUE;

?>