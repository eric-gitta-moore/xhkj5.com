<?php
/**
 *      [Liangjian] (C)2001-2099 Liangjian Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_plugin_lj_exam.php liangjian $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_plugin_ljwenwen_ts extends discuz_table
{
	public function __construct() {

		$this->_table = 'plugin_ljwenwen_ts';
		$this->_pk    = 'wid';
		parent::__construct();
	}
	public function fetch_by_conutid($lunzhuan,$ziti){
		return DB::result_first(" select count(*) from %t where lunzhuan=%d and ziti=%d ",array($this->_table,$lunzhuan,$ziti));
	}
	public function fetch_by_id($lunzhuan,$ziti){
		return DB::fetch_first(" select * from %t where lunzhuan=%d and ziti=%d order by timestamp desc",array($this->_table,$lunzhuan,$ziti));
	}
	public function fetch_all_by_id($lunzhuan,$ziti,$start,$end){
		return DB::fetch_all(" select * from %t where lunzhuan=%d and ziti=%d order by timestamp desc limit %d,%d",array($this->_table,$lunzhuan,$ziti,$start,$end));
	}
	public function range_by_id($con,$start,$perpage,$sort){
		return DB::fetch_all('select * from '.DB::table($this->_table)." $con order by id $sort limit $start,$perpage");
	}
	public function count_by_id($con){
		return DB::result_first('select count(*) from '.DB::table($this->_table)." $con ");
	}
}


?>