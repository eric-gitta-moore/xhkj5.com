<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_ljww360 {

	
}
class plugin_ljww360_forum extends plugin_ljww360 {
	function viewthread_modaction() {
		global $_G;
		require_once libfile('function/discuzcode');
		include_once libfile('function/editor');
		$config = $_G ['cache'] ['plugin'] ['ljww360'];
		if($config['tuisong']&&$_GET['tid']){
			$tid=intval($_GET['tid']);
			$bu=C::t('#ljww360#plugin_lj_thread')->fetch_thread_by_bc($tid);
			if($bu){
				$bc='<h3><b>&#38382;&#39064;&#34917;&#20805;&#65306;</b></h3>'.$bu;
			}
		}
		return '<style type="text/css">.pl .blockcode{padding-left:30px;}</style>'.discuzcode(html2bbcode(stripslashes($bc)));
	}
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
		
		if ($param ['param'] [0] == "post_edit_succeed") {
			$tid = $param ['param'] [2][tid];
			$pid = $param ['param'] [2][pid];
			$edit=DB::result_first("select count(*) from %t where first=1 and tid=%d",array('plugin_lj_post',$tid));
			
			if($edit){
				if($_GET['subject']){
					$arr[subject]=$_GET['subject'];
				}
				$arr[message]=$_GET['message'];
				DB::update('plugin_lj_post',$arr,array('tid'=>$tid,'pid'=>$pid));
				if($_GET['subject']){
					DB::update('plugin_lj_thread',array('subject'=>$_GET['subject']),'tid='.$tid);
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
					if($wcache['zhitongbu'][$_GET['fid']]){
						if($price['typeid']!=$wcache['zhitongbu'][$_GET['fid']]){
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
		function misc_ljww360(){
			if(addslashes($_GET['action'])=='bestanswer'){
				global $_G;
				$settingfile = DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
				if(file_exists($settingfile)){
					include $settingfile;
				}
				if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
					$settingfile = DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
					include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
				}
				$config = $_G['cache']['plugin']['ljww360'];
				$wendajf='extcredits'.$config['wendajf'];
				$bkfid = unserialize($config['wenwenbk']);
				$zuijiadaan=$config['zuijiadaan'];
				$wwbestanswersubmit = addslashes($_GET['bestanswersubmit']);
				$wwpid = addslashes($_GET['pid']);
				$tid = addslashes($_GET['tid']);
				if ($wwbestanswersubmit == 'yes') {
					$zjwt = C::t('forum_thread')->fetch($tid);
					$wwuid=$zjwt['authorid'];
					$fid=$zjwt['fid'];
					if($config['isforum']){
						if(in_array ($fid, $bkfid)){
							updatemembercount($wwuid , array($wendajf => $zuijiadaan));
							DB::update('plugin_lj_post', array('bestnum'=>1), "pid='$wwpid'");
							DB::update('plugin_lj_thread', array('sign'=>1,'price'=>-$zjwt['price']), "tid='$tid'");
							if($wcache['yijiejue'][$fid]&&C::t('forum_thread')->fetch($tid)){
								DB::update('forum_thread', array('typeid'=>$wcache['yijiejue'][$fid]), "tid='$tid'");
							}
						}
					}
				}
			}
		}
		

}
?>