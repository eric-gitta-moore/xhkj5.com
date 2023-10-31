<?php
/**
 * @Project_name :  
 * @Author: 源码哥 www_YMG6_COM
 * @Date:   2016-01-24 21:19:24
 * @Email: caogenba@qq.com
 * @Web:http://www.fx8.cc
 * @Last Modified by:   源码哥 www_YMG6_COM
 * @Last Modified time: 2016-03-15 13:10:58
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denid');
}
class MfxContrl{
	function index(){
		global $_G;
		require_once './source/plugin/jameson_fx/class/Page.class.php';
		if(!isset($_GET['fx'])){
			$counts = C::t('#jameson_fx#jamesonfx_fx')->count_all_uid();
			$page = new Page($counts,50,'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=jameson_fx&pmod=jameson_fx&contrl=mfx&act=index');
			$fenxiangs = C::t('#jameson_fx#jamesonfx_fx')->fetch_all_uid($page->getStart(),$page->getSize());
			$pageshow = $page->show();
		}else if(!$_GET['fxuid']){
			$counts = C::t('#jameson_fx#jamesonfx_fx')->count_all_tid();
			$page = new Page($counts,50,'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=jameson_fx&pmod=jameson_fx&contrl=mfx&act=index&fx=1');
			$fenxiangs = C::t('#jameson_fx#jamesonfx_fx')->fetch_all_tid($page->getStart(),$page->getSize());
			$pageshow = $page->show();
		}else if($_GET['fxuid']){
			$counts = C::t('#jameson_fx#jamesonfx_fx')->count_byuid($_GET['fxuid']);
			$username = DB::result_first('SELECT username FROM %t WHERE uid=%d',array('common_member',$_GET['fxuid']));
			$page = new Page($counts,50,'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=jameson_fx&pmod=jameson_fx&contrl=mfx&act=index&fx=1&fxuid='.$_GET['fxuid']);
			$fenxiangs = C::t('#jameson_fx#jamesonfx_fx')->fetch_byuid($_GET['fxuid'],$page->getStart(),$page->getSize());
			$pageshow = $page->show();
		}
		include template('jameson_fx:mfx_index');
	}
	// 门户
	function portal(){
		global $_G;
		require_once './source/plugin/jameson_fx/class/Page.class.php';
		if(!isset($_GET['fx'])){
			$counts = C::t('#jameson_fx#jamesonfx_fxpor')->count_all_uid();
			$page = new Page($counts,50,'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=jameson_fx&pmod=jameson_fx&contrl=mfx&act=portal');
			$fenxiangs = C::t('#jameson_fx#jamesonfx_fxpor')->fetch_all_uid($page->getStart(),$page->getSize());
			$pageshow = $page->show();
		}else if(!$_GET['fxuid']){
			$counts = C::t('#jameson_fx#jamesonfx_fxpor')->count_all_aid();
			$page = new Page($counts,50,'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=jameson_fx&pmod=jameson_fx&contrl=mfx&act=portal&fx=1');
			$fenxiangs = C::t('#jameson_fx#jamesonfx_fxpor')->fetch_all_aid($page->getStart(),$page->getSize());
			$pageshow = $page->show();
		}else if($_GET['fxuid']){
			$counts = C::t('#jameson_fx#jamesonfx_fxpor')->count_byuid($_GET['fxuid']);
			$username = DB::result_first('SELECT username FROM %t WHERE uid=%d',array('common_member',$_GET['fxuid']));
			$page = new Page($counts,50,'admin.php?action=plugins&operation=config&do='.$_GET['do'].'&identifier=jameson_fx&pmod=jameson_fx&contrl=mfx&act=portal&fx=1&fxuid='.$_GET['fxuid']);
			$fenxiangs = C::t('#jameson_fx#jamesonfx_fxpor')->fetch_byuid($_GET['fxuid'],$page->getStart(),$page->getSize());
			$pageshow = $page->show();
		}
		include template('jameson_fx:mfx_portal');
	}


	function delall(){
		global $_G;
		if($_GET['type']){
			$forwrad = 'portal';
		}else{
			$forwrad = 'index';
		}
		if(FORMHASH != $_GET['formhash']){
			cpmsg(lang('plugin/jameson_fx','laiyuanfeifa'),'action=plugins&operation=config&do='.$_GET['do'].'&identifier=jameson_fx&pmod=jameson_fx&contrl=mfx&act='.$forwrad, 'error');
		}
		C::t('#jameson_fx#jamesonfx_fx')->clear();
		C::t('#jameson_fx#jamesonfx_fxpor')->clear();
		C::t('#jameson_fx#jamesonfx_day')->clear();
		cpmsg(lang('plugin/jameson_fx','caozuochenggong'),'action=plugins&operation=config&do='.$_GET['do'].'&identifier=jameson_fx&pmod=jameson_fx&contrl=mfx&act='.$forwrad, 'succeed');
	}
}