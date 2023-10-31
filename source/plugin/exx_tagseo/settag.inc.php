<?php
if (! defined ('IN_DISCUZ')) {
	exit ('Access Denied');
}
	global $_G;
	$exx_tagseo = $_G['cache']['plugin']['exx_tagseo'];	
	$tid=intval($_GET['tid']);
	
	if($_GET['formhash']!=FORMHASH)return;
	include_once DISCUZ_ROOT.'./source/plugin/exx_tagseo/fun.inc.php';
	
	$group = empty($exx_tagseo['yhz']) ? array() : unserialize($exx_tagseo['yhz']);
	if(!(empty($group[0]) || in_array($_G['groupid'],$group))){
		return;
	}
	
	$postdata=DB::fetch_first("select * from ".DB::table('forum_post')." where tid=".$tid." AND first=1");

	if($postdata && empty($postdata['tags'])){
		require_once libfile('function/post');
		$message=strip_tags($thread['message']);
		$msg=messagecutstr($message, 500);
		getmode($tid,$postdata['pid'],$postdata['subject'],$msg);
	}
	

	