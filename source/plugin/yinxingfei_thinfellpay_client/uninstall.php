<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

DB::query("DROP TABLE IF EXISTS ".DB::table('a_yinxingfei_thinfellpay_client_order')."");

$finish = TRUE;