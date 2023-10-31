<?php
/**
 *      [Liangjian] (C)2001-2099 Liangjian Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_plugin_lj_post.php liangjian $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_plugin_lj_post extends discuz_table
{
	public function __construct() {

		$this->_table = 'plugin_lj_post';
		$this->_pk    = 'id';

		parent::__construct();
	}
	public function fetch_by_bestnum($starttime,$endtime){
		return DB::fetch_first ( "select count(*) best,authorid,author from %t WHERE   first!='1' and %s < dateline and %s > dateline and bestnum='1'  group by authorid order by count(*) desc" ,array($this->_table,$starttime,$endtime));
	}
	public function fetch_by_conut_tid($uid){
		return DB::result_first("select count(tid) from %t where  authorid=%d and first!='1' ",array($this->_table,$uid));
	}
	public function fetch_post_all_bestnum($uid){
		if($uid){
			return DB::fetch_all("select threadid from %t where bestnum=1 and first!=1 and authorid=%d ",array($this->_table,$uid));
		}else{
			return DB::fetch_all("select threadid,message from " . DB::table ( $this->_table )." where bestnum=1 and first!=1 ");
		}
		
	}
	public function fetch_post_all_first(){
		return DB::fetch_first ( "select count(*) num,author,authorid from " . DB::table ( $this->_table ) . " WHERE   first!='1' group by author order by count(*) desc" );
	}
	public function fetch_by_first(){
		return DB::fetch_first ( "select count(*) a,authorid,author from " . DB::table ( $this->_table ) . " WHERE   first!='1' and curdate()=FROM_UNIXTIME(dateline,'%Y-%m-%d')   group by authorid order by count(*) desc" );
	}
	public function fetch_common_join_count($wendajf,$uid){
		return DB::fetch_first ( "select a.username,b.".$wendajf." from %t a left join %t b on a.uid=b.uid WHERE  a.uid=%d " ,array('common_member','common_member_count',$uid));
	}
	public function fetch_by_count_brenfirst($uid){
		return DB::result_first("select count(tid) from %t where  authorid=%d and first='1'",array($this->_table,$uid));
	}
	public function fetch_by_count_brenbestnum($uid){
		return DB::result_first("select count(*) from %t where   authorid=%d and bestnum='1'",array($this->_table,$uid));
	}
	public function fetch_by_count_bren($uid){
		return DB::result_first("select count(*) from %t where  authorid=%d and first='0' ",array($this->_table,$uid));
	}
	public function fetch_post_all_threadid($uid){
		return DB::fetch_all("select threadid from %t where first!=1 and authorid=%d ",array($this->_table,$uid));
	}
	public function fetch_by_del($id){
		return DB::query("DELETE FROM %t where threadid = %d",array($this->_table,$id));
	}
	public function fetch_by_brhdnum($uid){
		return DB::result_first ( "select count(*) from " . DB::table ($this->_table) . " WHERE   first!='1' and curdate()=FROM_UNIXTIME(dateline,'%Y-%m-%d')  AND  authorid=".$uid );
	}
	public function fetch_by_num($id){
		return DB::result_first("SELECT count(*) FROM %t where threadid=%d and first!=1 and invisible>='0'",array($this->_table,$id));
	}
	public function fetch_by_forum_post_pid($tid){
		return DB::result_first("SELECT pid FROM %t where tid=%d and first=1 and invisible>='0'",array('forum_post',$tid));
	}
	public function fetch_by_forum_attachment_tableid($tid){
		return DB::result_first("SELECT tableid FROM %t where tid=%d ",array('forum_attachment',$tid));
	}
	public function fetch_by_forum_attachment_x($tid,$pid,$table){
		return DB::fetch_all("SELECT aid,isimage,attachment,filename FROM %t where tid=%d and pid=%d",array($table,$tid,$pid));
	}
	public function fetch_post_join_thread($id){
		return DB::fetch_first ( " select a.*,b.price,b.special,b.sign,b.catid,b.bc,b.replies,b.catid2,b.views,b.qrcode from %t a left join %t b on b.id=a.threadid where a.threadid =%d and a.first=1",array($this->_table,'plugin_lj_thread',$id));
	}
	public function fetch_post_by_threadid($id){
		return DB::fetch_first("SELECT * FROM %t where bestnum=1 and first!=1  and threadid=%d",array($this->_table,$id));
	}
	public function fetch_post_by_ht($id,$curnum,$perpage){
		return DB::fetch_all ( " select * from %t where threadid =%d and first!=1 and invisible>='0' order by id desc limit %d,%d",array($this->_table,$id,$curnum,$perpage));
	}
	public function fetch_post_by_tuisong_thread($tid){
		return DB::result_first("select threadid from %t where first=1 and tid=%d",array($this->_table,$tid));
	}
	public function fetch_forum_post_by_tid($tid){
		return DB::fetch_first("select * from %t where first=1 and tid=%d",array('forum_post',$tid));
	}
	public function fetch_forum_post_count_fid($fid) {
		$fid=dimplode($fid);
		if($end){
			$con.=" and dateline > $start and dateline < $end";
		}
		return DB::result_first("select count(*) from %t where fid in (".$fid.") and invisible>='0' $con",array('forum_post'));
	}
	public function fetch_forum_post_all_fid($fid,$post_curnum,$postpage) {
		$fid=dimplode($fid);
		if($end){
			$con.=" and dateline > $start and dateline < $end";
		}
		return DB::fetch_all("select * from %t where fid in (".$fid.") and invisible>='0' $con limit %d,%d",array('forum_post',$post_curnum,$postpage));
	}
	public function fetch_forum_post_count_post_tid($tid) {
		$tid=dimplode($tid);
		return DB::result_first("select count(*) from %t where tid in (".$tid.") and invisible>='0' ",array('forum_post'));
	}
	public function fetch_forum_post_all_post_tid($tid) {
		$tid=dimplode($tid);
		
		//debug($tid);
		return DB::fetch_all("select * from %t where tid in (".$tid.") and invisible>='0' ",array('forum_post'));
	}
	public function fetch_forum_post_by_conuttid($pid) {
		return DB::result_first("select count(*) from %t where pid=%d",array($this->_table,$pid));
	}
	public function fetch_post_by_bianji_threadid($id) {
		return DB::fetch_first("select * from %t where first=1 and threadid=%d",array($this->_table,$id));
	}
	public function count_by_id($con){
		return DB::result_first("SELECT count(*) FROM %t $con and first=0 and invisible>='0'",array($this->_table));
	}
	public function range_by_id($con,$start,$perpage,$desc){
		return DB::fetch_all("SELECT * FROM %t  $con and  first=0 and invisible>='0' order by pid $desc limit %d,%d",array($this->_table,$start,$perpage));
	}
	public function fetch_by_thread_forum_post(){
		$replies=DB::fetch_first("select *,max(replies) from ".DB::table('plugin_lj_thread')." where  curdate()=FROM_UNIXTIME(lastpost,'%Y-%m-%d') group by id");
		//debug($replies);
		return DB::fetch_first ("select * from %t where threadid=%d and first=1",array($this->_table,$replies['id']));
	}
	public function fetch_forum_post_by_tid_first($tid){
		return DB::fetch_all("select * from %t where tid=%d",array('forum_post',$tid));
	}
}

?>