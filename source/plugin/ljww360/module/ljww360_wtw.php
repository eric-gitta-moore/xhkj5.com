<?php
	if (! defined ( 'IN_DISCUZ' )) {
		exit ( 'Access Denied' );
	}
require_once libfile('function/discuzcode');
include_once libfile ('function/forum');
include_once libfile('function/post');
include_once libfile('function/editor');
include_once DISCUZ_ROOT . './source/plugin/ljww360/wenwenfuc.php';
$settingfile = DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
if(file_exists($settingfile)){
	include $settingfile;
}
if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
	$settingfile = DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
	include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
}
$config = $_G ['cache'] ['plugin'] ['ljww360'];
$bkfid = $config['wenwenbk'];
$dingbu = $config ['dingbu'];
$grade = $config ['grade'];
$wendajf = 'extcredits' . $config ['wendajf'];
$creditname = $_G['setting']['extcredits'][$config['wendajf']]['title'];
$title = $config ['title'];
$brjl = $config ['brjl'];
$isxst = $config ['isxst'];
$brjlnum = $config ['brjlnum'];
$keywords = $config ['keywords'];
$description = $config ['description'];
$zuijiadaan=$config['zuijiadaan'];
if($_GET['uid']){
	$uid=$_GET['uid'];
}else{
	$uid=$_G['uid'];
}
$gradearr=wenwendj($uid);
$dj=$gradearr[0];
$cha=$gradearr[1];
$action=$_GET['action'];
$myaction=$_GET['myaction'];
//$brenmyarr = C::t('#ljww360#plugin_lj_post')->fetch_common_join_count($wendajf,$uid);
$brenmyarr_1 = getuserprofile($wendajf);
//debug($brenmyarr);
$brentid=C::t('#ljww360#plugin_lj_post')->fetch_by_count_brenfirst($_G['uid']);
$brenbest=C::t('#ljww360#plugin_lj_post')->fetch_by_count_brenbestnum($_G['uid']);
$brennum=C::t('#ljww360#plugin_lj_post')->fetch_by_count_bren($_G['uid']);

$brencainalv = round ( ($brenbest / $brennum) * 100 ) . '%';
$typearr=C::t('#ljww360#plugin_ljwenwentype')->range();//分类
//....
if($action=='ask'||$myaction=='yi'||$myaction=='dai'){//我提问
	if(!$_G['uid']){
		showmessage(lang('plugin/ljww360','wenwen1'), '', array(), array('login' => true));
	}
	if($myaction=='yi'){
		$q=2;
		$con=" sign=1";
		if($config['isrewrite']){
			$daohang='<a href="my-ask.html">'.lang('plugin/ljww360','mydj3').lang('plugin/ljww360','wtw9').'</a>';
		}else{
			$daohang='<a href="plugin.php?id=ljww360&mod=wtw&action=ask">'.lang('plugin/ljww360','mydj3').lang('plugin/ljww360','wtw9').'</a>';
		}
		
	}else{
		$q=1;
		$con=" sign!=1";
		if($config['isrewrite']){
			$daohang='<a href="my-ask.html">'.lang('plugin/ljww360','mydj3').lang('plugin/ljww360','wtw10').'</a>';
		}else{
			$daohang='<a href="plugin.php?id=ljww360&mod=wtw&action=ask">'.lang('plugin/ljww360','mydj3').lang('plugin/ljww360','wtw10').'</a>';
		}
		
	}
	$djarr=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_gerendj($con,$uid);//未解决
	foreach($djarr as $k=>$v){
		$djarr[$k]['dateline']=date('Y-m-d H:i:s',$v['dateline']);
	}
	$navtitle = lang('plugin/ljww360','mydj3').$title;
	$metakeywords = $keywords;
	$metadescription = $description;
	include template ( 'ljww360:wtw' );
}else if($action=='whd'||$myaction=='all'||$myaction=='best'){//我回答
	if(!$_G['uid']){
		showmessage(lang('plugin/ljww360','wenwen1'), '', array(), array('login' => true));
	}
	if($config['isrewrite']){
		$daohang='<a href="my-whd.html">'.lang('plugin/ljww360','wtw11').'</a>';
	}else{
		$daohang='<a href="plugin.php?id=ljww360&mod=wtw&action=whd">'.lang('plugin/ljww360','wtw11').'</a>';
	}
	
	if($myaction=='best'){
		$allarr=C::t('#ljww360#plugin_lj_post')->fetch_post_all_bestnum($_G[uid]);
		if($allarr){
			foreach($allarr as $kk=>$vv){
				$pidss .= $vv ['threadid'] . ',';
			}
			$pid = explode ( ',', $pidss );
			$pid = array_unique ( $pid );
			$pid = array_filter($pid);
			$pid = dimplode ( $pid );
			//debug($pid);
			$whdall = C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_cn($pid);
			$q=2;
		}
	}else{
		$threadids=C::t('#ljww360#plugin_lj_post')->fetch_post_all_threadid($uid);
		foreach($threadids as $kk=>$vv){
				$ids .= $vv ['threadid'] . ',';
			}
		$ids = explode ( ',', $ids );
		$ids = array_unique ( $ids );
		$ids = array_filter($ids);
		$ids = dimplode ( $ids );
		$q=1;
		$whdall = C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_cn($ids);//我回答
	}
	//debug($whdall);
	$navtitle = lang('plugin/ljww360','mydj4').$title;
	$metakeywords = $keywords;
	$metadescription = $description;
	include template ( 'ljww360:whd' );
}else if($action=='sy'){//首页
	if(!$_G['uid']){
		showmessage(lang('plugin/ljww360','wenwen1'), '', array(), array('login' => true));
	}
	$brentw=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_conn("where authorid=$uid and displayorder<>-1 and displayorder<>-2 and displayorder<>-3 and displayorder<>-4 order by id desc",0,10);//我提问
	$threadids=DB::fetch_all("select threadid from " . DB::table ( 'plugin_lj_post' )." where first!=1 and authorid=$uid ");
	foreach($threadids as $kk=>$vv){
			$ids .= $vv ['threadid'] . ',';
		}
		$ids = explode ( ',', $ids );
		$ids = array_unique ( $ids );
		$ids = array_filter($ids);
		$ids = dimplode ( $ids );
	$whdall = C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_cn($ids);//我回答
	if($config['isrewrite']){
		$daohang='<a href="my-sy.html">'.lang('plugin/ljww360','wtw12').'</a>';
	}else{
		$daohang='<a href="plugin.php?id=ljww360&mod=wtw&action=sy">'.lang('plugin/ljww360','wtw12').'</a>';
	}
	$navtitle = lang('plugin/ljww360','myindex8').$title;
	$metakeywords = $keywords;
	$metadescription = $description;
	include template ( 'ljww360:myindex' );
}else if($action=='jf'){//积分
	if(!$_G['uid']){
		showmessage(lang('plugin/ljww360','wenwen1'), '', array(), array('login' => true));
	}
	if($config['isrewrite']){
		$daohang='<a href="my-jf.html">'.lang('plugin/ljww360','wtw13').$creditname.'</a>';
	}else{
		$daohang='<a href="plugin.php?id=ljww360&mod=wtw&action=jf">'.lang('plugin/ljww360','wtw13').$creditname.'</a>';
	}
	$navtitle = lang('plugin/ljww360','myindex8').$title;
	$metakeywords = $keywords;
	$metadescription = $description;
	include template ( 'ljww360:myjf' );
}else if($action=='del'){//删除
	$tid=intval($_GET['tid']);
	$id=intval($_GET['wid']);
	if($id){
		C::t('#ljww360#plugin_lj_thread')->delete($id);
		C::t('#ljww360#plugin_lj_post')->fetch_by_del($id);
		if($config['tuisong']){
			DB::update('forum_post', array('invisible'=>'-1'), "tid='$tid'");
			DB::update('forum_thread', array('displayorder'=>'-1'), "tid='$tid'");
		}
		
	}
	if($config['isrewrite']){
		showmessage(lang('plugin/ljww360','wwtype1'),'answer.html');
	}else{
		showmessage(lang('plugin/ljww360','wwtype1'),'plugin.php?id=ljww360');
	}
}else if($action=='tsmsg'){//推送
	if($_GET['formhash']==formhash()){
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		include template ( 'ljww360:tsmsg' );
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='msgts'){//推送
	if(submitcheck('submit')){
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		
		//判断是否为论坛帖
		 if($tid){
			 $pida = C::t('#ljww360#plugin_lj_post')->fetch_by_forum_post_pid($tid);
			 $tableid = C::t('#ljww360#plugin_lj_post')->fetch_by_forum_attachment_tableid($tid);
			 $marr=C::t('forum_post')->fetch('',$pida);
			 $message=$marr['message'];
		 }else{
			 $marr=C::t('#ljww360#plugin_lj_post')->fetch_post_by_bianji_threadid($id);
			 $message=$marr['message'];
		 }
		 //判断帖子是否有图片
		
		if($_GET['big1']||$_GET['big2']||$_GET['big3']){
			 if($tableid||$tableid==='0'){
				 $table='forum_attachment_'.$tableid;
				 $img = C::t('#ljww360#plugin_lj_post')->fetch_by_forum_attachment_x($tid,$pida,$table);
				 foreach($img as $key=>$value){
					if($value[isimage]){
						$tssrc=$_G['setting']['attachurl'].'forum/'.$value['attachment'];
						break;
					 }else{
						$tssrc=$_G['siteurl'].'forum.php?mod=attachment&aid='.base64_encode($value['aid']).']'.$value['filename'];
						break;
					 }
				 }
			 }else{
				preg_match_all("/\[img\]\s*([^\[\<\r\n]+?)\s*\[\/img\]|\[img=\d{1,4}[x|\,]\d{1,4}\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/is",
				$message, $image1, PREG_SET_ORDER);
				if(count($image1)==1){
					$tssrc=$image1[0][1];
				}else{
					if($image1[0][1]){
						$tssrc=$image1[0][1];
					}else{
						$tssrc=$image1[0][2];
					}
				}
			 }
			// debug($tssrc);
			 if(!$tssrc){
				showmessage(lang('plugin/ljww360','wtw24'));
			 }
		}
		if($_GET['big1']||$_GET['small1']){
			$lunzhuan=1;
			if($_GET['big1']){
				$ziti=1;//大字体
			}else{
				$ziti=2;//小字体
			}
		}else if($_GET['big2']||$_GET['small2']){
			$lunzhuan=2;
			if($_GET['big2']){
				$ziti=1;//大字体
			}else{
				$ziti=2;//小字体
			}
		}else if($_GET['big3']||$_GET['small3']){
			$lunzhuan=3;
			if($_GET['big3']){
				$ziti=1;//大字体
			}else{
				$ziti=2;//小字体
			}
		}
		 DB::insert('plugin_ljwenwen_ts',array(
			 'tid'=>$tid,
			 'timestamp'=>$_G['timestamp'],
			 'subject'=>$marr['subject'],
			 'lunzhuan'=>$lunzhuan,
			 'ziti'=>$ziti,
			 'src'=>$tssrc,
			 'id'=>$id,
		 ));
		// debug($tssrc);
		if($config['isrewrite']){
			showmessage(lang('plugin/ljww360','wtw25'),"answer-".$id."-".$tid.".html");
		}else{
			showmessage(lang('plugin/ljww360','wtw25'),"plugin.php?id=ljww360&mod=wtw&tid=$tid&wid=$id");
		}
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='bc'){//问题补充弹
	if($_GET['formhash']==formhash()){
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		$bc=C::t('#ljww360#plugin_lj_thread')->fetch($id);
		$bu=$bc['bc'];
		include template ( 'ljww360:bcmsg' );
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='bcmsg'){//问题补充
	if(submitcheck('submit')){
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		$message=daddslashes($_GET['message']);
		
		if(!$message){
			showmessage(lang('plugin/ljww360','wtw22'));
		}
		DB::update('plugin_lj_thread', array('bc'=>$message), "id='$id'");
		if($config['isrewrite']){
			showmessage(lang('plugin/ljww360','wtw6'),"answer-".$id."-".$tid.".html");
		}else{
			showmessage(lang('plugin/ljww360','wtw6'),"plugin.php?id=ljww360&mod=wtw&tid=$tid&wid=$id");
		}
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='zjxs'){//追加悬赏弹
	if($_GET['formhash']==formhash()){
		$zjysy = str_replace('{xssl}',$config ['xsgs'],$config ['zjysy']);
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		$price=C::t('#ljww360#plugin_lj_thread')->fetch($id);
		$price=$price['price'];
		//$price=DB::result_first(" select price from ".DB::table('plugin_lj_thread')." where id='$id'");
		if($brenmyarr_1<1){
			showmessage($creditname.lang('plugin/ljww360','wenwen3'));
		}
		include template ( 'ljww360:zjxsmsg' );
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='zjxsmsg'){//追加悬赏
	if(submitcheck('submit')){
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		$coin=intval($_GET['coin']);
		if($coin>$brenmyarr_1 || $coin < 0){
			showmessage($creditname.lang('plugin/ljww360','wenwen3'));
		}
		$xsjf=ceil($coin*$config ['xsgs']+$coin);
		updatemembercount($_G['uid'] , array($wendajf => -$xsjf));
		$price=C::t('#ljww360#plugin_lj_thread')->fetch($id);
		$price=$price['price'];
		$zong=$coin+$price;
		DB::update('plugin_lj_thread', array('price'=>$zong), "id='$id'");
		if($tid){
			$che=C::t('#ljww360#plugin_lj_thread')->fetch_common_credit_log($tid);
			if(!$che){
				DB::insert('common_credit_log',array(
					'uid'=>$uid,	
					'operation'=>'RAC',	
					'relatedid'=>$tid,	
					'dateline'=>$_G[timestamp],	
					$wendajf=>$price,	
				));
			}
			$special=C::t('forum_thread')->fetch($tid);
			if($special=='3'){
				DB::update('forum_thread', array('price'=>$zong), "tid='$tid'");
			}else{
				DB::update('forum_thread', array('price'=>$zong,'special'=>'3'), "tid='$tid'");
			}
			
		}
		if($config['isrewrite']){
			showmessage(lang('plugin/ljww360','wtw6'),"answer-".$id."-".$tid.".html");
		}else{
			showmessage(lang('plugin/ljww360','wtw6'),"plugin.php?id=ljww360&mod=wtw&tid=$tid&wid=$id");
		}
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='msgpl'){//修改分类弹窗
	if($_GET['formhash']==formhash()){
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		$fenlei = C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid();
		include template ( 'ljww360:msgpl' );
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='plsubject'){//修改分类
	if(submitcheck('submit')){
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		$catid=intval($_GET['catid']);
		if(!$catid){
			showmessage(lang('plugin/ljww360','wt_3'));
		}
		$catid2=intval($_GET['id_3']);
		if($catid2){
			$catid=$catid2;
		}
		DB::update('plugin_lj_thread', array('catid'=>$catid,'catid2'=>$catid2), "id='$id'");
		if($config['isrewrite']){
			showmessage(lang('plugin/ljww360','wtw5'),"answer-".$id."-".$tid.".html");
		}else{
			showmessage(lang('plugin/ljww360','wtw5'),"plugin.php?id=ljww360&mod=wtw&wid=$id&tid=$tid");
		}
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='msgbj'){//编辑问题
	if($_GET['formhash']==formhash()){
		$tid=intval($_GET['tid']);
		$id=intval($_GET['wid']);
		$bianji=C::t('#ljww360#plugin_lj_post')->fetch_post_by_bianji_threadid($id);
		//$bianji=DB::fetch_first('select * from '.DB::table('plugin_lj_post')." where first=1 and threadid=$id");
		//$bianji['message']=discuzcode($bianji['message']);
		include template ( 'ljww360:bianjimsg' );
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='msgbianji'){//编辑提交
	if(submitcheck('submit')){
		$tid=intval($_GET['tid']);
		$message=daddslashes($_GET['message']);
		if(!$message){
			showmessage(lang('plugin/ljww360','wt_2'));
		}
		$subject=daddslashes($_GET['subject']);
		if(!$subject){
			showmessage(lang('plugin/ljww360','wt_1'));
		}
		if($tid){
			DB::update('forum_thread', array('subject'=>stripslashes($subject)), "tid='$tid'");
			DB::update('forum_post', array('subject'=>stripslashes($subject),'message'=>stripslashes($message)), array('tid'=>$tid,'first'=>1));
		}
		$id=intval($_GET['wid']);
		if($id){
			DB::update('plugin_lj_thread', array('subject'=>stripslashes($subject)), "id='$id'");
			DB::update('plugin_lj_post', array('subject'=>stripslashes($subject),'message'=>stripslashes($message)), array('threadid'=>$id,'first'=>1));
		}
		if($config['isrewrite']){
			showmessage(lang('plugin/ljww360','wtw15'),"answer-".$id."-".$tid.".html");
		}else{
			showmessage(lang('plugin/ljww360','wtw15'),"plugin.php?id=ljww360&mod=wtw&wid=$id&tid=$tid");
		}
	}else{
		showmessage(lang('plugin/ljww360','wtw21'));
	}
}else if($action=='dj'){
	//等级
	$gg=explode("\r\n",$grade);
	foreach($gg as $k=>$zk){
		$ggarr[]=explode("=",$zk);
	}
	foreach($ggarr as $k=>$v){
		$arrgg[$v[0]]=$v[1];
	}
	if($config['isrewrite']){
		$daohang='<a href="my-dj.html">'.lang('plugin/ljww360','wtw14').'</a>';
	}else{
		$daohang='<a href="plugin.php?id=ljww360&mod=wtw&action=dj">'.lang('plugin/ljww360','wtw14').'</a>';
	}
	
	$navtitle = lang('plugin/ljww360','mydj5').$title;
	$metakeywords = $keywords;
	$metadescription = $description;
	include template ( 'ljww360:mydj' );
}else if($_GET['ht']=='ask'){
		if($_GET['formhash']==formhash()){
			$tid=intval($_GET['tid']);
			$fid=intval($_GET['fid']);
			$pid=intval($_GET['pid']);
			$id=intval($_GET['wid']);
			$postid=intval($_GET['postid']);
			include template ( 'ljww360:askmsg' );
		}else{
			showmessage(lang('plugin/ljww360','wtw21'));
		}
}else if($action=='best'){//最佳答案已解决
		if($_GET['formhash']==formhash()){
			$tid=intval($_GET['tid']);
			$fid=intval($_GET['fid']);
			$uid=intval($_GET['uid']);
			$price=intval($_GET['price']);
			$special=intval($_GET['special']);
			$pid=intval($_GET['pid']);
			$id=intval($_GET['wid']);
			$postid=intval($_GET['postid']);
			$che=C::t('#ljww360#plugin_lj_thread')->fetch_common_credit_log($tid);
			DB::update('plugin_lj_post', array('bestnum'=>1), "id='$postid'");
			DB::update('plugin_lj_thread', array('sign'=>1,'price'=>-$price), "id='$id'");
			if($special=='3'){
				updatemembercount($uid , array($wendajf => $price+$config['zuijiadaan']));
			}else{
				updatemembercount($uid , array($wendajf => $config['zuijiadaan']));
			}
			
			$hsubject=C::t('#ljww360#plugin_lj_thread')->fetch($id);
			$hfr=C::t('#ljww360#plugin_lj_post')->fetch($postid);
			$notification = lang('plugin/ljww360','wtw16')."<a target=\"_blank\" href=\"plugin.php?id=ljww360&mod=wtw&wid=".$id."&tid=".$tid."\">".$hsubject['subject']."</a>".lang('plugin/ljww360','wtw17')."<a href=\"home.php?mod=space&uid=".$hsubject[authorid]."\">&nbsp;".$hsubject[author]."&nbsp;</a>".lang('plugin/ljww360','wtw18')."&nbsp;&nbsp;<a class=\"lit\" target=\"_blank\" href=\"plugin.php?id=ljww360&mod=wtw&wid=".$id."&tid=".$tid."\">".lang('plugin/ljww360','wtw19')."&nbsp;<em> &rsaquo; </em></a>";
			$notification = nl2br(str_replace(':', '&#58;', $notification));
			notification_add($hfr[authorid], 'post',$notification );
			//选最佳答案时同步判断
			if($config['tuisong']){
				if($special=='3'){
					DB::update('forum_thread', array('price'=>-$price), "tid='$tid'");
					$dateline=C::t('forum_thread')->fetch($tid);
					$dateline=$dateline['dateline'];
					DB::update('forum_post', array('dateline'=>$dateline+1), "pid='$pid'");
					if(!$che){
						DB::insert('common_credit_log',array(
							'uid'=>$uid,	
							'operation'=>'RAC',	
							'relatedid'=>$tid,	
							'dateline'=>$_G[timestamp],	
							$wendajf=>$price,	
						));
					}	
				}
				if($wcache['yijiejue'][$fid]&&C::t('forum_thread')->fetch($tid)){
					DB::update('forum_thread', array('typeid'=>$wcache['yijiejue'][$fid]), "tid='$tid'");
				}
			}
			if($_GET['sj']=='yes'){
				//header('Location: plugin.php?id=ljww360&mod=wtw&wid='.$_GET['wid'].'&tid='.$_GET['tid']);
				echo "<script>parent.tips('".lang('plugin/ljww360','wenwen2')."',function(){parent.location.href='plugin.php?id=ljww360&mod=wtw&wid=".$_GET['wid']."&tid=".$_GET['tid']."';});</script>";
				exit;
			}else{
				echo"<script language='JavaScript'> "; 
				echo"parent.showDialog('".lang('plugin/ljww360','wtw1')."','right','',function(){parent.location.href=parent.location.href;})"; 
				echo"</script>";
				exit;
			}
		}else{
			showmessage(lang('plugin/ljww360','wtw21'));
		}
}else if($action=='htaction'){//追问
		
		if($_GET['formhash']==formhash()){
			if(!$_G['uid']){
				showmessage(lang('plugin/ljww360','wenwen1'), '', array(), array('login' => true));
			}
			//允许提问用户组
			$reply_groups = unserialize($config['reply_groups']);
			if(!in_array($_G['groupid'],unserialize($config['reply_groups'])) && $reply_groups[0]){
				
				echo"<script language='JavaScript'> "; 
				echo"parent.showError('".$config['prompt']."')"; 
				echo"</script>";
				exit;
			}
			$intro=addslashes(html2bbcode($_GET['content']));
			$url_groups=unserialize($config['url_groups']);
			if(!in_array($_G['groupid'],unserialize($config['url_groups'])) && $url_groups[0]){
				$intro=preg_replace("/\[url\=(.+?)\](.+?)\[\/url\]/is","<a href='$1'>$2</a>",$_GET['content']);

				$intro = preg_replace("/<a[^>]*href=[^>]*>|<\/[^a]*a[^>]*>/i","",$intro);
				$intro=addslashes(html2bbcode($intro));
			}
			if(!$intro){
				echo"<script language='JavaScript'> "; 
				echo"parent.showError('".lang('plugin/ljww360','wt_2')."')"; 
				echo"</script>";
				exit;
			}
			$pid=intval($_GET['pid']);
			$tid=intval($_GET['tid']);
			$id=intval($_GET['wid']);
			$postid=intval($_GET['postid']);
			$x_useip = "202." . rand(96, 184) . "." . rand(124, 127) . "." . rand(9, 200);
			//回复的回复
			
			//判断回复是否同步论坛
			if($config['tuisong']&&$tid){
				if(!$_GET['ac']=='yiht'){
					$hfr=C::t('forum_post')->fetch('',$pid,1);
					$message=preg_replace('/\[quote\].*\[\/quote\]\s+/is','',$hfr[message]);
					$message='[quote][size=2][color=#999999]'.$hfr[author].lang('plugin/ljww360','wtw2').date('Y-m-d H:i:s',$hfr[dateline]).'[/color] [url=forum.php?mod=redirect&goto=findpost&pid='.$pid.'&ptid='.$hfr[tid].'][img]static/image/common/back.gif[/img][/url][/size]
'.$message.'[/quote]';
					$intro=$message.'
'.$intro;
				}else{
					$hfr=C::t('#ljww360#plugin_lj_post')->fetch_forum_post_by_tid($tid);
				}
				$subject=C::t('forum_thread')->fetch($tid);
				
				$subject=$subject['subject'];
				$x_user = $_G['username'];
				$pid = insertpost(array('fid' => $hfr[fid], 'tid' => $hfr[tid], 'first' => '0', 'author' => $x_user, 'authorid' => $_G[uid], 'subject' => '', 'dateline' => $_G[timestamp], 'message' => stripslashes($intro), 'useip' => $x_useip, 'invisible' => '0', 'anonymous' => '0', 'usesig' => $Signiture, 'htmlon' => '0', 'bbcodeoff' => '0', 'smileyoff' => '0', 'parseurloff' => '0', 'attachment' => '0',)); 
				$x_lastpost = "$hfr[tid]\t" . stripslashes($subject) . "\t$_G[timestamp]\t$x_user";
				C::t('common_member_count')->increase($uid, array('posts'=>1));
				C::t('#ljww360#plugin_lj_thread')->fetch_update_common_member_status($x_useip, $_G[timestamp],$_G[uid]);
				C::t('#ljww360#plugin_forum_forum')->update('',$hfr[fid], $x_lastpost);
				C::t('#ljww360#plugin_lj_thread')->forum_thread_update($tid,$_G[timestamp],$x_user);
				//C::t('#ljww360#plugin_lj_thread')->forum_thread_update_views($tid);
				//DB::update('forum_thread', array('views'=>$subject['views']), "tid='".$tid."'");
			}else{

				if(!$_GET['ac']=='yiht'){
					$hfr_lj=C::t('#ljww360#plugin_lj_post')->fetch($postid);
					
					$message=preg_replace('/\[quote\].*\[\/quote\]\s+/is','',$hfr_lj[message]);
					$message='[quote][size=2][color=#999999]'.$hfr_lj[author].lang('plugin/ljww360','wtw2').date('Y-m-d H:i:s',$hfr_lj[dateline]).'[/color] [url=forum.php?mod=redirect&goto=findpost&pid='.$pid.'&ptid='.$hfr_lj[tid].'][img]static/image/common/back.gif[/img][/url][/size]
'.$message.'[/quote]';
					$intro=$message.'
'.$intro;
					$notification = "<a href='home.php?mod=space&uid=".$_G['uid']."'>".$_G['username']."</a>".lang('plugin/ljww360','wtw20')."&nbsp;<a target='_blank' href='plugin.php?id=ljww360&mod=wtw&wid=".$id."&tid=".$hfr_lj[tid]."'>".$hfr_lj[message]."</a>&nbsp;&nbsp;<a target='_blank' href='plugin.php?id=ljww360&mod=wtw&wid=".$id."&tid=".$hfr_lj[tid]."'>".lang('plugin/ljww360','wtw19')."</a>";
					$notification = nl2br(str_replace(':', '&#58;', $notification));
					notification_add($hfr_lj[authorid], 'post',$notification );
				}else{
					$hsubject=C::t('#ljww360#plugin_lj_thread')->fetch($id);
					$notification = "<a href='home.php?mod=space&uid=".$_G['uid']."'>".$_G['username']."</a>".lang('plugin/ljww360','wtw20')."&nbsp;<a target='_blank' href='plugin.php?id=ljww360&mod=wtw&wid=".$id."&tid=".$hsubject[tid]."'>".$hsubject['subject']."</a>&nbsp;&nbsp;<a target='_blank' href='plugin.php?id=ljww360&mod=wtw&wid=".$id."&tid=".$hsubject[tid]."'>".lang('plugin/ljww360','wtw19')."</a>";
					$notification = nl2br(str_replace(':', '&#58;', $notification));
					notification_add($hsubject[authorid], 'post',$notification );
				}
			}
			DB::insert('plugin_lj_post',array(
				'fid' => $hfr[fid], 
				'pid' => $pid, 
				'tid' => $tid, 
				'first' => 0, 
				'author' => $_G['username'], 
				'authorid' => $_G[uid], 
				'subject' => '', 
				'dateline' => $_G[timestamp], 
				'message' => stripslashes($intro), 
				'useip' => $x_useip, 
				'invisible' => 0,
				'threadid' => $id,	
			));
			C::t('#ljww360#plugin_lj_thread')->fetch_update_by_replies_views($_G['username'], $_G[timestamp],$id);
			//本日回答数
			$brhdnum = C::t('#ljww360#plugin_lj_post')->fetch_by_brhdnum($_G['uid']);
			if($brhdnum<=$brjlnum){
				updatemembercount($_G[uid], array($config['jljflx'] => $brjl));
			}

			//快速回帖
			if($_GET['sj']=='yes'){
				header('Location: plugin.php?id=ljww360&mod=wtw&wid='.$_GET['wid'].'&tid='.$_GET['tid']);
			}else{
				echo"<script language='JavaScript'> "; 
				echo"parent.showDialog('".lang('plugin/ljww360','wtw3')."','right','',function(){parent.location.href=parent.location.href;})"; 
				echo"</script>";
				exit;
			}
		}
}else{//问题页
	if(!$_GET['id']){
		showmessage(lang('plugin/ljww360','wtw8'));
	}
	
	$id=addslashes($_GET['wid']);
	$tid=addslashes($_GET['tid']);
	 
	$perpage=10;
	$curpage=daddslashes($_GET['page']);
	 
	 if(!$curpage){
		$curpage=1;
	 }
	 $curnum=($curpage-1)*$perpage;
	 $sign=1;
	 $num = C::t('#ljww360#plugin_lj_post')->fetch_by_num($id);
	 $total_page = ceil($num/$perpage);
		//第一页的时候没有上一页
		if($curpage > 1){
			$shangyiye='<a href="plugin.php?id=ljww360&mod=wtw&tid='.$tid.'&wid='.$_GET['wid'].'&page='.($curpage-1).'">'.lang('plugin/ljww360','sj_1').'</a>&nbsp;&nbsp;';
		}else{
			$shangyiye='<span>'.lang('plugin/ljww360','sj_1').'</span>';
		}
		//尾页的时候不显示下一页
		if($curpage < $total_page){
			$xiayiye= '<a href="plugin.php?id=ljww360&mod=wtw&tid='.$tid.'&wid='.$_GET['wid'].'&page='.($curpage+1).'">'.lang('plugin/ljww360','sj_2').'</a>&nbsp;&nbsp;';
		}else{
			$xiayiye='<span>'.lang('plugin/ljww360','sj_2').'</span>';
		}
	 //判断是否为论坛帖
	 if($tid){
		 $pida = C::t('#ljww360#plugin_lj_post')->fetch_by_forum_post_pid($tid);
		 $tableid = C::t('#ljww360#plugin_lj_post')->fetch_by_forum_attachment_tableid($tid);
		 $marr=C::t('forum_post')->fetch('',$pida);
		 $message=$marr['message'];
	 }
	 //判断帖子是否有图片
	 if($tableid){
		 $table='forum_attachment_'.$tableid;
		 $img = C::t('#ljww360#plugin_lj_post')->fetch_by_forum_attachment_x($tid,$pida,$table);
		 foreach($img as $key=>$value){
			if($value[isimage]){
				$arr1[]='[attach]'.$value['aid'].'[/attach]';
				$arr2[]='[img]'.$_G['setting']['attachurl'].'forum/'.$value['attachment'].'[/img]';
			 }else{
				$arr1[]='[attach]'.$value['aid'].'[/attach]';
				$arr2[]='[url='.$_G['siteurl'].'forum.php?mod=attachment&aid='.base64_encode($value['aid']).']'.$value['filename'].'[/url]';
			 }
		 }
		  
		 foreach($img as $key=>$value){
			$arr3[]='[attachimg]'.$value['aid'].'[/attachimg]';
			$arr4[]='[img]'.$_G['setting']['attachurl'].'forum/'.$value['attachment'].'[/img]';
		 }
	 }
	$wtarr = C::t('#ljww360#plugin_lj_post')->fetch_post_join_thread($id);
	//debug($wtarr);
	if(!$wtarr){
		showmessage(lang('plugin/ljww360','wtw8'));
	}
	//debug($wtarr);
	//$brenmyarr = C::t('#ljww360#plugin_lj_post')->fetch_common_join_count($wendajf,$wtarr['authorid']);
	$besttime=$wtarr['dateline'];
	$wtarr['message'] = str_replace($arr1, $arr2, $wtarr['message']);
	$wtarr['message'] = str_replace($arr3, $arr4, $wtarr['message']);
	$wtarr['message']=stripslashes($wtarr['message']);
	$wtarr['message']=preg_replace('/\[hide\].*?\[\/hide\]/is', '', $wtarr['message']);
	$wtarr['message']=discuzcode($wtarr['message']);
	$wtarr['dateline']=date('Y-m-d H:i:s',$wtarr['dateline']);//and a.
	//相关问题
	$xgwt =C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_xgwt_catid($wtarr['catid']);
	foreach($xgwt as $k=>$v){
		$xgwt[$k]['dateline']=date('Y-m-d H:i:s',$v['dateline']);
	}
	//判断是否有最佳答案
	$best = C::t('#ljww360#plugin_lj_post')->fetch_post_by_threadid($id);
	
	if($best){
		$bestarr=wenwendj($best['authorid']);
		$bestdj=$gradearr[0];
		$bestcha=$gradearr[1];
		$best['dateline']=date('Y-m-d H:i:s',$best['dateline']);
		//回答人总回答数
		$bestnum = C::t('#ljww360#plugin_lj_post')->fetch_by_count_bren($best['authorid']);
		//回答人最佳答案数
		$bestpid = C::t('#ljww360#plugin_lj_post')->fetch_by_count_brenbestnum($best['authorid']);
		//回答人采纳率
		$cainalv = round ( ($bestpid / $bestnum) * 100 ) . '%';
	}
	$htarr = C::t('#ljww360#plugin_lj_post')->fetch_post_by_ht($id,$curnum,$perpage);
	//debug($htarr);
	foreach($htarr as $kk=>$huitie){
		if($tid){
			$tableid = C::t('#ljww360#plugin_lj_post')->fetch_by_forum_attachment_tableid($tid);
		}
		 if($tableid||$tableid==='0'){
			 $table='forum_attachment_'.$tableid;
			 
			 $huitieimg = C::t('#ljww360#plugin_lj_post')->fetch_by_forum_attachment_x($tid,$huitie['pid'],$table);
			
			 foreach($huitieimg as $key=>$value){
				if($value[isimage]){
					$arr5[$kk][]='[attach]'.$value['aid'].'[/attach]';
					$arr6[$kk][]='[img]'.$_G['setting']['attachurl'].'forum/'.$value['attachment'].'[/img]';
				 }else{
					$arr5[$kk][]='[attach]'.$value['aid'].'[/attach]';
					$arr6[$kk][]='[url='.$_G['siteurl'].'forum.php?mod=attachment&aid='.base64_encode($value['aid']).']'.$value['filename'].'[/url]';
				 }
			 }
			 
			 foreach($huitieimg as $key=>$value){
				$arr7[$kk][]='[attachimg]'.$value['aid'].'[/attachimg]';
				$arr8[$kk][]='[img]'.$_G['setting']['attachurl'].'forum/'.$value['attachment'].'[/img]';
			}
			$htarr[$kk]['message'] = str_replace($arr5[$kk], $arr6[$kk], $huitie['message']);
	
			$htarr[$kk]['message'] = str_replace($arr7[$kk], $arr8[$kk], $htarr[$kk]['message']);
			$htarr[$kk]['message']=stripslashes($htarr[$kk]['message']);
			if($tableid==='0'&&$huitieimg){
				foreach($arr6[$kk] as $huitiesrc){
					$huitieim[$kk].=$huitiesrc.'';
				}
				$htarr[$kk]['message']=$htarr[$kk]['message'].$huitieim[$kk];
			}
			
		}
		$htarr[$kk]['dateline']=date('Y-m-d H:i:s',$huitie['dateline']);
	}
	$username=$wtarr['author'];
	$authorid=$wtarr['authorid'];
	$djuid=$wtarr['authorid'];
	$gradearr=wenwendj($djuid);
	$dj=$gradearr[0];
	$cha=$gradearr[1];
	//本人总发帖数
	$brentid=C::t('#ljww360#plugin_lj_post')->fetch_by_count_brenfirst($djuid);
	//本人总最佳答案数
	$brenbest=C::t('#ljww360#plugin_lj_post')->fetch_by_count_brenbestnum($djuid);
	//本人总回答数
	$brennum=C::t('#ljww360#plugin_lj_post')->fetch_by_count_bren($djuid);
	$brencainalv = round ( ($brenbest / $brennum) * 100 ) . '%';
	//debug($brencainalv);
	foreach($htarr as $k=>$v){
		$htarr[$k]['message']=htmlspecialchars_decode(discuzcode($v['message']));
	}
	$del="plugin.php?id=ljww360&mod=wtw&action=del&wid=$id&tid=";
	$queding=lang('plugin/ljww360','wtw7');
	$wuser = $config ['dxuser'];
	$wuser = unserialize ($wuser);
	//判断用户组权限
	if (in_array ($_G['groupid'], $wuser)) {
		$dxyhz=1;
		$groupiddel=1;
	}
	require_once DISCUZ_ROOT.'source/plugin/ljww360/class/qrcode.class.php';
	
	if(!file_exists('source/plugin/ljww360/images/qrcode/'.$wtarr['qrcode'])||!$wtarr['qrcode']){
		$file = dgmdate(TIMESTAMP, 'YmdHis').random(18).'.jpg';	 QRcode::png($_G['siteurl'].'plugin.php?id=ljww360&mod=wtw&wid='.$_GET['wid'].'&tid='.$_GET['tid'], 'source/plugin/ljww360/images/qrcode/'.$file, QR_MODE_STRUCTURE, 8);
		DB::update('plugin_lj_thread', array('qrcode'=>$file), "id=".$_GET['wid']);
	}
	if($config['isrewrite']){
		$daohang='<a href="answer-'.$_GET['wid'].'-'.$_GET['tid'].'.html">'.mb_substr($wtarr['subject'],0,24,$_G['charset']).'</a>';
	}else{
		$daohang='<a href="plugin.php?id=ljww360&mod=wtw&wid='.$_GET['wid'].'&tid='.$_GET['tid'].'">'.mb_substr($wtarr['subject'],0,24,$_G['charset']).'</a>';
	}
	C::t('#ljww360#plugin_lj_thread')->fetch_update_views($_GET['wid']);
	$brry =  C::t('#ljww360#plugin_lj_post')->fetch_by_thread_forum_post();
	
	if($brry['message']){
		$brry['message']=discuzcode($brry['message']);
		$brry['message']=preg_replace('/\[hide\].*?\[\/hide\]/is', '', $brry['message']);
		$brry['message']=preg_replace('/\<img.*?\>/is', '', $brry['message']);
		$brry['message']=strip_tags($brry['message']);
	}
	$mingren = explode ("\n", str_replace ("\r", "", $config ['mingren']));
	foreach($mingren as $key=>$value){
		$arr=explode('|',$value);
		$types[$arr[0]]=$arr[1];
	}
	$rand_keys = array_rand($types, 1);
	//debug($brry['message']);
	$navtitle = $wtarr['subject'].'-'.$title;
	$metakeywords = $keywords;
	$metadescription = $description;
	if($ljww360_seo['view']['seotitle']){
		$seodata = array('bbname' => $_G['setting']['bbname'],'subject'=>$wtarr['subject'],'message'=>mb_substr(strip_tags(preg_replace('/\<img.*?\>/is', '', $wtarr['message'])),0,80,$_G['charset']));
		list($navtitle, $metadescription, $metakeywords) = get_seosetting('', $seodata, $ljww360_seo['view']);
	}
	if($_G['mobile']) {
		include template ( 'ljww360:wt' );
	} else {
		include template('diy:wt', null, 'source/plugin/ljww360/template');
	}
	
}
	
?>