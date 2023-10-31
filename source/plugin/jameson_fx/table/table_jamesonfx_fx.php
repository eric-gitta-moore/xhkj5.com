<?php
/*
Author:分.享.吧
Website:www.fx8.cc
Qq:154-6069-14
*/
if(!defined('IN_DISCUZ')){
	exit('Access Denid');
}
/**
* fxuid 多个 tid多个 jiangli为每次的奖励数
*/
class table_jamesonfx_fx extends discuz_table
{
	public $_time;
	public $_cache = array();
	function __construct()
	{
		$this->_table = 'jamesonfx_fx';
		$this->_pk = 'id';
		$this->_cache_ttl = 600;
		$this->_time = time();
		parent::__construct();
		// var_dump($this);
	}

	// 获取当前用户的分享记录数，以tid分组统计
	function count_byuid($uid){
		return (int)DB::result_first('SELECT count(*) FROM %t WHERE fxuid=%d GROUP BY tid',array($this->_table,$uid));
	}
	// 当前用户的分享记录和奖励,以tid分组
	function fetch_byuid($uid,$start,$size){
		return (array) DB::fetch_all('SELECT SUM(f.jiangli) as jianglinums,COUNT(f.fxuid) as usernums,f.id,f.fxuid,f.addtime,f.tid,f.jiangli,t.subject FROM %t as f INNER JOIN %t as t ON f.tid=t.tid WHERE f.fxuid=%d GROUP BY f.tid ORDER BY usernums DESC LIMIT %d,%d',array($this->_table,'forum_thread',$uid,$start,$size));
	}

	// 后台以会员查看，合并tid，总数
	function count_all_uid(){
		return  (int) count(DB::fetch_all('SELECT COUNT(fxuid) FROM %t GROUP BY fxuid',array($this->_table)));
	}

	// 后台以会员会员查看
	function fetch_all_uid($start,$size){
		return (array) DB::fetch_all(
			'SELECT SUM(f.jiangli) as jianglinums,COUNT(f.id) as usernums,f.fxuid,c.username FROM %t as f INNER JOIN %t as c ON f.fxuid=c.uid  GROUP BY fxuid ORDER BY usernums DESC LIMIT %d,%d',array($this->_table,'common_member',$start,$size)
			);
	}


	// 后台以tid查看，合并uid，总数
	function count_all_tid(){
		return  (int) count(DB::fetch_all('SELECT COUNT(tid) FROM %t GROUP BY tid',array($this->_table)));
	}

	// 后台以tid查看
	function fetch_all_tid($start,$size){
		return (array) DB::fetch_all(
			'SELECT SUM(f.jiangli) as jianglinums,COUNT(f.id) as usernums,f.tid,t.subject FROM %t as f INNER JOIN %t as t ON f.tid=t.tid  GROUP BY f.tid ORDER BY usernums DESC LIMIT %d,%d',array($this->_table,'forum_thread',$start,$size)
			);
	}
	// 清空所有记录
	function clear(){
		$this->truncate();
	}
	// 获取排行榜数据
	function fetch_paihang($num){
			$data = (array) DB::fetch_all(
				'SELECT SUM(f.jiangli) as jianglinums,COUNT(f.id) as usernums,f.fxuid,c.username FROM %t as f INNER JOIN %t as c ON f.fxuid=c.uid  GROUP BY fxuid ORDER BY jianglinums DESC LIMIT %d',array($this->_table,'common_member',$num)
				);
			$this->store_cache('jamesonfxpaihang',$data,$this->_cache_ttl,$this->_pre_cache_key);
			return $data;
	}
	// 获取最近分享者
	function fetch_new($num){
		return (array) DB::fetch_all('SELECT DISTINCT fxuid,username FROM %t as f INNER JOIN %t AS m ON f.fxuid=m.uid ORDER BY addtime DESC LIMIT %d',array($this->_table,'common_member',$num));
	}
}