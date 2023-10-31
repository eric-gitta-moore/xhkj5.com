<?php
/**
 *	[网站内容自动提交至百度(urlpush.urlpush.inc)] (C)2016-2099 Powered by 安德兔：http://www.andetu.com.
 *	Version: 1.0
 *	Date: 2016-09-12 09:58
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!in_array($_G['groupid'],dunserialize($_G['cache']['plugin']['urlpush']['view_gp']))){
	showmessage(lang('plugin/urlpush', 'no_view_gp'), 'forum.php?mod=viewthread&tid='.intval($_GET['tid']), array(), array('alert'=>'error','showdialog' => 1, 'showmsg' => true, 'locationtime' => true));
}
$thread = DB::fetch_first('SELECT * FROM '.DB::table('forum_thread').' WHERE '.DB::field('tid',intval($_GET['tid'])));
if(!$thread){
	showmessage(lang('plugin/urlpush', 'no_thread'), 'forum.php?mod=viewthread&tid='.intval($_GET['tid']), array(), array('alert'=>'error','showdialog' => 1, 'showmsg' => true, 'locationtime' => true));
}
if(!in_array($thread['fid'],dunserialize($_G['cache']['plugin']['urlpush']['view_fm']))){
	showmessage(lang('plugin/urlpush', 'no_view_fm'), 'forum.php?mod=viewthread&tid='.intval($thread['tid']), array(), array('alert'=>'error','showdialog' => 1, 'showmsg' => true, 'locationtime' => true));
}

if(submitcheck('editsubmit')){
	if(empty($_GET['formhash']) || $_GET['formhash'] != formhash()){
		showmessage(lang('plugin/urlpush', 'hasherror'), 'forum.php?mod=viewthread&tid='.intval($_GET['tid']), array(), array('alert'=>'error','showdialog' => 1, 'showmsg' => true, 'locationtime' => true));
	}
	$urls = array($_GET['urlpush_url']);
	$api = $_G['cache']['plugin']['urlpush']['bdurl'];
	if(function_exists('curl_init') && function_exists('curl_exec')){
		$ch = curl_init();
		$options =  array(
			CURLOPT_URL => $api,
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => implode("\n", $urls),
			CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		$result =   json_decode($result,true);
		DB::insert('andetu_urlpush',array(
				'uid' => $_G['uid'],
				'username' => $_G['member']['username'],
				'tid' => $thread['tid'],
				'fid' => $thread['fid'],
				'dateline' => TIMESTAMP,
				'type' => 'viewthread',
				'message' => $result['message'] ? $result['message'] : '',
				'not_valid' => $result['not_valid'] ? serialize($result['not_valid']) : '',
				'url' => serialize($urls),
				'status' => $result['success'] ? $result['success'] : 0,
		));
		showmessage(lang('plugin/urlpush', 'succ_urlpush_tid'), 'forum.php?mod=viewthread&tid='.$thread['tid'], array(), array('alert'=>'right','showdialog' => 1, 'showmsg' => true, 'locationtime' => true));
	}else{
		showmessage(lang('plugin/urlpush', 'no_curl_init'), 'forum.php?mod=viewthread&tid='.$thread['tid'], array(), array('alert'=>'error','showdialog' => 1, 'showmsg' => true, 'locationtime' => true));
	}
}else{
	include template('urlpush:urlpush');
}