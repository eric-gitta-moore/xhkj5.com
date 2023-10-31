<?php
/*
 *讯幻网：www.xhkj5.com
 *更多商业插件/模版免费下载 就在讯幻网
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */



if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_dc_downlimit {
	var $cvar=null;
	function plugin_dc_downlimit(){
		global $_G;
		$this->cvar= $_G['cache']['plugin']['dc_downlimit'];
	}
	function global_usernav_extra3(){
		global $_G;
		if(!$this->cvar['open'])
			return;
		$r=DB::fetch_first("select * from ".DB::table('dc_downlimit')." where fid='".$_G['fid']."'");
		$data=dunserialize($r['data']);
		if(!$data[$_G['groupid']]['free'])
			return;
		$r=DB::fetch_first("select * from ".DB::table('dc_downlimit_user')." where uid='".$_G['uid']."' and fid='".$_G['fid']."' and from_unixtime(dateline,'%Y%m%d')='".dgmdate(TIMESTAMP,'Ymd')."'");
		if(!$r)
			$r['times']=0;
		if($this->cvar['freemsg'])
			$fmsg=$this->cvar['freemsg'];
		else
			$fmsg=$this->plang('freeinfo');
		return str_replace(array('{total}','{count}','{times}'),array($data[$_G['groupid']]['free'],$data[$_G['groupid']]['free']>$r['times']?$data[$_G['groupid']]['free']-$r['times']:0,$r['times']),$fmsg);
	}
	function _download(){
		global $_G;
		$ck = $_GET['ck'];
		@list($aid, $k, $t, $uid, $tid) = explode('|', base64_decode($_GET['aid']));
		if(!$ck){
			$att=DB::fetch_first("SELECT * FROM ".DB::table('forum_attachment')." where aid='".$aid."' AND uid='".$_G['uid']."'");
			if(!empty($att))
				return;
			$thread = C::t('forum_thread')->fetch_by_tid_displayorder($tid, 0, '>=', null, 0);
			$fid = $thread['fid'];
			$r=DB::fetch_first("select * from ".DB::table('dc_downlimit')." where fid='$fid'");
			$data=dunserialize($r['data']);
			if(!$data[$_G['groupid']])
				return;
			$r=DB::fetch_first("select * from ".DB::table('dc_downlimit_user')." where uid='".$_G['uid']."' and fid='".$fid."' and from_unixtime(dateline,'%Y%m%d')='".dgmdate(TIMESTAMP,'Ymd')."'");
			if(!$r){
				DB::query("REPLACE INTO ".DB::table('dc_downlimit_user')."(uid,fid,times,dateline) VALUES('".$_G['uid']."','".$fid."','1','".TIMESTAMP."')");
				if($data[$_G['groupid']]['free'])
					dheader('location: forum.php?mod=attachment&aid='.aidencode($aid,0,$tid).'&ck='.substr(md5($aid. TIMESTAMP .md5($_G['config']['security']['authkey'])), 0, 8));
			}else{
				if($r['times']<$data[$_G['groupid']]['max']||!$data[$_G['groupid']]['max']){
					DB::query("update ".DB::table('dc_downlimit_user')." set times=times+1 where uid='".$_G['uid']."' and fid='".$fid."'");
					if($r['times']<$data[$_G['groupid']]['free'])
						dheader('location: forum.php?mod=attachment&aid='.aidencode($aid,0,$tid).'&ck='.substr(md5($aid. TIMESTAMP .md5($_G['config']['security']['authkey'])), 0, 8));
				}else{
					if($this->cvar['msg'])
						$msg=$this->cvar['msg'];
					else
						$msg=$this->plang('downinfo');
					showmessage(str_replace('{count}',$data[$_G['groupid']]['max'],$msg));
				}
			}
		}else{
			if($ck != substr(md5($aid.$t.md5($_G['config']['security']['authkey'])), 0, 8)) {
				showmessage($this->plang('error'));
			}
		}
	}
	function plang($str){
		return lang('plugin/dc_downlimit',$str);
	}
}
class plugin_dc_downlimit_forum extends plugin_dc_downlimit{
	function attachment_down() {
		if(!$this->cvar['open'])
			return;
		$this->_download();
	}
}
?>