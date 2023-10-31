<?php
	if (! defined ( 'IN_DISCUZ' )) {
		exit ( 'Access Denied' );
	}

$_G['setting']['switchwidthauto']=0;
$_G['setting']['allowwidthauto']=1;
include_once libfile('function/forum');
include_once libfile('function/post');
include_once libfile('function/editor');
$config = $_G ['cache'] ['plugin'] ['ljww360'];
//判断发布普通问答帖是否扣积分
if($config['putong']){
	$shuoming=str_replace('{jflx}',$_G['setting']['extcredits'][$config['putongjflx']]['title'],$config['shuoming']);
	$shuoming=str_replace('{jfs}',$config['putong'],$shuoming);
}
$bkfid = $config['wenwenbk'];
$grade = $config ['grade'];
$indexasknum = $config ['indexasknum'];
$isxs = $config ['isxs'];
$xsjfz = $config ['xsjfz'];
$xsjfz = explode ( ',', $xsjfz );
$isqz = $config ['isqz'];
$xsgs = $config ['xsgs'];
$tsy = $config ['tsy'];
$isxst = $config ['isxst'];
$istj = $config ['istj'];
$wendajf = 'extcredits' . $config ['wendajf'];
$creditname = $_G['setting']['extcredits'][$config['wendajf']]['title'];
$dingbu = $config ['dingbu'];	
$act=daddslashes($_GET['act']);
$uid=$_G['uid'];	
if(!$_G['uid']){
	showmessage(lang('plugin/ljww360','wenwen1'), '', array(), array('login' => true));
}
if(file_exists(DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php')){
	include DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
}else if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
	include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
}
if($act=='twmsg'){
	$subject=daddslashes($_GET['subject']);
	//判断标题是否存在
	if(!$subject){
		if($_G['mobile']){
			echo "<script>parent.tips('".lang('plugin/ljww360','wt_1')."','');</script>";
			exit;
		}else{
			showerror(lang('plugin/ljww360','wt_1'));
		}
	}
	
	$message=htmlspecialchars_decode(daddslashes(html2bbcode($_GET['content'])));
	
	//判断内容是否存在
	if(!$message){
		if($_G['mobile']){
			echo "<script>parent.tips('".lang('plugin/ljww360','wt_2')."','');</script>";
			exit;
		}else{
			showerror(lang('plugin/ljww360','wt_2'));
		}
	}
	$catid=daddslashes($_GET['catid']);
	if(!$catid){
		if($_G['mobile']){
			echo "<script>parent.tips('".lang('plugin/ljww360','wt_3')."','');</script>";
			exit;
		}else{
			showerror(lang('plugin/ljww360','wt_3'));
		}
	}
	$catid2=daddslashes($_GET['id_3']);
	if($catid2){
		$catid=$catid2;
	}
	
	$fid=$wcache['catid'][$catid];
	$typeid=$wcache['typeid'][$catid];
	//判断问答帖子同步论坛FID是否存在
	if($config['tuisong']){
		if(!$fid){
			if($_G['mobile']){
				echo "<script>parent.tips('".lang('plugin/ljww360','wt_4')."','');</script>";
				exit;
			}else{
				showerror(lang('plugin/ljww360','wt_4'));
			}
		}
	}
	//$jf=DB::result_first("select ".$wendajf." from ".DB::table('common_member_count')." where uid=".$_G['uid']);
	$jf=C::t('common_member_count')->fetch($_G['uid']);
	$coin=daddslashes($_GET['rewardprice']);
	//判断是否强制悬赏
	if($isxs){
		if(!$coin){
			if($_G['mobile']){
				echo "<script>parent.tips('".$tsy."','');</script>";
				exit;
			}else{
				showerror($tsy);
			}
		}
		
	}
	//判断是否为悬赏帖
	if($coin){
		$special=3;
		if($coin>$jf[$wendajf]){
			if($_G['mobile']){
				echo "<script>parent.tips('".$creditname.lang('plugin/ljww360','wenwen3')."','');</script>";
				exit;
			}else{
				showerror($creditname.lang('plugin/ljww360','wenwen3'));
			}
		}
		if($coin<0){
			if($_G['mobile']){
				echo "<script>parent.tips('".$creditname.lang('plugin/ljww360','wenwen3')."','');</script>";
				exit;
			}else{
				showerror($creditname.lang('plugin/ljww360','wenwen3'));
			}
		}
	}else{
		$special=0;
	}
	if($_G['clientip']){
		$x_useip=$_G['clientip'];
	}else{
		$x_useip="202.".rand(96,184).".".rand(124,127).".".rand(9,200);
	}
	//判断问答发帖是否同步到论坛
	if($config['tuisong']){
		$synctid=C::t('forum_thread')->insert(array(
			'fid'=>$fid,
			'posttableid'=>'0',
			'readperm'=>'0',
			'price'=>$coin,
			'typeid'=>$typeid,
			'sortid'=>'0',
			'author'=>$_G[username],
			'authorid'=>$uid,
			'subject'=>stripslashes($subject),
			'dateline'=>$_G['timestamp'],
			'lastpost'=>$_G['timestamp'],
			'lastposter'=>$_G[username],
			'displayorder'=>$displayorder,
			'digest'=>'0',
			'special'=>$special,
			'attachment'=>'0',
			'moderated'=>'0',
			'highlight'=>'0',
			'closed'=>'0',
			'status'=>'32',
			'isgroup'=>'0',
		),true);
		//$tid=$synctid;
		$syncpid = insertpost(array('fid' => $fid,'tid' => $synctid,'first' => '1','author' => $_G[username],'authorid' =>$_G['uid'],'subject' => stripslashes($subject),'dateline' => $_G['timestamp'],'message' => stripslashes($message),'useip' => $x_useip,'invisible' => '0','anonymous' => '0','usesig' => '1','htmlon' => 1,'bbcodeoff' => 0,'smileyoff' => 0,'parseurloff' => '0','attachment' => '2',));
		$pid=$syncpid;
		updatepostcredits('+', $_G['uid'], 'post', $fid);
		$synclastpost = "$synctid\t".addslashes($subject)."\t$_G[timestamp]\t$_G[username]";
		C::t('#ljww360#plugin_forum_forum')->update($synclastpost,$fid);
		$feedcontent = array(
			'tid' => $synctid,
			'content' => $todaysay,
		);
		C::t('forum_threadpreview')->insert($feedcontent);
		$followfeed = array(
			'uid' => $_G['uid'],
			'username' =>$_G[username],
			'tid' => $synctid,
			'note' => '',
			'dateline' => TIMESTAMP
		);
		
		C::t('home_follow_feed')->insert($followfeed, true);
		C::t('common_member_count')->increase($_G['uid'], array('feeds'=>1));
			
		if($coin){
			DB::insert('common_credit_log',array(
						'uid'=>$_G['uid'],	
						'operation'=>'RTC',	
						'relatedid'=>$synctid,	
						'dateline'=>$_G[timestamp],	
						$wendajf=>-$coin,	
					));
		}
	}
	if($coin){
		$xsjf=ceil($coin*$xsgs+$coin);
		updatemembercount($uid , array($wendajf => '-'.$xsjf));
	}

	//问答发帖入库
	$threadid=DB::insert('plugin_lj_thread',array(
				'tid'=>$synctid,
				'fid'=>$fid,
				'posttableid'=>'0',
				'readperm'=>'0',
				'price'=>$coin,
				'catid'=>$catid,
				'catid2'=>$catid2,
				'author'=>$_G[username],
				'authorid'=>$_G[uid],
				'subject'=>stripslashes($subject),
				'dateline'=>$_G[timestamp],
				'lastpost'=>'',
				'lastposter'=>'',
				'displayorder'=>'',
				'digest'=>'0',
				'special'=>$special,
				'attachment'=>'0',
				'moderated'=>'0',
				'highlight'=>'0',
				'closed'=>'0',
				'status'=>'32',
				'isgroup'=>'0',
			),true);
	DB::insert('plugin_lj_post',array(
				'fid' => $fid, 
				'pid' => $pid, 
				'tid' => $synctid, 
				'first' => '1', 
				'author' => $_G[username], 
				'authorid' => $_G[uid], 
				'subject' => stripslashes($subject), 
				'dateline' => $_G[timestamp], 
				'message' => stripslashes($message), 
				'useip' => $x_useip, 
				'invisible' => '0',
				'threadid' => $threadid,
			));
			if($config['putong']&&!$coin){
				$shuoming=str_replace('{jflx}',$_G['setting']['extcredits'][$config['putongjflx']]['title'],$config['shuoming']);
				$shuoming=str_replace('{jfs}',$config['putong'],$shuoming);
				updatemembercount($uid , array($config['putongjflx'] => '-'.$config['putong']));
			}
		if($config['isrewrite']){
			if(!$synctid){
				$synctid=0;
			}
			if($_G['mobile']){
				echo "<script>parent.tips('".lang('plugin/ljww360','wenwen2')."',function(){parent.location.href='answer-".$threadid."-".$synctid.".html';});</script>";
				exit;
			}else{
				echo"<script language='JavaScript'> "; 
				echo"parent.showDialog('".lang('plugin/ljww360','wenwen2')."','right','',function(){parent.location.href='answer-".$threadid."-".$synctid.".html'})"; 
				echo"</script>";
				exit;
			}
		}else{
			if($_G['mobile']){
				echo "<script>parent.tips('".lang('plugin/ljww360','wenwen2')."',function(){parent.location.href='plugin.php?id=ljww360&mod=wtw&wid=$threadid&tid=$synctid';});</script>";
				exit;
			}else{
				echo"<script language='JavaScript'> "; 
				echo"parent.showDialog('".lang('plugin/ljww360','wenwen2')."','right','',function(){parent.location.href='plugin.php?id=ljww360&mod=wtw&wid=$threadid&tid=$synctid'})"; 
				echo"</script>";
				exit;
			}
			
		}
			
}else{
	//允许提问用户组
	if(!in_array($_G['groupid'],unserialize($config['lj_groups']))){
			showmessage($config['lj_tsy']);
	}
	//认证问答发帖权限
	if($config['isverify']){
		$verifys=C::t('common_member_verify')->range();
		$verify_n='verify'.$config['verify'];
		foreach($verifys as $k=>$v){
			if($v[$verify_n]==1){
				$veris[]=$v['uid'];
			}
		}
		
		if(!in_array ($_G['uid'], $veris)){
			showmessage(lang('plugin/ljww360','wt_6'),'home.php?mod=spacecp&ac=profile&op=verify&vid='.$cofig['verify']);
		}
	}
	//本人积分数
	$brenmyarr = getuserprofile($wendajf);
	//$brenmyarr = C::t('#ljww360#plugin_lj_post')->fetch_common_join_count($wendajf,$_G['uid']);
	//问答分类
	$fenlei = C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid();
	//判断悬赏是否开启
	if($isxs){
		$mrz=1;
	}
	//SEO信息
	$title = $config ['title'];
	$keywords = $config ['keywords'];
	$description = $config ['description'];
	$navtitle = lang('plugin/ljww360','wt_5').$title;
	$metakeywords = $keywords;
	$metadescription = $description;
	include template ( 'ljww360:twmsg' );
}
function showerror($msg){
	include template('ljww360:showerror');
	exit;
}
	
?>