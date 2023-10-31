<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_nimba_linkhelper {
	public $uids=array();
	public $nav=0;
	public $name='';
	
	function  __construct() {
	    loadcache('plugin');
		global $_G;
		$this->vars = $_G['cache']['plugin']['nimba_linkhelper'];
		$this->uids=explode(",",$this->vars['uids']);
		$this->nav=$this->vars['ailab_rk'];
		$this->name=$this->vars['ailab_mc'];
	}
	function global_cpnav_extra1() {
		loadcache('plugin');
		global $_G;
		if($this->nav==2) return '<a href="plugin.php?id=nimba_linkhelper:addlink" target="_blank">'.$this->name.'</a>';
	}

	function global_nav_extra(){
		loadcache('plugin');
		global $_G;
		if($this->nav==3) return '<ul><li><a href="plugin.php?id=nimba_linkhelper:addlink" target="_blank">'.$this->name.'</a></ul></li>';	
	}
	
	function global_footerlink(){
		loadcache('plugin');
		global $_G;
		if($this->nav==4) return '<span class="pipe">|</span><a href="plugin.php?id=nimba_linkhelper:addlink" target="_blank">'.$this->name.'</a>';	
	}
	
	function global_usernav_extra2(){
		loadcache('plugin');
		global $_G;
		if($this->nav==5) return '<span class="pipe">|</span><a href="plugin.php?id=nimba_linkhelper:addlink" target="_blank">'.$this->name.'</a>';		
	}	
}

?>