<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ')) {
   exit('2017022614Tx5F8IafFi');
}

class plugin_freeaddon_qqmail {
		function global_cpnav_extra1() {
		    global $_G;
		    $return = '';
		    $splugin_setting = $_G['cache']['plugin']['freeaddon_qqmail'];
		    $return = '<div style="float: left;top: 2px;position: relative;"><a href="'.$splugin_setting['code'].'" target="_blank"><img src="source/plugin/freeaddon_qqmail/images/mail.png"></a></div>';
		    return $return;
		}
}
?>