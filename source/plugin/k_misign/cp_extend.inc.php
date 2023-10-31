<?php

/**

 * 

 * 信偶网提醒：为保证信偶网资源的更新维护保障，防止信偶网首发资源被恶意泛滥，

 *             希望所有下载信偶网资源的会员不要随意把信偶网首发资源提供给其他人;

 *             如被发现，将取消信偶网VIP会员资格，停止一切后期更新支持以及所有补丁BUG等修正服务；

 *          

 * 信偶网出品 必属精品

 * 信偶网源码论坛 全网首发 http://www.5dzy.cc

 * 官网：www.lbw3.com (请收藏备用!)

 * 技术支持/更新维护：QQ 898235212

 * 谢谢支持，感谢你对信偶网源码论坛的关注和信赖！！！   

 * 

 */



if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {

	exit('Access Denied');

}

loadcache('plugin');

$setting = $_G['cache']['plugin']['k_misign'];

require_once libfile('function/core', 'plugin/k_misign');



$act = $_GET['act'];

$formhash = isset($_GET['formhash']) ? trim($_GET['formhash']) : '';

if($act == 'lastdefend'){

	C::import('extend/lastdefend','plugin/k_misign');

}elseif($act == 'dataimport'){

	C::import('extend/dataimport','plugin/k_misign');

}elseif($act == 'dataexport'){

	C::import('extend/dataexport','plugin/k_misign');

}else{

	//辅助系统

	showtableheader(lang('plugin/k_misign', 'extend'), 'psetting');

	//仿小米每日格言点赞

	showtablerow('class="hover"', array('valign="top" style="width:45px"', 'valign="top"', 'align="right" valign="bottom" style="width:160px"'), array(

					'<img src="http://open.discuz.net/resource/plugin/k_migeyan.png" onerror="this.src=\'static/image/admincp/plugin_logo.png\';this.onerror=null" width="40" height="40" align="left" />',

					'<span '.($extend['k_migeyan'] ? 'class="bold"' : 'class="bold light"').'>'.lang('plugin/k_misign', 'extend_k_migeyan').'</span>'.

					'<p><span class="bold light">'.($extend['k_migeyan'] ? lang('plugin/k_misign', 'extend_installed') : '<a href="http://addon.discuz.com/?@k_migeyan.plugin">'.lang('plugin/k_misign', 'extend_toinstall').'</a>').'</span></p>'

	) );

	showtablefooter();

	

	//增值组件

	showtableheader(lang('plugin/k_misign', 'extend'));

		//数据导入

		showtablerow('', array('class="td24 lineheight"','class="td24 lineheight smallfont"','class="lineheight smallfont"'), array(lang('plugin/k_misign', 'extend_dataimport'),($extend['dataimport'] ? lang('plugin/k_misign', 'extend_installed') : '<a href="http://addon.discuz.com/?@k_misign.plugin.49727">'.lang('plugin/k_misign', 'extend_toinstall').'</a>'),($extend['dataimport'] ? '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$do.'&identifier=k_misign&pmod=cp_extend&act=dataimport">'.$lang['config'].'</a>' : '')));

		//数据导入

		showtablerow('', array('class="td24 lineheight"','class="td24 lineheight smallfont"','class="lineheight smallfont"'), array(lang('plugin/k_misign', 'extend_dataexport'),($extend['dataexport'] ? lang('plugin/k_misign', 'extend_installed') : '<a href="http://addon.discuz.com/?@k_misign.plugin.49727">'.lang('plugin/k_misign', 'extend_toinstall').'</a>'),($extend['dataexport'] ? '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$do.'&identifier=k_misign&pmod=cp_extend&act=dataexport">'.$lang['config'].'</a>' : '')));

		//连签维护

		showtablerow('', array('class="td24 lineheight"','class="td24 lineheight smallfont"','class="lineheight smallfont"'), array(lang('plugin/k_misign', 'extend_lastdefend'),($extend['lastdefend'] ? lang('plugin/k_misign', 'extend_installed') : '<a href="http://addon.discuz.com/?@k_misign.plugin.49732">'.lang('plugin/k_misign', 'extend_toinstall').'</a>'),($extend['lastdefend'] ? '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$do.'&identifier=k_misign&pmod=cp_extend&act=lastdefend">'.$lang['config'].'</a>' : '')));

	showtablefooter();

	

	//道具扩展

	showtableheader(lang('plugin/k_misign', 'extend_magics'));

		//补签卡

		showtablerow('', array('class="td24 lineheight"','class="td24 lineheight smallfont"','class="lineheight smallfont"'), array(lang('plugin/k_misign', 'magic_bq'),($extend['magic']['bq'] ? lang('plugin/k_misign', 'extend_installed') : '<a href="http://addon.discuz.com/?@k_misign.plugin">'.lang('plugin/k_misign', 'extend_toinstall').'</a>'), ''));

	showtablefooter();

}

//From:www_lbw3_co

?>
