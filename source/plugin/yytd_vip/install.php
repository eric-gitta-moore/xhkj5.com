<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF
DROP TABLE IF EXISTS pre_yytd_vip;
CREATE TABLE IF NOT EXISTS `pre_yytd_vip` (
  `order_id` char(38) NOT NULL,
  `order_status` char(3) NOT NULL,
  `uid` bigint(11) unsigned NOT NULL,
  `username`  varchar(20)  NOT NULL,
  `trade_no` char(50) NOT NULL,
  `group_id` mediumint(9) NOT NULL,
  `group_name` varchar(256) NOT NULL ,
  `extcreditstitle` varchar(256) NOT NULL,
  `extcredits` varchar(256) NOT NULL,
  `price` float(7,2) NOT NULL,
  `expire` char(10) NOT NULL,
  `adddate` int(10) NOT NULL,
  `editdate` int(10) NOT NULL,
  `ip` char(15) NOT NULL,
  `bankname` char(15) NOT NULL,
  UNIQUE KEY `order_id` (`order_id`),
  KEY `adddate` (`adddate`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM;
EOF;
runquery($sql);
$finish = TRUE;
?>