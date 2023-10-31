<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class ljww360_api {

	function forumdisplay_topBar() {
		global $_G;
		$config = $_G['cache']['plugin']['ljww360'];
		require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
		$return = array();
		$url = WeChatHook::getPluginUrl('ljww360:ljww360',array('mod' => 'tw'));
		$index_url = WeChatHook::getPluginUrl('ljww360');
		$return[] = array(
			'name' => $config['dingbu'],
			'html' => '<a href="'.$index_url.'">'.$config['wsq_1'].'</a><br/><br/><a href="'.$url.'">'.$config['wsq_2'].'</a>',
			'more' => '',
		);
		return $return;
	}

}

?>
