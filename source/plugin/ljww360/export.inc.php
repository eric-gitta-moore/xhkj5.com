<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($_GET['level'] == 88 && $_G['inajax']){
	$fid = intval($_GET['fid']);
	$query = DB::query('SELECT id, subject FROM '.DB::table('plugin_ljwenwentype').' WHERE  upid= '.$fid);
	$che = DB::result_first('SELECT count(*) FROM '.DB::table('plugin_ljwenwentype').' WHERE  upid= '.$fid);
	include template('common/header_ajax');
	if($che){
	echo <<<EOF
<select name="id_3"  >

EOF;
//echo '<option value="" selected="selected">'.lang('plugin/ljww360','wenwen34').'</option>';
}
	while($group = DB::fetch($query)){
		echo "<option value=\"{$group[id]}\">{$group[subject]}</option>";
	}
	echo '</select>';
	include template('common/footer_ajax');
	exit();
	
}else if($_GET['level'] == 66 && $_G['inajax']){
	$fid = intval($_GET['fid']);
	$catid = intval($_GET['catid']);
	$query = DB::result_first('SELECT threadtypes FROM '.DB::table('forum_forumfield').' WHERE  fid= '.$fid);
	$threadtypes=unserialize($query);
	include template('common/header_ajax');
	if($threadtypes){
echo <<<EOF
<select name="typeid[$catid]"  >
EOF;
	foreach($threadtypes[types] as $k=>$v){
		//debug($group);
		echo "<option value=\"{$k}\">{$v}</option>";
	}
	echo '</select>';
	}
	include template('common/footer_ajax');
	exit();
}
?>