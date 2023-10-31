<?php
/**
 * @Project_name :  
 * @Author: 源码哥 www_YMG6_COM
 * @Date:   2016-01-24 21:19:24
 * @Email: caogenba@qq.com
 * @Web:http://www.fx8.cc
 * @Last Modified by:   源码哥 www_YMG6_COM
 * @Last Modified time: 2016-01-30 22:41:53
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denid');
}
class TouchContrl{
	function index(){
		global $_G;
		require_once './source/plugin/jameson_fx/class/Page.class.php';
		$countsfx = C::t('#jameson_fx#jamesonfx_fx')->count_byuid($_G['uid']);
		$pagefx = new Page($countsfx,50,'./home.php?mod=spacecp&ac=plugin&id=jameson_fx:'.'myfx');
		$fengxiangs = C::t('#jameson_fx#jamesonfx_fx')->fetch_byuid($_G['uid'],$pagefx->getStart(),$pagefx->getSize());
		$pageshow = $pagefx->showprenext();
		include template('jameson_fx:touch/index');
	}

}