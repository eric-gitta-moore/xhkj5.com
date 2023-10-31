<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


if(!submitcheck('searchsubmit')) {

echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
showtips(lang('plugin/yytd_vip', 'tips'));
showtableheader(lang('plugin/yytd_vip', 'tableheader'));
showformheader('plugins&operation=config&do='.$pluginid.'&pmod=adminRecord&identifier=yytd_vip', 'testhd');  
showsetting(lang('plugin/yytd_vip', 'order_status'), array('order_status', array(
			array(0,lang('plugin/yytd_vip', 'order_status_all')),
			array(1,lang('plugin/yytd_vip', 'order_status_wait')),
			array(2, lang('plugin/yytd_vip', 'order_status_sucess')),
		)), intval(order_status), 'select');
showsetting( lang('plugin/yytd_vip', 'username'),'username','','text');  
showsetting( lang('plugin/yytd_vip', 'order_submitdate'), array('submitdatebegin', 'submitdateend'), array($sstarttime, $sendtime), 'daterange');
showsetting( lang('plugin/yytd_vip', 'order_confirmdate'), array('confirmbegin', 'confirmend'), array($cstarttime, $cendtime), 'daterange');
showsubmit('searchsubmit');
showformfooter();
showtablefooter();

}
if(submitcheck('searchsubmit', 1)) {
showtips(lang('plugin/yytd_vip', 'tips'));
showtableheader(lang('plugin/yytd_vip', 'tableheader'));
showtablerow("",'',array(lang('plugin/yytd_vip', 'order_id'),lang('plugin/yytd_vip', 'order_status'),lang('plugin/yytd_vip', 'username'),lang('plugin/yytd_vip', 'order_group_name'),lang('plugin/yytd_vip', 'order_valitidy'),lang('plugin/yytd_vip', 'order_price'),lang('plugin/yytd_vip', 'order_submitdate'),lang('plugin/yytd_vip', 'order_confirmdate')));
	$order_status = $_GET['order_status'];
	$username = $_GET['username'];
	$submitdatebegin = $_GET['submitdatebegin'];
	
	$submitdateend = $_GET['submitdateend'];
	
	$confirmbegin = $_GET['confirmbegin'];
	
	$confirmend = $_GET['confirmend'];
	
	$alldata = C::t('#yytd_vip#yytd_vip')->fetch_orderCondition($order_status,$username,$submitdatebegin,$submitdateend,$confirmbegin,$confirmend);
	//exit;
	
	foreach($alldata as $value){
		
		if($value['expire'] ==0){
			$value['expire'] =lang('plugin/yytd_vip', 'validityinfo');
		}
		switch ($value['order_status']) {
				case 1:
					$value['order_status'] =lang('plugin/yytd_vip', 'order_status_wait');
					break;
				case 2:
					$value['order_status'] =lang('plugin/yytd_vip', 'order_status_sucess');
					break;
		}
		if($value['adddate']  ==0){
			$value['adddate']  ='N/A';
		}else{
			$value['adddate']  =  date('Y-m-d H:i:s',$value['adddate'] );
		}
		
		if($value['editdate']  ==0){
			$value['editdate']  ='N/A';
		}else{
			$value['editdate']  = date('Y-m-d H:i:s',$value['editdate'] );
		}
	
		showtablerow("",'',array($value['order_id'],$value['order_status'],$value['username'],$value['group_name'],$value['expire'],$value['price'],$value['adddate'],$value['editdate']));
	}
	showtablefooter();
	}
?>