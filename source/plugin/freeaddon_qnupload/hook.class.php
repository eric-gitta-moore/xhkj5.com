<?php
/*
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ')) {
    exit('2017011917wWKY8337Jj');
}

class plugin_freeaddon_qnupload {

}

class plugin_freeaddon_qnupload_forum extends plugin_freeaddon_qnupload {
	function post_middle() {
			global $_G;
			$return = '';
			$splugin_setting = $_G['cache']['plugin']['freeaddon_qnupload'];
			$qn_id = $splugin_setting['qiannaoid'] ? $splugin_setting['qiannaoid'] : 'common';
			$freeaddon_gids = unserialize($splugin_setting['freeaddon_gids']);
			$freeaddon_fids = unserialize($splugin_setting['freeaddon_fids']);
			$qn_returnhead = "http://www.qiannao.com/upload/dzupload.html?return_url=";
			if(CHARSET == 'gbk'){
					$qn_returnurl  = $_G['siteurl']."source/plugin/freeaddon_qnupload/returnurl_gbk.php&userId=$qn_id";
			}else{
					$qn_returnurl  = $_G['siteurl']."source/plugin/freeaddon_qnupload/returnurl.php&userId=$qn_id";
			}
			if(in_array($_G['groupid'], $freeaddon_gids) && in_array($_G['fid'], $freeaddon_fids)){
					include template('freeaddon_qnupload:upload');
			}
			return $return;
	}
}
?>