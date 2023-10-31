<?php
/**
 * @Project_name :  
 * @Author: 源码哥 www_YMG6_COM
 * @Date:   2016-01-24 20:52:08
 * @Email: caogenba@qq.com
 * @Web:http://www.fx8.cc
 * @Last Modified by:   源码哥 www_YMG6_COM
 * @Last Modified time: 2016-04-20 21:55:39
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
function init_jamesonfx(){
	global $_G;
	loadcache('plugin');
	$_G['jameson_fx']['trameid'] = intval($_G['cache']['plugin']['jameson_fx']['trameid'])?intval($_G['cache']['plugin']['jameson_fx']['trameid']):2;
	$_G['jameson_fx']['trametitle'] = $_G['setting']['extcredits'][$_G['jameson_fx']['trameid']]['title'];
	$_G['jameson_fx']['tramefield'] = 'extcredits'.$_G['jameson_fx']['trameid'];

	$_G['jameson_fx']['jiangli'] = intval($_G['cache']['plugin']['jameson_fx']['jiangli']);
	$_G['jameson_fx']['fenxiangkejian'] = intval($_G['cache']['plugin']['jameson_fx']['fenxiangkejian']);
	// 默认显示哪组排行榜数据
	$_G['jameson_fx']['whichpaihang'] = ($_G['cache']['plugin']['jameson_fx']['whichpaihang']);
	// 排行榜标题
	$_G['jameson_fx']['paihangbangtitle'] = trim($_G['cache']['plugin']['jameson_fx']['paihangbangtitle']);

	$_G['jameson_fx']['fxkjmessage'] = trim($_G['cache']['plugin']['jameson_fx']['fxkjmessage']);
	// 启用手机端分享
	$_G['jameson_fx']['enablemobile'] = intval($_G['cache']['plugin']['jameson_fx']['enablemobile']);
	// 启用pc端分享
	$_G['jameson_fx']['enablepc'] = intval($_G['cache']['plugin']['jameson_fx']['enablepc']);
	// 手机端是否显示二维码
	$_G['jameson_fx']['erweima'] = intval($_G['cache']['plugin']['jameson_fx']['erweima']);
	// pc端是否显示二维码
	$_G['jameson_fx']['pcerweima'] = intval($_G['cache']['plugin']['jameson_fx']['pcerweima']);
	$_G['jameson_fx']['time'] = intval($_G['cache']['plugin']['jameson_fx']['time']);
	// 每日奖励积分上限
	$_G['jameson_fx']['top'] = intval($_G['cache']['plugin']['jameson_fx']['top']);
	// PC图片分享
	$_G['jameson_fx']['pcimgfx'] = intval($_G['cache']['plugin']['jameson_fx']['pcimgfx']);
	// 头像下显示排行榜
	$_G['jameson_fx']['showpaihangbang'] = intval($_G['cache']['plugin']['jameson_fx']['showpaihangbang']);
	// PC划词分享
	$_G['jameson_fx']['pchuaci'] = intval($_G['cache']['plugin']['jameson_fx']['pchuaci']);
	// 是否奖励自己
	$_G['jameson_fx']['self'] = intval($_G['cache']['plugin']['jameson_fx']['self']);
	// pc端默认分享图标
	$_G['jameson_fx']['button'] = unserialize($_G['cache']['plugin']['jameson_fx']['pcbutton']);
	// 是否启用了侧栏
	$_G['jameson_fx']['celan'] = unserialize(trim($_G['cache']['plugin']['jameson_fx']['celan']));
	// 手机端默认分享图标
	$_G['jameson_fx']['shoujibutton'] = unserialize($_G['cache']['plugin']['jameson_fx']['mobilebutton']);
	$_G['jameson_fx']['morentitle'] = $_G['cache']['plugin']['jameson_fx']['morentitle'];
	$_G['jameson_fx']['morendescro'] = $_G['cache']['plugin']['jameson_fx']['morendescro'];
	$_G['jameson_fx']['morenimage'] = $_G['cache']['plugin']['jameson_fx']['morenimage'];
	$_G['jameson_fx']['appid'] = $_G['cache']['plugin']['jameson_fx']['appid'];
	$_G['jameson_fx']['appsec'] = $_G['cache']['plugin']['jameson_fx']['appsec'];
	$_G['jameson_fx']['debug'] = $_G['cache']['plugin']['jameson_fx']['debug']?'true':'false';
	$_G['jameson_fx']['tishiyu'] = $_G['cache']['plugin']['jameson_fx']['tishiyu'];
	$_G['jameson_fx']['mytishiyu'] = $_G['cache']['plugin']['jameson_fx']['mytishiyu'];
	// 最近访问者头像列表
	$_G['jameson_fx']['fxusers'] = (int) $_G['cache']['plugin']['jameson_fx']['fxusers'];
	// 门户
	$_G['jameson_fx']['menhu'] = (int) $_G['cache']['plugin']['jameson_fx']['menhu'];
	$_G['jameson_fx']['onlyone'] = (int) $_G['cache']['plugin']['jameson_fx']['onlyone'];
	$_G['jameson_fx']['otherimg'] = trim($_G['cache']['plugin']['jameson_fx']['otherimg']);
	// 启用的版块
	$_G['jameson_fx']['forum'] = unserialize($_G['cache']['plugin']['jameson_fx']['forum']);
	$_G['jameson_fx']['kejianbankuai'] = unserialize($_G['cache']['plugin']['jameson_fx']['kejianbankuai']);
	$_G['jameson_fx']['jifenzhong'] = intval($_G['cache']['plugin']['jameson_fx']['jifenzhong'])*60;
}