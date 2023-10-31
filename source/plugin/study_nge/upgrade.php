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

CREATE TABLE IF NOT EXISTS `cdb_study_nge_recpost` (

  `id` mediumint(8) unsigned NOT NULL auto_increment,

  `tid` mediumint(8) unsigned NOT NULL,

  `uid` mediumint(8) unsigned NOT NULL,

  `username` char(15) NOT NULL,

  `subject` char(80) NOT NULL,

  `dateline` int(10) unsigned NOT NULL,

  PRIMARY KEY  (`id`),

  KEY `dateline` (`dateline`),

  KEY `tid` (`tid`)

) ENGINE=MyISAM;

EOF;

		runquery($sql);
		
		$finish = TRUE;

?>