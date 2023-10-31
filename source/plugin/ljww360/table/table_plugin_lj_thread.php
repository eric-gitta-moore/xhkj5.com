<?php
/**
 *      [Liangjian] (C)2001-2099 Liangjian Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_alj_eggs_log.php liangjian $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_plugin_lj_thread extends discuz_table
{
	public function __construct() {

		$this->_table = 'plugin_lj_thread';
		$this->_pk    = 'id';

		parent::__construct();
	}
	public function fetch_thread_all_dj($indexasknum,$conn){
		return DB::fetch_all("select * from %t where sign!='1' and displayorder>='0' $conn order by id desc limit 0,%d",array($this->_table,$indexasknum,));
	}
	public function fetch_thread_all_yjj($indexasknum){
		return DB::fetch_all("select * from %t where sign='1' and displayorder>='0' order by id desc limit 0,%d",array($this->_table,$indexasknum,));
	}
	public function fetch_thread_all_zero($indexasknum){
		return DB::fetch_all("select * from %t where sign!='1' and displayorder>='0' and replies='0' order by id desc limit 0,%d",array($this->_table,$indexasknum,));
	}
	public function fetch_thread_all_gxs($indexasknum){
		return DB::fetch_all("select * from %t where sign!='1' and displayorder>='0' and price>'0' order by price desc limit 0,%d",array($this->_table,$indexasknum,));
	}
	public function fetch_thread_all_tj($lzts){
		if($lzts){
			//debug($lzts);
			return DB::fetch_all("select * from %t where id in ($lzts) ",array($this->_table));
		}else{
			return DB::fetch_all('select * from '.DB::table($this->_table)." where sign!='1' and displayorder>='0' order by id desc limit 0,24");
		}
	}
	public function fetch_thread_all($pid){
		return DB::fetch_all ( "select * from " . DB::table ( $this->_table ) . " where id in ($pid)  order by id desc limit 0,2" );
	}
	public function fetch_thread_by_conn($conn){
		return DB::result_first('select count(*) from '.DB::table($this->_table)." $conn");
	}
	public function fetch_thread_all_conn($conn,$curnum,$perpage){
		if($perpage){
			$limit="limit $curnum,$perpage";
		}
		return DB::fetch_all('select * from '.DB::table($this->_table)." $conn $limit");
	}
	public function fetch_thread_all_gerendj($con,$uid){
		return DB::fetch_all("select * from %t where $con and authorid=$uid and displayorder>='0' order by id desc limit 0,10",array($this->_table,$uid));
	}
	public function fetch_thread_all_cn($pid){
		return DB::fetch_all ( "select * from " . DB::table ( $this->_table ) . " where id in ($pid)  order by id desc limit 0,10" );
	}
	public function fetch_common_credit_log($tid){
		return DB::result_first(" select count(*) from %t where operation='RAC' and relatedid=%d",array('common_credit_log',$tid));
	}
	public function fetch_update_common_member_status($ip,$time,$x_uid) {
		return DB :: query("UPDATE %t SET lastip=%s,lastvisit=%s,lastactivity=%s,lastpost=%s WHERE uid=%d'",'UNBUFFERED', array('common_member_status',$ip,$time,$x_uid));
	}
	public function fetch_update_by_replies_views($username,$timestamp,$id) {
		return DB :: query("UPDATE %t SET replies=replies+1,views=views+1,lastposter=%s, lastpost=%s WHERE id=%d", array($this->_table,$username,$timestamp,$id));
	}
	public function fetch_thread_all_xgwt_catid($catid) {
		return DB::fetch_all ("select * from %t where displayorder>='0' AND authorid>'0' and catid =%d  order by id desc limit 0,5",array($this->_table,$catid));
	}
	public function fetch_forum_thread_count_fid($fid,$start,$end,$special) {
		
		
		if(count($fid)>1){
			$fid=dimplode($fid);
			$con.=" and fid in (".$fid.")";
		}else{
			$fid=dimplode($fid);
			$con.=" and fid=".$fid;
		}
		if($end){
			$con.=" and dateline > $start and dateline < $end";
		}
		if($special){
			$con.=" and special=3";
		}
		
		return DB::result_first("select count(*) from %t where  displayorder>='0' and closed!=1 $con",array('forum_thread'));
	}
	public function fetch_forum_thread_all_fid($fid,$forum_curnum,$forumpage,$start,$end,$special) {
		if(count($fid)>1){
			$fid=dimplode($fid);
			$con.=" and fid in (".$fid.")";
		}else{
			$fid=dimplode($fid);
			$con.=" and fid=".$fid;
		}
		if($end){
			$con.=" and dateline > $start and dateline < $end";
		}
		if($special){
			$con.=" and special=3";
		}
		if($forumpage){
			return DB::fetch_all("select * from %t where  displayorder>='0' and closed!=1 $con limit %d,%d",array('forum_thread',$forum_curnum,$forumpage));
		}else{
			return DB::fetch_all("select * from %t where  displayorder>='0' and closed!=1 $con",array('forum_thread'));
		}
	}
	public function fetch_forum_thread_all_count_tid($fid,$start,$end) {
		$fid=dimplode($fid);
			if($end){
				$con.=" and dateline > $start and dateline < $end";
			}
			return DB::fetch_all("select * from %t where fid in (".$fid.") and displayorder>='0' and closed!=1 $con ",array('forum_thread'));
	}
	public function fetch_forum_thread_by_conuttid($tid) {
		return DB::result_first("select * from %t where tid=%d",array($this->_table,$tid));
	}
	public function fetch_thread_by_bc($tid) {
		return DB::result_first("select bc from %t where tid=%d",array($this->_table,$tid));
	}
	public function forum_thread_update($tid,$time,$x_user){
		if($_G['setting']['version']!='X2'){
			return DB :: query("UPDATE %t SET replies=replies+1,views=views+1,lastposter=%s, lastpost=%s,maxposition=maxposition+1 WHERE tid=%d",array('forum_thread',$x_user,$time,$tid));
		}else{
			return DB :: query("UPDATE %t SET replies=replies+1,views=views+1,lastposter=%s, lastpost=%s WHERE tid=%d",array('forum_thread',$x_user,$time,$tid));
		}
	}
	public function range_by_id($con,$start,$perpage,$sort){
		return DB::fetch_all('select * from '.DB::table($this->_table)." $con order by id $sort limit $start,$perpage");
	}
	public function count_by_id($con){
		return DB::result_first('select count(*) from '.DB::table($this->_table)." $con ");
	}
	public function forum_thread_update_views($tid){
		return DB :: query("UPDATE %t SET views=views+1 WHERE tid=%d",array('forum_thread',$tid));
	}
	public function fetch_update_views($id){
		return DB :: query("UPDATE %t SET views=views+1 WHERE id=%d",array($this->_table,$id));
	}
	public function fetch_thread_all_block($con,$sc,$items){
		return DB::fetch_all("select * from %t $con and displayorder>='0' $sc limit 0,%d",array($this->_table,$items));
	}
	public function fetch_thread_all_mobile(){
		return DB::fetch_all("select * from %t where  displayorder>='0' order by views desc limit 0,5",array($this->_table));
	}
}

?>