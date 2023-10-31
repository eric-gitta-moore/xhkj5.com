<?php
/**
 *	[网站内容自动提交至百度(urlpush.urlpush.class)] (C)2016-2099 Powered by 安德兔：http://www.andetu.com.
 *	Version: 1.0
 *	Date: 2016-09-12 09:58
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_urlpush {

}

class plugin_urlpush_forum extends plugin_urlpush {

	public function post_attribute_extra_body() {
		global $_G;
		if(in_array($_G['groupid'],dunserialize($_G['cache']['plugin']['urlpush']['post_gp'])) && in_array($_G['fid'],dunserialize($_G['cache']['plugin']['urlpush']['post_fm'])) && $_GET['action'] != 'reply'){
			return '<div class="cl" style="background: #E5EDF2;border: 1px solid #CDCDCD;padding: 10px 14px;margin-top:15px;"><div class="sinf sppoll" style="width:100%;border-right:0"><dl><dt><span style="width: 4em">'.lang('plugin/urlpush', 'post_span').'&nbsp;</span></dt><dd><label for="urlpush"><input type="checkbox" name="urlpush" id="urlpush" class="pc vm" checked value="yes"> '.lang('plugin/urlpush', 'post_span_notic').'</label></dd></dl></div></div>';
		}
	}
	
	public function post_feedlog_message($param) {
		global $_G;
		$tid = $param['param'][2]['tid'];
		$fid = $param['param'][2]['fid'];
		if($_GET['urlpush'] == 'yes' && $_GET['action'] != 'reply' && $tid && $fid){
			$condition1 = substr($param['param'][0], -8) != '_succeed';
			$condition2 = $_GET['action'] == 'edit' && !$GLOBALS['isfirstpost'];
			if ($condition1 || $condition2) {
				return false;
			}
			$urls = array($_G['siteurl'].'forum.php?mod=viewthread&tid='.$tid);
			$api = $_G['cache']['plugin']['urlpush']['bdurl'];
			if(function_exists('curl_init') && function_exists('curl_exec')){
				$ch = curl_init();
				$options =  array(
					CURLOPT_URL => $api,
					CURLOPT_POST => true,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POSTFIELDS => implode("\n", $urls),
					CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
				);
				curl_setopt_array($ch, $options);
				$result = curl_exec($ch);
				$result =   json_decode($result,true);
				DB::insert('andetu_urlpush',array(
						'uid' => $_G['uid'],
						'username' => $_G['member']['username'],
						'tid' => $tid,
						'fid' => $fid,
						'dateline' => TIMESTAMP,
						'type' => 'postthread',
						'message' => $result['message'] ? $result['message'] : '',
						'not_valid' => $result['not_valid'] ? serialize($result['not_valid']) : '',
						'url' => serialize($urls),
						'status' => $result['success'] ? $result['success'] : 0,
				));
			}else{
				DB::insert('andetu_urlpush',array(
						'uid' => $_G['uid'],
						'username' => $_G['member']['username'],
						'tid' => $tid,
						'fid' => $fid,
						'dateline' => TIMESTAMP,
						'type' => 'postthread',
						'message' =>lang('plugin/urlpush', 'no_curl_init_message'),
						'url' => serialize($urls),
						'status' => 0,
				));
			}
		}
	}
	
	public function viewthread_title_extra(){
		global $_G;
		if(in_array($_G['groupid'],dunserialize($_G['cache']['plugin']['urlpush']['view_gp'])) && in_array($_G['fid'],dunserialize($_G['cache']['plugin']['urlpush']['view_fm']))){
			return '<a href="plugin.php?id=urlpush&tid='.$_G['tid'].'" onclick="showWindow(\'urlpush\', this.href);">['.lang('plugin/urlpush', 'view_urlpush').']</a>';
		}
	}

}

?>