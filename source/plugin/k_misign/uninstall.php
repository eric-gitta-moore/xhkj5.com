<?php

/*

 * 出处：五动中原

 * 官网: www.5dzy.cc

 * 备用网址: www.5dzy.cc (请收藏备用!)

www.5dzy.cc

 * 

 */

if(!defined('IN_DISCUZ')) {

	exit('Access Denied');

}

DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_misign'));

DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_misignset'));

DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_misign_prize'));

DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_misign_prize_kami'));

DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_misign_prize_log'));

DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_misign_push'));

DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_misign_lastrule'));

DB::query("DROP TABLE IF EXISTS ".DB::table('plugin_k_misign_bq'));

$finish = TRUE;

?>
