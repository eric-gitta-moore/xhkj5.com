<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_xhkj5_qqgroup
{

}
class plugin_xhkj5_qqgroup_forum extends plugin_xhkj5_qqgroup
{
	function index_status_extra_output(){
		global $_G;
		if($_G['cache']['plugin']['xhkj5_qqgroup']['open']){
			return '<a href="javascript:;" onclick="showWindow(\'qqgroup\', \'plugin.php?id=xhkj5_qqgroup\',\'get\',1);">'.lang('plugin/xhkj5_qqgroup','jiaru').'</a>';
		}
	}

}
?>