<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_yytd_vip extends discuz_table
{
	public function __construct() {

		$this->_table = 'yytd_vip';
		$this->_pk    = '';

		parent::__construct();
	}
	
	public function fetch_orderCondition($order_status=null,$username=null,$submitdatebegin=null,$submitdateend=null,$confirmbegin=null,$confirmend=null)
	{
		$condition = '';
		$condition .= $order_status ? ' AND order_status='. $order_status:'';
		$condition .= $username ? " AND username=". "'".$username."'":'';

		if($submitdatebegin and $submitdateend){
			$condition .=' AND (adddate>='.strtotime($submitdatebegin.' 00:00:00').' AND adddate<='.strtotime($submitdateend.' 23:59:59').')';
		}
		if($submitdatebegin and !$submitdateend){
				$condition .=$submitdatebegin? ' AND adddate>='.strtotime($submitdatebegin.' 00:00:00'):'';
		}
		if($confirmbegin and $confirmend){
			$condition .=' AND (adddate>='.strtotime($confirmbegin.' 00:00:00').' AND adddate<='.strtotime($confirmend.' 23:59:59').')';
		}
		
		if($confirmbegin and !$confirmend){
			$condition .=$confirmbegin? ' AND adddate>='.strtotime($confirmbegin.' 00:00:00'):'';
		}
		if($condition ==''){
			return  DB::fetch_all('SELECT * FROM  %t  ORDER BY adddate desc', array($this->_table));
		}
		echo $condition;
		$condition = substr($condition,4);
		return  DB::fetch_all('SELECT * FROM %t where ' .$condition .' ORDER BY adddate desc', array($this->_table));
		
	}
	public function fetch_ordercompleted_data($showNumber)
	{
		return DB::fetch_all('SELECT * FROM %t where order_status=2 and trade_no is not null ORDER BY editdate desc  limit 8', array($this->_table));
	}
	
	public function insert_data($data)
	{
		return 	DB::insert($this->_table,$data);
	}
	
	public function  fetch_buy_order_id($order_id)
   {
		return DB::fetch_first('SELECT * FROM %t WHERE  order_id=%s', array($this->_table, $order_id));
	}
	
	public function update_by_order_id($order_id,$trade_no,$timestamp)
	{
		return DB::query("UPDATE %t SET order_status=2,trade_no='".$trade_no. "' ,editdate = ".$timestamp." WHERE order_id=%s AND order_status<>2", array($this->_table, $order_id));
	}
}

?>