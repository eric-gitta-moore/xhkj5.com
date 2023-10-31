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
* 
*/
class table_jamesonfx_day extends discuz_table
{
	
	function __construct()
	{
		$this->_table = 'jamesonfx_day';
		$this->_pk = 'fxuid';
		parent::__construct();
	}

	// 今日已奖励积分数量
	function count_today_byuid($uid,$timestart){
		return (int) DB::result_first('SELECT count FROM %t WHERE fxuid=%d AND '.DB::field('addtime',$timestart,'>'),array($this->_table,$uid));
	}

	// 插入今日记录表
	function add($uid,$kedui){
		if($old = $this->fetch(intval($uid))){
			// 如果原本存在则更新
			$data = array();
			$data['fxuid'] = intval($uid);
			$data['addtime'] = time();
			if(($old['addtime']) > dmktime(date('Y-m-d',time()))){
				// 如果已有时间大于今日0点，则相加，否则直接替换
				$data['count'] = intval($old['count'])+intval($kedui);
			}else{
				$data['count'] = intval($kedui);
			}
			$this->update(intval($uid),$data);
		}else{
			// 不存在则插入
			$this->insert(array(
				'addtime'=>time(),
				'fxuid'=>intval($uid),
				'count'=>intval($kedui)
				));
		}
		return;
	}

	// 今日排行榜
	function fetch_jinri($size,$start,$end){
		return (array) DB::fetch_all('SELECT d.fxuid,d.count,c.username  FROM %t AS d INNER JOIN %t  AS c ON d.fxuid=c.uid  WHERE d.addtime<%d AND d.addtime>%d  ORDER BY d.count DESC LIMIT %d',array($this->_table,'common_member',$end,$start,$size));
	}
	// 清空所有记录
	function clear(){
		$this->truncate();
	}
}