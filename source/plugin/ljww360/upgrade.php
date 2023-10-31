<?php
/*
	Install Uninstall Upgrade AutoStat System Code
*/
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sql ="ALTER TABLE ".DB::table('plugin_lj_thread')." ADD `qrcode` varchar(255) NOT NULL ;" ;
DB::query($sql,'SILENT');
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_plugin_ljwenwen_ts` (
  `wid` int(11) NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `subject` varchar(255)  NOT NULL,
  `lunzhuan` int(11) NOT NULL,
  `ziti` int(11) NOT NULL,
  `src` varchar(255)  NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY  (`wid`)
)
EOF;
runquery($sql);
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_plugin_lj_thread` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `fid` mediumint(8) unsigned NOT NULL default '0',
  `posttableid` smallint(6) unsigned NOT NULL default '0',
  `catid` smallint(6) unsigned NOT NULL default '0',
  `catid2` smallint(6) unsigned NOT NULL default '0',
  `readperm` tinyint(3) unsigned NOT NULL default '0',
  `price` smallint(6) NOT NULL default '0',
  `author` char(15)  NOT NULL,
  `authorid` mediumint(8) unsigned NOT NULL default '0',
  `subject` char(80)  NOT NULL,
  `dateline` int(10) unsigned NOT NULL default '0',
  `lastpost` int(10) unsigned NOT NULL default '0',
  `lastposter` char(15)  NOT NULL,
  `views` int(10) unsigned NOT NULL default '0',
  `replies` mediumint(8) unsigned NOT NULL default '0',
  `displayorder` tinyint(1) NOT NULL default '0',
  `highlight` tinyint(1) NOT NULL default '0',
  `digest` tinyint(1) NOT NULL default '0',
  `rate` tinyint(1) NOT NULL default '0',
  `special` tinyint(1) NOT NULL default '0',
  `attachment` tinyint(1) NOT NULL default '0',
  `moderated` tinyint(1) NOT NULL default '0',
  `closed` mediumint(8) unsigned NOT NULL default '0',
  `stickreply` tinyint(1) unsigned NOT NULL default '0',
  `recommends` smallint(6) NOT NULL default '0',
  `recommend_add` smallint(6) NOT NULL default '0',
  `recommend_sub` smallint(6) NOT NULL default '0',
  `heats` int(10) unsigned NOT NULL default '0',
  `status` smallint(6) unsigned NOT NULL default '0',
  `isgroup` tinyint(1) NOT NULL default '0',
  `favtimes` mediumint(8) NOT NULL default '0',
  `sharetimes` mediumint(8) NOT NULL default '0',
  `stamp` tinyint(3) NOT NULL default '-1',
  `icon` tinyint(3) NOT NULL default '-1',
  `pushedaid` mediumint(8) NOT NULL default '0',
  `cover` smallint(6) NOT NULL default '0',
  `replycredit` smallint(6) NOT NULL default '0',
  `relatebytag` char(255)  NOT NULL default '0',
  `maxposition` int(8) unsigned NOT NULL default '0',
  `bgcolor` char(8)  NOT NULL,
  `comments` int(10) unsigned NOT NULL default '0',
  `tid` int(11) NOT NULL,
  `sign` int(11) NOT NULL,
  `bc` mediumtext  NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `digest` (`digest`),
  KEY `sortid` (`catid2`),
  KEY `displayorder` (`fid`,`displayorder`,`lastpost`),
  KEY `typeid` (`fid`,`catid`,`displayorder`,`lastpost`),
  KEY `recommends` (`recommends`),
  KEY `heats` (`heats`),
  KEY `authorid` (`authorid`),
  KEY `isgroup` (`isgroup`,`lastpost`),
  KEY `special` (`special`)
)
EOF;
runquery($sql);

//finish to put your own code
//start to put your own code 
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_plugin_lj_post` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `first` int(11) NOT NULL,
  `author` varchar(100)  NOT NULL,
  `authorid` int(11) NOT NULL,
  `subject` mediumtext  NOT NULL,
  `dateline` bigint(20) NOT NULL,
  `message` mediumtext  NOT NULL,
  `useip` varchar(15)  NOT NULL,
  `invisible` tinyint(1) NOT NULL,
  `bestnum` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `sign` int(11) NOT NULL,
  `jifen` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `threadid` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
)
EOF;
runquery($sql);
if(file_exists( DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php')&&file_exists( DISCUZ_ROOT . './source/plugin/ljww360/template/touch/wenwen.htm')){
	$pluginid = 'ljww360';
	$Hooks = array(
		'forumdisplay_topBar',
	);
	$data = array();
	foreach ($Hooks as $Hook) {
		$data[] = array($Hook => array('plugin' => $pluginid, 'include' => 'api.class.php', 'class' => $pluginid . '_api', 'method' => $Hook));
	}
	require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
	WeChatHook::updateAPIHook($data);
}
//finish to put your own code
$finish = TRUE;
?>