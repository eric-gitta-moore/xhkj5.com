<?php
if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}
include_once DISCUZ_ROOT . './source/plugin/ljww360/wenwenfuc.php';
include_once 'source/function/function_misc.php';
include_once 'source/include/misc/misc_counter.php';
require_once DISCUZ_ROOT.'source/plugin/ljww360/class/qrcode.class.php';
if (!file_exists("source/plugin/ljww360/images/qrcode/ljww360_qrcode.jpg")) {
	$file = 'ljww360_qrcode.jpg';	 QRcode::png($_G['siteurl'].'plugin.php?id=ljww360', 'source/plugin/ljww360/images/qrcode/'.$file, QR_MODE_STRUCTURE, 8);
}
$act=$_GET['act'];
$brenuid=$_G['uid'];
$config = $_G ['cache'] ['plugin'] ['ljww360'];
$fids = unserialize($config['wenwenbk']);
$bkfid=dimplode($fids);
$grade = $config ['grade'];
$indexasknum = $config ['indexasknum'];
$isqz = $config ['isqz'];
$xsgs = $config ['xsgs'];
$tsy = $config ['tsy'];
$isxst = $config ['isxst'];
$istj = $config ['istj'];
$wendajf = 'extcredits' . $config ['wendajf'];
$creditname = $_G['setting']['extcredits'][$config['wendajf']]['title'];
$dingbu = $config ['dingbu'];	
$settingfile = DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
if(file_exists($settingfile)){
	include $settingfile;
}
if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
	$settingfile = DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
	include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
}
$time=$_G['timestamp'];
include libfile ( 'function/forumlist' );
$groupid = $_G ['groupid'];
//debug($visitor);
$px = $config ['px'];
$cache = $config ['cache'];
$title = $config ['title'];
$keywords = $config ['keywords'];
$description = $config ['description'];
$lunzhuan1=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_conutid('1','1');//轮转1大字体推送
if($lunzhuan1){
	$im1=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_id('1','1');
}else{
	$im1=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_dj('1');
	$im1=$im1[0];
	$tupian1 = $config ['tupian1'];
}
//debug($im1);
$lunzhuan2=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_conutid('2','1');//轮转2大字体推送
if($lunzhuan2){
	$im2=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_id('2','1');
}else{
	if($im1['id']){
		$im2=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_dj('1'," and id!='".$im1['id']."'");
	}
	$im2=$im2[0];
	$tupian2 = $config ['tupian2'];
}
$lunzhuan3=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_conutid('3','1');//轮转3大字体推送
if($lunzhuan3){
	$im3=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_id('3','1');
}else{
	if($im2['id']){
		$im3=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_dj('1'," and id!='".$im1['id']."' and id!='".$im2['id']."'");
	}
	$im3=$im3[0];
	$tupian3 = $config ['tupian3'];
}
$tid=$im1['id'].','.$im2['id'].','.$im3['id'];
//$tid = str_replace ('，',',',$tid );
$tid = trim ($tid,',');
$tid = explode ( ',', $tid );
$tid = array_unique ( $tid );
$tid = array_filter ( $tid );
$tid = dimplode ( $tid );
$small1=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_conutid('1','2');//轮转1小字体推送
if($small1>7){
	$wwarr=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_all_by_id('1','2','0','7');
}else{
	$wwarr1=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_all_by_id('1','2','0',$small1);
	if($tid){
		$wwarr2=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_dj(7-$small1," and id not in (".$tid.")");
	}
	$wwarr=array_merge($wwarr1, $wwarr2);
}
foreach($wwarr as $wtid){
	$tid1.=$wtid['id'].',';
}
$tid1 = trim ($tid1,',');
$tid1 = explode ( ',', $tid1 );
$tid1 = array_unique ( $tid1 );
$tid1 = array_filter ( $tid1 );
$tid1 = dimplode ( $tid1 );
$small2=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_conutid('2','2');//轮转2小字体推送
if($small2>7){
	$ggarr=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_all_by_id('2','2','0','7');
}else{
	$ggarr1=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_all_by_id('2','2','0',$small2);
	$tid2=$tid.','.$tid1;
	if($tid||$tid1){
		$ggarr2=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_dj(7-$small2," and id not in (".trim($tid2,',').")");
	}
	$ggarr=array_merge($ggarr1, $ggarr2);
}
foreach($ggarr as $gtid){
	$tid3.=$gtid['id'].',';
}
$tid3 = trim ($tid3,',');
$tid3 = explode ( ',', $tid3 );
$tid3 = array_unique ( $tid3 );
$tid3 = array_filter ( $tid3 );
$tid3 = dimplode ( $tid3 );
$small3=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_by_conutid('3','2');//轮转3小字体推送
if($small3>7){
	$ffarr=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_all_by_id('3','2','0','7');
}else{
	$ffarr1=C::t('#ljww360#plugin_ljwenwen_ts')->fetch_all_by_id('3','2','0',$small3);
	$tid3=$tid.','.$tid1.','.$tid3;
	if($tid||$tid1||$tid3){
		$ffarr2=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_dj(7-$small3," and id not in (".trim($tid3,',').")");
	}
	
	$ffarr=array_merge($ffarr1, $ffarr2);
}
$djarr=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_dj($indexasknum);//未解决
$zeroarr=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_zero($indexasknum);//0回答
$yjqarr=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_yjj($indexasknum);//已解决
$xsarr=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_gxs($indexasknum);//高悬赏
$typearr=C::t('#ljww360#plugin_ljwenwentype')->range();//分类
//debug($tyarr);
//debug($typearr1);
$guanggao = $config ['guanggao'];
$wendajf = 'extcredits' . $config ['wendajf'];
if (empty ( $config ['wendajf'] )) {
	$wendajf = '';
}
/*if(!$wcache['bzwatime']||$time>$wcache['bzwatime']+7*24*60*60){//本周问答之星开始时间
	$wcache['bzwatime']=$_G[timestamp];
	require_once libfile('function/cache');
	writetocache('wenwen_setting', getcachevars(array('wcache' => $wcache)));//将管理中心配置项写入缓存
}*/
	$day  = date('d'); 
	$mon  = date('m'); 
	$year = date('Y'); 
	$today  = date('N'); 
	$start = date('Y-m-d', mktime(0,0,0, $mon, $day-$today+1, $year)); 
	$end   = date('Y-m-d H:i:s', mktime(23,59,59, $mon, $day-$today+7, $year)); 
	$tomon_s = date('Y-m-d H:i:s', mktime(0,0,0, $mon, 1, $year)); 
	$tomon_e = date('Y-m-d H:i:s', mktime(23,59,59, $mon+1, 0, $year));
	$year_s = date('Y-m-d H:i:s', mktime(0,0,0, $mon, 1, $year)); 
	$year_e = date('Y-m-d H:i:s', mktime(23,59,59, $mon, 0, $year+1));
	//debug($end);
if(!$wcache['allbest']||$time>$wcache['allbest']['time']+$cache*60||$_GET['update']==1){
	//$bzwatime=$wcache['bzwatime']+7*24*60*60;
	$bzwarfirst = C::t('#ljww360#plugin_lj_post')->fetch_by_bestnum(strtotime($start),strtotime($end));//本周问答之星最佳答案数
	//debug($bzwarfirst);
	$num=C::t('#ljww360#plugin_lj_post')->fetch_by_conut_tid($bzwarfirst['authorid']);
	$best=C::t('#ljww360#plugin_lj_post')->fetch_by_count_brenbestnum($bzwarfirst['authorid']);
	//$best=;
	$cainalv = round ( ($best / $num) * 100 ) . '%';
	$allarr=C::t('#ljww360#plugin_lj_post')->fetch_post_all_bestnum($bzwarfirst['authorid']);
	//debug($bzwarfirst);	
	if($allarr&&$bzwarfirst){
		foreach($allarr as $kk=>$vv){
			$pidss .= $vv ['threadid'] . ',';
		}
		$pid = explode ( ',', $pidss );
		$pid = array_unique ( $pid );
		$pid = array_filter($pid);
		$pid = dimplode ( $pid );
		//debug($pidss);
		$allbest = C::t('#ljww360#plugin_lj_thread')->fetch_thread_all($pid);//精选回答
	}
	$bignum = C::t('#ljww360#plugin_lj_post')->fetch_post_all_first();//回答总数最多的人
	$wcache['allbest']['time']=$time;
	$wcache['allbest']['cainalv']=$cainalv;
	$wcache['allbest']['bzwarfirst']=$bzwarfirst;
	$wcache['allbest']['num']=$num;
	$wcache['allbest']['value']=$allbest;
	$wcache['allbest']['bignum']=$bignum;
	require_once libfile('function/cache');
	writetocache('wenwen_setting', getcachevars(array('wcache' => $wcache)));//将管理中心配置项写入缓存
}
$allbest=$wcache['allbest']['value'];
$cainalv=$wcache['allbest']['cainalv'];
$bzwarfirst=$wcache['allbest']['bzwarfirst'];
$num=$wcache['allbest']['num'];
$bignum=$wcache['allbest']['bignum'];
$gradearr=wenwendj($bzwarfirst['authorid']);
$dj=$gradearr[0];
$cha=$gradearr[1];
if(!$wcache['brnum']||$time>$wcache['brnum']['time']+$cache*60||$_GET['update']==1){
	$brnum = C::t('#ljww360#plugin_lj_post')->fetch_by_first();//本日之星回答数
	if($brnum){
		$wcache['brnum']['time']=$time;
		$wcache['brnum']['value']=$brnum;
		require_once libfile('function/cache');
		writetocache('wenwen_setting', getcachevars(array('wcache' => $wcache)));//将管理中心配置项写入缓存
	}
}
$myarr=$wcache['brnum']['myarr'];
$brnum=$wcache['brnum']['value'];

if($brenuid){//当前登录用户信息
	$brenmyarr = C::t('#ljww360#plugin_lj_post')->fetch_common_join_count($wendajf,$_G['uid']);
	$username = $brenmyarr ['username'];
	$brentid=C::t('#ljww360#plugin_lj_post')->fetch_by_count_brenfirst($_G['uid']);
	$brenbest=C::t('#ljww360#plugin_lj_post')->fetch_by_count_brenbestnum($_G['uid']);
	$brennum=C::t('#ljww360#plugin_lj_post')->fetch_by_count_bren($_G['uid']);
	$brencainalv = round ( ($brenbest / $brennum) * 100 ) . '%';
	//debug($brenbest);
	$gradearr=wenwendj($_G['uid']);
	$brendj=$gradearr[0];
	$brencha=$gradearr[1];
}	
include_once DISCUZ_ROOT . '/source/plugin/ljww360/include/index.inc.php';

if ($wendajf) {
	if(!$wcache['pmarr']||$time>$wcache['pmarr']['time']+$cache*60||$_GET['update']==1){
			//$pmarr = C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_count($wendajf);
			$pmarr=DB::fetch_all(" select * from ".DB::table("common_member_count")." order by $wendajf desc limit 0,10");
			$wcache['pmarr']['time']=$time;
			$wcache['pmarr']['value']=$pmarr;
			require_once libfile('function/cache');
			writetocache('wenwen_setting', getcachevars(array('wcache' => $wcache)));//将管理中心配置项写入缓存
		}
		$pmarr=$wcache['pmarr']['value'];
}
$navtitle = $title;
$metakeywords = $keywords;
$metadescription = $description;
if($ljww360_seo['index']['seotitle']){
	$seodata = array('bbname' => $_G['setting']['bbname']);
	list($navtitle, $metadescription, $metakeywords) = get_seosetting('', $seodata, $ljww360_seo['index']);
}
if($_GET['update']==1){

	showmessage(lang('plugin/ljww360','wenwen33'),"plugin.php?id=ljww360");
}

$mobile=C::t('#ljww360#plugin_lj_thread')->fetch_thread_all_mobile();
$sjlz = explode ("\n", str_replace ("\r", "", $config ['mobile_index_img']));
	foreach($sjlz as $key=>$value){
		$arr=explode('|',$value);
		$lz_types[$arr[0]]=$arr[1];
	}
//debug($_G['mobile']);
if($_G['mobile']) {
	//debug(template ( 'ljww360:wenwen' ));
	include template ( 'ljww360:wenwen' );
} else {
	include template('diy:wenwen', null, 'source/plugin/ljww360/template');
}

?>
