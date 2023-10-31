<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_csu_baidu_connect extends discuz_table {

	public function __construct() {
		$this->_table = 'csu_baidu_connect';
		$this->_pk = 'uid';

		parent::__construct();
	}
	function getbyuserid($userid){
		return DB::fetch_first('SELECT * FROM %t WHERE userid=%d',array($this->_table,$userid));
	}
	function countbind(){
		$count = DB::fetch_first("SELECT COUNT(*) FROM %t WHERE status=1",array($this->_table));
		return end($count);
	}
	function getbind($orderby='dateline',$count=0,$sc='DESC',$page=0,$num=20){
		if($count) $sql = "SELECT COUNT(*) FROM %t WHERE status=1";
		else $sql = "SELECT * FROM %t WHERE status=1";
		$sql .= ' ORDER BY '.$orderby.' '.$sc;
		if($page) {
			$page = dintval($page);
			$num = dintval($num);
			$now = ($page-1)*$num;
			$sql .= ' LIMIT '.$now.','.$num;
		}//因为不一定有查询条数限制，所以就直接了
		if($count){
			$data = DB::fetch_first($sql,array($this->_table));
			$data = end($data);
		}else $data = DB::fetch_all($sql,array($this->_table));
		return $data;
	}
}