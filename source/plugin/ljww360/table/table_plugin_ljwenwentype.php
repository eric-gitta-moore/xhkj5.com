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

class table_plugin_ljwenwentype extends discuz_table
{
	public function __construct() {

		$this->_table = 'plugin_ljwenwentype';
		$this->_pk    = 'id';

		parent::__construct();
	}
	public function fetch_ljwwtype_all_upid($catid){
		if($catid){
			return DB::fetch_all(" select * from %t where upid=%d",array($this->_table,$catid));
		}else{
			return DB::fetch_all(" select * from ".DB::table($this->_table)." where upid=0 order by displayorder asc");
		}
	}
	public function fetch_ljwwtype_all_id($av){
		return DB::fetch_all(" select * from ".DB::table($this->_table)." where id in ($av) order by displayorder asc");
	}
	public function fetch_ljwwtype_all_count($wendajf){
		//return DB::fetch_all ( "select a.username,a.uid,b.$wendajf from " . DB::Table ( 'common_member' ) . " a left join " . DB::table ( 'common_member_count' ) . " b on a.uid=b.uid  ORDER BY b.$wendajf DESC limit 0,10 " );
	}
	public function fetch_by_upid_count($catid){
		return DB::result_first(" select count(*) from %t where upid=%d",array($this->_table,$catid));
	}
}

?>