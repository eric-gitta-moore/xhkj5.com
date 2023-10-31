<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');
0
|| checktplrefresh('data/diy/./template/comiis_nby//portal/index.htm', './template/comiis_nby/common/header.htm', 1524236865, 'diy', './data/template/3_diy_portal_index.tpl.php', 'data/diy/./template/comiis_nby/', 'portal/index')
|| checktplrefresh('data/diy/./template/comiis_nby//portal/index.htm', './template/comiis_nby/common/comiis_navss.htm', 1524236865, 'diy', './data/template/3_diy_portal_index.tpl.php', 'data/diy/./template/comiis_nby/', 'portal/index')
|| checktplrefresh('data/diy/./template/comiis_nby//portal/index.htm', './template/comiis_nby/common/footer.htm', 1524236865, 'diy', './data/template/3_diy_portal_index.tpl.php', 'data/diy/./template/comiis_nby/', 'portal/index')
|| checktplrefresh('data/diy/./template/comiis_nby//portal/index.htm', './template/default/common/header_common.htm', 1524236865, 'diy', './data/template/3_diy_portal_index.tpl.php', 'data/diy/./template/comiis_nby/', 'portal/index')
|| checktplrefresh('data/diy/./template/comiis_nby//portal/index.htm', './template/comiis_nby/common/comiis_user.htm', 1524236865, 'diy', './data/template/3_diy_portal_index.tpl.php', 'data/diy/./template/comiis_nby/', 'portal/index')
|| checktplrefresh('data/diy/./template/comiis_nby//portal/index.htm', './template/comiis_nby/common/comiis_navss.htm', 1524236865, 'diy', './data/template/3_diy_portal_index.tpl.php', 'data/diy/./template/comiis_nby/', 'portal/index')
|| checktplrefresh('data/diy/./template/comiis_nby//portal/index.htm', './template/comiis_nby/common/header_qmenu.htm', 1524236865, 'diy', './data/template/3_diy_portal_index.tpl.php', 'data/diy/./template/comiis_nby/', 'portal/index')
|| checktplrefresh('data/diy/./template/comiis_nby//portal/index.htm', './template/default/common/pubsearchform.htm', 1524236865, 'diy', './data/template/3_diy_portal_index.tpl.php', 'data/diy/./template/comiis_nby/', 'portal/index')
;
block_get('144,154,148,138,140,149,150,232,227,152,151,141,128,126,127,153,145,146,136,130,131,133,129,139,132,134,135,142,143,147,167,137');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<?php if($_G['config']['output']['iecompatible']) { ?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE<?php echo $_G['config']['output']['iecompatible'];?>" /><?php } ?>
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if(empty($nobbname)) { ?> <?php echo $_G['setting']['bbname'];?> - <?php } ?> www.xhkj5.com</title>
<?php echo $_G['setting']['seohead'];?>

<meta name="keywords" content="<?php if(!empty($metakeywords)) { echo dhtmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { echo dhtmlspecialchars($metadescription); ?> <?php } if(empty($nobbname)) { ?>,<?php echo $_G['setting']['bbname'];?><?php } ?>" />
<meta name="generator" content="Xunhuan" />
<meta name="author" content="Xunhuan Team" />
<meta name="copyright" content="2001-2017 Xunhuan Inc." />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<base href="<?php echo $_G['siteurl'];?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_3_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_3_portal_index.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle']) && strpos($_G['cookie']['extstyle'], TPLDIR) !== false) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>', CSSPATH = '<?php echo $_G['setting']['csspath'];?>', DYNAMICURL = '<?php echo $_G['dynamicurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php if(empty($_GET['diy'])) { $_GET['diy'] = '';?><?php } if(!isset($topic)) { $topic = array();?><?php } require_once("./template/comiis_nby/comiis_config.php");?><meta name="application-name" content="<?php echo $_G['setting']['bbname'];?>" />
<meta name="msapplication-tooltip" content="<?php echo $_G['setting']['bbname'];?>" />
<?php if($_G['setting']['portalstatus']) { ?><meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['1']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['portal']) ? 'http://'.$_G['setting']['domain']['app']['portal'] : $_G['siteurl'].'portal.php'; ?>;icon-uri=<?php echo $_G['siteurl'];?><?php echo IMGDIR;?>/portal.ico" /><?php } ?>
<meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['2']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['forum']) ? 'http://'.$_G['setting']['domain']['app']['forum'] : $_G['siteurl'].'forum.php'; ?>;icon-uri=<?php echo $_G['siteurl'];?><?php echo IMGDIR;?>/bbs.ico" />
<?php if($_G['setting']['groupstatus']) { ?><meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['3']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['group']) ? 'http://'.$_G['setting']['domain']['app']['group'] : $_G['siteurl'].'group.php'; ?>;icon-uri=<?php echo $_G['siteurl'];?><?php echo IMGDIR;?>/group.ico" /><?php } if(helper_access::check_module('feed')) { ?><meta name="msapplication-task" content="name=<?php echo $_G['setting']['navs']['4']['navname'];?>;action-uri=<?php echo !empty($_G['setting']['domain']['app']['home']) ? 'http://'.$_G['setting']['domain']['app']['home'] : $_G['siteurl'].'home.php'; ?>;icon-uri=<?php echo $_G['siteurl'];?><?php echo IMGDIR;?>/home.ico" /><?php } if($_G['basescript'] == 'forum' && $_G['setting']['archiver']) { ?>
<link rel="archives" title="<?php echo $_G['setting']['bbname'];?>" href="<?php echo $_G['siteurl'];?>archiver/" />
<?php } if(!empty($rsshead)) { ?><?php echo $rsshead;?><?php } if(widthauto()) { ?>
<link rel="stylesheet" id="css_widthauto" type="text/css" href='<?php echo $_G['setting']['csspath'];?><?php echo STYLEID;?>_widthauto.css?<?php echo VERHASH;?>' />
<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
<?php } if($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && check_diy_perm($topic)) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && check_diy_perm($topic)) { ?>
<link rel="stylesheet" type="text/css" id="diy_common" href="<?php echo $_G['setting']['csspath'];?><?php echo STYLEID;?>_css_diy.css?<?php echo VERHASH;?>" />
<?php } $comiis_ff=1;?><?php if($comiis_window_width==2) { ?>
<script>
if(screen.width>1210){
HTMLNODE.className += ' comiis_wide';
}
</script>
<?php } if($comiis_navss!=3) { ?>
<style>
#comiis_hd, #comiis_nv {margin-bottom:5px;}
.comiis_wide #comiis_hd, .comiis_wide #comiis_nv {margin-bottom:10px;}
</style>
<?php } ?>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?><?php if($_G['basescript'] === 'portal' && CURMODULE === 'list' && !empty($cat)) { ?> <?php echo $cat['bodycss'];?><?php } if($comiis_window_width==1) { ?> comiis_wide<?php } ?> ityp" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && check_diy_perm($topic)) { include template('common/header_diy'); } if(check_diy_perm($topic)) { include template('common/header_diynav'); } if(CURMODULE == 'topic' && $topic && empty($topic['useheader']) && check_diy_perm($topic)) { ?>
<?php echo $diynav;?>
<?php } if(empty($topic) || $topic['useheader']) { if($_G['setting']['mobile']['allowmobile'] && (!$_G['setting']['cacheindexlife'] && !$_G['setting']['cachethreadon'] || $_G['uid']) && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')) { ?>
<div class="xi1 bm bm_c">
请选择 <a href="<?php echo $_G['siteurl'];?>forum.php?mobile=yes">进入手机版</a><span class="xg1">|</span><a href="<?php echo $_G['setting']['mobile']['nomobileurl'];?>">继续访问电脑版</a>
</div>
<?php } if($_G['setting']['shortcut'] && $_G['member']['credits'] >= $_G['setting']['shortcut']) { ?>
<div id="shortcut">
<span><a href="javascript:;" id="shortcutcloseid" title="关闭">关闭</a></span>
您经常访问 <?php echo $_G['setting']['bbname'];?>，试试添加到桌面，访问更方便！
<a href="javascript:;" id="shortcuttip">添加 <?php echo $_G['setting']['bbname'];?> 到桌面</a>
</div>
<script type="text/javascript">setTimeout(setShortcut, 2000);</script>
<?php } ?>
<div id="toptb" class="cl">
<?php if(!empty($_G['setting']['pluginhooks']['global_cpnav_top'])) echo $_G['setting']['pluginhooks']['global_cpnav_top'];?>
<div class="wp cl">
<?php if($comiis_header==1) { ?>			
<div class="y comiis_nvlogin"><div class="comiis_um cl">
<?php if($_G['uid']) { ?>	
<div class="z comiis_cjpimg"></div>
<div id="comiis_key" onMouseOver="showMenu({'ctrlid':this.id,'pos':'34!','ctrlclass':'on','duration':2});">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" title="访问我的空间" target="_blank" class="kmuser"><?php echo avatar($_G[uid],small);?><span><?php echo $_G['member']['username'];?></span></a><?php if($_G['member']['newpm'] || $_G['member']['newprompt']) { ?><span class="kmmsnon"></span><?php } else { ?><span class="kmmsn"></span><?php } ?>
</div>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser" class="noborder"><?php echo dhtmlspecialchars($_G['cookie']['loginuser']); ?></a></strong>
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">激活</a>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } elseif(!$_G['connectguest']) { ?>
<div class="z qqdlico"><?php if(!empty($_G['setting']['pluginhooks']['global_login_text'])) echo $_G['setting']['pluginhooks']['global_login_text'];?></div>
<div class="comiis_dlq"><a onclick="showWindow('login', this.href);return false;" href="member.php?mod=logging&amp;action=login">登录</a> | <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><?php echo $_G['setting']['reglinkname'];?></a></div>
<?php } else { ?>
<strong class="vwmy qq"><?php echo $_G['member']['username'];?></strong>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
<a href="home.php?mod=spacecp&amp;ac=credit&amp;showcredit=1">积分: 0</a>
用户组: <?php echo $_G['group']['grouptitle'];?>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } ?>
</div></div>
<div class="y">
<?php if($_G['uid'] && !empty($_G['style']['extstyle'])) { ?><a id="sslct" href="javascript:;" onmouseover="delayShow(this, function() {showMenu({'ctrlid':'sslct','pos':'34!'})});">切换风格</a><?php } if(check_diy_perm($topic)) { ?>
<?php echo $diynav;?>
<?php } ?>
<a id="switchblind" href="javascript:;" onclick="toggleBlind(this)" title="开启辅助访问" class="switchblind">开启辅助访问</a>
</div>
<?php } else { ?>
<div class="y">
<a id="switchblind" href="javascript:;" onclick="toggleBlind(this)" title="开启辅助访问" class="switchblind">开启辅助访问</a>
<?php if(!empty($_G['setting']['pluginhooks']['global_cpnav_extra2'])) echo $_G['setting']['pluginhooks']['global_cpnav_extra2'];?><?php if(is_array($_G['setting']['topnavs']['1'])) foreach($_G['setting']['topnavs']['1'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><?php echo $nav['code'];?><?php } } if(empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']) { ?>
<a href="javascript:;" id="switchwidth" onclick="widthauto(this)" title="<?php if(widthauto()) { ?>切换到窄版<?php } else { ?>切换到宽版<?php } ?>" class="switchwidth"><?php if(widthauto()) { ?>切换到窄版<?php } else { ?>切换到宽版<?php } ?></a>
<?php } if($_G['uid'] && !empty($_G['style']['extstyle'])) { ?><a id="sslct" href="javascript:;" onmouseover="delayShow(this, function() {showMenu({'ctrlid':'sslct','pos':'34!'})});">切换风格</a><?php } if(check_diy_perm($topic)) { ?>
<?php echo $diynav;?>
<?php } ?>
</div>
<?php } ?>
<div class="z">
<a class="comiis_tweibo" target="_blank" href="http://weibo.com/xhkj5" title="新浪微博"></a>
<a href="javascript:;" class="comiis_tweixin" id="kmweixin" onMouseOver="showMenu({'ctrlid':this.id,'pos':'43!','ctrlclass':'hover','duration':2});" title="官方微信"></a>
<a class="comiis_tkefu" target="_blank" href="http://wpa.qq.com/msgrd?V=3&amp;uin=2444300667&amp;Site=%20%D1%B6%BB%C3%CD%F8&amp;Menu=yes&amp;from=discuz" title="在线客服"></a><?php if(is_array($_G['setting']['topnavs']['0'])) foreach($_G['setting']['topnavs']['0'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><?php echo $nav['code'];?><?php } } ?>
<a href="javascript:;" onclick="showWindow('qqgroup', 'plugin.php?id=xhkj5_qqgroup','get',1);">加入QQ群</a>
<?php if(!empty($_G['setting']['pluginhooks']['global_cpnav_extra1'])) echo $_G['setting']['pluginhooks']['global_cpnav_extra1'];?>
<?php if(!empty($_G['setting']['pluginhooks']['global_cpnav_extra2'])) echo $_G['setting']['pluginhooks']['global_cpnav_extra2'];?><?php if(is_array($_G['setting']['topnavs']['1'])) foreach($_G['setting']['topnavs']['1'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><?php echo $nav['code'];?><?php } } ?>
</div>
<div style="display:none" class="weixin_tip" id="kmweixin_menu">			
<div class="weixin_img"></div>
<p>扫一扫关注官方微信</p>
</div>
</div>
</div><?php echo adshow("headerbanner/wp a_h");?><?php if($comiis_header==1) { ?>
<div style="height:111px;">
<div id="comiis_hd">
<div class="wp cl"><?php $mnid = getcurrentnav();?><div class="comiis_hdnv">
<ul><?php if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><li <?php if($mnid == $nav['navid']) { ?>class="a" <?php } ?><?php echo $nav['nav'];?>></li><?php } } ?>
</ul>
<?php if(!empty($_G['setting']['pluginhooks']['global_nav_extra'])) echo $_G['setting']['pluginhooks']['global_nav_extra'];?>
</div>
<h2><?php if(!isset($_G['setting']['navlogos'][$mnid])) { ?><a href="<?php if($_G['setting']['domain']['app']['default']) { ?>http://<?php echo $_G['setting']['domain']['app']['default'];?>/<?php } else { ?>./<?php } ?>" title="<?php echo $_G['setting']['bbname'];?>"><?php echo $_G['style']['boardlogo'];?></a><?php } else { ?><?php echo $_G['setting']['navlogos'][$mnid];?><?php } ?></h2>			
</div>		
</div>
</div>
<div class="ssnr" style="clear:both;"></div>
<?php } else { ?>
<div id="hd">
<div class="wp">
<div class="hdc cl"><?php $mnid = getcurrentnav();?><h2><?php if(!isset($_G['setting']['navlogos'][$mnid])) { ?><a href="<?php if($_G['setting']['domain']['app']['default']) { ?>http://<?php echo $_G['setting']['domain']['app']['default'];?>/<?php } else { ?>./<?php } ?>" title="<?php echo $_G['setting']['bbname'];?>"><?php echo $_G['style']['boardlogo'];?></a><?php } else { ?><?php echo $_G['setting']['navlogos'][$mnid];?><?php } ?></h2><?php include template('common/header_userstatus'); ?></div>
<div class="ssnr" style="clear:both;"></div>
</div>
<div style="height:60px;">
<div id="comiis_nv">
<div class="wp comiis_nvbox cl">
<?php if($comiis_navss==1) { ?>
<div id="sckm" class="y"><?php if($_G['setting']['search']) { $slist = array();?><?php if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><a href="javascript:;" rel="curforum" fid="{$_G['fid']}" >本版</a></li>
EOF;
?><?php } if($_G['setting']['portalstatus'] && $_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><a href="javascript:;" rel="article">文章</a></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><a href="javascript:;" rel="forum" class="curtype">帖子</a></li>
EOF;
?><?php } if(helper_access::check_module('blog') && $_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><a href="javascript:;" rel="blog">日志</a></li>
EOF;
?><?php } if(helper_access::check_module('album') && $_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><a href="javascript:;" rel="album">相册</a></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><a href="javascript:;" rel="group">{$_G['setting']['navs']['3']['navname']}</a></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><a href="javascript:;" rel="user">用户</a></li>
EOF;
?>
<?php } if($_G['setting']['search'] && $slist) { ?>
<div id="comiis_twtsc" class="<?php if($_G['setting']['srchhotkeywords'] && count($_G['setting']['srchhotkeywords']) > 5) { ?>comiis_scbar_narrow <?php } ?>cl">
<form id="scbar_form" method="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?>get<?php } else { ?>post<?php } ?>" autocomplete="off" onsubmit="searchFocus($('comiis_twtsc_txt'))" action="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?><?php echo $searchparams['url'];?><?php } else { ?>search.php?searchsubmit=yes<?php } ?>" target="_blank">
<input type="hidden" name="mod" id="comiis_twtsc_mod" value="search" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="srhlocality" value="<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>" />
<?php if(!empty($searchparams['params'])) { if(is_array($searchparams['params'])) foreach($searchparams['params'] as $key => $value) { $srchotquery .= '&' . $key . '=' . rawurlencode($value);?><input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>" />
<?php } ?>
<input type="hidden" name="source" value="discuz" />
<input type="hidden" name="fId" id="srchFId" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="q" id="cloudsearchquery" value="" />			
<style>
#comiis_twtsc { overflow: visible; position: relative; }
#comiis_sg{ background: #FFF; width:456px; border: 1px solid #B2C7DA; }
.comiis_scbar_narrow #comiis_sg { width: 316px; }
#comiis_sg li { padding:0 8px; line-height:30px; font-size:14px; }
#comiis_sg li span { color:#999; }
.comiis_sml { background:#FFF; cursor:default; }
.comiis_smo { background:#E5EDF2; cursor:default; }
            </style>
            <div style="display: none; position: absolute; top:37px; left:44px;" id="comiis_sg">
                <div id="comiis_twtsc_box" cellpadding="2" cellspacing="0"></div>
            </div>
<?php } ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="comiis_twtsc_type"><a href="javascript:;" id="comiis_twtsc_type" class="showmenu xg1" onclick="showMenu(this.id)" hidefocus="true">搜索</a></td>
<td class="comiis_twtsc_txt"><input type="text" name="srchtxt" id="comiis_twtsc_txt" onblur="if (value ==''){value='请输入搜索内容'}" onfocus="if (value =='请输入搜索内容'){value =''}" value="请输入搜索内容" autocomplete="off" x-webkit-speech speech /></td>	
<td class="comiis_twtsc_btn"><button type="submit" name="searchsubmit" id="comiis_twtsc_btn" sc="1" class="pn pnc" value="true">&nbsp;&nbsp;</button></td>
</tr>
</table>
</form>
</div>
<?php } ?></div>
<?php } elseif($comiis_navss==0 || $comiis_navss==2 || $comiis_navss==3) { ?>
<a href="javascript:;" id="qmenu" onmouseover="delayShow(this, function () {showMenu({'ctrlid':'qmenu','pos':'34!','ctrlclass':'a','duration':2});showForummenu(<?php echo $_G['fid'];?>);})">快捷导航</a>
<?php } ?>
<ul><?php if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><li <?php if($mnid == $nav['navid']) { ?>class="a" <?php } ?><?php echo $nav['nav'];?>></li><?php } } ?>
</ul>
<?php if(!empty($_G['setting']['pluginhooks']['global_nav_extra'])) echo $_G['setting']['pluginhooks']['global_nav_extra'];?>
</div>
</div>
</div>
<?php } if($_G['uid'] && $comiis_header==1) { ?>
<div id="comiis_key_menu" style="display:none;">
<div class="comiis_key_menu_div">
<div class="comiis_user_info">
<a href="home.php?mod=spacecp&amp;ac=avatar" target="_blank" class="nvtx" title="修改头像"><?php echo avatar($_G[uid],small);?><em>修改</em></a>
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" title="访问我的空间" target="_blank" style="font-size:16px;line-height:30px;"><?php echo $_G['member']['username'];?></a>
<?php if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus">
<a id="loginstatusid" href="member.php?mod=switchstatus" title="切换在线状态" onclick="ajaxget(this.href, 'loginstatus');return false;"></a>
</span>
<?php } ?>
<br><a href="home.php?mod=spacecp&amp;ac=usergroup" target="_blank">用户组: <?php echo $_G['group']['grouptitle'];?><?php if($_G['member']['freeze']) { ?><span class="xi1">(已冻结)</span><?php } ?></a>
<br><a href="home.php?mod=spacecp&amp;ac=credit&amp;showcredit=1" target="_blank">积分: <font color="#e03300"><?php echo $_G['member']['credits'];?></font></a>
</div>			
<div class="comiis_user_txt cl">	
<span class="comiis_user_qq"><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?></span>
<div style="clear:both"></div>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra3'])) echo $_G['setting']['pluginhooks']['global_usernav_extra3'];?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra4'])) echo $_G['setting']['pluginhooks']['global_usernav_extra4'];?>
<a href="forum.php?mod=guide&amp;view=my" target="_blank">我的帖子</a>
<a href="home.php?mod=space&amp;do=favorite&amp;view=me" target="_blank">我的收藏</a>
<a href="home.php?mod=space&amp;do=friend" target="_blank">我的好友</a>	
<a href="home.php?mod=spacecp" target="_blank">设置</a>
<a href="home.php?mod=space&amp;do=pm" target="_blank"<?php if($_G['member']['newpm']) { ?> title="<?php echo $_G['member']['newpm'];?>条新消息" class="new"<?php } ?>>消息<?php if($_G['member']['newpm']) { ?><span></span><?php } ?></a>
<a href="home.php?mod=space&amp;do=notice" target="_blank"<?php if($_G['member']['newprompt']) { ?> title="<?php echo $_G['member']['newprompt'];?>条新提醒" class="new"<?php } ?>>提醒<?php if($_G['member']['newprompt']) { ?><span></span><?php } ?></a>
<?php if($_G['member']['newprompt_num']['follower']) { ?>
<a href="home.php?mod=follow&amp;do=follower" target="_blank" title="<?php echo $_G['member']['newprompt_num']['follower'];?>位新听众" class="new">新听众<span></span></a>
<?php } if($_G['member']['newprompt'] && $_G['member']['newprompt_num']['follow']) { ?>
<a href="home.php?mod=follow" target="_blank" title="<?php echo $_G['member']['newprompt_num']['follow'];?>条我关注的" class="new">我关注的<span></span></a>
<?php } if($_G['member']['newprompt']) { if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { ?><a href="home.php?mod=space&amp;do=notice&amp;view=<?php echo $key;?>" target="_blank" title="<?php echo $val;?>条<?php echo lang('template', 'notice_'.$key); ?>" class="<?php echo $key;?>"><?php echo lang('template', 'notice_'.$key); ?><span></span></a>
<?php } } ?>				
<?php if($_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?><a href="home.php?mod=task&amp;item=doing" id="task_ntc"  target="_blank" class="new">进行中的任务</a><?php } if(($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))) { ?>
<a href="portal.php?mod=portalcp" target="_blank"><?php if($_G['setting']['portalstatus'] ) { ?>门户管理<?php } else { ?>模块管理<?php } ?></a>
<?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
<a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
<?php } if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
<a href="admin.php" target="_blank">管理中心</a>
<?php } if(empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']) { ?>
<a href="javascript:;" id="switchwidth" onclick="widthauto(this)" title="<?php if(widthauto()) { ?>切换到窄版<?php } else { ?>切换到宽版<?php } ?>"><?php if(widthauto()) { ?>切换到窄版<?php } else { ?>切换到宽版<?php } ?></a>
<?php } ?>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<div style="clear:both"></div>
</div>
<div class="comiis_nv_qmenu cl"> 
<div class="qmenu_an" id="qmenu_an">
<a class="next" href="javascript:qmenu_move('1');"><em></em></a>
<a class="prev" href="javascript:qmenu_move('0');"><em></em></a>
</div>				
<div class="qmenu_ico" id="qmenu_loop">
<ul class="cl" id="qmenu_loopul"><?php if(is_array($_G['setting']['mynavs'])) foreach($_G['setting']['mynavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
<li><?php echo str_replace($nav['navname'], '<span>'. $nav['navname'].'</span>', $nav['code']);; ?></li>
<?php } } ?>

</ul> 
</div>
</div>
</div>
</div>
<?php } if(!IS_ROBOT) { if($_G['uid']) { ?>
<ul id="myprompt_menu" class="p_pop" style="display: none;">
<li><a href="home.php?mod=space&amp;do=pm" id="pm_ntc" style="background-repeat: no-repeat; background-position: 0 50%;"><em class="prompt_news<?php if(empty($_G['member']['newpm'])) { ?>_0<?php } ?>"></em>消息</a></li>
<li><a href="home.php?mod=follow&amp;do=follower"><em class="prompt_follower<?php if(empty($_G['member']['newprompt_num']['follower'])) { ?>_0<?php } ?>"></em>新听众<?php if($_G['member']['newprompt_num']['follower']) { ?>(<?php echo $_G['member']['newprompt_num']['follower'];?>)<?php } ?></a></li>
<?php if($_G['member']['newprompt'] && $_G['member']['newprompt_num']['follow']) { ?>
<li><a href="home.php?mod=follow"><em class="prompt_concern"></em>我关注的(<?php echo $_G['member']['newprompt_num']['follow'];?>)</a></li>
<?php } if($_G['member']['newprompt']) { if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { ?><li><a href="home.php?mod=space&amp;do=notice&amp;view=<?php echo $key;?>"><em class="notice_<?php echo $key;?>"></em><?php echo lang('template', 'notice_'.$key); ?>(<span class="rq"><?php echo $val;?></span>)</a></li>
<?php } } if(empty($_G['cookie']['ignore_notice'])) { ?>
<li class="ignore_noticeli"><a href="javascript:;" onclick="setcookie('ignore_notice', 1);hideMenu('myprompt_menu')" title="暂不提醒"><em class="ignore_notice"></em></a></li>
<?php } ?>
</ul>
<?php } if($_G['uid'] && !empty($_G['style']['extstyle'])) { ?>
<div id="sslct_menu" class="cl p_pop" style="display: none;">
<?php if(!$_G['style']['defaultextstyle']) { ?><span class="sslct_btn" onclick="extstyle('')" title="默认"><i></i></span><?php } if(is_array($_G['style']['extstyle'])) foreach($_G['style']['extstyle'] as $extstyle) { ?><span class="sslct_btn" onclick="extstyle('<?php echo $extstyle['0'];?>')" title="<?php echo $extstyle['1'];?>"><i style='background:<?php echo $extstyle['2'];?>'></i></span>
<?php } ?>
</div>
<?php } if($_G['uid']) { ?>
<ul id="myitem_menu" class="p_pop" style="display: none;">
<li><a href="forum.php?mod=guide&amp;view=my">帖子</a></li>
<li><a href="home.php?mod=space&amp;do=favorite&amp;view=me">收藏</a></li>
<li><a href="home.php?mod=space&amp;do=friend">好友</a></li>
<?php if(!empty($_G['setting']['pluginhooks']['global_myitem_extra'])) echo $_G['setting']['pluginhooks']['global_myitem_extra'];?>
</ul>
<?php } ?><div id="qmenu_menu" class="p_pop <?php if(!$_G['uid']) { ?>blk<?php } ?>" style="display: none;">
<?php if(!empty($_G['setting']['pluginhooks']['global_qmenu_top'])) echo $_G['setting']['pluginhooks']['global_qmenu_top'];?>
<?php if($_G['uid']) { ?>
<ul class="cl nav"><?php if(is_array($_G['setting']['mynavs'])) foreach($_G['setting']['mynavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
<li><?php echo $nav['code'];?></li>
<?php } } ?>
</ul>
<?php } elseif($_G['connectguest']) { ?>
<div class="ptm pbw hm">
请先<br /><a class="xi2" href="member.php?mod=connect"><strong>完善帐号信息</strong></a> 或 <a href="member.php?mod=connect&amp;ac=bind" class="xi2 xw1"><strong>绑定已有帐号</strong></a><br />后使用快捷导航
</div>
<?php } else { ?>
<div class="ptm pbw hm">
请 <a href="javascript:;" class="xi2" onclick="lsSubmit()"><strong>登录</strong></a> 后使用快捷导航<br />没有帐号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" class="xi2 xw1"><?php echo $_G['setting']['reglinkname'];?></a>
</div>
<?php } if($_G['setting']['showfjump']) { ?><div id="fjump_menu" class="btda"></div><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_qmenu_bottom'])) echo $_G['setting']['pluginhooks']['global_qmenu_bottom'];?>
</div><?php } if($comiis_navss==1 && $_G['setting']['search'] && $slist) { ?>
<ul id="comiis_twtsc_type_menu" class="p_pop" style="display: none;"><?php echo implode('', $slist);; ?></ul>
<script type="text/javascript">
initSearchmenu('comiis_twtsc', '<?php echo $searchparams['url'];?>');
</script>
<?php } ?>
<div class="wp comiis_nv_pop">
<?php if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
<ul class="p_pop h_pop" id="plugin_menu" style="display: none"><?php if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
<li><?php echo $module['url'];?></li>
<?php } } ?>
</ul>
<?php } ?>
<?php echo $_G['setting']['menunavs'];?>
<div id="mu" class="cl">
<?php if($_G['setting']['subnavs']) { if(is_array($_G['setting']['subnavs'])) foreach($_G['setting']['subnavs'] as $navid => $subnav) { if($_G['setting']['navsubhover'] || $mnid == $navid) { ?>
<ul class="cl <?php if($mnid == $navid) { ?>current<?php } ?>" id="snav_<?php echo $navid;?>" style="display:<?php if($mnid != $navid) { ?>none<?php } ?>">
<?php echo $subnav;?>
</ul>
<?php } } } ?>
</div>
<?php if($comiis_navss==3) { if($_G['setting']['search']) { $slist = array();?><?php if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><a href="javascript:;" rel="curforum" fid="{$_G['fid']}" >本版</a></li>
EOF;
?><?php } if($_G['setting']['portalstatus'] && $_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><a href="javascript:;" rel="article">文章</a></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><a href="javascript:;" rel="forum" class="curtype">帖子</a></li>
EOF;
?><?php } if(helper_access::check_module('blog') && $_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><a href="javascript:;" rel="blog">日志</a></li>
EOF;
?><?php } if(helper_access::check_module('album') && $_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><a href="javascript:;" rel="album">相册</a></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><a href="javascript:;" rel="group">{$_G['setting']['navs']['3']['navname']}</a></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><a href="javascript:;" rel="user">用户</a></li>
EOF;
?>
<?php } if($_G['setting']['search'] && $slist) { ?>
<div id="scbar" class="<?php if($_G['setting']['srchhotkeywords'] && count($_G['setting']['srchhotkeywords']) > 5) { ?>scbar_narrow <?php } ?>cl">
<form id="scbar_form" method="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?>get<?php } else { ?>post<?php } ?>" autocomplete="off" onsubmit="searchFocus($('scbar_txt'))" action="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?><?php echo $searchparams['url'];?><?php } else { ?>search.php?searchsubmit=yes<?php } ?>" target="_blank">
<input type="hidden" name="mod" id="scbar_mod" value="search" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="srhlocality" value="<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>" />
<?php if(!empty($searchparams['params'])) { if(is_array($searchparams['params'])) foreach($searchparams['params'] as $key => $value) { $srchotquery .= '&' . $key . '=' . rawurlencode($value);?><input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>" />
<?php } ?>
<input type="hidden" name="source" value="discuz" />
<input type="hidden" name="fId" id="srchFId" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="q" id="cloudsearchquery" value="" />

<style>
#scbar { overflow: visible; position: relative; }
#sg{ background: #FFF; width:456px; border: 1px solid #B2C7DA; }
.scbar_narrow #sg { width: 316px; }
#sg li { padding:0 8px; line-height:30px; font-size:14px; }
#sg li span { color:#999; }
.sml { background:#FFF; cursor:default; }
.smo { background:#E5EDF2; cursor:default; }
            </style>
            <div style="display: none; position: absolute; top:37px; left:44px;" id="sg">
                <div id="st_box" cellpadding="2" cellspacing="0"></div>
            </div>
<?php } ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="scbar_icon_td"></td>
<td class="scbar_txt_td"><input type="text" name="srchtxt" id="scbar_txt" value="请输入搜索内容" autocomplete="off" x-webkit-speech speech /></td>
<td class="scbar_type_td"><a href="javascript:;" id="scbar_type" class="xg1" onclick="showMenu(this.id)" hidefocus="true">搜索</a></td>
<td class="scbar_btn_td"><button type="submit" name="searchsubmit" id="scbar_btn" sc="1" class="pn pnc" value="true"><strong class="xi2">搜索</strong></button></td>
<td class="scbar_hot_td">
<div id="scbar_hot">
<?php if($_G['setting']['srchhotkeywords']) { ?>
<strong class="xw1">热搜: </strong><?php if(is_array($_G['setting']['srchhotkeywords'])) foreach($_G['setting']['srchhotkeywords'] as $val) { if($val=trim($val)) { $valenc=rawurlencode($val);?><?php
$__FORMHASH = FORMHASH;$srchhotkeywords[] = <<<EOF


EOF;
 if(!empty($searchparams['url'])) { 
$srchhotkeywords[] .= <<<EOF

<a href="{$searchparams['url']}?q={$valenc}&source=hotsearch{$srchotquery}" target="_blank" class="xi2" sc="1">{$val}</a>

EOF;
 } else { 
$srchhotkeywords[] .= <<<EOF

<a href="search.php?mod=forum&amp;srchtxt={$valenc}&amp;formhash={$__FORMHASH}&amp;searchsubmit=true&amp;source=hotsearch" target="_blank" class="xi2" sc="1">{$val}</a>

EOF;
 } 
$srchhotkeywords[] .= <<<EOF


EOF;
?>
<?php } } echo implode('', $srchhotkeywords);; } ?>
</div>
</td>
</tr>
</table>
</form>
</div>
<ul id="scbar_type_menu" class="p_pop" style="display: none;"><?php echo implode('', $slist);; ?></ul>
<script type="text/javascript">
initSearchmenu('scbar', '<?php echo $searchparams['url'];?>');
</script>
<?php } } ?><?php echo adshow("subnavbanner/a_mu");?></div>
</div>	
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header'];?>
<?php } if($comiis_header_fx == 1) { ?>
<script src="<?php echo $_G['style']['styleimgdir'];?>/comiis_nv.js" type="text/javascript" type="text/javascript"></script>
<?php } ?>
<div id="wp" class="wp"><style id="diy_style" type="text/css">#portal_block_135 { margin:5px 0px 12px !important;}#portal_block_136 { margin:14px 0px 0px 14px !important;}#frameh1VoQS { margin:13px 0px 0px !important;}#portal_block_128 { margin-top:14px !important;margin-right:0px !important;margin-bottom:0px !important;margin-left:14px !important;}#portal_block_146 { margin:14px 0px -10px 14px !important;}#portal_block_152 { margin-top:15px !important;margin-right:0px !important;margin-bottom:0px !important;margin-left:0px !important;}</style>
<!--[diy=comiis_ibox_top]--><div id="comiis_ibox_top" class="area"></div><!--[/diy]-->
<div class="comiis_slider box">
<!--[diy=comiis_ibox_swf]--><div id="comiis_ibox_swf" class="area"><div id="framexyUb6E" class="cl_frame_bm frame move-span cl frame-1"><div id="framexyUb6E_left" class="column frame-1-c"><div id="framexyUb6E_left_temp" class="move-span temp"></div><?php block_display('144');?></div></div></div><!--[/diy]-->
</div>
<div class="comiis_main cl">
<div class="comiis_main_l">
<div class="comiis_main_l_box cl">
<div class="comiis_irbox_tit cl">
<span><!--[diy=comiis_izbox_tq]--><div id="comiis_izbox_tq" class="area"><div id="frameXM4wQV" class="cl_frame_bm frame move-span cl frame-1"><div id="frameXM4wQV_left" class="column frame-1-c"><div id="frameXM4wQV_left_temp" class="move-span temp"></div><?php block_display('154');?></div></div></div><!--[/diy]--></span>
<h2>焦点播报</h2>
</div>
<div class="comiis_izbox_hot cl">
<div class="kmnr">
<!--[diy=comiis_izbox_hot]--><div id="comiis_izbox_hot" class="area"><div id="frameiP2MVY" class="cl_frame_bm frame move-span cl frame-1"><div id="frameiP2MVY_left" class="column frame-1-c"><div id="frameiP2MVY_left_temp" class="move-span temp"></div><?php block_display('148');?></div></div></div><!--[/diy]-->
</div>
<div class="kmimg">
<!--[diy=comiis_izbox_swf]--><div id="comiis_izbox_swf" class="area"><div id="frameuHy5nS" class="cl_frame_bm frame move-span cl frame-1"><div id="frameuHy5nS_left" class="column frame-1-c"><div id="frameuHy5nS_left_temp" class="move-span temp"></div><?php block_display('138');?></div></div></div><!--[/diy]-->
</div>
</div>
<!--[diy=comiis_izbox_01]--><div id="comiis_izbox_01" class="area"><div id="frameMnUKEg" class="cl_frame_bm frame move-span cl frame-1"><div id="frameMnUKEg_left" class="column frame-1-c"><div id="frameMnUKEg_left_temp" class="move-span temp"></div><?php block_display('140');?><?php block_display('149');?></div></div></div><!--[/diy]-->
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span>
<h2>社区精选</h2>
</div>
<!--[diy=comiis_isqjx]--><div id="comiis_isqjx" class="area"><div id="framelcsJCC" class="cl_frame_bm frame move-span cl frame-1"><div id="framelcsJCC_left" class="column frame-1-c"><div id="framelcsJCC_left_temp" class="move-span temp"></div><?php block_display('150');?><?php block_display('232');?><?php block_display('227');?><?php block_display('152');?></div></div></div><!--[/diy]-->
<div class="comiis_irbox_tits cl">
<ul>				
<li class="kmon" id="comiis_db_tab_1" onMouseOver="switchTab('comiis_db_tab',1,2,'kmon');"><a href="forum.php?mod=forumdisplay&amp;fid=90" target="_blank">Discuz商业插件</a></li>
<li id="comiis_db_tab_2" onMouseOver="switchTab('comiis_db_tab',2,2,'kmon');"><a href="forum.php?mod=forumdisplay&amp;fid=93" target="_blank">Discuz模板风格</a></li>
</ul>
</div>
<div class="cl" id="comiis_db_tab_c_1">
<!--[diy=comiis_wzx]--><div id="comiis_wzx" class="area"><div id="frameggA6kK" class="cl_frame_bm frame move-span cl frame-1"><div id="frameggA6kK_left" class="column frame-1-c"><div id="frameggA6kK_left_temp" class="move-span temp"></div><?php block_display('151');?></div></div></div><!--[/diy]-->
</div>
<div class="cl" id="comiis_db_tab_c_2" style="display:none">
<!--[diy=comiis_izbox_02]--><div id="comiis_izbox_02" class="area"><div id="framen89Z73" class="cl_frame_bm frame move-span cl frame-1"><div id="framen89Z73_left" class="column frame-1-c"><div id="framen89Z73_left_temp" class="move-span temp"></div><?php block_display('141');?></div></div></div><!--[/diy]-->
</div>
</div>
</div>
<div class="comiis_main_r">	
<div style="height:95px;overflow:hidden;">	
<div class="comiis_irbox comiis_irftbtn cl" id="comiis_irftbtn">
<a href="forum.php?mod=misc&amp;action=nav" onclick="showWindow('nav', this.href, 'get', 0)" class="kmfbzt" title="发表主题"></a>
<a href="/k_misign-sign.html" target="_blank" class="kmqd" title="签到"><script type="text/javascript">var dfsj = new Date();document.write('周'+'日一二三四五六'.charAt(new Date().getDay())+'<br>'+(dfsj.getMonth()+1)+'月'+dfsj.getDate()+'日');</script></a>
</div>			
</div>
<!--[diy=comiis_irbox_diy01]--><div id="comiis_irbox_diy01" class="area"></div><!--[/diy]-->
<div class="comiis_irbox comiis_irbox_ss cl">
<!--[diy=comiis_irbox_video]--><div id="comiis_irbox_video" class="area"><div id="framelQg2Q7" class="cl_frame_bm frame move-span cl frame-1"><div id="framelQg2Q7_left" class="column frame-1-c"><div id="framelQg2Q7_left_temp" class="move-span temp"></div><?php block_display('128');?></div></div></div><!--[/diy]-->
<?php if($comiis_navss==0 || $comiis_navss==2) { ?>
<div id="sckm"><?php if($_G['setting']['search']) { $slist = array();?><?php if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><a href="javascript:;" rel="curforum" fid="{$_G['fid']}" >本版</a></li>
EOF;
?><?php } if($_G['setting']['portalstatus'] && $_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><a href="javascript:;" rel="article">文章</a></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><a href="javascript:;" rel="forum" class="curtype">帖子</a></li>
EOF;
?><?php } if(helper_access::check_module('blog') && $_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><a href="javascript:;" rel="blog">日志</a></li>
EOF;
?><?php } if(helper_access::check_module('album') && $_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><a href="javascript:;" rel="album">相册</a></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><a href="javascript:;" rel="group">{$_G['setting']['navs']['3']['navname']}</a></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><a href="javascript:;" rel="user">用户</a></li>
EOF;
?>
<?php } if($_G['setting']['search'] && $slist) { ?>
<div id="comiis_twtsc" class="<?php if($_G['setting']['srchhotkeywords'] && count($_G['setting']['srchhotkeywords']) > 5) { ?>comiis_scbar_narrow <?php } ?>cl">
<form id="scbar_form" method="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?>get<?php } else { ?>post<?php } ?>" autocomplete="off" onsubmit="searchFocus($('comiis_twtsc_txt'))" action="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?><?php echo $searchparams['url'];?><?php } else { ?>search.php?searchsubmit=yes<?php } ?>" target="_blank">
<input type="hidden" name="mod" id="comiis_twtsc_mod" value="search" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="srhlocality" value="<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>" />
<?php if(!empty($searchparams['params'])) { if(is_array($searchparams['params'])) foreach($searchparams['params'] as $key => $value) { $srchotquery .= '&' . $key . '=' . rawurlencode($value);?><input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>" />
<?php } ?>
<input type="hidden" name="source" value="discuz" />
<input type="hidden" name="fId" id="srchFId" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="q" id="cloudsearchquery" value="" />			
<style>
#comiis_twtsc { overflow: visible; position: relative; }
#comiis_sg{ background: #FFF; width:456px; border: 1px solid #B2C7DA; }
.comiis_scbar_narrow #comiis_sg { width: 316px; }
#comiis_sg li { padding:0 8px; line-height:30px; font-size:14px; }
#comiis_sg li span { color:#999; }
.comiis_sml { background:#FFF; cursor:default; }
.comiis_smo { background:#E5EDF2; cursor:default; }
            </style>
            <div style="display: none; position: absolute; top:37px; left:44px;" id="comiis_sg">
                <div id="comiis_twtsc_box" cellpadding="2" cellspacing="0"></div>
            </div>
<?php } ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="comiis_twtsc_type"><a href="javascript:;" id="comiis_twtsc_type" class="showmenu xg1" onclick="showMenu(this.id)" hidefocus="true">搜索</a></td>
<td class="comiis_twtsc_txt"><input type="text" name="srchtxt" id="comiis_twtsc_txt" onblur="if (value ==''){value='请输入搜索内容'}" onfocus="if (value =='请输入搜索内容'){value =''}" value="请输入搜索内容" autocomplete="off" x-webkit-speech speech /></td>	
<td class="comiis_twtsc_btn"><button type="submit" name="searchsubmit" id="comiis_twtsc_btn" sc="1" class="pn pnc" value="true">&nbsp;&nbsp;</button></td>
</tr>
</table>
</form>
</div>
<?php } ?></div>
<?php } if($comiis_navss==2 && $_G['setting']['search'] && $slist) { ?>
<ul id="comiis_twtsc_type_menu" class="p_pop" style="display: none;"><?php echo implode('', $slist);; ?></ul>
<script type="text/javascript">
initSearchmenu('comiis_twtsc', '<?php echo $searchparams['url'];?>');
</script>
<?php } if($comiis_navss==2) { ?>
<div id="scbar_hot" class="cl">
<?php if($_G['setting']['srchhotkeywords']) { ?>
<span class="z">热搜：</span><?php if(is_array($_G['setting']['srchhotkeywords'])) foreach($_G['setting']['srchhotkeywords'] as $val) { if($val=trim($val)) { $valenc=rawurlencode($val);?><?php
$__FORMHASH = FORMHASH;$srchhotkeywords[] = <<<EOF


EOF;
 if(!empty($searchparams['params'])) { $srchotquery='';
$srchhotkeywords[] .= <<<EOF
 
EOF;
 if(is_array($searchparams['params'])) foreach($searchparams['params'] as $key => $value) { 
$srchhotkeywords[] .= <<<EOF
 
EOF;
 $srchotquery .= '&' . $key . '=' . rawurlencode($value);
$srchhotkeywords[] .= <<<EOF
 

EOF;
 } } if(!empty($searchparams['url'])) { 
$srchhotkeywords[] .= <<<EOF

<a href="{$searchparams['url']}?q={$valenc}&source=hotsearch{$srchotquery}" target="_blank" sc="1">{$val}</a>

EOF;
 } else { 
$srchhotkeywords[] .= <<<EOF

<a href="search.php?mod=forum&amp;srchtxt={$valenc}&amp;formhash={$__FORMHASH}&amp;searchsubmit=true&amp;source=hotsearch" target="_blank" sc="1">{$val}</a>

EOF;
 } 
$srchhotkeywords[] .= <<<EOF


EOF;
?>
<?php } } echo implode('', $srchhotkeywords);; } ?>
</div>
<?php } ?>
</div>
<!--[diy=comiis_irbox_diy02]--><div id="comiis_irbox_diy02" class="area"></div><!--[/diy]-->
<div class="comiis_bkbox">
<div class="comiis_bkbox_tab">
<ul>
<li class="kmon" id="comiis_bkbox_tab1_1" onMouseOver="switchTab('comiis_bkbox_tab1',1,2,'kmon');">版块推荐</li>
<li id="comiis_bkbox_tab1_2" onMouseOver="switchTab('comiis_bkbox_tab1',2,2,'kmon');">百宝箱</li>
</ul>
</div>
<div id="comiis_bkbox_tab1_c_1" class="comiis_bkbox_list cl">
<!--[diy=comiis_irbox_02]--><div id="comiis_irbox_02" class="area"><div id="frameEA2Dgo" class="cl_frame_bm frame move-span cl frame-1"><div id="frameEA2Dgo_left" class="column frame-1-c"><div id="frameEA2Dgo_left_temp" class="move-span temp"></div><?php block_display('126');?></div></div></div><!--[/diy]-->
</div>
<div id="comiis_bkbox_tab1_c_2" class="comiis_bkbox_list cl" style="display:none">
<!--[diy=comiis_irbox_03]--><div id="comiis_irbox_03" class="area"><div id="frameRnE44X" class="cl_frame_bm frame move-span cl frame-1"><div id="frameRnE44X_left" class="column frame-1-c"><div id="frameRnE44X_left_temp" class="move-span temp"></div><?php block_display('127');?></div></div></div><!--[/diy]-->
</div>	
</div>
<!--[diy=comiis_irbox_nby07]--><div id="comiis_irbox_nby07" class="area"></div><!--[/diy]-->
<div class="comiis_irbox cl">
<div class="comiis_irbox_tit cl" id="comiis_keys">
<h2>精彩推荐</h2>
</div>
<div class="comiis_irbox_jctj cl">
<!--[diy=comiis_irbox_nbyjctj]--><div id="comiis_irbox_nbyjctj" class="area"><div id="frameqvc5Hh" class="cl_frame_bm frame move-span cl frame-1"><div id="frameqvc5Hh_left" class="column frame-1-c"><div id="frameqvc5Hh_left_temp" class="move-span temp"></div><?php block_display('153');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_nby00]--><div id="comiis_irbox_nby00" class="area"></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_nby01]--><div id="comiis_irbox_nby01" class="area"></div><!--[/diy]-->
<div class="comiis_irbox cl">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span><h2>易编程</h2>
</div>
<!--[diy=comiis_irbox_nby02]--><div id="comiis_irbox_nby02" class="area"><div id="frameAXxwW8" class="cl_frame_bm frame move-span cl frame-1"><div id="frameAXxwW8_left" class="column frame-1-c"><div id="frameAXxwW8_left_temp" class="move-span temp"></div><?php block_display('145');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_nby03]--><div id="comiis_irbox_nby03" class="area"></div><!--[/diy]-->
<div class="comiis_irbox cl">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">详细</a></span><h2>官方微博</h2>
</div>
<!--[diy=comiis_irbox_nby04]--><div id="comiis_irbox_nby04" class="area"><div id="framer8D1dJ" class="cl_frame_bm frame move-span cl frame-1"><div id="framer8D1dJ_left" class="column frame-1-c"><div id="framer8D1dJ_left_temp" class="move-span temp"></div><?php block_display('146');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_diy04]--><div id="comiis_irbox_diy04" class="area"></div><!--[/diy]-->
<div class="comiis_irbox">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span><h2>热门活动</h2>
</div>
<!--[diy=comiis_irbox_05]--><div id="comiis_irbox_05" class="area"><div id="framebB23av" class="cl_frame_bm frame move-span cl frame-1"><div id="framebB23av_left" class="column frame-1-c"><div id="framebB23av_left_temp" class="move-span temp"></div><?php block_display('136');?><?php block_display('130');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_diy05]--><div id="comiis_irbox_diy05" class="area"></div><!--[/diy]-->
<div class="comiis_irbox">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span><h2>图片精选</h2>
</div>
<div class="comiis_irbox_ssp cl">
<!--[diy=comiis_irbox_pai]--><div id="comiis_irbox_pai" class="area"><div id="frameepI4h6" class="cl_frame_bm frame move-span cl frame-1"><div id="frameepI4h6_left" class="column frame-1-c"><div id="frameepI4h6_left_temp" class="move-span temp"></div><?php block_display('131');?></div></div></div><!--[/diy]-->
</div>
</div>
<!--[diy=comiis_irbox_diy07]--><div id="comiis_irbox_diy07" class="area"></div><!--[/diy]-->
<div class="comiis_irbox cl">
<div class="comiis_irbox_tit cl">
<span><a href="/forum-57-1.html" target="_blank">更多</a></span><h2>C/C++编程</h2>
</div>
<!--[diy=comiis_irbox_07]--><div id="comiis_irbox_07" class="area"><div id="frameEPA1o4" class="cl_frame_bm frame move-span cl frame-1"><div id="frameEPA1o4_left" class="column frame-1-c"><div id="frameEPA1o4_left_temp" class="move-span temp"></div><?php block_display('133');?></div></div></div><!--[/diy]-->	
</div>			
<!--[diy=comiis_irbox_diy03]--><div id="comiis_irbox_diy03" class="area"></div><!--[/diy]-->
<div class="comiis_irbox">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span><h2>精华帖</h2>
</div>
<div class="comiis_irbox_list cl">
<!--[diy=comiis_irbox_04]--><div id="comiis_irbox_04" class="area"><div id="framef3QZ3G" class="cl_frame_bm frame move-span cl frame-1"><div id="framef3QZ3G_left" class="column frame-1-c"><div id="framef3QZ3G_left_temp" class="move-span temp"></div><?php block_display('129');?></div></div></div><!--[/diy]-->
</div>
</div>
<!--[diy=comiis_irbox_nby05]--><div id="comiis_irbox_nby05" class="area"></div><!--[/diy]-->
<div class="comiis_irbox kmtch cl">
<div class="comiis_irbox_tit cl">
<span><a href="group.php" target="_blank">更多</a></span><h2>热门同城会</h2>
</div>
<!--[diy=comiis_irbox_nby06]--><div id="comiis_irbox_nby06" class="area"><div id="frameX4AymO" class="cl_frame_bm frame move-span cl frame-1"><div id="frameX4AymO_left" class="column frame-1-c"><div id="frameX4AymO_left_temp" class="move-span temp"></div><?php block_display('139');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_diy06]--><div id="comiis_irbox_diy06" class="area"></div><!--[/diy]-->
<div class="comiis_irbox">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span><h2>玩机</h2>
</div>
<!--[diy=comiis_irbox_06]--><div id="comiis_irbox_06" class="area"><div id="frameBLwqc0" class="cl_frame_bm frame move-span cl frame-1"><div id="frameBLwqc0_left" class="column frame-1-c"><div id="frameBLwqc0_left_temp" class="move-span temp"></div><?php block_display('132');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_diy08]--><div id="comiis_irbox_diy08" class="area"></div><!--[/diy]-->
<div class="comiis_irbox">
<div class="comiis_irbox_tit cl">
<span><a href="misc.php?mod=ranklist&amp;type=member" target="_blank">更多</a></span><h2>会员Show</h2>
</div>
<div class="comiis_irbox_user cl">
<!--[diy=comiis_irbox_08]--><div id="comiis_irbox_08" class="area"><div id="framef4n9NN" class="cl_frame_bm frame move-span cl frame-1"><div id="framef4n9NN_left" class="column frame-1-c"><div id="framef4n9NN_left_temp" class="move-span temp"></div><?php block_display('134');?><?php block_display('135');?></div></div></div><!--[/diy]-->
</div>
</div>
<!--[diy=comiis_irbox_diy09]--><div id="comiis_irbox_diy09" class="area"></div><!--[/diy]-->
<div class="comiis_irbox" style="margin-bottom:0;">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span><h2>客服中心</h2>
</div>
<div class="comiis_irbox_tel cl">
<!--[diy=comiis_irbox_tel]--><div id="comiis_irbox_tel" class="area"><div id="frameEkjEmE" class="cl_frame_bm frame move-span cl frame-1"><div id="frameEkjEmE_left" class="column frame-1-c"><div id="frameEkjEmE_left_temp" class="move-span temp"></div><?php block_display('142');?></div></div></div><!--[/diy]-->
</div>
<div class="comiis_irbox_qqwb cl">
<!--[diy=comiis_irbox_qqwb]--><div id="comiis_irbox_qqwb" class="area"><div id="framem8GTC6" class="cl_frame_bm frame move-span cl frame-1"><div id="framem8GTC6_left" class="column frame-1-c"><div id="framem8GTC6_left_temp" class="move-span temp"></div><?php block_display('143');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_nbyewm]--><div id="comiis_irbox_nbyewm" class="area"><div id="framemraBtG" class="cl_frame_bm frame move-span cl frame-1"><div id="framemraBtG_left" class="column frame-1-c"><div id="framemraBtG_left_temp" class="move-span temp"></div><?php block_display('147');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_diy10]--><div id="comiis_irbox_diy10" class="area"><div id="frameoYD5ym" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">讯幻网邮箱登录</span></div><div id="frameoYD5ym_left" class="column frame-1-c"><div id="frameoYD5ym_left_temp" class="move-span temp"></div><?php block_display('167');?></div></div></div><!--[/diy]-->
</div>
</div>
<!--[diy=comiis_ibox_ad03]--><div id="comiis_ibox_ad03" class="area"></div><!--[/diy]-->
<div class="comiis_ibox kmmb0 cl">
<div class="comiis_ibox_tit cl">
<span><a href="plugin.php?id=nimba_linkhelper:addlink" target="_blank">+ 申请友情链接</a></span><h2>友情链接</h2>
</div>
<!--[diy=comiis_ibox_link]--><div id="comiis_ibox_link" class="area"><div id="frameh1VoQS" class="cl_frame_bm frame move-span cl frame-1"><div id="frameh1VoQS_left" class="column frame-1-c"><div id="frameh1VoQS_left_temp" class="move-span temp"></div><?php block_display('137');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_ibox_ad05]--><div id="comiis_ibox_ad05" class="area"></div><!--[/diy]-->
<script src="<?php echo $_G['style']['styleimgdir'];?>/jquery.min.js" type="text/javascript" type="text/javascript"></script>
<script src="<?php echo $_G['style']['styleimgdir'];?>/xmSlide.js" type="text/javascript" type="text/javascript"></script>
<script src="<?php echo $_G['style']['styleimgdir'];?>/responsiveslides.min.js" type="text/javascript" type="text/javascript"></script><?php $topsss = ($comiis_header_fx ? ($comiis_header ? '63' : '50') : '0');?><style>.comiis_btn{top:<?php echo $topsss;?>px;}</style>
<script>
var comiis_irftbtn = $('comiis_irftbtn');
var comiis_irftbtnoffset = parseInt(fetchOffset(comiis_irftbtn)['top']);
_attachEvent(window, 'scroll', function () {
var comiis_scrollTopk = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
if(comiis_scrollTopk >= comiis_irftbtnoffset - <?php echo $topsss;?>){
comiis_irftbtn.className = 'comiis_irbox comiis_irftbtn cl comiis_btn';
if (BROWSER.ie && BROWSER.ie < 7) {
comiis_irftbtn.style.position = 'absolute';
comiis_irftbtn.style.top = (comiis_scrollTopk + <?php echo $topsss;?>) + 'px';
}else{
comiis_irftbtn.style.position = 'fixed';
}
}else{
comiis_irftbtn.style.position = 'static';
comiis_irftbtn.className = 'comiis_irbox comiis_irftbtn cl';
}
});
</script></div>
<?php if(empty($topic) || ($topic['usefooter'])) { $focusid = getfocus_rand($_G[basescript]);?><?php if($focusid !== null) { $focus = $_G['cache']['focus']['data'][$focusid];?><?php $focusnum = count($_G['setting']['focus'][$_G[basescript]]);?><div class="focus" id="sitefocus">
<div class="bm">
<div class="bm_h cl">
<a href="javascript:;" onclick="setcookie('nofocus_<?php echo $_G['basescript'];?>', 1, <?php echo $_G['cache']['focus']['cookie'];?>*3600);$('sitefocus').style.display='none'" class="y" title="关闭">关闭</a>
<h2>
<?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?>
<span id="focus_ctrl" class="fctrl"><img src="<?php echo $_G['style']['styleimgdir'];?>/pic_nv_prev.gif" alt="上一条" title="上一条" id="focusprev" class="cur1" onclick="showfocus('prev');" /> <em><span id="focuscur"></span>/<?php echo $focusnum;?></em> <img src="<?php echo $_G['style']['styleimgdir'];?>/pic_nv_next.gif" alt="下一条" title="下一条" id="focusnext" class="cur1" onclick="showfocus('next')" /></span>
</h2>
</div>
<div class="bm_c" id="focus_con">
</div>
</div>
</div><?php $focusi = 0;?><?php if(is_array($_G['setting']['focus'][$_G['basescript']])) foreach($_G['setting']['focus'][$_G['basescript']] as $id) { ?><div class="bm_c" style="display: none" id="focus_<?php echo $focusi;?>">
<dl class="xld cl bbda">
<dt><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2" target="_blank"><?php echo $_G['cache']['focus']['data'][$id]['subject'];?></a></dt>
<?php if($_G['cache']['focus']['data'][$id]['image']) { ?>
<dd class="m"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" target="_blank"><img src="<?php echo $_G['cache']['focus']['data'][$id]['image'];?>" alt="<?php echo $_G['cache']['focus']['data'][$id]['subject'];?>" /></a></dd>
<?php } ?>
<dd><?php echo $_G['cache']['focus']['data'][$id]['summary'];?></dd>
</dl>
<p class="ptn cl"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2 y" target="_blank">查看 &raquo;</a></p>
</div><?php $focusi ++;?><?php } ?>
<script type="text/javascript">
var focusnum = <?php echo $focusnum;?>;
if(focusnum < 2) {
$('focus_ctrl').style.display = 'none';
}
if(!$('focuscur').innerHTML) {
var randomnum = parseInt(Math.round(Math.random() * focusnum));
$('focuscur').innerHTML = Math.max(1, randomnum);
}
showfocus();
var focusautoshow = window.setInterval('showfocus(\'next\', 1);', 5000);
</script>
<?php } ?><?php echo adshow("footerbanner/wp a_f/1");?><?php echo adshow("footerbanner/wp a_f/2");?><?php echo adshow("footerbanner/wp a_f/3");?><?php echo adshow("float/a_fl/1");?><?php echo adshow("float/a_fr/2");?><?php echo adshow("couplebanner/a_fl a_cb/1");?><?php echo adshow("couplebanner/a_fr a_cb/2");?><?php echo adshow("cornerbanner/a_cn");?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer'];?>
<div class="comiis_kmzxk" style="clear:both;"></div>
<?php if($comiis_ff==1) { ?>
<div class="comiis_dibox cl">
<div id="ft" class="wp comiis_foot cl hytj">
<dl>
<dt>关于我们</dt>
<dd><a href="#" target="_blank">关于我们</a></dd>
<dd><a href="plugin.php?id=nimba_linkhelper:addlink" target="_blank">友情链接</a></dd>
<dd><a href="http://wpa.qq.com/msgrd?V=3&amp;uin=2444300667&amp;Site=%20%D1%B6%BB%C3%CD%F8&amp;Menu=yes&amp;from=discuz" target="_blank">联系我们</a></dd>
</dl>
<dl>
<dt>帮助中心</dt>
<dd><a href="#" target="_blank">网友中心</a></dd>
<dd><a href="#" target="_blank">购买须知</a></dd>
<dd><a href="#" target="_blank">支付方式</a></dd>
</dl>
<dl>
<dt>服务支持</dt>
<dd><a href="#" target="_blank">资源下载</a></dd>
<dd><a href="#" target="_blank">售后服务</a></dd>
<dd><a href="#" target="_blank">定制流程</a></dd>
</dl>	
<dl>
<dt>关注我们</dt>
<dd><a href="http://weibo.com/xhkj5" target="_blank" class="kmweibo">官方微博</a></dd>
<dd><a href="#" target="_blank" class="kmkongjian">官方空间</a></dd>
<dd><a href="#" target="_blank" class="kmweixin">官方微信</a></dd>
</dl>
<div class="comiis_tel">
<ul>
<li class="item1">暂无客服电话</li>
<li class="item2">周一到周日 8:30-20:30 (全年无休)</li>
<li class="item3 cl">
<a href="http://wpa.qq.com/msgrd?V=3&amp;uin=2444300667&amp;Site=%20%D1%B6%BB%C3%CD%F8&amp;Menu=yes&amp;from=discuz" target="_blank">7 x 24小时在线客服</a>
</li>
</ul> 
</div> 
</div>
<div class="comiis_dilogo wp cl">
<div class="comiis_minilogo"><a href="./"><img src="<?php echo IMGDIR;?>/comiis_minilogo.gif" alt="<?php echo $_G['setting']['sitename'];?>"></a></div>
<div class="comiis_dinav"><?php if(is_array($_G['setting']['footernavs'])) foreach($_G['setting']['footernavs'] as $nav) { if($nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) || !$nav['type'] && ($nav['id'] == 'stat' && $_G['group']['allowstatdata'] || $nav['id'] == 'report' && $_G['uid'] || $nav['id'] == 'archiver' || $nav['id'] == 'mobile' || $nav['id'] == 'darkroom'))) { ?><?php echo $nav['code'];?><?php } } ?>
</div>
</div>
</div>
<div class="wp comiis_copyright cl">
<a href="#" target="_blank"><img src="<?php echo IMGDIR;?>/comiis_diico01.gif" alt="诚信网站"></a>
<a href="#" target="_blank"><img src="<?php echo IMGDIR;?>/comiis_diico02.gif" alt="可信网站"></a>
Powered by <a href="http://www.xhkj5.com" target="_blank">讯幻网</a>  &copy; 2008-2017 <a href="<?php echo $_G['setting']['siteurl'];?>" target="_blank"><?php echo $_G['setting']['sitename'];?></a> 版权所有 <?php if($_G['setting']['icp']) { ?><a href="http://www.miitbeian.gov.cn/" rel="nofollow" target="_blank"><?php echo $_G['setting']['icp'];?></a><?php } ?> <?php if($_G['setting']['site_qq']) { ?><a href="http://wpa.qq.com/msgrd?V=3&amp;uin=<?php echo $_G['setting']['site_qq'];?>&amp;Site=<?php echo $_G['setting']['bbname'];?>&amp;Menu=yes&amp;from=discuz" rel="nofollow" target="_blank" title="QQ">客服QQ: <?php echo $_G['setting']['site_qq'];?></a><?php } ?>
&nbsp;技术支持: <A href="http://www.xhkj5.com" target="_blank" title="讯幻网">讯幻网</A>	<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink'];?>
</div>

<div id="ft" class="wp cl comiis_di01 hytj">
<div style="text-align:center;">
<p>
<?php if($_G['setting']['statcode']) { ?><?php echo $_G['setting']['statcode'];?><?php } ?>
</p>
<?php if($_G['adminid']) { ?>
<p class="xs0" style="position:absolute;  left:0; text-align:center; width:100%;">
GMT<?php echo $_G['timenow']['offset'];?>, <?php echo $_G['timenow']['time'];?>
<span id="debuginfo">
<?php if(debuginfo()) { ?>, Processed in <?php echo $_G['debuginfo']['time'];?> second(s), <?php echo $_G['debuginfo']['queries'];?> queries
<?php if($_G['gzipcompress']) { ?>, Gzip On<?php } if(C::memory()->type) { ?>, <?php echo ucwords(C::memory()->type); ?> On<?php } ?>.
<?php } ?>
</span>
</p>
<?php } ?>
</div>
</div>
<?php } updatesession();?><?php if($_G['uid'] && $_G['group']['allowinvisible']) { ?>
<script type="text/javascript">
var invisiblestatus = '<?php if($_G['session']['invisible']) { ?>隐身<?php } else { ?>在线<?php } ?>';
var loginstatusobj = $('loginstatusid');
if(loginstatusobj != undefined && loginstatusobj != null) loginstatusobj.innerHTML = invisiblestatus;
</script>
<?php } } if(!$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if($_G['uid'] && helper_access::check_module('follow') && !isset($_G['cookie']['checkfollow'])) { ?>
<script src="home.php?mod=spacecp&ac=follow&op=checkfeed&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes') { if(check_diy_perm($topic) && (empty($do) || $do != 'index')) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>portal_diy<?php if(!check_diy_perm($topic, 'layout')) { ?>_data<?php } ?>.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($space['self'] && CURMODULE == 'space' && $do == 'index') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } } if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && empty($_G['cookie']['pluginnotice'])) { ?>
<div class="focus plugin" id="plugin_notice"></div>
<script type="text/javascript">pluginNotice();</script>
<?php } if(!$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry'] && $_G['setting']['disableipnotice'] != 1 && $_G['uid'] && !empty($_G['cookie']['lip'])) { ?>
<div class="focus plugin" id="ip_notice"></div>
<script type="text/javascript">ipNotice();</script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_GET['do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } if(($_G['member']['newpm'] || $_G['member']['newprompt']) && empty($_G['cookie']['ignore_notice'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>html5notification.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var h5n = new Html5notification();
if(h5n.issupport()) {
<?php if($_G['member']['newpm'] && $_GET['do'] != 'pm') { ?>
h5n.shownotification('pm', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=pm', '<?php echo avatar($_G[uid],small,true);?>', '新的短消息', '有新的短消息，快去看看吧');
<?php } if($_G['member']['newprompt'] && $_GET['do'] != 'notice') { if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { $noticetitle = lang('template', 'notice_'.$key);?>h5n.shownotification('notice_<?php echo $key;?>', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=notice&view=<?php echo $key;?>', '<?php echo avatar($_G[uid],small,true);?>', '<?php echo $noticetitle;?> (<?php echo $val;?>)', '有新的提醒，快去看看吧');
<?php } } ?>
}
</script>
<?php } userappprompt();?><?php if($_G['basescript'] != 'userapp') { ?>
<div id="scrolltop">
<?php if($_G['fid'] && $_G['mod'] == 'viewthread') { ?>
<span><a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?><?php if($_GET['from']) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>" onclick="showWindow('reply', this.href)" class="replyfast" title="快速回复"><b>快速回复</b></a></span>
<?php } ?>
<span hidefocus="true"><a title="返回顶部" onclick="window.scrollTo('0','0')" class="scrolltopa" href="javascript:;"><b>返回顶部</b></a></span>
<?php if($_G['fid']) { ?>
<span>
<?php if($_G['mod'] == 'viewthread') { ?>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" hidefocus="true" class="returnlist" title="返回列表"><b>返回列表</b></a>
<?php } else { ?>
<a href="forum.php" hidefocus="true" class="returnboard" title="返回版块"><b>返回版块</b></a>
<?php } ?>
</span>
<?php } ?>
</div>
<script type="text/javascript">_attachEvent(window, 'scroll', function () { new_showTopLink(); });checkBlind();</script>
<?php } if(isset($_G['makehtml'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>html2dynamic.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var html_lostmodify = <?php echo TIMESTAMP;?>;
htmlGetUserStatus();
<?php if(isset($_G['htmlcheckupdate'])) { ?>
htmlCheckUpdate();
<?php } ?>
</script>
<?php } ?>
<script type="text/javascript">
<?php if($comiis_dbss==1) { ?>
_attachEvent(document,'click',function(){hidecomiismenu('comiis_sousuo_menu');});
function hidecomiismenu(id) {
var menuObj = $(id);
var menu = $(menuObj.getAttribute('ctrlid'));
if(ctrlclass = menuObj.getAttribute('ctrlclass')) {
var reg = new RegExp(' ' + ctrlclass);
menu.className = menu.className.replace(reg, '');
}
menuObj.style.display = 'none';
}
<?php } ?>
function new_showTopLink() {
var ft = $('ft');
if(ft){
var scrolltop = $('scrolltop');
var viewPortHeight = parseInt(document.documentElement.clientHeight);
var scrollHeight = parseInt(document.body.getBoundingClientRect().top);
var basew = parseInt(ft.clientWidth);
var sw = scrolltop.clientWidth;
if (basew < 1500) {
var left = parseInt(fetchOffset(ft)['left']);
left = left < sw ? left * 2 - sw : left;
scrolltop.style.left = ( basew + left ) + 'px';
} else {
scrolltop.style.left = 'auto';
scrolltop.style.right = 0;
}
if (BROWSER.ie && BROWSER.ie < 7) {
scrolltop.style.top = viewPortHeight - scrollHeight - 150 + 'px';
}
if (scrollHeight < -100) {
scrolltop.style.visibility = 'visible';
} else {
scrolltop.style.visibility = 'hidden';
}
}
}
if($("myrepeats") && $("comiis_key")){
$("comiis_key").appendChild($("myrepeats"));
}
if($("qmenu_loop")){
var qmenu_timer, qmenu_scroll_l;
var qmenu_in = 0;
var qmenu_width = 246;
var qmenu_loop = $('qmenu_loop');
var qmenu_all_width = 41 * $('qmenu_loopul').getElementsByTagName("li").length - qmenu_width;
if(qmenu_all_width < 20){
$('qmenu_an').style.display = 'none';
}
}
function qmenu_move(qmenu_lr){
if(qmenu_in == 0 && ((qmenu_lr == 1 && qmenu_loop.scrollLeft < qmenu_all_width) || (qmenu_lr == 0 && qmenu_loop.scrollLeft > 0))){
qmenu_in = 1;
qmenu_scroll_l = qmenu_loop.scrollLeft;
qmenu_timer = setInterval(function(){
qmenu_scroll(qmenu_lr);
}, 10);
}
}
function qmenu_scroll(qmenu_lr){
if((qmenu_lr == 1 && qmenu_loop.scrollLeft >= qmenu_width + qmenu_scroll_l) || (qmenu_lr == 0 && ((qmenu_loop.scrollLeft <= qmenu_scroll_l - qmenu_width) || qmenu_loop.scrollLeft == 0))){
clearInterval(qmenu_timer);
qmenu_in = 0;
}else{
if(qmenu_lr == 1){
qmenu_loop.scrollLeft += Math.round((qmenu_width + qmenu_scroll_l - qmenu_loop.scrollLeft) / 15) + 1;
}else{
qmenu_loop.scrollLeft -= Math.round((qmenu_width - (qmenu_scroll_l - qmenu_loop.scrollLeft)) / 15) + 1;
}
}
}
</script><?php output();?></body>
</html>