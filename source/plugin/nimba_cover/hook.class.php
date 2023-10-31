<?php
/*
 * 应用中心主页：http://addon.discuz.com/?@ailab
 * 人工智能实验室：Discuz!应用中心十大优秀开发者！
 * 插件定制 联系QQ594941227
 * From www.ailab.cn
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_nimba_cover {
	function list_dir($dirname){//获取目录中的图片列表
		if(!is_dir($dirname)){ 
			return false; 
		} 
		$handle=@opendir($dirname);
		$list=array();
		while(($file = @readdir($handle))!==false){
			if($file != '.'&&$file !='..'){ 
				$list[]=$file;
			} 
		} 
		closedir($handle); 
		return $list; 
	}
}

class plugin_nimba_cover_forum extends plugin_nimba_cover{
	function viewthread_top_output(){
		//免费版 无自动封面设置功能
		return '<!-- run for free-->';
	}
	
	function viewthread_useraction(){
		global $_G;
		loadcache('plugin');
		$open_upload=intval($_G['cache']['plugin']['nimba_cover']['open_upload']);
		if(!$open_upload) return '';
		$groups=unserialize($_G['cache']['plugin']['nimba_cover']['groups']);
		if($_G['groupid']&&in_array($_G['groupid'],$groups)){
			return '<a href="plugin.php?id=nimba_cover:cover&tid='.$_G['tid'].'" id="nimba_cover" onclick="showWindow(this.id, this.href)"><i><img src="static/image/filetype/image_s.gif" alt="'.lang('plugin/nimba_cover','button').'">'.lang('plugin/nimba_cover','button').'</i></a>';
		}else{
			return '';
		}
	}
}

?>