<?php
/**
 *	[网站内容自动提交至百度(urlpush.admin_push)] (C)2016-2099 Powered by 安德兔：http://www.andetu.com.
 *	Version: 1.0
 *	Date: 2016-09-12 09:58
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if($_GET['edit_id']){
	if(empty($_GET['formhash']) || $_GET['formhash'] != formhash()){
		cpmsg(lang('plugin/urlpush', 'hasherror') , 'action=plugins&operation=config&identifier=urlpush&pmod=admin_push', 'error');
	}
	$edit = DB::fetch_first('SELECT * FROM '.DB::table('andetu_urlpush').' WHERE '.DB::field('id',intval($_GET['edit_id'])));
	if($_GET['managedo'] == 'delete'){
		DB::delete('andetu_urlpush',array('id'=>$edit['id']));
		cpmsg(lang('plugin/urlpush', 'admin_delete_succ'), 'action=plugins&operation=config&identifier=urlpush&pmod=admin_push', 'succeed');exit;
	}
}

$limit = 100;
$page = max(1, intval($_GET['page']));
$start = ($page-1)*$limit;

$editlist = $tids = $thread = array();
foreach(DB::fetch_all('SELECT * FROM '.DB::table('andetu_urlpush').' ORDER BY '.DB::order('id','desc').DB::limit($start,$limit)) as $data){
	if(!in_array($data['tid'],$tids)){
		$tids[] = $data['tid'];
	}
	$data['dateline'] = date('Y-m-d H:i',$data['dateline']);
	$data['url'] = dunserialize($data['url']);
	$data['not_same_site'] = dunserialize($data['not_same_site']);
	$data['not_valid'] = dunserialize($data['not_valid']);
	$editlist[] = $data;
}
if($tids){
	foreach(DB::fetch_all('SELECT tid,subject FROM '.DB::table('forum_thread').' WHERE '.DB::field('tid',$tids,'in')) as $data){
		$thread[$data['tid']] = $data['subject'];
	}
}
$count = DB::result_first('SELECT count(*) FROM '.DB::table('andetu_urlpush'));
$multi = multi($count, $limit, $page, 'admin.php?action=plugins&operation=config&do=$pluginid&identifier=urlpush&pmod=admin_push');
include template('urlpush:admin_push');
?>