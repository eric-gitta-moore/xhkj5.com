<?PHP exit('Access Denied');?>
<!--{template common/header}-->
<!--{if $close_leftinfo == 0 && !($_GET['diy'] == 'yes' && check_diy_perm($topic))}-->
	<!--{eval $comiis_view_zlb = 0;}-->
<!--{/if}-->
<script type="text/javascript">var fid = parseInt('$_G[fid]'), tid = parseInt('$_G[tid]');</script>
<!--{if $modmenu['thread'] || $modmenu['post']}-->
	<script type="text/javascript" src="{$_G['setting']['jspath']}forum_moderate.js?{VERHASH}"></script>
<!--{/if}-->
<script type="text/javascript" src="{$_G['setting']['jspath']}forum_viewthread.js?{VERHASH}"></script>
<script type="text/javascript">zoomstatus = parseInt($_G['setting']['zoomstatus']);var imagemaxwidth = '{$_G['setting']['imagemaxwidth']}';var aimgcount = new Array();</script>
<style id="diy_style" type="text/css"></style>
<!--[diy=diynavtop]--><div id="diynavtop" class="area"></div><!--[/diy]-->
<!--{if !$close_leftinfo}-->
<div id="pt" class="bm cl">
	<div class="z">
		<a href="./" class="nvhm" title="{lang homepage}">$_G[setting][bbname]</a><em>&raquo;</em><a href="forum.php">{$_G[setting][navs][2][navname]}</a>$navigation <em>&rsaquo;</em> <a href="forum.php?mod=viewthread&tid=$_G[tid]">$_G[forum_thread][short_subject]</a>
	</div>
</div>
<!--{/if}-->
<div class="wp">
	<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<!--{if $close_leftinfo}-->
<div id="pt" class="bm cl">
	<div class="z">
		<a href="./" class="nvhm" title="{lang homepage}">$_G[setting][bbname]</a><em>&raquo;</em><a href="forum.php">{$_G[setting][navs][2][navname]}</a>$navigation <em>&rsaquo;</em> <a href="forum.php?mod=viewthread&tid=$_G[tid]">$_G[forum_thread][short_subject]</a>
	</div>
</div>
<!--{hook/viewthread_top}-->
<!--{ad/text/wp a_t}-->
<!--{else}-->
<div id="pgt" class="pgs mbm cl">
	<div class="pgt">$multipage</div>
	<span class="y pgb"{if $_G['setting']['visitedforums']} id="visitedforums" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id,'pos':'34'})"{/if}><a href="$upnavlink">{lang return_forumdisplay}</a></span>
	<!--{if $_G['forum']['threadsorts'] && $_G['forum']['threadsorts']['templatelist']}-->
		<!--{loop $_G['forum']['threadsorts']['types'] $id $name}-->
			<button id="newspecial" class="pn pnc" onclick="location.href='forum.php?mod=post&action=newthread&fid=$_G[fid]&extra=$extra&sortid=$id'"><strong>{lang i_want}$name</strong></button>
		<!--{/loop}-->
	<!--{else}-->
		<!--{if !$_G['forum_thread']['is_archived']}--><a id="newspecial" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"{if !$_G['forum']['allowspecialonly'] && empty($_G['forum']['picstyle']) && !$_G['forum']['threadsorts']['required']} onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=$_G[fid]')"{else} onclick="location.href='forum.php?mod=post&action=newthread&fid=$_G[fid]';return false;"{/if} href="javascript:;" title="{lang send_posts}"><img src="{IMGDIR}/pn_post.png" alt="{lang send_posts}" /></a><!--{/if}-->
	<!--{/if}-->
	<!--{if $allowpostreply && !$_G['forum_thread']['archiveid']}-->
		<a id="post_reply" onclick="showWindow('reply', 'forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]')" href="javascript:;" title="{lang reply}"><img src="{IMGDIR}/pn_reply.png" alt="{lang reply}" /></a>
	<!--{/if}-->
	<!--{if $modmenu['thread']}-->
	<a href="javascript:;" id="comiis_guanli" onmouseover="showMenu({'ctrlid':'comiis_guanli'});"><img src="{IMGDIR}/pn_guanli.png" alt="帖子管理" /></a>
	<!--{/if}-->
	<!--{hook/viewthread_postbutton_top}-->
</div>
<!--{/if}-->
<div class="wp">
	<!--[diy=diy1s]--><div id="diy1s" class="area"></div><!--[/diy]-->
</div>
<div class="boardnav{if $comiis_view_zlb==1}l{elseif $comiis_view_zlb==2}r{/if}">
<!--{if $comiis_view_zlb>0}-->
<!--{eval $leftside=0;}-->
<DIV class="comiis_width">
<DIV class="comiis_rk">
<DIV class="comiis_lp">
<!--{/if}-->
<div id="ct" class="wp cl">
<!--{if $_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])}-->
	<ul class="p_pop" id="newspecial_menu" style="display: none">
		<!--{if !$_G['forum']['allowspecialonly']}--><li><a href="forum.php?mod=post&action=newthread&fid=$_G[fid]">{lang post_newthread}</a></li><!--{/if}-->
		<!--{if $_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']}-->
			<!--{loop $_G['forum']['threadsorts']['types'] $id $threadsorts}-->
				<!--{if $_G['forum']['threadsorts']['show'][$id]}-->
					<li class="popupmenu_option"><a href="forum.php?mod=post&action=newthread&fid=$_G[fid]&sortid=$id">$threadsorts</a></li>
				<!--{/if}-->
			<!--{/loop}-->
		<!--{/if}-->
		<!--{if $_G['group']['allowpostpoll']}--><li class="poll"><a href="forum.php?mod=post&action=newthread&fid=$_G[fid]&special=1">{lang post_newthreadpoll}</a></li><!--{/if}-->
		<!--{if $_G['group']['allowpostreward']}--><li class="reward"><a href="forum.php?mod=post&action=newthread&fid=$_G[fid]&special=3">{lang post_newthreadreward}</a></li><!--{/if}-->
		<!--{if $_G['group']['allowpostdebate']}--><li class="debate"><a href="forum.php?mod=post&action=newthread&fid=$_G[fid]&special=5">{lang post_newthreaddebate}</a></li><!--{/if}-->
		<!--{if $_G['group']['allowpostactivity']}--><li class="activity"><a href="forum.php?mod=post&action=newthread&fid=$_G[fid]&special=4">{lang post_newthreadactivity}</a></li><!--{/if}-->
		<!--{if $_G['group']['allowposttrade']}--><li class="trade"><a href="forum.php?mod=post&action=newthread&fid=$_G[fid]&special=2">{lang post_newthreadtrade}</a></li><!--{/if}-->
		<!--{if $_G['setting']['threadplugins']}-->
			<!--{loop $_G['forum']['threadplugin'] $tpid}-->
				<!--{if array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])}-->
					<li class="popupmenu_option"{if $_G['setting']['threadplugins'][$tpid][icon]} style="background-image:url(source/plugin/$tpid/$_G['setting']['threadplugins'][$tpid][icon])"{/if}><a href="forum.php?mod=post&action=newthread&fid=$_G[fid]&specialextra=$tpid">{$_G['setting']['threadplugins'][$tpid][name]}</a></li>
				<!--{/if}-->
			<!--{/loop}-->
		<!--{/if}-->
	</ul>
<!--{/if}-->
<!--{if $modmenu['post']}-->
	<div id="mdly" class="fwinmask" style="display:none;z-index:350;">
		<table cellspacing="0" cellpadding="0" class="fwin">
			<tr>
				<td class="t_l"></td>
				<td class="t_c"></td>
				<td class="t_r"></td>
			</tr>
			<tr>
				<td class="m_l">&nbsp;&nbsp;</td>
				<td class="m_c">
					<div class="f_c">
						<div class="c">
							<h3>{lang admin_select}&nbsp;<strong id="mdct" class="xi1"></strong>&nbsp;{lang piece}: </h3>
							<!--{if $_G['forum']['ismoderator']}-->
								<!--{if $_G['group']['allowwarnpost']}--><a href="javascript:;" onclick="modaction('warn')">{lang modmenu_warn}</a><span class="pipe">|</span><!--{/if}-->
								<!--{if $_G['group']['allowbanpost']}--><a href="javascript:;" onclick="modaction('banpost')">{lang modmenu_banpost}</a><span class="pipe">|</span><!--{/if}-->
								<!--{if $_G['group']['allowdelpost'] && !$rushreply}--><a href="javascript:;" onclick="modaction('delpost')">{lang modmenu_deletepost}</a><span class="pipe">|</span><!--{/if}-->
							<!--{/if}-->
							<!--{if $_G['forum']['ismoderator'] && $_G['group']['allowstickreply'] || $_G['forum_thread']['authorid'] == $_G['uid']}--><a href="javascript:;" onclick="modaction('stickreply')">{lang modmenu_stickpost}</a><span class="pipe">|</span><!--{/if}-->
							<!--{if $_G['forum_thread']['pushedaid'] && $allowpostarticle}--><a href="javascript:;" onclick="modaction('pushplus', '', 'aid=$_G[forum_thread][pushedaid]', 'portal.php?mod=portalcp&ac=article&op=pushplus')">{lang modmenu_pushplus}</a><span class="pipe">|</span><!--{/if}-->
						</div>
					</div>
				</td>
				<td class="m_r"></td>
			</tr>
			<tr>
				<td class="b_l"></td>
				<td class="b_c"></td>
				<td class="b_r"></td>
			</tr>
		</table>
	</div>
<!--{/if}-->
<!--{if $modmenu['thread']}-->
	<div id="comiis_guanli_menu" class="p_pop kmp_pop" style="display: none;">
		<!--{eval $modopt=0;}-->
		<!--{if $_G['forum']['ismoderator']}-->
			<!--{if $_G['group']['allowdelpost']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(3, 'delete')">{lang modmenu_deletethread}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowbumpthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(3, 'bump')">{lang modmenu_updown}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowstickthread'] && ($_G['forum_thread']['displayorder'] <= 3 || $_G['adminid'] == 1) && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(1, 'stick')">{lang modmenu_stickthread}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowlivethread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('live')">{lang modmenu_live}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowhighlightthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(1, 'highlight')">{lang modmenu_highlight}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowdigestthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(1, 'digest')">{lang modmenu_digestpost}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowrecommendthread'] && !empty($_G['forum']['modrecommend']['open']) && $_G['forum']['modrecommend']['sort'] != 1 && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(1, 'recommend')">{lang modmenu_recommend}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowstampthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('stamp')">{lang modmenu_stamp}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowstamplist'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('stamplist')">{lang modmenu_icon}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowclosethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(4)"><!--{if !$_G['forum_thread']['closed']}-->{lang modmenu_switch_off}<!--{else}-->{lang modmenu_switch_on}<!--{/if}--></a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowmovethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(2, 'move')">{lang modmenu_move}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowedittypethread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(2, 'type')">{lang modmenu_type}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if !$_G['forum_thread']['special'] && !$_G['forum_thread']['is_archived']}-->
				<!--{if $_G['group']['allowcopythread'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('copy')">{lang modmenu_copy}</a><span class="pipe">|</span><!--{/if}-->
				<!--{if $_G['group']['allowmergethread'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('merge')">{lang modmenu_merge}</a><span class="pipe">|</span><!--{/if}-->
				<!--{if $_G['group']['allowrefund'] && $_G['forum_thread']['price'] > 0}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('refund')">{lang modmenu_restore}</a><span class="pipe">|</span><!--{/if}-->
			<!--{/if}-->
			<!--{if $_G['group']['allowsplitthread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('split')">{lang modmenu_split}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowrepairthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('repair')">{lang modmenu_repair}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['forum_thread']['is_archived'] && $_G['adminid'] == 1}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('restore', '', 'archiveid={$_G[forum_thread][archiveid]}')">{lang modmenu_archive}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['forum_firstpid']}-->
				<!--{if $_G['group']['allowwarnpost']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('warn', '$_G[forum_firstpid]')">{lang modmenu_warn}</a><span class="pipe">|</span><!--{/if}-->
				<!--{if $_G['group']['allowbanpost']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('banpost', '$_G[forum_firstpid]')">{lang modmenu_banthread}</a><span class="pipe">|</span><!--{/if}-->
			<!--{/if}-->
			<!--{if $_G['group']['allowremovereward'] && $_G['forum_thread']['special'] == 3 && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('removereward')">{lang modmenu_removereward}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['forum']['status'] == 3 && in_array($_G['adminid'], array('1','2')) && $_G['forum_thread']['closed'] < 1}--><a href="javascript:;" onclick="modthreads(5, 'recommend_group');return false;">{lang modmenu_grouprecommend}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowmanagetag']}--><a href="javascript:;" onclick="showWindow('mods', 'forum.php?mod=tag&op=manage&tid=$_G[tid]', 'get', 0)">{lang post_tag}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['alloweditusertag']}--><a href="javascript:;" onclick="showWindow('usertag', 'forum.php?mod=misc&action=usertag&tid=$_G[tid]', 'get', 0)">{lang usertag}</a><span class="pipe">|</span><!--{/if}-->
		<!--{/if}-->
		<!--{if $allowpusharticle && $allowpostarticle}--><!--{eval $modopt++}--><a href="portal.php?mod=portalcp&ac=article&from_idtype=tid&from_id=$_G['tid']">{lang modmenu_pusharticle}</a><span class="pipe">|</span><!--{/if}-->
		<!--{hook/viewthread_modoption}-->
	</div>
<!--{/if}-->
<!--{hook/viewthread_beginline}-->
<div id="postlist" class="pl bm efia comiis_x0<!--{if $close_leftinfo}--> comiis_dx1<!--{/if}-->">
<!--{if $close_leftinfo}-->
<div class="comiis_viewbt cl">
	<!--{if $_G['setting']['close_leftinfo_userctrl']}-->
		<div style="position:absolute;left:-9px;top:-8px;">
		<!--{if !$close_leftinfo}-->
			<a onclick="setcookie('close_leftinfo', 1);location.reload();" title="{lang collapse_the_left}" href="javascript:;"><img src="{IMGDIR}/control_l.png" alt="{lang collapse_the_left}" class="vm" /></a>
		<!--{else}-->
			<a onclick="setcookie('close_leftinfo', 2);location.reload();" title="{lang open_the_left}" href="javascript:;"><img src="{IMGDIR}/control_r.png" alt="{lang open_the_left}" class="vm" /></a>
		<!--{/if}-->
		</div>
	<!--{/if}-->
	<!--{if $close_leftinfo && $modmenu['thread']}-->
		<div style="position:absolute;left:8px;top:8px;">		
			<a href="javascript:;" id="comiis_guanli" onmouseover="showMenu({'ctrlid':'comiis_guanli'});"><img src="{IMGDIR}/comiis_nbygl.gif" alt="帖子管理" /></a>		
		</div>
	<!--{/if}-->
	<div style="clear:both;"></div>
	<div class="comiis_viewbt_box cl">
	<!--{if $comiis_view_tit_avt == 1}-->
	<div class="comiis_avt">
	<!--{if $_G[forum_thread][authorid] && $_G[forum_thread][author]}-->
	<a href="home.php?mod=space&uid=$_G[forum_thread][authorid]" title="$_G[forum_thread][author]" target="_blank"><!--{avatar($_G[forum_thread][authorid],middle)}--></a>
	<!--{else}-->
		<!--{if $_G['forum']['ismoderator']}-->
			<!--{avatar(0,middle)}-->
		<!--{else}-->
			<!--{avatar(0,middle)}-->
		<!--{/if}-->
	<!--{/if}-->
	</div>
	<!--{/if}-->
	<div class="comiis_v_h2<!--{if $comiis_view_tit_avt==0 || $comiis_view_tit_avt==2}--> kmml0<!--{/if}-->">	
		<h2 class="z">
			<!--{if $thread['digest'] > 0 && $filter != 'digest'}--><a herf="javascript:;" title="精华" class="km1 kmjh">精</a><!--{/if}-->
			<!--{if in_array($thread['displayorder'], array(1, 2, 3, 4))}--><a herf="javascript:;" title="置顶" class="km1 kmzd">顶</a><!--{/if}-->	
			<span id="thread_subject">$_G[forum_thread][subject]</span>
		</h2>
		<span class="z xg1">
			<!--{if $_G['forum_thread'][displayorder] == -2}-->({lang moderating})
			<!--{elseif $_G['forum_thread'][displayorder] == -3}-->({lang have_ignored})
			<!--{elseif $_G['forum_thread'][displayorder] == -4}-->({lang draft})
				<!--{if $post['first'] && $post['invisible'] == -3}-->
					<a href="forum.php?mod=misc&action=pubsave&tid=$_G[tid]" class="psave">{lang published}</a>
				<!--{/if}-->
			<!--{/if}-->
			<!--{if $_G['setting']['threadhidethreshold'] && $_G['forum_thread']['hidden'] >= $_G['setting']['threadhidethreshold']}-->						
				<!--{if $_G['forum_thread']['authorid'] == $_G['uid']}--><a href="forum.php?mod=misc&action=hiderecover&tid=$_G[tid]&formhash={FORMHASH}" class="psave" id="hiderecover" title="{lang hiderecover_tips}" onclick="showWindow(this.id, this.href, 'get', 0);">{lang hidden}</a><!--{else}-->({lang hidden})<!--{/if}-->
				&nbsp;
			<!--{/if}-->
			<!--{if $_G['forum_thread']['recommendlevel']}-->
				&nbsp;<img src="{IMGDIR}/recommend_$_G['forum_thread']['recommendlevel'].gif" alt="" title="{lang thread_recommend} $_G['forum_thread'][recommends]" />
			<!--{/if}-->
			<!--{if $_G['forum_thread'][heatlevel]}-->
				&nbsp;<img src="{IMGDIR}/hot_$_G['forum_thread'][heatlevel].gif" alt="" title="{lang heats}: $_G['forum_thread']['heats']" />
			<!--{/if}-->
			<!--{if $_G['forum_thread']['closed'] == 1}-->
				&nbsp;<img src="{IMGDIR}/locked.gif" alt="{lang close}" title="{lang close}" class="vm" />
			<!--{/if}-->
			<!--{if !IS_ROBOT && $post['warned']}-->
				<a href="forum.php?mod=misc&action=viewwarning&tid=$_G[tid]&uid=$post[authorid]" title="{lang warn_get}" onclick="showWindow('viewwarning', this.href)"><img src="{IMGDIR}/warning.gif" alt="{lang warn_get}" /></a>
			<!--{/if}-->
			<a href="forum.php?mod=viewthread&tid=$_G[tid]$fromuid" onclick="return copyThreadUrl(this, '$_G[setting][bbname]')" {if $fromuid}title="{lang share_url_copy_comment}"{/if} class="kmcopy">[{lang share_url_copy}]</a>
		</span>
		<!--{hook/viewthread_title_extra}-->
	</div>
	<div class="comiis_v_action<!--{if $comiis_view_tit_avt==0 || $comiis_view_tit_avt==2}--> kmml0<!--{/if}-->">
		<span class="y comiis_v_views">
			<em class="views" title="{lang show}">$_G[forum_thread][views]</em>
			<em class="replies" title="{lang reply}">$_G[forum_thread][replies]</em>			
		</span>
		<span class="xg1">
			<span id="comiis_authi_author_div" class="z"></span>
			<!--{if !IS_ROBOT}-->
			<span class="z">
					<!--{if $post['invisible'] == 0}--><a href="forum.php?mod=viewthread&action=printable&tid=$_G[tid]" title="{lang thread_printable}" target="_blank"><img src="{IMGDIR}/print.png" alt="{lang thread_printable}" class="vm" /></a>
					<!--{/if}-->
					<a href="forum.php?mod=redirect&goto=nextoldset&tid=$_G[tid]" title="{lang last_thread}"><img src="{IMGDIR}/thread-prev.png" alt="{lang last_thread}" class="vm" /></a>
					<a href="forum.php?mod=redirect&goto=nextnewset&tid=$_G[tid]" title="{lang next_thread}"><img src="{IMGDIR}/thread-next.png" alt="{lang next_thread}" class="vm" /></a>
			</span>
			<!--{/if}-->
		</span>
	</div>
	</div>
	<!--{if $_G['forum_threadstamp']}-->
		<div id="threadstamp"><img src="{STATICURL}image/stamp/$_G[forum_threadstamp][url]" title="$_G[forum_threadstamp][text]" /></div>
	<!--{/if}-->
</div>
<!--{else}-->
<div class="bm_h comiis_snvbt">
<!--{if $_G['setting']['close_leftinfo_userctrl']}-->
	<span class="z" style="padding:3px 5px 0 0;">
	<!--{if !$close_leftinfo}-->
		<a onclick="setcookie('close_leftinfo', 1);location.reload();" title="{lang collapse_the_left}" href="javascript:;"><img src="{IMGDIR}/control_l.png" alt="{lang collapse_the_left}" class="vm" /></a>
	<!--{else}-->
		<a onclick="setcookie('close_leftinfo', 2);location.reload();" title="{lang open_the_left}" href="javascript:;"><img src="{IMGDIR}/control_r.png" alt="{lang open_the_left}" class="vm" /></a>
	<!--{/if}-->
	</span>
<!--{/if}-->
<span class="z">
<!--{if $_G['page'] > 1}-->
<div class="comiis_user">
	<!--{if $_G[forum_thread][authorid] && $_G[forum_thread][author]}-->
		<span class="z kmvtx"><a href="home.php?mod=space&uid=$_G[forum_thread][authorid]" title="$_G[forum_thread][author]"><!--{avatar($_G[forum_thread][authorid],small)}--></a></span>
		<span class="z">{lang thread_author}: <a href="home.php?mod=space&uid=$_G[forum_thread][authorid]" title="$_G[forum_thread][author]">$_G[forum_thread][author]</a>&nbsp;-&nbsp;</span>
	<!--{else}-->
		{lang thread_author}:
		<!--{if $_G['forum']['ismoderator']}-->
			<a href="home.php?mod=space&uid=$_G[forum_thread][authorid]">{lang anonymous}</a>
		<!--{else}-->
			{lang anonymous}
		<!--{/if}-->
	<!--{/if}-->
</div>
<!--{/if}-->				
</span>
<h2 class="z">
<!--{if $_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]}-->
	<!--{if !IS_ROBOT && ($_G['forum']['threadtypes']['listable'] || $_G['forum']['status'] == 3)}-->
		<a href="forum.php?mod=forumdisplay&fid=$_G[fid]&filter=typeid&typeid=$_G[forum_thread][typeid]">[{$_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]}]</a>
	<!--{else}-->
		[{$_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]}]
	<!--{/if}-->
<!--{/if}-->
<!--{if $threadsorts && $_G['forum_thread']['sortid']}-->
	<a href="forum.php?mod=forumdisplay&fid=$_G[fid]&filter=sortid&sortid=$_G[forum_thread][sortid]">[{$_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']]}]</a>
<!--{/if}-->
<span id="thread_subject">$_G[forum_thread][subject]</span>
</h2>
<span class="z kmfz">
	<!--{if $_G['forum_thread'][displayorder] == -2}-->({lang moderating})
	<!--{elseif $_G['forum_thread'][displayorder] == -3}-->({lang have_ignored})
	<!--{elseif $_G['forum_thread'][displayorder] == -4}-->({lang draft})
		<!--{if $post['first'] && $post['invisible'] == -3}-->
			<a href="forum.php?mod=misc&action=pubsave&tid=$_G[tid]" class="psave">{lang published}</a>
		<!--{/if}-->
	<!--{/if}-->
	<!--{if $_G['setting']['threadhidethreshold'] && $_G['forum_thread']['hidden'] >= $_G['setting']['threadhidethreshold']}-->						
		<!--{if $_G['forum_thread']['authorid'] == $_G['uid']}--><a href="forum.php?mod=misc&action=hiderecover&tid=$_G[tid]&formhash={FORMHASH}" class="psave" id="hiderecover" title="{lang hiderecover_tips}" onclick="showWindow(this.id, this.href, 'get', 0);">{lang hidden}</a><!--{else}-->({lang hidden})<!--{/if}-->
		&nbsp;
	<!--{/if}-->
	<!--{if $_G['forum_thread']['recommendlevel']}-->
		&nbsp;<img src="{IMGDIR}/recommend_$_G['forum_thread']['recommendlevel'].gif" alt="" title="{lang thread_recommend} $_G['forum_thread'][recommends]" />
	<!--{/if}-->
	<!--{if $_G['forum_thread'][heatlevel]}-->
		&nbsp;<img src="{IMGDIR}/hot_$_G['forum_thread'][heatlevel].gif" alt="" title="{lang heats}: $_G['forum_thread']['heats']" />
	<!--{/if}-->
	<!--{if $_G['forum_thread']['closed'] == 1}-->
		&nbsp;<img src="{IMGDIR}/locked.gif" alt="{lang close}" title="{lang close}" class="vm" />
	<!--{/if}-->
	<a href="forum.php?mod=viewthread&tid=$_G[tid]$fromuid" onclick="return copyThreadUrl(this, '$_G[setting][bbname]')" {if $fromuid}title="{lang share_url_copy_comment}"{/if} class="kmcopy">[{lang share_url_copy}]</a>
	<!--{hook/viewthread_title_extra}-->
</span>
<!--{if !IS_ROBOT}-->
<span class="y comiis_hfs"><strong>$_G[forum_thread][allreplies]</strong><br>{lang reply}</span>
<span class="y comiis_cks"><strong>$_G[forum_thread][views]</strong><br>{lang show}</span>
<span class="y comiis_sxy">
		<!--{if $post['invisible'] == 0}--><a href="forum.php?mod=viewthread&action=printable&tid=$_G[tid]" title="{lang thread_printable}" target="_blank"><img src="{IMGDIR}/print.png" alt="{lang thread_printable}" class="vm" /></a>
		<!--{/if}-->
		<a href="forum.php?mod=redirect&goto=nextoldset&tid=$_G[tid]" title="{lang last_thread}"><img src="{IMGDIR}/thread-prev.png" alt="{lang last_thread}" class="vm" /></a>
		<a href="forum.php?mod=redirect&goto=nextnewset&tid=$_G[tid]" title="{lang next_thread}"><img src="{IMGDIR}/thread-next.png" alt="{lang next_thread}" class="vm" /></a>
</span>
<!--{/if}-->
</div>
<!--{/if}-->
	<!--{if $_G['forum_thread']['replycredit'] > 0 || $rushreply}-->
	<div id="pl_top"<!--{if $rushreply}--> class="comiis_qltop"<!--{/if}-->>
		<table cellspacing="0" cellpadding="0">
			<!--{if $_G['forum_thread']['replycredit'] > 0 }-->
				<tr>
					<!--{if !$close_leftinfo}-->
					<td class="pls vm ptm">
					<!--{else}-->
					<td class="pls ptm pbm xi1" colspan="2">
					<!--{/if}-->
						<img src="{IMGDIR}/thread_prize_s.png" class="hm" alt="{lang replycredit}" />
							<strong>{$_G['forum_thread']['replycredit']} {$_G['setting']['extcredits'][$_G[forum_thread][replycredit_rule][extcreditstype]][unit]}{$_G['setting']['extcredits'][$_G[forum_thread][replycredit_rule][extcreditstype]][title]}</strong>
					<!--{if !$close_leftinfo}-->
					</td>
					<td class="plc ptm pbm xi1">
					<!--{else}-->
					&nbsp;&nbsp;&nbsp;&nbsp;
					<!--{/if}-->
						{lang thread_replycredit_tips1} {lang thread_replycredit_tips2}<!--{if $_G['forum_thread']['replycredit_rule'][random] > 0}--><span class="xg1">{lang thread_replycredit_tips3}</span><!--{/if}-->
					</td>
				</tr>
		<!--{/if}-->
		<!--{if $rushreply}-->
			<tr>
				<!--{if !$close_leftinfo}-->
				<td class="pls vm ptm">
					<img src="{IMGDIR}/rushreply_s.png" class="vm" alt="{lang rushreply}" />
					<strong>{lang rushreply}</strong>
				</td>
				<td class="plc ptm pbm xi1">
				<!--{else}-->
				<td class="plc ptm pbm xi1" colspan="2">
					<img src="{IMGDIR}/rushreply_s.png" class="vm" alt="{lang rushreply}" />
				<!--{/if}-->
					<!--{if $rushresult[rewardfloor]}-->
						<span class="y">
						<!--{if $_G['uid'] == $_G['thread']['authorid'] || $_G['forum']['ismoderator']}--><a href="javascript:;" onclick="showWindow('membernum', 'forum.php?mod=ajax&action=get_rushreply_membernum&tid=$_G[tid]')" class="y pn xi2"><span>{lang thread_rushreply_statnum}</span></a><!--{/if}-->
						<!--{if !$_GET['checkrush']}-->
								<a href="forum.php?mod=viewthread&tid=$post[tid]&checkrush=1" rel="nofollow" class="y pn xi2"><span>{lang rushreply_view}</span></a>
						<!--{/if}-->
						</span>
					<!--{/if}-->
					<!--{if $rushresult[creditlimit] == ''}-->
						{lang thread_rushreply}&nbsp;
					<!--{else}-->
						{lang thread_rushreply_limit} &nbsp;
					<!--{/if}-->
					<!--{if $rushresult['timer']}-->
					<span id="rushtimer_$thread[tid]"> {lang havemore_special} <span id="rushtimer_body_$thread[tid]"></span> <script language="javascript">settimer($rushresult['timer'], 'rushtimer_body_$thread[tid]');</script>{if $rushresult['timertype'] == 'start'} {lang header_start} {else} {lang over} {/if} {lang right_special}</span>
					<!--{/if}-->
					<!--{if $rushresult[stopfloor]}-->
						{lang thread_rushreply_end}$rushresult[stopfloor]&nbsp;
					<!--{/if}-->
					<!--{if $rushresult[rewardfloor]}-->
						{lang thread_rushreply_floor}: $rushresult[rewardfloor]&nbsp;
					<!--{/if}-->
					<!--{if $rushresult[rewardfloor] && $_GET['checkrush']}-->
						<p class="ptn">
							<!--{if $countrushpost}-->[<strong>$countrushpost</strong>]{lang thread_rushreply_rewardnum}<!--{else}--> {lang thread_rushreply_noreward} <!--{/if}-->&nbsp;&nbsp;
							<a href="forum.php?mod=viewthread&tid=$_G[tid]" class="xi2">{lang thread_rushreply_check_back}</a>
						</p>
					<!--{/if}-->
				</td>
			</tr>
		<!--{/if}-->
		</table>
	</div>
	<!--{/if}-->	
	<!--{hook/viewthread_title_row}-->
	<!--{eval $postcount = 0;}-->
	<!--{loop $postlist $post}-->
		<!--{if $rushreply && $_GET['checkrush'] && $post['rewardfloor'] != 1}-->
			<!--{eval continue;}-->
		<!--{/if}-->
		<!--{if $close_leftinfo}--><div class="comiis_viewbox"><!--{/if}-->
		<div id="post_$post[pid]" {if $_G['blockedpids'] && $post['inblacklist']}style="display:none;"{/if} class="comiis_vrx<!--{if $close_leftinfo}--> comiis_viewbox_nr<!--{/if}-->">
			<!--{subtemplate forum/viewthread_node}-->
		</div>
		<!--{if $close_leftinfo}--></div><!--{/if}-->
		<!--{if $close_leftinfo && $post['first'] && $_G[forum_thread][allreplies]!=0}-->
		<div id="comiis_allreplies" class="comiis_viewtitle cl">
			<h2 class="cl">
			<!--{if !IS_ROBOT && !$_G['forum_thread']['archiveid'] && !$rushreply}--><div class="y comiis_hfpx"><a onmouseover="showMenu(this.id)" class="showmenu" href="javascript:;" id="comiis_hfpx"><!--{if $ordertype != 1}-->{lang post_ascview}<!--{else}-->{lang post_descview}<!--{/if}--></a></div><!--{/if}-->
			<!--{if !IS_ROBOT && !$postcount && !$_G['forum_thread']['archiveid'] && $post['first'] }-->
				<div id="fj" class="y">
					<label class="z">{lang thread_redirect_postno}</label>
					<input type="text" class="px p_fre z" size="2" onkeyup="$('fj_btn').href='forum.php?mod=redirect&ptid=$_G[tid]&authorid=$_GET[authorid]&postno='+this.value" onkeydown="if(event.keyCode==13) {window.location=$('fj_btn').href;return false;}" title="{lang thread_redirect_postno_tips}" />
					<a href="javascript:;" id="fj_btn" class="z" title="{lang thread_redirect_postno_tips}"><img src="{IMGDIR}/fj_btn.png" alt="{lang thread_redirect_postno_tips}" class="vm" /></a>
				</div>
			<!--{/if}-->
			<span class="z">{$_G[forum_thread][allreplies]} 个评论</span>
			</h2>
		</div>
		<!--{if !IS_ROBOT && !$_G['forum_thread']['archiveid'] && !$rushreply && $_G[forum_thread][allreplies]!=0}-->
        <div style="display:none" class="p_pop" id="comiis_hfpx_menu">
          <ul>
			<!--{if $ordertype != 1}-->
            <li><a href="forum.php?mod=viewthread&tid=$_G[tid]&extra=$_GET[extra]&ordertype=2#comiis_allreplies">{lang post_ascview}</a></li>
            <li><a href="forum.php?mod=viewthread&tid=$_G[tid]&extra=$_GET[extra]&ordertype=1#comiis_allreplies">{lang post_descview}</a></li>
            <!--{else}-->
            <li><a href="forum.php?mod=viewthread&tid=$_G[tid]&extra=$_GET[extra]&ordertype=1#comiis_allreplies">{lang post_descview}</a></li>
            <li><a href="forum.php?mod=viewthread&tid=$_G[tid]&extra=$_GET[extra]&ordertype=2#comiis_allreplies">{lang post_ascview}</a></li>
            <!--{/if}-->
          </ul>          
        </div>
        <!--{/if}-->
		<!--{/if}-->
		<!--{eval $postcount++;}-->
	<!--{/loop}-->
	<div id="postlistreply" class="pl<!--{if !$close_leftinfo}--> comiis_postlistreply<!--{/if}-->"><div id="post_new" class="viewthread_table" style="display: none"></div></div>
	<!--{if $_G['blockedpids']}-->
		<div id='hiddenpoststip'><a href='javascript:display_blocked_post();'>{lang other_reply_hide}</a></div>
		<div id="hiddenposts"></div>
	<!--{/if}-->
</div>
<form method="post" autocomplete="off" name="modactions" id="modactions">
	<input type="hidden" name="formhash" value="{FORMHASH}" />
	<input type="hidden" name="optgroup" />
	<input type="hidden" name="operation" />
	<input type="hidden" name="listextra" value="$_GET[extra]" />
	<input type="hidden" name="page" value="$page" />
</form>
$_G['forum_tagscript']
<!--{if $close_leftinfo}-->
<div class="comiis_vfy cl">
	<!--{if $multipage && $page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']}-->
	<!--{eval $nxtpage = $page + 1;}-->
		<a href="forum.php?mod=viewthread&tid=$_G[tid]{if $_GET[authorid]}&authorid=$_GET[authorid]{/if}&page=$nxtpage" hidefocus="true" class="comiis_pgbtn"><i></i>查看下一页</a>
	<!--{/if}-->
</div>
<!--{else}-->
<div class="pgbtn"><a href="forum.php?mod=viewthread&tid=$_G[tid]{if $_GET[authorid]}&authorid=$_GET[authorid]{/if}&page=$nxtpage" hidefocus="true" class="bm_h">{lang next_page_extra}</a></div>
<!--{/if}-->
<!--{if $close_leftinfo}-->
<div class="comiis_pgs cl">	
	<span class="pgb"{if $_G['setting']['visitedforums']} id="visitedforumstmp" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id,'pos':'21'})"{/if}><a href="$upnavlink">{lang return_forumdisplay}</a></span>$multipage
</div>
<!--{else}-->
<div class="pgs mtm mbm cl">
	$multipage
	<span class="pgb y"{if $_G['setting']['visitedforums']} id="visitedforumstmp" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id,'pos':'21'})"{/if}><a href="$upnavlink">{lang return_forumdisplay}</a></span>
	<!--{if !$_G['forum_thread']['is_archived']}-->
		<a id="newspecialtmp" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"{if !$_G['forum']['allowspecialonly'] && empty($_G['forum']['picstyle']) && !$_G['forum']['threadsorts']['required']} onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=$_G[fid]')"{else} onclick="location.href='forum.php?mod=post&action=newthread&fid=$_G[fid]';return false;"{/if} href="javascript:;" title="{lang send_posts}"><img src="{IMGDIR}/pn_post.png" alt="{lang send_posts}" /></a>
	<!--{/if}-->
	<!--{if $allowpostreply && !$_G['forum_thread']['archiveid']}-->
		<a id="post_replytmp" onclick="showWindow('reply', 'forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]')" href="javascript:;" title="{lang reply}"><img src="{IMGDIR}/pn_reply.png" alt="{lang reply}" /></a>
	<!--{/if}-->
</div>
<!--{/if}-->
<!--{hook/viewthread_middle}-->
<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->
<!--{if $fastpost}-->
<!--{if !$close_leftinfo}-->
<div class="bm_h kmtx">
<h2>{lang post_newreply}</h2>
</div>
<!--{/if}-->
	<!--{subtemplate forum/viewthread_fastpost}-->
<!--{/if}-->
<!--{hook/viewthread_bottom}-->
<!--{if ($_G['setting']['visitedforums']) && $_G['forum']['status'] != 3}-->
	<div id="visitedforums_menu" class="p_pop blk cl" style="display: none;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td id="v_forums">
					<h3 class="mbn pbn bbda xg1">{lang viewed_forums}</h3>
					<ul class="xl xl1">
						$_G['setting']['visitedforums']
					</ul>
				</td>
			</tr>
		</table>
	</div>
<!--{/if}-->
<!--{if $_G['medal_list']}-->
<!--{loop $_G['medal_list'] $medalid $medal}-->
	<div id="md_{$medalid}_menu" class="tip tip_4" style="display: none;">
		<div class="tip_horn"></div>
		<div class="tip_c">
			<h4>$medal[name]</h4>
			<p>$medal[description]</p>
		</div>
	</div>
<!--{/loop}-->
<!--{/if}-->
<!--{if !IS_ROBOT && !empty($_G[setting][lazyload])}-->
	<script type="text/javascript">
	new lazyload();
	</script>
<!--{/if}-->
<!--{if !IS_ROBOT && $_G['setting']['threadmaxpages'] > 1}-->
	<script type="text/javascript">document.onkeyup = function(e){keyPageScroll(e, <!--{if $page > 1}-->1<!--{else}-->0<!--{/if}-->, <!--{if $page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']}-->1<!--{else}-->0<!--{/if}-->, 'forum.php?mod=viewthread&tid=$_G[tid]<!--{if $_GET[authorid]}-->&authorid=$_GET[authorid]<!--{/if}-->', $page);}</script>
<!--{/if}-->
</div></div>
<!--{if $comiis_view_zlb>0}-->
</div></div>
<div class="comiis_lbox">
	<!--{if !$close_leftinfo}--><div class="comiis_divtis">提醒：为防止数据丢失，下面边栏数据DIY的时候会出现，不会影响正常使用，谢谢!</div><!--{/if}-->
	<div style="height:158px;overflow:hidden;">	
		<div class="comiis_irbox comiis_irftbtn cl" id="comiis_irftbtn">
			<a href="javascript:;" id="newspecial" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"{if !$_G['forum']['allowspecialonly'] && empty($_G['forum']['picstyle']) && !$_G['forum']['threadsorts']['required']} onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=$_G[fid]')"{else} onclick="location.href='forum.php?mod=post&action=newthread&fid=$_G[fid]';return false;"{/if} title="{lang send_posts}" class="kmfbzt" title="发表主题"></a>
			<a href="/k_misign-sign.html" target="_blank" class="kmqd" title="签到"><script type="text/javascript">var dfsj = new Date();document.write('周'+'日一二三四五六'.charAt(new Date().getDay())+'<br>'+(dfsj.getMonth()+1)+'月'+dfsj.getDate()+'日');</script></a>
			<div class="comiis_xmft cl">
				<ul>
					<li class="a1"><!--{if $_G['uid']}--><a href="forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]&reppost=$post[pid]&extra=$_GET[extra]&page=$page" onclick="showWindow('reply', this.href)">回复</a><!--{else}--><span>回复</span><!--{/if}--></LI>
					<li class="a2"><!--{if helper_access::check_module('follow') && $_G['uid']}--><a href="home.php?mod=spacecp&ac=follow&op=relay&tid=$_G[tid]&from=forum" onclick="showWindow('relaythread', this.href, 'get', 0);">转播</a><!--{else}--><span>转播</span><!--{/if}--></li>
					<li class="a3"><!--{if $_G['group']['raterange'] && $_G['uid']}--><a href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=$_G[tid]&pid=$post[pid]', 'get', -1);return false;">评分</a><!--{else}--><span>评分</span><!--{/if}--></li>
					<li class="a4"><!--{if helper_access::check_module('share') && $_G['uid']}--><a href="home.php?mod=spacecp&ac=share&type=thread&id=$_G[tid]" onclick="showWindow('sharethread', this.href, 'get', 0);">分享</a><!--{else}--><span class="a4">分享</span><!--{/if}--></li>
				</ul>
			</div>
		</div>	
	</div>
	<!--[diy=comiis_irbox_diy01s]--><div id="comiis_irbox_diy01s" class="area"></div><!--[/diy]-->
	<!--{if $_G[forum_thread][authorid] && $comiis_view_tit_avt == 2}-->	
		<div class="comiis_irbox comiis_lzinfo">
			<div class="comiis_lzinfo_one">
				<div class="lzinfo_img">
					<a href="home.php?mod=space&uid={$_G[forum_thread][authorid]}" target="_blank" title="访问我的空间"><!--{avatar($_G[forum_thread][authorid],middle)}--></a>
				</div>
				<div class="kmuser">
				<a href="home.php?mod=space&uid={$_G[forum_thread][authorid]}" target="_blank" title="访问我的空间" c="1">{$_G[forum_thread][author]}</a>
				<!--{eval $comiis_threadnum = '';}-->
				<!--{loop $postlist $post}-->
					<!--{if $post['first']}-->
						<!--{loop $post['verifyicon'] $vid}-->
							<a href="home.php?mod=spacecp&ac=profile&op=verify&vid=$vid" target="_blank"><!--{if $_G['setting']['verify'][$vid]['icon']}--><img src="$_G['setting']['verify'][$vid]['icon']" class="vm" alt="$_G['setting']['verify'][$vid][title]" title="$_G['setting']['verify'][$vid][title]" /><!--{else}-->$_G['setting']['verify'][$vid]['title']<!--{/if}--></a>
						<!--{/loop}-->
						<!--{loop $post['unverifyicon'] $vid}-->
							<a href="home.php?mod=spacecp&ac=profile&op=verify&vid=$vid" target="_blank"><img src="$_G['setting']['verify'][$vid]['unverifyicon']" class="vm" alt="$_G['setting']['verify'][$vid][title]" title="$_G['setting']['verify'][$vid][title]" /></a>
						<!--{/loop}--><br>
						<a href="home.php?mod=spacecp&ac=usergroup&gid=$post[groupid]" target="_blank" class="kmtxt">{$post[authortitle]}</a>
						<!--{block comiis_threadnum}-->
							<div class="tns"><table cellspacing="0" cellpadding="0">
								<!--{loop $post['numbercard'] $numbercardkey $numbercard}-->
									<!--{if $numbercardkey == 2}--><td><!--{else}--><th><!--{/if}-->
									<p><a href="{$numbercard[link]}" class="xi2">{$numbercard[value]}</a></p>{$numbercard[lang]}
									<!--{if $numbercardkey == 2}--></td><!--{else}--></th><!--{/if}-->
								<!--{/loop}-->		
							</table></div>
						<!--{/block}-->
					<!--{/if}-->
				<!--{/loop}-->
				</div>
				{$comiis_threadnum}
				<div class="kmuser_an cl">
					<a href="home.php?mod=space&uid={$_G[forum_thread][authorid]}" target="_blank">Ta的主页</a><a href="home.php?mod=spacecp&ac=pm&op=showmsg&handlekey=showmsg_{$_G[forum_thread][authorid]}&touid={$_G[forum_thread][authorid]}&pmid=0&daterange=2&tid={$_G[forum_thread][tid]}" class="kmmsn" onclick="showWindow('sendpm', this.href);">发信息</a>
				</div>
			</div>			
		</div>
	<!--{/if}-->
	<!--[diy=comiis_irbox_diy01]--><div id="comiis_irbox_diy01" class="area"></div><!--[/diy]-->
	<div class="comiis_irbox comiis_irbox_ss cl">
		<!--[diy=comiis_irbox_video]--><div id="comiis_irbox_video" class="area"></div><!--[/diy]-->
		<!--{if $comiis_navss==0 || $comiis_navss==2}-->
			<div id="sckm">
			<!--{subtemplate common/comiis_navss}-->
			</div>
		<!--{/if}-->
		<!--{if $comiis_navss==2 && $_G['setting']['search'] && $slist}-->
			<ul id="comiis_twtsc_type_menu" class="p_pop" style="display: none;"><!--{echo implode('', $slist);}--></ul>
			<script type="text/javascript">
				initSearchmenu('comiis_twtsc', '$searchparams[url]');
			</script>
		<!--{/if}-->
		<!--{if $comiis_navss==2}-->
		<div id="scbar_hot" class="cl">
			<!--{if $_G['setting']['srchhotkeywords']}-->
				<span class="z">{lang hot_search}：</span>
				<!--{loop $_G['setting']['srchhotkeywords'] $val}-->
					<!--{if $val=trim($val)}-->
						<!--{eval $valenc=rawurlencode($val);}-->
						<!--{block srchhotkeywords[]}-->
							<!--{if !empty($searchparams['params'])}-->
								<!--{eval $srchotquery='';}--> 
								<!--{loop $searchparams['params'] $key $value}--> 
									<!--{eval $srchotquery .= '&' . $key . '=' . rawurlencode($value);}--> 
								<!--{/loop}-->
							<!--{/if}-->
							<!--{if !empty($searchparams[url])}-->
								<a href="$searchparams[url]?q=$valenc&source=hotsearch{$srchotquery}" target="_blank" sc="1">$val</a>
							<!--{else}-->
								<a href="search.php?mod=forum&srchtxt=$valenc&formhash={FORMHASH}&searchsubmit=true&source=hotsearch" target="_blank" sc="1">$val</a>
							<!--{/if}-->
						<!--{/block}-->
					<!--{/if}-->
				<!--{/loop}-->
				<!--{echo implode('', $srchhotkeywords);}-->
			<!--{/if}-->
		</div>
		<!--{/if}-->
	</div>
	<!--[diy=comiis_irbox_diy02km]--><div id="comiis_irbox_diy02km" class="area"></div><!--[/diy]-->
	<div id="comiis_viewthread_sidebottom_div"></div>
	<!--[diy=comiis_irbox_diy02]--><div id="comiis_irbox_diy02" class="area"></div><!--[/diy]-->
	<div class="comiis_bkbox">
		<div class="comiis_bkbox_tab">
			<ul>
				<li class="kmon" id="comiis_bkbox_tab1_1" onMouseOver="switchTab('comiis_bkbox_tab1',1,2,'kmon');">版块推荐</li>
				<li id="comiis_bkbox_tab1_2" onMouseOver="switchTab('comiis_bkbox_tab1',2,2,'kmon');">百宝箱</li>
			</ul>
		</div>
		<div id="comiis_bkbox_tab1_c_1" class="comiis_bkbox_list cl">
			<!--[diy=comiis_irbox_02]--><div id="comiis_irbox_02" class="area"></div><!--[/diy]-->
		</div>
		<div id="comiis_bkbox_tab1_c_2" class="comiis_bkbox_list cl" style="display:none">
			<!--[diy=comiis_irbox_03]--><div id="comiis_irbox_03" class="area"></div><!--[/diy]-->
		</div>	
	</div>
	<!--[diy=comiis_irbox_nby07]--><div id="comiis_irbox_nby07" class="area"></div><!--[/diy]-->
	<div class="comiis_irbox cl">
		<div class="comiis_irbox_tit cl" id="comiis_keys">
			<h2>图文热点</h2>
		</div>
		<div class="comiis_irbox_jctj cl">
			<!--[diy=comiis_irbox_nbyjctj]--><div id="comiis_irbox_nbyjctj" class="area"></div><!--[/diy]-->
		</div>
		<!--[diy=comiis_irbox_nby00]--><div id="comiis_irbox_nby00" class="area"></div><!--[/diy]-->
	</div>		
	<!--[diy=comiis_irbox_diy03]--><div id="comiis_irbox_diy03" class="area"></div><!--[/diy]-->
	<div class="comiis_irbox">
		<div class="comiis_irbox_tit cl">
			<span><a href="#" target="_blank">更多</a></span><h2>精华推荐</h2>
		</div>
		<div class="comiis_irbox_list cl">
			<!--[diy=comiis_irbox_04]--><div id="comiis_irbox_04" class="area"></div><!--[/diy]-->
		</div>
	</div>
	<!--[diy=comiis_irbox_diy08]--><div id="comiis_irbox_diy08" class="area"></div><!--[/diy]-->
	<div class="comiis_irbox">
		<div class="comiis_irbox_tit cl">
			<span><a href="misc.php?mod=ranklist&type=member" target="_blank">更多</a></span><h2>社区学堂</h2>
		</div>
		<div class="comiis_irbox_user cl">
			<!--[diy=comiis_irbox_08]--><div id="comiis_irbox_08" class="area"></div><!--[/diy]-->
		</div>
	</div>
	<!--[diy=comiis_irbox_diy09]--><div id="comiis_irbox_diy09" class="area"></div><!--[/diy]-->
	<div class="comiis_irbox" style="margin-bottom:0;">
		<div class="comiis_irbox_tit cl">
			<span><a href="#" target="_blank">更多</a></span><h2>客服中心</h2>
		</div>
		<div class="comiis_irbox_tel cl">
			<!--[diy=comiis_irbox_tel]--><div id="comiis_irbox_tel" class="area"></div><!--[/diy]-->
		</div>
		<div class="comiis_irbox_qqwb cl">
			<!--[diy=comiis_irbox_qqwb]--><div id="comiis_irbox_qqwb" class="area"></div><!--[/diy]-->
		</div>
		<!--[diy=comiis_irbox_nbyewm]--><div id="comiis_irbox_nbyewm" class="area"></div><!--[/diy]-->
	</div>
	<!--[diy=comiis_irbox_diy10]--><div id="comiis_irbox_diy10" class="area"></div><!--[/diy]-->
</div>
<div style="clear:both;height:0px;overflow:hidden;font-size:0;"></div>
</div>
<!--{/if}-->
<div class="wp mtn">
	<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<!--{if $_G['relatedlinks'] || $_GET['highlight']}-->
	<script type="text/javascript">
		var relatedlink = [];
		<!--{loop $_G['relatedlinks'] $key $link}-->
		relatedlink[$key] = {'sname':'$link[name]', 'surl':'$link[url]'};
		<!--{/loop}-->
		{eval $highlights = explode(' ', str_replace(array('\'', chr(125)), array('&#039;', '&#125;'), dhtmlspecialchars($_GET['highlight'])));}
		<!--{loop $highlights $word}-->
		{eval $key++;}
		relatedlink[$key] = {'sname':'$word', 'surl':''};
		<!--{/loop}-->
		relatedlinks('postmessage_$_G[forum_firstpid]');
	</script>
<!--{/if}-->
<!--{if !empty($_G['cookie']['clearUserdata']) && $_G['cookie']['clearUserdata'] == 'forum'}-->
	<script type="text/javascript">saveUserdata('forum_'+discuz_uid, '')</script>
<!--{/if}-->
<script type="text/javascript">
<!--{if $_G['forum']['picstyle'] && ($_G['forum']['ismoderator'] || $_G['uid'] == $_G['thread']['authorid'])}-->
function showsetcover(obj) {
	if(obj.parentNode.id == 'postmessage_$_G[forum_firstpid]') {
		var defheight = $_G['setting']['forumpicstyle']['thumbheight'];
		var defwidth = $_G['setting']['forumpicstyle']['thumbwidth'];
		var newimgid = 'showcoverimg';
		var imgsrc = obj.src ? obj.src : obj.file;
		if(!imgsrc) return;
		var tempimg=new Image();
		tempimg.src=imgsrc;
		if(tempimg.complete) {
			if(tempimg.width < defwidth || tempimg.height < defheight) return;
		} else {
			return;
		}
		if($(newimgid) && obj.id != newimgid) {
			$(newimgid).id = 'img'+Math.random();
		}
		if($(newimgid+'_menu')) {
			var menudiv = $(newimgid+'_menu');
		} else {
			var menudiv = document.createElement('div');
			menudiv.className = 'tip tip_4 aimg_tip';
			menudiv.id = newimgid+'_menu';
			menudiv.style.position = 'absolute';
			menudiv.style.display = 'none';
			obj.parentNode.appendChild(menudiv);
		}
		menudiv.innerHTML = '<div class="tip_c xs0"><a onclick="showWindow(\'setcover_'+newimgid+'\', this.href)" href="forum.php?mod=ajax&amp;action=setthreadcover&amp;tid=$_G[tid]&amp;pid=$_G[forum_firstpid]&amp;fid=$_G[fid]&imgurl='+imgsrc+'">{lang set_cover}</a></div>';
		obj.id = newimgid;
		showMenu({'ctrlid':newimgid,'pos':'12'});
	}
	return;
}
<!--{/if}-->
function succeedhandle_followmod(url, msg, values) {
	var fObj = $('followmod_'+values['fuid']);
	if(values['type'] == 'add') {
		fObj.innerHTML = '{lang nofollow}';
		fObj.href = 'home.php?mod=spacecp&ac=follow&op=del&fuid='+values['fuid'];
	} else if(values['type'] == 'del') {
		fObj.innerHTML = '{lang follow}';
		fObj.href = 'home.php?mod=spacecp&ac=follow&op=add&hash={FORMHASH}&fuid='+values['fuid'];
	}
}
<!--{if $_G['blockedpids']}-->
var blockedPIDs = [<!--{echo implode(',', $_G['blockedpids'])}-->];
<!--{/if}-->
<!--{if $postlist && empty($_G['setting']['disfixedavatar'])}-->
fixed_avatar([<!--{echo implode(',', array_keys($postlist))}-->], {if empty($_G['setting']['disfixednv_viewthread']) }1{else}0{/if});
<!--{elseif empty($_G['setting']['disfixednv_viewthread'])}-->
fixed_top_nv();
<!--{/if}-->
<!--{if $close_leftinfo}-->
if($('comiis_viewthread_sidebottom_div') && $('comiis_viewthread_sidebottom')){
	$('comiis_viewthread_sidebottom_div').innerHTML = "<div class=\"comiis_irbox comis_kmlzrt\">" + $('comiis_viewthread_sidebottom').innerHTML + "</div>";
}
<!--{/if}-->
</script>
<!--{if $close_leftinfo && $page > 1}-->
<script>
jQuery(function(){
	if($('comiis_allreplies')){
		jQuery("html,body").animate({scrollTop:jQuery("#comiis_allreplies").offset().top - 50}, 1000);
	}
});
</script>
<!--{/if}-->
<!--{if $close_leftinfo}-->
<script src="{$_G['style']['styleimgdir']}/jquery.min.js" type="text/javascript"></script>
<script src="{$_G['style']['styleimgdir']}/responsiveslides.min.js" type="text/javascript"></script>
<!--{eval $topsss = ($comiis_header_fx ? ($comiis_header ? '63' : '50') : '0');}-->
<style>.comiis_btn{top:{$topsss}px;}</style>
<script>
var comiis_irftbtn = $('comiis_irftbtn');
var comiis_irftbtnoffset = parseInt(fetchOffset(comiis_irftbtn)['top']);
_attachEvent(window, 'scroll', function () {
var comiis_scrollTopk = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
if(comiis_scrollTopk >= comiis_irftbtnoffset - {$topsss}){
	comiis_irftbtn.className = 'comiis_irbox comiis_irftbtn cl comiis_btn';
	if (BROWSER.ie && BROWSER.ie < 7) {
		comiis_irftbtn.style.position = 'absolute';
		comiis_irftbtn.style.top = (comiis_scrollTopk + {$topsss}) + 'px';
	}else{
		comiis_irftbtn.style.position = 'fixed';
	}
}else{
	comiis_irftbtn.style.position = 'static';
	comiis_irftbtn.className = 'comiis_irbox comiis_irftbtn cl';
}
});
</script>
<!--{/if}-->
<!--{template common/footer}-->