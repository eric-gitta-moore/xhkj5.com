<?php
	if (! defined ( 'IN_DISCUZ' )) {
		exit ( 'Access Denied' );
	}

include libfile ( 'function/forumlist' );
$settingfile = DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
if(file_exists($settingfile)){
	include $settingfile;
}
if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
	$settingfile = DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
	include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
}
$config = $_G ['cache'] ['plugin'] ['ljww360'];
$fid = $config ['wenwenbk'];
$title = $config ['title'];
$keywords = $config ['keywords'];
$description = $config ['description'];
$flasknum = $config ['flasknum'];
$tyid=$wcache[$fid];
$dingbu = $config ['dingbu'];
$catid=intval($_GET['catid']);
$upid=intval($_GET['upid']);
$typearr=C::t('#ljww360#plugin_ljwenwentype')->range();//分类
if($config['isrewrite']){
	$daohang='<a href="type-1-0-0.html">'.lang('plugin/ljww360','list9').'</a>';
}else{
	$daohang='<a href="plugin.php?id=ljww360&mod=list&q=1">'.lang('plugin/ljww360','list9').'</a>';
}
if($catid){
	$fenl=C::t('#ljww360#plugin_ljwenwentype')->fetch_by_upid_count($catid);
	if($fenl){
		$fenlei=C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid($catid);
		if($config['isrewrite']){
			$daohang='<a href="type-1-0-0.html">'.lang('plugin/ljww360','list9').'</a><em> &rsaquo; </em><a href="type-1-'.$_GET['catid'].'-0.html">'.$typearr[$catid]['subject'].'</a>';
		}else{
			$daohang='<a href="plugin.php?id=ljww360&mod=list&q=1">'.lang('plugin/ljww360','list9').'</a><em> &rsaquo; </em><a href="plugin.php?id=ljww360&mod=list&q=1&catid='.$_GET['catid'].'">'.$typearr[$catid]['subject'].'</a>';
		}
	}elseif($upid){
		$fenlei=C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid($upid);
		if($config['isrewrite']){
			$daohang='<a href="type-1-0-0.html">'.lang('plugin/ljww360','list9').'</a><em> &rsaquo; </em><a href="type-1-'.$_GET['catid'].'-'.$_GET['upid'].'.html">'.$typearr[$catid]['subject'].'</a>';
		}else{
			$daohang='<a href="plugin.php?id=ljww360&mod=list&q=1">'.lang('plugin/ljww360','list9').'</a><em> &rsaquo; </em><a href="plugin.php?id=ljww360&mod=list&q=1&catid='.$_GET['catid'].'&upid='.$_GET['upid'].'">'.$typearr[$catid]['subject'].'</a>';
		}
	}else{
		$fenlei=C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid();
	}
}else{	
	$fenlei=C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid();
	
}

//debug($typearr1);
if($_GET['upid']){
	$all=trim($upid);
}else{
	$all=trim($typearr[$catid]['subid'].','.$catid,',');

}
//debug($all);
$conn=" where fid =$fid   ";
if($_GET['q']==1){
	if($catid){
		if($_GET['upid']){
			$conn=" where authorid>'0' and sign!='1' and catid=$catid ";
			$fyurl='plugin.php?id=ljww360&mod=list&q=1&catid='.$_GET['catid'].'&upid='.$_GET['upid'];
		}else{
			$conn=" where authorid>'0' and sign!='1' and  catid in ($all)";
			$fyurl='plugin.php?id=ljww360&mod=list&q=1&catid='.$_GET['catid'];
		}
		$navtitle = lang('plugin/ljww360','list1').$typearr[$catid]['subject'].'-'.$title;
		$problem_state = lang('plugin/ljww360','list1');
	}else{
		$conn=" where authorid>'0' and sign!='1' ";
		$navtitle = lang('plugin/ljww360','list2').$title;
		$problem_state = lang('plugin/ljww360','list2');
		$fyurl='plugin.php?id=ljww360&mod=list&q=1';
	}
	
	$metakeywords = $keywords;
	$metadescription = $description;

}
if($_GET['q']==2){
	if($catid){
		if($_GET['upid']){
			$conn=" where authorid>'0' and sign='1'  and catid=$catid ";
			$fyurl='plugin.php?id=ljww360&mod=list&q=2&catid='.$_GET['catid'].'&upid='.$_GET['upid'];
		}else{
			$conn=" where authorid>'0' and sign='1' and  catid in ($all)";
			$fyurl='plugin.php?id=ljww360&mod=list&q=2&catid='.$_GET['catid'];
		}
		
		$navtitle = lang('plugin/ljww360','list3').$typearr[$catid]['subject'].'-'.$title;
		$problem_state = lang('plugin/ljww360','list3');
	}else{
		$conn=" where authorid>'0' and sign='1'  ";
		$navtitle = lang('plugin/ljww360','list4').$title;
		$problem_state = lang('plugin/ljww360','list4');
		$fyurl='plugin.php?id=ljww360&mod=list&q=2';
	}
	$metakeywords = $keywords;
	$metadescription = $description;
}
if($_GET['q']==3){
	if($catid){
		if($_GET['upid']){
			$conn=" where authorid>'0' and price>'0'  and catid=$catid ";
			$fyurl='plugin.php?id=ljww360&mod=list&q=3&catid='.$_GET['catid'].'&upid='.$_GET['upid'];
		}else{
			$conn=" where authorid>'0'  and price>'0'  and  catid in ($all)";
			$fyurl='plugin.php?id=ljww360&mod=list&q=3&catid='.$_GET['catid'];
		}
		
		$navtitle = lang('plugin/ljww360','list5').$typearr[$catid]['subject'].'-'.$title;
		$problem_state = lang('plugin/ljww360','list5');
	}else{
		$conn=" where authorid>'0'  and price>'0'  ";
		$navtitle = lang('plugin/ljww360','list6').$title;
		$problem_state = lang('plugin/ljww360','list6');
		$fyurl='plugin.php?id=ljww360&mod=list&q=3';
	}		
	$metakeywords = $keywords;
	$metadescription = $description;
}
if($_GET['q']==4){
	if($catid){
		if($_GET['upid']){
			$conn=" where authorid>'0'  and replies='0' and catid=$catid ";
			$fyurl='plugin.php?id=ljww360&mod=list&q=4&catid='.$_GET['catid'].'&upid='.$_GET['upid'];
		}else{
			$conn=" where authorid>'0' and replies='0' and  catid in ($all)";
			$fyurl='plugin.php?id=ljww360&mod=list&q=4&catid='.$_GET['catid'];
		}
		
		$navtitle = lang('plugin/ljww360','list7').$typearr[$catid]['subject'].'-'.$title;
		$problem_state = lang('plugin/ljww360','list7');
		
	}else{
		$conn=" where authorid>'0' and replies='0' ";
		$navtitle = lang('plugin/ljww360','list8').$title;
		$problem_state = lang('plugin/ljww360','list8');
		$fyurl='plugin.php?id=ljww360&mod=list&q=4';
	}
	$metakeywords = $keywords;
	$metadescription = $description;
}
$subject=addcslashes($_GET['s'], '%_');
if($subject){
			
			$conn.=" and subject like '%$subject%' "; 
		}
		$perpage=$flasknum;
$conn.=" and displayorder<>'-1' AND displayorder<>'-2' AND displayorder<>'-3' AND displayorder<>'-4' ";
$conn.=" order by id desc";
 $curpage=daddslashes($_GET['page']);
 
 if(!$curpage){
	$curpage=1;
 }
 $curnum=($curpage-1)*$perpage;
 $sign=1;
 $num = C::t('#ljww360#plugin_lj_thread')->fetch_thread_by_conn($conn);
 $djarr=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_conn($conn,$curnum,$perpage);//未解决
foreach($djarr as $k=>$v){
	$djarr[$k]['dateline']=date('Y-m-d H:i:s',$v['dateline']);
}
if($ljww360_seo['list']['seotitle']){
	$cat = $typearr[$catid]['subject'];
	$seodata = array('bbname' => $_G['setting']['bbname'],'cat'=>$cat,'problem_state'=>$problem_state);
	list($navtitle, $metadescription, $metakeywords) = get_seosetting('', $seodata, $ljww360_seo['list']);
}
include template ( 'ljww360:list' );
?>