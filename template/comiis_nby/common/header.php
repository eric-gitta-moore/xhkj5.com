<?PHP exit('Access Denied');?>
<!--{subtemplate common/header_common}-->
<!--{eval require_once("./template/comiis_nby/comiis_config.php");}-->
	<meta name="application-name" content="$_G['setting']['bbname']" />
	<meta name="msapplication-tooltip" content="$_G['setting']['bbname']" />
	<!--{if $_G['setting']['portalstatus']}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][1]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['portal']) ? 'http://'.$_G['setting']['domain']['app']['portal'] : $_G[siteurl].'portal.php'};icon-uri={$_G[siteurl]}{IMGDIR}/portal.ico" /><!--{/if}-->
	<meta name="msapplication-task" content="name=$_G['setting']['navs'][2]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['forum']) ? 'http://'.$_G['setting']['domain']['app']['forum'] : $_G[siteurl].'forum.php'};icon-uri={$_G[siteurl]}{IMGDIR}/bbs.ico" />
	<!--{if $_G['setting']['groupstatus']}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][3]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['group']) ? 'http://'.$_G['setting']['domain']['app']['group'] : $_G[siteurl].'group.php'};icon-uri={$_G[siteurl]}{IMGDIR}/group.ico" /><!--{/if}-->
	<!--{if helper_access::check_module('feed')}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][4]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['home']) ? 'http://'.$_G['setting']['domain']['app']['home'] : $_G[siteurl].'home.php'};icon-uri={$_G[siteurl]}{IMGDIR}/home.ico" /><!--{/if}-->
	<!--{if $_G['basescript'] == 'forum' && $_G['setting']['archiver']}-->
		<link rel="archives" title="$_G['setting']['bbname']" href="{$_G[siteurl]}archiver/" />
	<!--{/if}-->
	<!--{if !empty($rsshead)}-->$rsshead<!--{/if}-->
	<!--{if widthauto()}-->
		<link rel="stylesheet" id="css_widthauto" type="text/css" href='{$_G['setting']['csspath']}{STYLEID}_widthauto.css?{VERHASH}' />
		<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
	<!--{/if}-->
	<!--{if $_G['basescript'] == 'forum' || $_G['basescript'] == 'group'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}forum.js?{VERHASH}"></script>
	<!--{elseif $_G['basescript'] == 'home' || $_G['basescript'] == 'userapp'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}home.js?{VERHASH}"></script>
	<!--{elseif $_G['basescript'] == 'portal'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
	<!--{/if}-->
	<!--{if $_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
	<!--{/if}-->
	<!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
		<link rel="stylesheet" type="text/css" id="diy_common" href="{$_G['setting']['csspath']}{STYLEID}_css_diy.css?{VERHASH}" />
	<!--{/if}-->
	<!--{eval $comiis_ff=1;}-->
	<!--{if $comiis_window_width==2}-->
	<script>
	if(screen.width>1210){
		HTMLNODE.className += ' comiis_wide';
	}
	</script>
	<!--{/if}-->
	<!--{if $comiis_navss!=3}-->
	<style>
		#comiis_hd, #comiis_nv {margin-bottom:5px;}
		.comiis_wide #comiis_hd, .comiis_wide #comiis_nv {margin-bottom:10px;}
	</style>
	<!--{/if}-->
</head>
<body id="nv_{$_G[basescript]}" class="pg_{CURMODULE}{if $_G['basescript'] === 'portal' && CURMODULE === 'list' && !empty($cat)} {$cat['bodycss']}{/if}<!--{if $comiis_window_width==1}--> comiis_wide<!--{/if}--> ityp" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
	<!--{template common/header_diy}-->
<!--{/if}-->
<!--{if check_diy_perm($topic)}-->
	<!--{template common/header_diynav}-->
<!--{/if}-->
<!--{if CURMODULE == 'topic' && $topic && empty($topic['useheader']) && check_diy_perm($topic)}-->
	$diynav
<!--{/if}-->
<!--{if empty($topic) || $topic['useheader']}-->
	<!--{if $_G['setting']['mobile']['allowmobile'] && (!$_G['setting']['cacheindexlife'] && !$_G['setting']['cachethreadon'] || $_G['uid']) && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')}-->
		<div class="xi1 bm bm_c">
			{lang your_mobile_browser}<a href="{$_G['siteurl']}forum.php?mobile=yes">{lang go_to_mobile}</a><span class="xg1">|</span><a href="$_G['setting']['mobile']['nomobileurl']">{lang to_be_continue}</a>
		</div>
	<!--{/if}-->
	<!--{if $_G['setting']['shortcut'] && $_G['member'][credits] >= $_G['setting']['shortcut']}-->
		<div id="shortcut">
			<span><a href="javascript:;" id="shortcutcloseid" title="{lang close}">{lang close}</a></span>
			{lang shortcut_notice}
			<a href="javascript:;" id="shortcuttip">{lang shortcut_add}</a>
		</div>
		<script type="text/javascript">setTimeout(setShortcut, 2000);</script>
	<!--{/if}-->
	<div id="toptb" class="cl">
		<!--{hook/global_cpnav_top}-->
		<div class="wp cl">
			<!--{if $comiis_header==1}-->			
				<div class="y comiis_nvlogin">
					<!--{subtemplate common/comiis_user}-->
				</div>
				<div class="y">
					<!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}--><a id="sslct" href="javascript:;" onmouseover="delayShow(this, function() {showMenu({'ctrlid':'sslct','pos':'34!'})});">{lang changestyle}</a><!--{/if}-->
					<!--{if check_diy_perm($topic)}-->
						$diynav
					<!--{/if}-->
					<a id="switchblind" href="javascript:;" onclick="toggleBlind(this)" title="{lang switch_blind}" class="switchblind">{lang switch_blind}</a>
				</div>
			<!--{else}-->
				<div class="y">
					<a id="switchblind" href="javascript:;" onclick="toggleBlind(this)" title="{lang switch_blind}" class="switchblind">{lang switch_blind}</a>
					<!--{hook/global_cpnav_extra2}-->
					<!--{loop $_G['setting']['topnavs'][1] $nav}-->
						<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
					<!--{/loop}-->
					<!--{if empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']}-->
						<a href="javascript:;" id="switchwidth" onclick="widthauto(this)" title="{if widthauto()}{lang switch_narrow}{else}{lang switch_wide}{/if}" class="switchwidth"><!--{if widthauto()}-->{lang switch_narrow}<!--{else}-->{lang switch_wide}<!--{/if}--></a>
					<!--{/if}-->
					<!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}--><a id="sslct" href="javascript:;" onmouseover="delayShow(this, function() {showMenu({'ctrlid':'sslct','pos':'34!'})});">{lang changestyle}</a><!--{/if}-->
					<!--{if check_diy_perm($topic)}-->
						$diynav
					<!--{/if}-->
				</div>
			<!--{/if}-->
			<div class="z">
				<a class="comiis_tweibo" target="_blank" href="http://weibo.com/xhkj5" title="新浪微博"></a>
				<a href="javascript:;" class="comiis_tweixin" id="kmweixin" onMouseOver="showMenu({'ctrlid':this.id,'pos':'43!','ctrlclass':'hover','duration':2});" title="官方微信"></a>
				<a class="comiis_tkefu" target="_blank" href="http://wpa.qq.com/msgrd?V=3&uin=2444300667&Site=%20%D1%B6%BB%C3%CD%F8&Menu=yes&from=discuz" title="在线客服"></a>
				<!--{loop $_G['setting']['topnavs'][0] $nav}-->
					<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
				<!--{/loop}-->
				<a href="javascript:;" onclick="showWindow('qqgroup', 'plugin.php?id=xhkj5_qqgroup','get',1);">加入QQ群</a>
				<!--{hook/global_cpnav_extra1}-->
				<!--{hook/global_cpnav_extra2}-->
				<!--{loop $_G['setting']['topnavs'][1] $nav}-->
					<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
				<!--{/loop}-->
			</div>
			<div style="display:none" class="weixin_tip" id="kmweixin_menu">			
				<div class="weixin_img"></div>
				<p>扫一扫关注官方微信</p>
			</div>
		</div>
	</div>
	<!--{ad/headerbanner/wp a_h}-->
	<!--{if $comiis_header==1}-->
	<div style="height:111px;">
		<div id="comiis_hd">
			<div class="wp cl">
				<!--{eval $mnid = getcurrentnav();}-->
				<div class="comiis_hdnv">
					<ul>						
						<!--{loop $_G['setting']['navs'] $nav}-->
							<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}--><li {if $mnid == $nav[navid]}class="a" {/if}$nav[nav]></li><!--{/if}-->
						<!--{/loop}-->
					</ul>
					<!--{hook/global_nav_extra}-->
				</div>
				<h2><!--{if !isset($_G['setting']['navlogos'][$mnid])}--><a href="{if $_G['setting']['domain']['app']['default']}http://{$_G['setting']['domain']['app']['default']}/{else}./{/if}" title="$_G['setting']['bbname']">{$_G['style']['boardlogo']}</a><!--{else}-->$_G['setting']['navlogos'][$mnid]<!--{/if}--></h2>			
			</div>		
		</div>
	</div>
	<div class="ssnr" style="clear:both;"></div>
	<!--{else}-->
	<div id="hd">
		<div class="wp">
			<div class="hdc cl">
				<!--{eval $mnid = getcurrentnav();}-->
				<h2><!--{if !isset($_G['setting']['navlogos'][$mnid])}--><a href="{if $_G['setting']['domain']['app']['default']}http://{$_G['setting']['domain']['app']['default']}/{else}./{/if}" title="$_G['setting']['bbname']">{$_G['style']['boardlogo']}</a><!--{else}-->$_G['setting']['navlogos'][$mnid]<!--{/if}--></h2>
				<!--{template common/header_userstatus}-->
			</div>
			<div class="ssnr" style="clear:both;"></div>
		</div>
		<div style="height:60px;">
			<div id="comiis_nv">
				<div class="wp comiis_nvbox cl">
					<!--{if $comiis_navss==1}-->
					<div id="sckm" class="y">
					<!--{subtemplate common/comiis_navss}-->
					</div>
					<!--{elseif $comiis_navss==0 || $comiis_navss==2 || $comiis_navss==3}-->
					<a href="javascript:;" id="qmenu" onmouseover="delayShow(this, function () {showMenu({'ctrlid':'qmenu','pos':'34!','ctrlclass':'a','duration':2});showForummenu($_G[fid]);})">{lang my_nav}</a>
					<!--{/if}-->
					<ul>
						<!--{loop $_G['setting']['navs'] $nav}-->
							<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}--><li {if $mnid == $nav[navid]}class="a" {/if}$nav[nav]></li><!--{/if}-->
						<!--{/loop}-->
					</ul>
					<!--{hook/global_nav_extra}-->
				</div>
			</div>
		</div>
	<!--{/if}-->
		<!--{if $_G['uid'] && $comiis_header==1}-->
			<div id="comiis_key_menu" style="display:none;">
			<div class="comiis_key_menu_div">
				<div class="comiis_user_info">
					<a href="home.php?mod=spacecp&ac=avatar" target="_blank" class="nvtx" title="修改头像"><!--{avatar($_G[uid],small)}--><em>修改</em></a>
					<a href="home.php?mod=space&uid=$_G[uid]" title="{lang visit_my_space}" target="_blank" style="font-size:16px;line-height:30px;">{$_G[member][username]}</a>
					<!--{if $_G['group']['allowinvisible']}-->
					<span id="loginstatus">
						<a id="loginstatusid" href="member.php?mod=switchstatus" title="{lang login_switch_invisible_mode}" onclick="ajaxget(this.href, 'loginstatus');return false;"></a>
					</span>
					<!--{/if}-->
					<br><a href="home.php?mod=spacecp&ac=usergroup" target="_blank">{lang usergroup}: $_G[group][grouptitle]<!--{if $_G[member]['freeze']}--><span class="xi1">({lang freeze})</span><!--{/if}--></a>
					<br><a href="home.php?mod=spacecp&ac=credit&showcredit=1" target="_blank">{lang credits}: <font color="#e03300">$_G[member][credits]</font></a>
				</div>			
				<div class="comiis_user_txt cl">	
					<span class="comiis_user_qq"><!--{hook/global_usernav_extra1}--></span>
					<div style="clear:both"></div>
					<!--{hook/global_usernav_extra2}-->
					<!--{hook/global_usernav_extra3}-->
					<!--{hook/global_usernav_extra4}-->
					<a href="forum.php?mod=guide&view=my" target="_blank">我的帖子</a>
					<a href="home.php?mod=space&do=favorite&view=me" target="_blank">我的{lang favorite}</a>
					<a href="home.php?mod=space&do=friend" target="_blank">我的{lang friends}</a>	
					<a href="home.php?mod=spacecp" target="_blank">{lang setup}</a>
					<a href="home.php?mod=space&do=pm" target="_blank"{if $_G[member][newpm]} title="{$_G[member][newpm]}条新{lang pm_center}" class="new"{/if}>{lang pm_center}{if $_G[member][newpm]}<span></span>{/if}</a>
					<a href="home.php?mod=space&do=notice" target="_blank"{if $_G[member][newprompt]} title="{$_G[member][newprompt]}条新{lang remind}" class="new"{/if}>{lang remind}{if $_G[member][newprompt]}<span></span>{/if}</a>
					<!--{if $_G[member][newprompt_num][follower]}-->
					<a href="home.php?mod=follow&do=follower" target="_blank" title="$_G[member][newprompt_num][follower]位{lang notice_interactive_follower}" class="new"><!--{lang notice_interactive_follower}--><span></span></a>
					<!--{/if}-->
					<!--{if $_G[member][newprompt] && $_G[member][newprompt_num][follow]}-->
						<a href="home.php?mod=follow" target="_blank" title="{$_G[member][newprompt_num][follow]}条<!--{lang notice_interactive_follow}-->" class="new"><!--{lang notice_interactive_follow}--><span></span></a>
					<!--{/if}-->
					<!--{if $_G[member][newprompt]}-->
						<!--{loop $_G['member']['category_num'] $key $val}-->
						<a href="home.php?mod=space&do=notice&view=$key" target="_blank" title="{$val}条<!--{echo lang('template', 'notice_'.$key)}-->" class="{$key}"><!--{echo lang('template', 'notice_'.$key)}--><span></span></a>
						<!--{/loop}-->
					<!--{/if}-->				
					<!--{if $_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid']])}--><a href="home.php?mod=task&item=doing" id="task_ntc"  target="_blank" class="new">{lang task_doing}</a><!--{/if}-->
					<!--{if ($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))}-->
						<a href="portal.php?mod=portalcp" target="_blank"><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a>
					<!--{/if}-->
					<!--{if $_G['uid'] && $_G['group']['radminid'] > 1}-->
						<a href="forum.php?mod=modcp&fid=$_G[fid]" target="_blank">{lang forum_manager}</a>
					<!--{/if}-->
					<!--{if $_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)}-->
						<a href="admin.php" target="_blank">{lang admincp}</a>
					<!--{/if}-->
					<!--{if empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']}-->
						<a href="javascript:;" id="switchwidth" onclick="widthauto(this)" title="{if widthauto()}{lang switch_narrow}{else}{lang switch_wide}{/if}"><!--{if widthauto()}-->{lang switch_narrow}<!--{else}-->{lang switch_wide}<!--{/if}--></a>
					<!--{/if}-->
					<a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a>
					<div style="clear:both"></div>
				</div>
				<div class="comiis_nv_qmenu cl"> 
					<div class="qmenu_an" id="qmenu_an">
						<a class="next" href="javascript:qmenu_move('1');"><em></em></a>
						<a class="prev" href="javascript:qmenu_move('0');"><em></em></a>
					</div>				
					<div class="qmenu_ico" id="qmenu_loop">
						<ul class="cl" id="qmenu_loopul">
							<!--{loop $_G['setting']['mynavs'] $nav}-->
								<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->
									<li>{echo str_replace($nav['navname'], '<span>'. $nav['navname'].'</span>', $nav['code']);}</li>
								<!--{/if}-->
							<!--{/loop}-->
							
						</ul> 
					</div>
				</div>
			</div>
			</div>
		<!--{/if}-->
		<!--{if !IS_ROBOT}-->
			<!--{if $_G['uid']}-->
			<ul id="myprompt_menu" class="p_pop" style="display: none;">
				<li><a href="home.php?mod=space&do=pm" id="pm_ntc" style="background-repeat: no-repeat; background-position: 0 50%;"><em class="prompt_news{if empty($_G[member][newpm])}_0{/if}"></em>{lang pm_center}</a></li>
					<li><a href="home.php?mod=follow&do=follower"><em class="prompt_follower{if empty($_G[member][newprompt_num][follower])}_0{/if}"></em><!--{lang notice_interactive_follower}-->{if $_G[member][newprompt_num][follower]}($_G[member][newprompt_num][follower]){/if}</a></li>
				<!--{if $_G[member][newprompt] && $_G[member][newprompt_num][follow]}-->
					<li><a href="home.php?mod=follow"><em class="prompt_concern"></em><!--{lang notice_interactive_follow}-->($_G[member][newprompt_num][follow])</a></li>
				<!--{/if}-->
				<!--{if $_G[member][newprompt]}-->
					<!--{loop $_G['member']['category_num'] $key $val}-->
						<li><a href="home.php?mod=space&do=notice&view=$key"><em class="notice_$key"></em><!--{echo lang('template', 'notice_'.$key)}-->(<span class="rq">$val</span>)</a></li>
					<!--{/loop}-->
				<!--{/if}-->
				<!--{if empty($_G['cookie']['ignore_notice'])}-->
				<li class="ignore_noticeli"><a href="javascript:;" onclick="setcookie('ignore_notice', 1);hideMenu('myprompt_menu')" title="{lang temporarily_to_remind}"><em class="ignore_notice"></em></a></li>
				<!--{/if}-->
				</ul>
			<!--{/if}-->
			<!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}-->
				<div id="sslct_menu" class="cl p_pop" style="display: none;">
					<!--{if !$_G[style][defaultextstyle]}--><span class="sslct_btn" onclick="extstyle('')" title="{lang default}"><i></i></span><!--{/if}-->
					<!--{loop $_G['style']['extstyle'] $extstyle}-->
						<span class="sslct_btn" onclick="extstyle('$extstyle[0]')" title="$extstyle[1]"><i style='background:$extstyle[2]'></i></span>
					<!--{/loop}-->
				</div>
				<!--{/if}-->
				<!--{if $_G['uid']}-->
					<ul id="myitem_menu" class="p_pop" style="display: none;">
						<li><a href="forum.php?mod=guide&view=my">帖子</a></li>
						<li><a href="home.php?mod=space&do=favorite&view=me">{lang favorite}</a></li>
						<li><a href="home.php?mod=space&do=friend">{lang friends}</a></li>
						<!--{hook/global_myitem_extra}-->
					</ul>
				<!--{/if}-->
				<!--{subtemplate common/header_qmenu}-->	
		<!--{/if}-->
		<!--{if $comiis_navss==1 && $_G['setting']['search'] && $slist}-->
			<ul id="comiis_twtsc_type_menu" class="p_pop" style="display: none;"><!--{echo implode('', $slist);}--></ul>
			<script type="text/javascript">
				initSearchmenu('comiis_twtsc', '$searchparams[url]');
			</script>
		<!--{/if}-->
		<div class="wp comiis_nv_pop">
			<!--{if !empty($_G['setting']['plugins']['jsmenu'])}-->
				<ul class="p_pop h_pop" id="plugin_menu" style="display: none">
				<!--{loop $_G['setting']['plugins']['jsmenu'] $module}-->
					<!--{if !$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])}-->
					<li>$module[url]</li>
					<!--{/if}-->
				<!--{/loop}-->
				</ul>
			<!--{/if}-->
			$_G[setting][menunavs]
			<div id="mu" class="cl">
			<!--{if $_G['setting']['subnavs']}-->
				<!--{loop $_G[setting][subnavs] $navid $subnav}-->
					<!--{if $_G['setting']['navsubhover'] || $mnid == $navid}-->
					<ul class="cl {if $mnid == $navid}current{/if}" id="snav_$navid" style="display:{if $mnid != $navid}none{/if}">
					$subnav
					</ul>
					<!--{/if}-->
				<!--{/loop}-->
			<!--{/if}-->
			</div>
			<!--{if $comiis_navss==3}-->
			<!--{subtemplate common/pubsearchform}-->
			<!--{/if}-->
			<!--{ad/subnavbanner/a_mu}-->
		</div>
	</div>	
	<!--{hook/global_header}-->
<!--{/if}-->
<!--{if $comiis_header_fx == 1}-->
<script src="{$_G['style']['styleimgdir']}/comiis_nv.js" type="text/javascript"></script>
<!--{/if}-->
<div id="wp" class="wp">