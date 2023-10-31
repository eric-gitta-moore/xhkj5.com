<?php

/**

 * 

 * 信偶网出品 必属精品

 * 信偶网源码论坛 全网首发 http://www.5dzy.cc

 * 感谢支持！您的支持是我们最大的动力！永久免费下载本站所有资源！

 * 欢迎大家来访获得最新更新的优秀资源！更多VIP特色资源不容错过！！

 * 信偶网用户交流群: ①群303954994

 * 永久域名：http://www.5dzy.cc/ (请收藏备用!)

 * 

 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {

	exit('Access Denied');

}



$url ='http://www.5dzy.cc/wq_viewthread-index.html';

$content = dfsockopen($url, 0, $post, '', FALSE, '', 120);

if ($content) {

	$content = iconv('gbk', CHARSET, $content);

	$content = str_replace('resource/devgroup.gif', 'http://addon.discuz.com/resource/devgroup.gif', $content);

	$content = str_replace('resource/developer', 'http://addon.discuz.com/resource/developer', $content);

	$content = str_replace('resource/event', 'http://addon.discuz.com/resource/event', $content);

	$content = str_replace('resource/plugin', 'http://addon.discuz.com/resource/plugin', $content);

	$content = str_replace('resource/template', 'http://addon.discuz.com/resource/template', $content);

	$content = str_replace('resource/pack', 'http://addon.discuz.com/resource/pack', $content);

	$content = str_replace('image/scrolltop.png', 'http://addon.discuz.com/image/scrolltop.png', $content);

	$content = str_replace('?ac=developer&id=', '?action=plugins&operation=config&do='.$pluginid.'&identifier='.$plugin['identifier'].'&pmod=addon&did=', $content);

	

	$content = preg_replace('/<div class="itemtitle" id="header">.*<div class="a_wp cl">/s', '<div class="a_wp cl">', $content);

	$content = preg_replace('/<div class="a_wp mbm cl">.*<div class="a_wp cl">/s', '<div class="a_wp cl">', $content);

	$content = preg_replace('/<ul class="a_tb cl">.*<div id="appdiv">/s', '<div id="appdiv">', $content);

	$content = preg_replace('/<div class="mtm type">.*<div id="appdiv">/s', '<div id="appdiv">', $content);

	$content = preg_replace('/<div id="footer">.*<\/div>/s', '', $content);

	echo $content;

}

