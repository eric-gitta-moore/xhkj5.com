<?php



if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}

$fromversion = $_GET['fromversion'];



if(version_compare($fromversion, '2.5.2', '<')){

$sql = <<<EOF

CREATE TABLE IF NOT EXISTS pre_plugin_k_misign_lastrule (

  ruleid int(11) NOT NULL AUTO_INCREMENT,

  lastday int(11) NOT NULL,

  reward text NOT NULL,

  relatedmedal int(11) NOT NULL,

  relatedmedaldate int(11) NOT NULL,

  `status` tinyint(1) NOT NULL,

  PRIMARY KEY (ruleid),

  KEY lastday (lastday,`status`)

) ENGINE=MyISAM;

EOF;

runquery($sql);	

}



$sqls = <<<EOF

CREATE TABLE IF NOT EXISTS pre_plugin_k_misign_bq (

  bid int(11) NOT NULL AUTO_INCREMENT,

  uid int(11) NOT NULL,

  lasttime int(11) NOT NULL,

  thistime int(11) NOT NULL,

  bqdays int(11) NOT NULL,

  PRIMARY KEY (bid),

  KEY uid (uid,lasttime,bqdays)

) ENGINE=MyISAM;

EOF;

runquery($sqls);	



$finish = TRUE;

?>

