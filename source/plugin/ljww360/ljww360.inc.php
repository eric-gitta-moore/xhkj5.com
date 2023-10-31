<?php
/**
 *      [Liangjian] (C)2001-2099 Liangjian Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: fingerguess.inc.php liangjian $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$ljww360_seo = dunserialize($_G['setting']['ljww360_seo']);
if(!$_G['mobile']){
	checkmobile();
	if($_G['mobile']){
	   define('IN_MOBILE',2);
	}
}
$modarray = array('index','wtw','tw','search','list','sjtw');
$mod = isset($_GET['mod']) ? $_GET['mod'] : '';
$mod = !in_array($mod, $modarray) ? 'index' : $mod;
require DISCUZ_ROOT.'./source/plugin/ljww360/module/ljww360_'.$mod.'.php';
?>