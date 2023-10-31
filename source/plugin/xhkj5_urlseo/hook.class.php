<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_xhkj5_urlseo {
	
	public function common() {
		
		global $_G;
		extract($_G['cache']['plugin']['xhkj5_urlseo']);
		if($pc_open) {
			if(CURSCRIPT == 'forum' && CURMODULE == 'viewthread') {
				$tid = intval($_GET['tid']);
				$rs = DB::fetch_first("select * from " . DB::table('forum_thread') . " where tid = {$tid}");
				if(empty($rs) || $rs['displayorder'] == '-1') {
					$this -> _show404();
					die;
				}
			} elseif(CURSCRIPT == 'portal' && CURMODULE == 'view') {
				$aid = intval($_GET['aid']);
				$rs = DB::fetch_first("select * from " . DB::table('portal_article_title') . " where aid = {$aid}");
				if(empty($rs)) {
					$this -> _show404();
					die;
				}				
			}
		}
	}
	
	private function _show404() {
		
		header("HTTP/1.1 404 Not Found");
		global $_G;
		extract($_G['cache']['plugin']['xhkj5_urlseo']);
		$siteurl = $_G["siteurl"];
		$charset = $_G["charset"];
		$bbname = $_G['setting']['bbname'];
		if(file_exists(DISCUZ_ROOT . "./data/sysdata/cache_xhkj5_urlseo.php")) {
			require_once DISCUZ_ROOT . "./data/sysdata/cache_xhkj5_urlseo.php";
			if(intval($_G["timestamp"]) - intval($data["ctime"]) > 600) {
				$rs = $this -> _cache();
			}
			$rs = $data['data'];
		} else {
			$rs = $this -> _cache();
		}
		//echo '111';
		include template("xhkj5_urlseo:index");
	}
	
	public function _show404_re() {
		
		//header("HTTP/1.1 404 Not Found");
		global $_G;
		extract($_G['cache']['plugin']['xhkj5_urlseo']);
		$siteurl = $_G["siteurl"];
		$charset = $_G["charset"];
		$bbname = $_G['setting']['bbname'];
		if(file_exists(DISCUZ_ROOT . "./data/sysdata/cache_xhkj5_urlseo.php")) {
			require_once DISCUZ_ROOT . "./data/sysdata/cache_xhkj5_urlseo.php";
			if(intval($_G["timestamp"]) - intval($data["ctime"]) > 600) {
				$rs = $this -> _cache();
			}
			$rs = $data['data'];
		} else {
			$rs = $this -> _cache();
		}
		//echo '111';
		include template("xhkj5_urlseo:index");
	}
	
	public function _cache() {
		
		global $_G;
		require_once libfile('function/cache');
		$sql ="
			select 
				t.tid, 
				t.subject, 
				ti.attachment 
			from ".DB::table("forum_thread")." as t
			inner join ".DB::table("forum_threadimage")." as ti on t.tid = ti.tid 
			where  t.displayorder >= 0
			order by t.dateline desc
			limit 10";
		$rs = DB::fetch_all($sql);
		$data['data'] = $rs;
		$data['ctime'] = $_G["timestamp"];
		$cacheArr = "\$data = " . arrayeval($data) . ";\n";
		writetocache("xhkj5_urlseo", $cacheArr);
		return $data['data'];
	}		
}


class mobileplugin_xhkj5_urlseo {
	
	public function common() {
				
		global $_G;
		extract($_G['cache']['plugin']['xhkj5_urlseo']);
		if($mobile_open) {
			if(CURSCRIPT == 'forum' && CURMODULE == 'viewthread') {
				$tid = intval($_GET['tid']);
				$rs = DB::fetch_first("select * from " . DB::table('forum_thread') . " where tid = {$tid}");
				if(empty($rs) || $rs['displayorder'] == '-1') {
					$this -> _show404();
					die;
				}
			}
		}
	}
	
	private function _show404() {
		
		header("HTTP/1.1 404 Not Found");
		global $_G;
		extract($_G['cache']['plugin']['xhkj5_urlseo']);
		$siteurl = $_G["siteurl"];
		$charset = $_G["charset"];
		$bbname = $_G['setting']['bbname'];
		include template("xhkj5_urlseo:index");
	}	
}