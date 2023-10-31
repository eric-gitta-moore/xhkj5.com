<?php
/**
 * @Project_name :  
 * @Author: 源码哥 www_YMG6_COM
 * @Date:   2016-01-24 21:19:24
 * @Email: caogenba@qq.com
 * @Web:http://www.fx8.cc
 * @Last Modified by:   源码哥 www_YMG6_COM
 * @Last Modified time: 2016-03-24 19:33:01
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denid');
}
class MhelpContrl{
	function index(){
		include template('jameson_fx:mhelp_index');
	}
	function faq(){
		include template('jameson_fx:mhelp_faq');
	}

	function guize(){
		include template('jameson_fx:mhelp_guize');
	}

}