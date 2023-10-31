<?php
/*
Author:分.享.吧
Website:www.fx8.cc
Qq:154-6069-14
*/
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
global $_G;
if( ($_GET['optype'] != 'erweima') && (FORMHASH != trim($_GET['formhash']))) {
	echo 'error';
 	exit;
 }
 require_once libfile('function/jamesonfx','plugin/jameson_fx');
 init_jamesonfx();
$optype = trim($_GET['optype']);
switch ($optype) {
	case 'erweima':
		$url = urldecode($_GET['url']);
		require_once './source/plugin/jameson_fx/class/Qrcode.php';
		QRcode::png($url);
		break;
	case 'jiangli':
		// 插入今日奖励表
		// 判断是门户
		$id = 0;
		$flag = 'forum';
		if(intval($_GET['tid'])){
			$id = (int) $_GET['tid'];
		}else if($_GET['aid']){
			$flag = 'portal';
			$id = (int) $_GET['aid'];
		}
		if($id){
			C::t('#jameson_fx#jamesonfx_day')->add($_GET['fxuid'],$_G["jameson_fx"]['jiangli']);
			echo jamesonfxfxact($_GET['fxuid'],$id,$_G["jameson_fx"]['jiangli'],$_G['jameson_fx']['trameid'],$_G['clientip'],$_G['jameson_fx']['trametitle'],$flag);
		}else{
			echo 0;
		}
		break;
		default:
		echo 'error';
		break;
}

// 奖励积分操作
function jamesonfxfxact($fxuid,$tid,$jiangli,$trameid,$ip,$trametitle,$flag){
	$fxuid = intval($fxuid);
	$tid = intval($tid);
	$jiangli = intval($jiangli);
	$trameid = intval($trameid);
	$ip = addslashes($ip);
	$trametitle = addslashes($trametitle);
	// 如果不曾存在此fxuid，tid，ip
	// 字段 aid 或tid
	if($flag == 'forum'){
		$idfield = 'tid';
		$fix = '';
	}else{
		$idfield = 'aid';
		$fix = 'por';
	}
	if(!DB::result_first("SELECT count(*) FROM %t WHERE fxuid=%d AND ".DB::field($idfield,$tid)." AND ".DB::field('ip',$ip),array('jamesonfx_fx'.$fix,$fxuid))){
		// 奖励积分
		if(!updatemembercount($fxuid,array($trameid=>$jiangli),true,'jmd',0,lang('plugin/jameson_fx','fenxiangjiangli'),lang('plugin/jameson_fx','fenxiangjiangli'))){
			// 奖励积分成功，插入fx表和积分日志
			C::t('#jameson_fx#jamesonfx_fx'.$fix)->insert(array(
					'fxuid'=>$fxuid,
					'addtime'=>time(),
					$idfield=>$tid,
					'ip'=>$ip,
					'jiangli'=>$jiangli
			));
		}else{
			return 8;
		}
	}else{
		return 9;
	}
}