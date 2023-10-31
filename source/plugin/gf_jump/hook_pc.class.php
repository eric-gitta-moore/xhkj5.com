<?php
/**
 *	[帖子重定向跳转链接(gf_jump.{modulename})] (C)2016-2099 Powered by 插件大王.
 *	Version: V1.0
 *	Date: 2016-1-4 21:07
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_gf_jump {
	
	protected $myconfg = array();

	public function plugin_gf_jump() {
		global $_G;
		$this->myconfg['onoff'] = $_G ['cache'] ['plugin'] ['gf_jump']['onoff'] ;
		$this->myconfg['allowgroups'] = ( array ) dunserialize (  $_G ['cache'] ['plugin'] ['gf_jump']['allowgroups'] );
		$this->myconfg['allowforums'] = ( array ) dunserialize (  $_G ['cache'] ['plugin'] ['gf_jump']['allowforums'] );
	}
	
	public function global_cpnav_top(){
		global $_G;
		if ($this->myconfg['onoff'] && !in_array ( $_G['groupid'], $this->myconfg['allowgroups'] ) && in_array ( $_G['fid'], $this->myconfg['allowforums'] )) {
			$url = DB::result_first ( "SELECT url FROM " . DB::table ( 'gf_jump' ) . " WHERE tid=".$_G['tid']);
			if ($url) {
				header("Location: {$url}");die;
			}
		}
	}
	
	public function deletethread($params) {
		global $_G;
		$count = count($_G['deletethreadtids']);
		for($i=0;$i<$count;$i++){
			DB::delete('gf_jump', array('tid'=> $_G['deletethreadtids'][$i]));
		}
	}
	
	public function post_message($params) {
		global $_G;
		if($this->myconfg['onoff']){
			
			if(!$params) return;  
			$param = $params['param'];
			$link = dhtmlspecialchars($_GET['gf_jump_link']);
			
			switch ($param[0]) {
				case 'post_newthread_succeed' :
					if(!empty($link)){
						$tid = DB::result_first ( "SELECT tid FROM " . DB::table ( 'forum_thread' ) . " order by tid desc");
						$val = array(
							'tid' => $tid,
							'url' => $link
						);
						DB::insert('gf_jump', $val);
					}
					break;
				case 'post_reply_succeed' :
					break;
				case 'post_edit_succeed' :
					if(empty($link)){
						DB::delete('gf_jump', array('tid'=> $_G['tid']));
					}else{
						$val = array(
							'tid' => $_G['tid'],
							'url' => $link
						);
						DB::insert('gf_jump', $val,0,1);
					}
					break;
			}
		}
	}

}

//脚本嵌入点类
class plugin_gf_jump_forum extends plugin_gf_jump {
	

	public function post_top_output() {
		global $_G;
		$html = '';
		if ($this->myconfg['onoff'] && in_array ( $_G['groupid'], $this->myconfg['allowgroups'] ) && in_array ( $_G['fid'], $this->myconfg['allowforums'] )) {
			$name = lang('plugin/gf_jump', 'jumplink') ;
			$title = lang('plugin/gf_jump', 'texttips') ;
			$url = DB::result_first ( "SELECT url FROM " . DB::table ( 'gf_jump' ) . " WHERE tid=".$_G['tid']);
			$html = '<div class="pbt cl" style="width:310px;float:right;margin-bottom:-20px">
						<div class="ftid">'.$name.'</div>
						<div class="z">
							<span><input name="gf_jump_link" tabindex="1" class="px"  style="width: 20em" title="'.$title.'" value="'.$url.'" type="text"></span>
						</div>
					</div>';
		}
		
		
		return $html;
	}
	
	public function forumdisplay_thread_output() {
		global $_G;
		
		if ($this->myconfg['onoff'] && in_array ( $_G['groupid'], $this->myconfg['allowgroups'] ) && in_array ( $_G['fid'], $this->myconfg['allowforums'] )) {
		
			foreach($_G['forum_threadlist'] as $key => $value){
					$tidlist[] = $value['tid'];
			}
			
			$postlist = array();
			$query = DB::query('SELECT tid,url FROM ' . DB::table ( 'gf_jump' ) . ' WHERE '.DB::field('tid', $tidlist));
			while($post = DB::fetch($query)) {
				$postlist[$post['tid']] = $post['url'];
			}
			
			$islink = lang('plugin/gf_jump', 'islink') ;
			foreach($_G['forum_threadlist'] as $key => $value){
				if($postlist[$value['tid']]){
					$tidlists[] = '<a href="'.$postlist[$value['tid']].'" style="color:blue" target="_blank">['.$islink.']</a>';
				}else{
					$tidlists[] = '';
				}
			}
			
			
			return $tidlists;
		
			
		}
	}
	
	public function viewthread_title_extra_output(){
		global $_G;
		if ($this->myconfg['onoff'] && in_array ( $_G['groupid'], $this->myconfg['allowgroups'] ) && in_array ( $_G['fid'], $this->myconfg['allowforums'] )) {
			$url = DB::result_first ( "SELECT url FROM " . DB::table ( 'gf_jump' ) . " WHERE tid=".$_G['tid']);
			if ($url) {
				$islink = lang('plugin/gf_jump', 'islink') ;
				$html = '<span><a href="'.$url.'" style="color:blue" target="_blank">['.$islink.']</a></span>';
				return $html;
			}
		}
	}


}

?>