<?php
/*
Author:·Ö.Ïí.°É
Website:www.fx8.cc
Qq:154-6069-14
*/
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

/**
* ·ÖÒ³
*/
class Page
{
	var $size;
	var $total;
	var $pagenum;
	var $curpage;
	var $url;
	function __construct($total,$size=50,$url,$hash='')
	{
		$this->total = $total;
		$this->size = $size;
		$this->pagenum = ($this->total ==  0)?0:ceil($this->total/$this->size);
		$this->url = $url;
		$this->curpage = isset($_GET['p']) && intval($_GET['p'])>0?intval($_GET['p']):1;
	}

	function getStart(){
		return ($this->curpage-1)*$this->size;
	}

	function getSize(){
		return $this->size;
	}

	function  show(){
		$pageshow = '';
		for($i=1;$i<=$this->pagenum;$i++){
			if($this->curpage == $i){
				$pageshow .= '<strong>'.$i.'</strong>';
			}else{
				$pageshow .= '<a href="./'.$this->url.'&p='.$i.$hash.'">'.$i.'</a>';
			}
		}
		return $pageshow;
	}


	function showprenext(){
		$pre  = '<a class="button button-big icon icon-left button-fill button-danger"  href="./'.$this->url.'&p='.($this->curpage-1).'">'.lang('plugin/jameson_fx','shangyiye').'</a>';
		$next  = '<a  class="button button-big button-fill icon icon-right button-success" href="./'.$this->url.'&p='.($this->curpage+1).'">'.lang('plugin/jameson_fx','xiayiye').'</a>';
		if($this->curpage == 1){
			$pre = '<a class="button icon icon-left button-big button-fill button-danger disabled">'.lang('plugin/jameson_fx','meiyoule').'</a>';
		}
		if($this->curpage >= $this->pagenum){
			$next = '<a  class="button button-big icon icon-right button-fill button-success disabled">'.lang('plugin/jameson_fx','meiyoule').'</a>';
		}
		return '<div class="col-50">'.$pre.'</div><div class="col-50">'.$next.'</div>';
	}

}