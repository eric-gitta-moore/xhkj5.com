<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_csu_baidu_guest extends discuz_table {

	public function __construct() {
		$this->_table = 'csu_baidu_guest';
		$this->_pk = 'code';

		parent::__construct();
	}
	function deletebyuserid($userid){
		return DB::delete($this->_table,array('userid'=>$userid));
	}
	function byuserid($userid){
		return DB::fetch_first("SELECT * FROM %t WHERE userid=%d",array($this->_table,$userid));
	}
}