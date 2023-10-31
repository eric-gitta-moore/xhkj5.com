<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
echo '<table class="tb tb2 " id="tips">
	<tr>
		<th  class="partition">'.lang('plugin/ljww360','yijiejue_1').'</th>
	</tr>
	<tr>
		<td class="tipsblock" s="1">
			<ul id="tipslis">
				<li>'.lang('plugin/ljww360','yijiejue_2').'</li>
				<li>'.lang('plugin/ljww360','yijiejue_3').'</li>
				<li>'.lang('plugin/ljww360','yijiejue_4').'</li>
			</ul>
		</td>
	</tr>
</table><br>';
if(file_exists(DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php')){
	include DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
}else if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
	include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
}
if(submitcheck('editsubmit')){
	$td_class=daddslashes($_GET['td_class']);
	$tr_class=daddslashes($_GET['tr_class']);
	$wcache['yijiejue']=$td_class;
	$wcache['zhitongbu']=$tr_class;
	require_once './source/function/function_cache.php';
	writetocache('wenwen_setting', getcachevars(array('wcache' => $wcache)));  
	cpmsg(lang('plugin/ljww360','yijiejue_5'),'action=plugins&operation=config&identifier=ljww360&pmod=yijiejue');
}
$config = array();
foreach($pluginvars as $key => $val) {

	$config[$key] = $val['value'];
	
}
$_G['cache']['plugin']['ljww360'] = $config;
$fids = $config['wenwenbk'];
$fids = unserialize ($fids);
$tfid=dimplode($fids);
//debug($fids);

$fidtype=$wcache['yijiejue'];
$typefid=$wcache['zhitongbu'];
$query=DB::query("select fid,threadtypes from ".DB::table('forum_forumfield')." where fid in ($tfid)");

while($arr=DB::fetch($query)){
	$typeids[$arr[fid]]=unserialize($arr[threadtypes]);
}
//debug($typeids);
$query=DB::query("select fid,name from ".DB::table('forum_forum'));

while($arr=DB::fetch($query)){
	$forums[$arr[fid]]=$arr[name];
}
include template ( 'ljww360:yijiejue' );
?>