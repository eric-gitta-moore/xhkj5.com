<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . './function/function_baidu.php';
$siteurl = baidu_get_plugin_setting('siteurl');
$sppasswd = baidu_get_plugin_setting('sppasswd');
$token = baidu_get_plugin_setting('pingtoken');

$sign = md5($siteurl . $token);

if ($token && $sppasswd) {
    baidu_submit_sitemap_index('del', 3, $siteurl, $sppasswd, $sign);
    baidu_submit_sitemap_index('add', 3, $siteurl, $sppasswd, $sign);
}

$engine = baidu_get_plugin_setting('engine');
if (empty($engine)){
    C::t('#baidusubmit#baidusubmit_setting')->update('mobile', 1);
}

$finish = TRUE;
