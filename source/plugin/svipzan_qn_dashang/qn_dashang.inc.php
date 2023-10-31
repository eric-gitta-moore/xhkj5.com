<?php

/**

 * 	   QQ：1245941148

 *	   time：2016-11-8  22:25:04

 */


if(!defined('IN_DISCUZ')) {

   exit('Access Deined');

}
		global $_G;
        $date= $_G['cache']['plugin']['svipzan_qn_dashang'];
        $kaiguan= $date['kaiguan'];
        $nav_name= $date['nav_name'];
        $top_info= $date['top_info'];
 		$but_info= $date['but_info'];
 		$copyright= $date['copyright'];
 		$alipay_url= $date['alipay_url'];
 		$wxpay_url= $date['wxpay_url'];
 		$qqpay_url= $date['qqpay_url'];
 		$bdpay_url= $date['bdpay_url'];
		$root='source/plugin/svipzan_qn_dashang/template/';
include template('svipzan_qn_dashang:qn_dashang');
?>