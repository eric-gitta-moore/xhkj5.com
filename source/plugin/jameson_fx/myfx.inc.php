<?php
// 前台我的书架
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
if(defined('IN_MOBILE')){
	dheader("location:./plugin.php?id=jameson_fx&contrl=touch&act=index");
			exit;
	}
require_once libfile('function/jamesonfx','plugin/jameson_fx');
init_jamesonfx();
require_once './source/plugin/jameson_fx/class/Page.class.php';
	$countsfx = C::t('#jameson_fx#jamesonfx_fx')->count_byuid($_G['uid']);
	$pagefx = new Page($countsfx,50,'./home.php?mod=spacecp&ac=plugin&id=jameson_fx:'.'myfx');
	$fengxiangs = C::t('#jameson_fx#jamesonfx_fx')->fetch_byuid($_G['uid'],$pagefx->getStart(),$pagefx->getSize());
	$pageshowfx = $pagefx->show();