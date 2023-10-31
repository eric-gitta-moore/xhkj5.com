<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$settingfile = DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
if(file_exists($settingfile)){
	include $settingfile;
}
if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
	$settingfile = DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
	include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
}
echo '<table class="tb tb2 " id="tips">
	<tr>
		<th  class="partition">'.lang('plugin/ljww360','type_1').'</th>
	</tr>
	<tr>
		<td class="tipsblock" s="1">
			<ul id="tipslis">
				<li>'.lang('plugin/ljww360','type_2').'</li>
				<li>'.lang('plugin/ljww360','type_3').'</li>
				<li>'.lang('plugin/ljww360','type_4').'</li>
				<li>'.lang('plugin/ljww360','typeid_14').'</li>
				<li>'.lang('plugin/ljww360','typeid_15').'<a href="tencent://message/?uin=190360183&amp;Site=http://www.isoseo.cn&amp;Menu=yes" class="l"><img src="http://wpa.qq.com/pa?p=1:190360183:4" title="">'.lang('plugin/ljww360','typeid_16').'</a></li>
			</ul>
		</td>
	</tr>
</table><br>';
include template('ljww360:typeid_nav');

			
			
$typearr=C::t('#ljww360#plugin_ljwenwentype')->range();//分类
//问答分类
$fenleiarr = C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid();			
if($_GET['lj'] == 'tid'){
	if(submitcheck('submit')){
		$tids = explode("\r\n", $_GET['tids']);
		$catid2=intval($_GET['id_3']);
		$catid=intval($_GET['catid']);
		if($catid2){
			$catid=$catid2;
		}
		//debug($threadall);displayorder>='0' and closed!=1
		foreach($tids as $k =>$v){
			//$fetch_thread=C::t('forum_thread')->fetch($v);
			$fetch_thread=DB::fetch_first("select * from %t where tid=%d and displayorder>='0' and closed!=1",array('forum_thread',$v));
			if(!$fetch_thread){
				continue;
			}
			$tids_tid[]=$v;
			
			if(C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_by_conuttid($v)){
				
				if($fetch_thread['price']<0){
					$sign=1;
					$best_tids[]=$tid;
				}else{
					$sign=0;
				}
				
				DB::update('plugin_lj_thread', array(
					'tid'=>$v,
					'fid'=>$fetch_thread['fid'],
					'views'=>$fetch_thread['views'],
					'posttableid'=>'0',
					'readperm'=>'0',
					'price'=>$fetch_thread['price'],
					'catid'=>$catid,
					'catid2'=>$catid2,
					'replies'=>$fetch_thread['replies'],
					'author'=>$fetch_thread['author'],
					'authorid'=>$fetch_thread['authorid'],
					'subject'=>$fetch_thread['subject'],
					'dateline'=>$fetch_thread['dateline'],
					'lastpost'=>$fetch_thread['lastpost'],
					'lastposter'=>$fetch_thread['lastposter'],
					'displayorder'=>$fetch_thread['displayorder'],
					'digest'=>'0',
					'special'=>$fetch_thread['special'],
					'attachment'=>'0',
					'moderated'=>'0',
					'highlight'=>'0',
					'closed'=>'0',
					'status'=>'32',
					'sign'=>$sign,
					'isgroup'=>'0',), "tid='$v'");
					$forum_update[]=$v;
					
			}else{
					DB::insert('plugin_lj_thread',array(
						'tid'=>$v,
						'fid'=>$fetch_thread['fid'],
						'views'=>$fetch_thread['views'],
						'posttableid'=>'0',
						'readperm'=>'0',
						'price'=>$fetch_thread['price'],
						'catid'=>$catid,
						'catid2'=>$catid2,
						'replies'=>$fetch_thread['replies'],
						'author'=>$fetch_thread['author'],
						'authorid'=>$fetch_thread['authorid'],
						'subject'=>$fetch_thread['subject'],
						'dateline'=>$fetch_thread['dateline'],
						'lastpost'=>$fetch_thread['lastpost'],
						'lastposter'=>$fetch_thread['lastposter'],
						'displayorder'=>$fetch_thread['displayorder'],
						'digest'=>'0',
						'special'=>$fetch_thread['special'],
						'attachment'=>'0',
						'moderated'=>'0',
						'highlight'=>'0',
						'closed'=>'0',
						'status'=>'32',
						'isgroup'=>'0',
						'sign'=>$sign,
					));
					unset($sign);
					//统计成功数
					$forum_insert[]=$v;
			}
			
		}
		
		$threadall=DB::fetch_all("select * from %t where tid in (".dimplode($tids_tid).")",array('forum_thread'));
		//debug($threadall);
			foreach($threadall as $time){
				$arrtime[$time[dateline]+1]=$time['tid'];
			}
		foreach($tids_tid as $kk=>$vv){
			$post=DB::fetch_all("select * from %t where tid =%d and invisible>='0' ",array('forum_post',$vv));
			if(is_array($post)&&$post){
				foreach($post as $key=>$val){
					$pid=intval($val['pid']);
					if($arrtime[$val['dateline']]==$val['tid']){
						$bestnum=1;
					}else{
						$bestnum=0;
					}
					$threadid=C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_by_conuttid($val['tid']);
					$aa[]=$threadid;
					
					if(!$threadid){
						continue;
					}
					if(C::t('#ljww360#plugin_lj_post')->fetch_forum_post_by_conuttid($pid)){
						DB::update('plugin_lj_post', array(
						'fid' => $val['fid'], 
						'pid' => $val['pid'], 
						'tid' => $val['tid'], 
						'first' => $val['first'], 
						'author' => $val['author'], 
						'authorid' => $val['authorid'], 
						'subject' => $val['subject'], 
						'dateline' => $val['dateline'], 
						'message' => $val['message'], 
						'useip' => $val['useip'], 
						'invisible' => $val['invisible'],
						'bestnum' => $bestnum,
						'threadid' => $threadid,), "pid='$pid'");
						$post_update[]=$pid;
						continue;
					}
					DB::insert('plugin_lj_post',array(
						'fid' => $val['fid'], 
						'pid' => $val['pid'], 
						'tid' => $val['tid'], 
						'first' => $val['first'], 
						'author' => $val['author'], 
						'authorid' => $val['authorid'], 
						'subject' => $val['subject'], 
						'dateline' => $val['dateline'], 
						'message' => $val['message'], 
						'useip' => $val['useip'], 
						'invisible' => $val['invisible'],
						'bestnum' => $bestnum,
						'threadid' => $threadid,
					));
					$post_insert[]=$pid;
					unset($bestnum);
					
				}
				//debug($post_tid_1);
			}
		}
		cpmsg(lang('plugin/ljww360','The_successful_introduction').count($forum_insert).lang('plugin/ljww360','A_update').count($forum_update).lang('plugin/ljww360','ge'), 'action=plugins&operation=config&identifier=ljww360&pmod=typeid&lj=tid', 'succeed', array(), $username_sb);
	}else{
		include template('ljww360:tids');
	}
}else{
if(submitcheck('editsubmit')){
	if(!$_GET['tzdr']||!$_GET['forumpage']||!$_GET['postpage']){
		cpmsg(lang('plugin/ljww360','type_5'));
	}
	$fid=implode(',',$_GET['tzdr']); 
	$catid2=$_GET['id_3'];
	$catid=$_GET['catid'];
	$start=strtotime(daddslashes($_GET['start'])); 
	$end=strtotime(daddslashes($_GET['end'])); 
	//debug($fid);
	$forumpage=daddslashes($_GET['forumpage']); 
	$postpage=daddslashes($_GET['postpage']); 
	$special=intval($_GET['special']); 
	$wcache['post_1']='';
	$wcache['forum']='';
	$wcache['forum_daoru']='';
	$wcache['post_daoru']='';
	$wcache['forum_insert']='';
	$wcache['post_insert']='';
	require_once libfile('function/cache');
	writetocache('wenwen_setting', getcachevars(array('wcache' => $wcache)));//将管理中心配置项写入缓存
	echo "<script>window.location.href='".ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=ljww360&pmod=typeid&fid=$fid&forumpage=$forumpage&postpage=$postpage&ac=daoru&catid=$catid&catid2=$catid2&start=$start&end=$end&special=$special';</script>";
}else if($_GET['fid']&&$_GET['forumpage']&&$_GET['postpage']&&$_GET['ac']=='daoru'){
	$fid=explode(',',$_GET['fid']);
	$catid2=$_GET['catid2'];
	$catid=$_GET['catid'];
	$special=intval($_GET['special']);
	if($catid2){
		$catid=$catid2;
	}
	$start=daddslashes($_GET['start']); 
	$end=daddslashes($_GET['end']);
	//debug($fid);
	//主题总数
	$for_count=C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_count_fid($fid,$start,$end,$special);
	//debug($for_count);
	$forumpage=intval($_GET['forumpage']);
	
	//分页计算
	$forum_per=ceil($for_count/$forumpage);
//判断程序是否执行完毕	
if(!$wcache['forum']){
	//判断分页执行结束
	if($wcache['forum_daoru']+1<=$forum_per){
		$forum_curpage=$wcache['forum_daoru']+1;
		$forum_curnum=($forum_curpage-1)*$forumpage;
		// debug($curnum);
		$thread=C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_all_fid($fid,$forum_curnum,$forumpage,$start,$end,$special);
		//debug($thread);
		if(is_array($thread)&&$thread){
			foreach($thread as $k=>$v){
				$tid=intval($v['tid']);
				$post_tid_1[]=$tid;
				//debug($v['price']<0);
				if($v['price']<0){
					$sign=1;
					$best_tids[]=$tid;
				}else{
					$sign=0;
				}
				//debug(C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_by_conuttid($tid));
				if(C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_by_conuttid($tid)){
					DB::update('plugin_lj_thread', array(
					'tid'=>$tid,
					'fid'=>$v['fid'],
					'views'=>$v['views'],
					'posttableid'=>'0',
					'readperm'=>'0',
					'price'=>$v['price'],
					'catid'=>$catid,
					'catid2'=>$catid2,
					'replies'=>$v['replies'],
					'author'=>$v['author'],
					'authorid'=>$v['authorid'],
					'subject'=>$v['subject'],
					'dateline'=>$v['dateline'],
					'lastpost'=>$v['lastpost'],
					'lastposter'=>$v['lastposter'],
					'displayorder'=>$v['displayorder'],
					'digest'=>'0',
					'special'=>$v['special'],
					'attachment'=>'0',
					'moderated'=>'0',
					'highlight'=>'0',
					'closed'=>'0',
					'status'=>'32',
					'sign'=>$sign,
					'isgroup'=>'0',), "tid='$tid'");
					
					
					$forum_update[]=$tid;
					continue;
				}
				DB::insert('plugin_lj_thread',array(
					'tid'=>$tid,
					'fid'=>$v['fid'],
					'views'=>$v['views'],
					'posttableid'=>'0',
					'readperm'=>'0',
					'price'=>$v['price'],
					'catid'=>$catid,
					'catid2'=>$catid2,
					'replies'=>$v['replies'],
					'author'=>$v['author'],
					'authorid'=>$v['authorid'],
					'subject'=>$v['subject'],
					'dateline'=>$v['dateline'],
					'lastpost'=>$v['lastpost'],
					'lastposter'=>$v['lastposter'],
					'displayorder'=>$v['displayorder'],
					'digest'=>'0',
					'special'=>$v['special'],
					'attachment'=>'0',
					'moderated'=>'0',
					'highlight'=>'0',
					'closed'=>'0',
					'status'=>'32',
					'isgroup'=>'0',
					'sign'=>$sign,
				));
				unset($sign);
				//统计成功数
				$forum_insert[]=$tid;
			}
		}
		$wcache['forum_update']=$wcache['forum_update']+count($forum_update);
		$wcache['forum_insert']=$wcache['forum_insert']+count($forum_insert);
	}else{
		$wcache['forum']=1;
		$wcache['forum_up']=$wcache['forum_update'];
		$wcache['forum_in']=$wcache['forum_insert'];

	}
}
	if($start&&$end){
		$count_tid=C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_all_count_tid($fid,$start,$end);
		foreach($count_tid as $v){
			$post_tid[]=$v['tid'];
		}
	}
	/*if($start&&$end){
		$post_count=C::t('#ljww360#plugin_lj_post')->fetch_forum_post_count_post_tid($post_tid);
	}else{
		$post_count=C::t('#ljww360#plugin_lj_post')->fetch_forum_post_count_fid($fid);	
	}
	if($start&&$end){debug(123);
		$postpage=intval($_GET['forumpage']);
		//分页计算
		$post_per=ceil($for_count/$forumpage);
	}else{
		$postpage=intval($_GET['postpage']); 
		$post_per=ceil($post_count/$postpage);
	}*/
	//debug($post_count);
	$postpage=intval($_GET['forumpage']);
		//分页计算
	$post_per=ceil($for_count/$forumpage);
	
if(!$wcache[post_1]){	//debug($post_1);
	if($wcache['post_daoru']+1<=$post_per){
		$post_curpage=$wcache['post_daoru']+1;
		$post_curnum=($post_curpage-1)*$postpage;
		//debug($post_curnum);
		/*if($start&&$end){
			$post=C::t('#ljww360#plugin_lj_post')->fetch_forum_post_all_post_tid($post_tid_1);
		}else{
			$post=C::t('#ljww360#plugin_lj_post')->fetch_forum_post_all_fid($fid,$post_curnum,$postpage);
		}*/
		
		//$post=C::t('#ljww360#plugin_lj_post')->fetch_forum_post_all_post_tid($post_tid_1);
		$threadall=C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_all_fid($fid,'','',$start,$end,$special);
		foreach($threadall as $time){
			$arrtime[$time[dateline]+1]=$time['tid'];
		}
		//debug($arrtime);
		foreach($post_tid_1 as $p_tid){
			$post=DB::fetch_all("select * from %t where tid =".$p_tid." and invisible>='0' ",array('forum_post'));
			
			
			if(is_array($post)&&$post){
				foreach($post as $key=>$val){
					$pid=intval($val['pid']);
					if($arrtime[$val['dateline']]==$val['tid']){
						$bestnum=1;
					}else{
						$bestnum=0;
					}
					$threadid=C::t('#ljww360#plugin_lj_thread')->fetch_forum_thread_by_conuttid($val['tid']);
					$aa[]=$threadid;
					
					if(!$threadid){
						continue;
					}
					if(C::t('#ljww360#plugin_lj_post')->fetch_forum_post_by_conuttid($pid)){
						DB::update('plugin_lj_post', array(
						'fid' => $val['fid'], 
						'pid' => $val['pid'], 
						'tid' => $val['tid'], 
						'first' => $val['first'], 
						'author' => $val['author'], 
						'authorid' => $val['authorid'], 
						'subject' => $val['subject'], 
						'dateline' => $val['dateline'], 
						'message' => $val['message'], 
						'useip' => $val['useip'], 
						'invisible' => $val['invisible'],
						'bestnum' => $bestnum,
						'threadid' => $threadid,), "pid='$pid'");
						$post_update[]=$pid;
						continue;
					}
					DB::insert('plugin_lj_post',array(
						'fid' => $val['fid'], 
						'pid' => $val['pid'], 
						'tid' => $val['tid'], 
						'first' => $val['first'], 
						'author' => $val['author'], 
						'authorid' => $val['authorid'], 
						'subject' => $val['subject'], 
						'dateline' => $val['dateline'], 
						'message' => $val['message'], 
						'useip' => $val['useip'], 
						'invisible' => $val['invisible'],
						'bestnum' => $bestnum,
						'threadid' => $threadid,
					));
					$post_insert[]=$pid;
					unset($bestnum);
					
				}
				//debug($post_tid_1);
			}
		}
		$wcache['post_update']=$wcache['post_update']+count($post_update);
		$wcache['post_insert']=$wcache['post_insert']+count($post_insert);
	}else{
		$wcache['post_1']=1;
		$wcache['post_in']=$wcache['post_insert'];
		$wcache['post_up']=$wcache['post_update'];
		$wcache['post_insert']='';
		$wcache['post_update']='';
		$wcache['forum_insert']='';
		$wcache['forum_update']='';
	}
}
	$wcache['forum_daoru']=$forum_curpage;
	$wcache['post_daoru']=$post_curpage;
	require_once libfile('function/cache');
	writetocache('wenwen_setting', getcachevars(array('wcache' => $wcache)));//将管理中心配置项写入缓存
	include template ( 'ljww360:daoru' );
}else{
	
	$config = array();
	foreach($pluginvars as $key => $val) {
		$config[$key] = $val['value'];	
	}
	//$_G['cache']['plugin']['ljtuandui'] = $config;
	$pingforumsvalue=dunserialize($comarray[$_GET['comid']]['setoption']['pingforums']);
	$pingforumsvalue = is_array($pingforumsvalue) ? $pingforumsvalue : array();
	require_once libfile('function/forumlist');
	$pingforums = '<select name="tzdr[]" size="10" multiple="multiple"><option value="">'.cplang('plugins_empty').'</option>'.forumselect(FALSE, 0, 0, TRUE).'</select>';		
	foreach($pingforumsvalue as $v) {
		$pingforums = str_replace('<option value="'.$v.'">', '<option value="'.$v.'" selected>', $pingforums);
	}
	
	$fids = unserialize($config['wenwenbk']);
	$tfid=dimplode($fids);
	$forums=C::t('forum_forum')->range();
	include template ( 'ljww360:typeid' );
}
}
?>