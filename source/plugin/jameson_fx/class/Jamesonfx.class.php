<?php
/**
 * @Project_name :  
 * @Author: 源码哥 www_YMG6_COM
 * @Date:   2016-01-24 20:47:38
 * @Email: caogenba@qq.com
 * @Web:http://www.fx8.cc
 * @Last Modified by:   源码哥 www_YMG6_COM
 * @Last Modified time: 2016-01-24 20:59:49
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

class Jamesonfx
{
	// 初始化
	public static function run($contrl=null,$act=null){
		global $_G;
		$classname = $contrl ? $contrl : ((isset($_GET['contrl']) && !empty($_GET['contrl'])) ? ucfirst(trim($_GET['contrl'])).'Contrl' : 'IndexContrl');
		$method = $act ? $act : ((isset($_GET['act']) && !empty($_GET['act'])) ? strtolower(trim($_GET['act'])) : 'index');
		require_once './source/plugin/jameson_fx/class/'.$classname.'.class.php';
		require_once './source/plugin/jameson_fx/function/function_jamesonfx.php';
		init_jamesonfx();
		$obj = new $classname();
		$obj->$method();
	}
}