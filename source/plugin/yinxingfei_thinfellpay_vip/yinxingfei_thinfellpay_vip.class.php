<?php

if(!defined('IN_DISCUZ')) {  
    exit('Access Denied');  
}  
class plugin_yinxingfei_thinfellpay_vip{
		
	function global_usernav_extra2(){
		global $_G;
		$navMenu = $_G['cache']['plugin']['yinxingfei_thinfellpay_vip']['navMenu'];
		if(trim($navMenu)!=""){
			$url = 'plugin.php?id=yinxingfei_thinfellpay_vip';
			return ' | <a href="'.$url.'"><strong style="color:#ff6600">'.$navMenu.'</strong></a>';
		}
		else{
			return "";
		}
	}
}
class plugin_yinxingfei_thinfellpay_vip_forum extends plugin_yinxingfei_thinfellpay_vip
{
	function index_nav_extra(){
			global $_G;
			$noteContent = $_G['cache']['plugin']['yinxingfei_thinfellpay_vip']['noteContent'];
			$isindexshow = $_G['cache']['plugin']['yinxingfei_thinfellpay_vip']['isindexshow'];
			if($isindexshow){

				$order_completed_data = C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->fetch_ordercompleted_data();
				if($order_completed_data){
               		$rand = mt_rand(0,count($order_completed_data)-1);
					$noteContent = str_replace(array('{datetime}','{username}','{usergroup}'),array(date('Y-m-d H:i:s',$order_completed_data[$rand]['adddate'] ),$order_completed_data[$rand]['username'],$order_completed_data[$rand]['group_name']),$noteContent);
					include template('yinxingfei_thinfellpay_vip:Message');
				}
				else
                {
                    $noteContent = lang('plugin/yinxingfei_thinfellpay_vip', 'no one get vip');
                    $noteContent = '';
                    include template('yinxingfei_thinfellpay_vip:Message');
                }
                return $noteContent;
			}
	}	
}
?>