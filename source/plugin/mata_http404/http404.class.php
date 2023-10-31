<?php 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_mata_http404{
	
	private function show_404(){
		global $_G;
		$cfg=$_G['cache']['plugin']['mata_http404'];
		header("HTTP/1.1 404 Not Found");
		header("STATUS:404 Not Found");
		if($cfg['istemp']){
			echo str_replace('{CHARSET}',CHARSET,$cfg['temp']);
			exit();
		}
	}
	
	
	
	public function common(){
		global $_G;
		
		$cfg=$_G['cache']['plugin']['mata_http404'];
		
		if($cfg['isopen']==1){
		
		if(CURSCRIPT=='forum' && CURMODULE=='viewthread'){
			
			if(!isset($_GET['tid'])) {
				self::show_404();
			}
			else{
				$n=DB::fetch_first('SELECT tid from '.DB::table('forum_thread').' where tid='.intval($_GET['tid']));
				if($n['tid']!=$_GET['tid']){
					self::show_404();
				}	
			}
			
		}
		
		if(CURSCRIPT=='forum' && CURMODULE=='index'){
			if(isset($_GET['gid'])){
				$n=DB::fetch_first('SELECT fid from '.DB::table('forum_forum').' where fid='.intval($_GET['gid']));
				if($n['fid']!=$_GET['gid']){
						self::show_404();
				}
			}
		}
		
		if(CURSCRIPT=='forum' && CURMODULE=='forumdisplay'){
			
			if(!isset($_GET['fid'])) {
				self::show_404();
			}
			else{
			
				$n=DB::fetch_first('SELECT fid from '.DB::table('forum_forum').' where fid='.intval($_GET['fid']));
				if($n['fid']!=$_GET['fid']){
					self::show_404();
				}
			}
			
		}
		
		
		if(CURSCRIPT=='portal' && CURMODULE=='view'){
			$n=DB::fetch_first('SELECT aid from '.DB::table('portal_article_title').' where aid='.intval($_GET['aid']));
			
			if($n['aid']!=$_GET['aid']){
					self::show_404();
			}
		}
		
		if(CURSCRIPT=='portal' && CURMODULE=='list'){
			$n=DB::fetch_first('SELECT catid from '.DB::table('portal_category').' where catid='.intval($_GET['catid']));	
			if($n['catid']!=$_GET['catid']){
					self::show_404();
			}
			
			
		}
		
		}


	}
	
	public function global_header(){
		
	}
	
}


?>