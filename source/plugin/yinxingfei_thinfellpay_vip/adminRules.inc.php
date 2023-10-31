<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
showtips(lang('plugin/yinxingfei_thinfellpay_vip', 'tips'));
showtableheader(lang('plugin/yinxingfei_thinfellpay_vip', 'ruletitle'));
showtablerow('','',lang('plugin/yinxingfei_thinfellpay_vip', 'rulenote00'));
showtablerow('','',lang('plugin/yinxingfei_thinfellpay_vip', 'rulenote01'));
showtablerow('','',lang('plugin/yinxingfei_thinfellpay_vip', 'rulenote02'));
showtablerow('','',lang('plugin/yinxingfei_thinfellpay_vip', 'rulenote03'));
showtablefooter();
?>