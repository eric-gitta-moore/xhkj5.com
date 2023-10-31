<?php
	if(!defined('IN_DISCUZ')) {
	exit('Access Deined');
}
class mobileplugin_ljww360 {
	function index_top_mobile() {
		global $_G;
		$config = $_G ['cache'] ['plugin'] ['ljww360'];
		if (!file_exists(DISCUZ_ROOT . './source/plugin/ljww360/template/mobile/wenwen.htm')) {
			return;
		}
		if($_GET['mobile']=='1'){
			$xian='<span class="pipe">|</span>';
		}else{
			$xian='&nbsp;&nbsp;&nbsp;';
		}
		return $xian.'<a href="plugin.php?id=ljww360" style="font-size:14px;">'.$config['dingbu'].'</a>';
		
	}
}
class mobileplugin_ljww360_forum extends mobileplugin_ljww360 {
	function post_checkreply_message($param) {
		global $_G;
		if(file_exists(DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php')){
			include DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
		}else if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
			include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
		}
		$config = $_G ['cache'] ['plugin'] ['ljww360'];
		$bkfid = unserialize($config['wenwenbk']);
		$brjl = $config ['brjl'];
		$brjlnum = $config ['brjlnum'];
		$wendajf = 'extcredits' . $config ['wendajf'];
		if ($param ['param'] [0] == "post_reply_succeed") {
			// 某某贴子有新的主题
			$pid = $param ['param'] [2][pid];
			if($config['isforum']){
				if(in_array ($_GET['fid'], $bkfid)){
					//$mes=DB::fetch_first('select * from '.DB::table('forum_post')." where pid=$pid");
					$mes=C::t('forum_post')->fetch('',$pid,1);
					$ljpost=C::t('#ljww360#plugin_lj_post')->fetch_post_by_tuisong_thread($mes['tid']);
					
					if($ljpost){
						DB::insert('plugin_lj_post',array(
							'fid' => $_GET['fid'], 
							'pid' => $pid, 
							'tid' => $mes['tid'], 
							'first' => '0', 
							'author' => $_G['username'], 
							'authorid' => $_G['uid'], 
							'subject' => '', 
							'dateline' => $_G['timestamp'], 
							'message' => $mes['message'], 
							'useip' => $mes['useip'], 
							'invisible' => '0',
							'threadid' =>$ljpost,
						));
						
						C::t('#ljww360#plugin_lj_thread')->fetch_update_by_replies_views($_G['username'], $_G[timestamp],$ljpost);
					}
					$brhdnum = C::t('#ljww360#plugin_lj_post')->fetch_by_brhdnum($_G['uid']);//本日回答数
					if($brhdnum<=$brjlnum){
						updatemembercount($_G[uid], array($config['jljflx'] => $brjl));
					}
				}
			}
		} 
		if ($param ['param'] [0] == "post_newthread_succeed") {
			// 某某版块有新的贴子
			if($config['isforum']){
				if(in_array ($_GET['fid'], $bkfid)){
					$tid = $param ['param'] [2][tid];
					$mes=C::t('#ljww360#plugin_lj_post')->fetch_forum_post_by_tid($tid);
					$price=C::t('forum_thread')->fetch($tid);
					if($config['isspecial']){
						if($price['special']!=3){
							return;
						}
					}
					$catid=$wcache['cfid'][$_GET['fid']];
					$carr=C::t('#ljww360#plugin_ljwenwentype')->fetch($catid);
					if($carr['upid']){
						$catid2=$catid;//二级
					}
					$threadid=DB::insert('plugin_lj_thread',array(
					'tid'=>$tid,
					'fid'=>$_GET['fid'],
					'catid'=>$catid,
					'catid2'=>$catid2,
					'author'=>$_G[username],
					'authorid'=>$_G[uid],
					'price'=>$price['price'],
					'special'=>$price['special'],
					'subject'=>$mes[subject],
					'dateline'=>$_G['timestamp'],
					'lastpost'=>$_G['timestamp'],
					'lastposter'=>$_G[username],
					'displayorder'=>$displayorder,
					'views'=>$price['views'],
					'digest'=>'0',
					'special'=>$special,
					'attachment'=>'2',
					'moderated'=>'0',
					'highlight'=>'0',
					'closed'=>'0',
					'status'=>'32',
					'isgroup'=>'0',
				),true);
					DB::insert('plugin_lj_post',array(
					'fid' => $_GET['fid'], 
					'pid' => $mes[pid], 
					'tid' => $tid, 
					'first' => '1', 
					'author' =>$_G[username], 
					'authorid' => $_G[uid], 
					'subject' => $mes[subject], 
					'dateline' => $_G['timestamp'], 
					'message' => $mes[message], 
					'useip' => $mes[useip], 
					'invisible' => $mes[invisible],
					'threadid' => $threadid,
				));
				}
			}
		}
	} 
}
?>