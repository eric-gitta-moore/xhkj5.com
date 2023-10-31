<?php
/**
 *	[网站内容自动提交至百度(urlpush.admin_push_all)] (C)2016-2099 Powered by 安德兔：http://www.andetu.com.
 *	Version: 1.0
 *	Date: 2016-09-12 09:58
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
loadcache('plugin');
if(submitcheck('editsubmit')) {
	if(empty($_GET['formhash']) || $_GET['formhash'] != formhash()){
		cpmsg(lang('plugin/urlpush', 'hasherror') , 'action=plugins&operation=config&identifier=urlpush&pmod=admin_push_all', 'error');
	}
	$urls = explode(PHP_EOL, $_GET['urllist']);
	if(function_exists('curl_init') && function_exists('curl_exec')){
		$ch = curl_init();
		$options =  array(
			CURLOPT_URL => $_G['cache']['plugin']['urlpush']['bdurl'],
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => implode("\n", $urls),
			CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		$result = json_decode($result,true);
		$success_urls = $error_urls = array();
		foreach ($urls as $url) {
			if(in_array($url,$result['not_same_site'])){
				$error_urls[] = $url;
			}else if(in_array($url,$result['not_valid'])){
				$error_urls[] = $url;
			}else{
				$success_urls[] = $url;
			}
		}
		DB::insert('andetu_urlpush',array(
				'uid' => $_G['uid'],
				'username' => $_G['member']['username'],
				'tid' => $thread['tid'],
				'fid' => $thread['fid'],
				'dateline' => TIMESTAMP,
				'type' => 'viewthread',
				'message' => $result['message'] ? $result['message'] : '',
				'not_valid' => serialize($error_urls),
				'url' => serialize($success_urls),
				'status' => $result['success'] ? $result['success'] : 0,
		));
		cpmsg(lang('plugin/urlpush', 'admin_push_all_succ'), 'action=plugins&operation=config&identifier=urlpush&pmod=admin_push_all', 'succeed');
	}else{
		cpmsg(lang('plugin/urlpush', 'no_curl_init'), 'action=plugins&operation=config&identifier=urlpush&pmod=admin_push_all', 'error');
	}
}
include template('urlpush:admin_push_all');
?>