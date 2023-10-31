<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

DROP TABLE IF EXISTS cdb_drc_wakelog;
CREATE TABLE `pre_drc_wakelog` (
  `id` int(10) NOT NULL auto_increment,
  `timecycle` tinyint(3) NOT NULL,
  `waketype` tinyint(1) NOT NULL,
  `operatorid` mediumint(8) NOT NULL,
  `operator` varchar(15) NOT NULL,
  `title` char(80) NOT NULL,
  `message` text NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

EOF;

runquery($sql);

$finish = TRUE;

?>