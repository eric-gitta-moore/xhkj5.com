<?PHP exit('Access Denied');?>
<!--{template common/header}-->
<div id="pt" class="bm cl">
	<div class="y">
		<!--{hook/index_nav_extra}-->
		<!--{if $_G['uid']}--><a href="forum.php?mod=guide&view=my" title="{lang my_posts}">{lang my_posts}</a><!--{/if}--><!--{if !empty($_G['setting']['search']['forum']['status'])}--><!--{if $_G['uid']}--><span class="pipe">|</span><!--{/if}--><a href="forum.php?mod=guide&view=new" title="{lang show_newthreads}">{lang show_newthreads}</a><!--{/if}-->
	</div>
	<div class="z">
		<a href="./" class="nvhm" title="{lang homepage}">$_G[setting][bbname]</a><em>&raquo;</em><a href="forum.php">{$_G[setting][navs][2][navname]}</a>$navigation
	</div>
	<div class="z"><!--{hook/index_status_extra}--></div>
</div>
<!--{if empty($gid)}-->
	<!--{ad/text/wp a_t}-->
<!--{/if}-->
	<style id="diy_style" type="text/css"></style>
<!--{if empty($gid)}-->
	<div class="wp">
		<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
	</div>
<!--{/if}-->
<!--{if empty($gid)}-->
<div class="comiis_chart">
	<ul class="comiis_chart_box">
		<li><em>$todayposts</em>今日发帖数</li>
		<li><em>$postdata[0]</em>昨日发帖数</li>
		<li><em>$posts</em>总帖数</li>
		<li<!--{if !$_G['cache']['userstats']['newsetuser']}--> class="norx"<!--{/if}-->><em>$_G['cache']['userstats']['totalmembers']</em>会员总数</li>
		<!--{if $_G['cache']['userstats']['newsetuser']}--><li class="norx"><em><a href="home.php?mod=space&username={echo rawurlencode($_G['cache']['userstats']['newsetuser'])}" target="_blank">$_G['cache']['userstats']['newsetuser']</a></em>{lang welcome_new_members}</li><!--{/if}-->
	</ul>
</div>
<!--{/if}-->
<!--[diy=diy_chart]--><div id="diy_chart" class="area"></div><!--[/diy]-->
<!--{if !empty($_G['setting']['grid']['showgrid'])}-->
<!-- index four grid -->
<div class="fl bm">
	<div class="bm bmw cl">
		<div id="category_grid" class="bm_c" >
			<table cellspacing="0" cellpadding="0"><tr>
			<!--{if !$_G['setting']['grid']['gridtype']}-->
				<td valign="top" class="category_l1">
					<div class="newimgbox">
						<h4><span class="tit_newimg"></span>{lang latest_images}</h4>
						<div class="module cl slidebox_grid comiis_ngswfk">
							<script type="text/javascript">
							var slideSpeed = 5000;
							{if $comiis_window_width!=0}
							if(screen.width>1210){
								var slideImgsize = [268,230];
							}else{
								var slideImgsize = [218,230];
							}
							{else}
							var slideImgsize = [218,230];
							{/if}
							var slideBorderColor = '{$_G['style']['specialborder']}';
							var slideBgColor = '{$_G['style']['commonbg']}';
							var slideImgs = new Array();
							var slideImgLinks = new Array();
							var slideImgTexts = new Array();
							var slideSwitchColor = '{$_G['style']['tabletext']}';
							var slideSwitchbgColor = '{$_G['style']['commonbg']}';
							var slideSwitchHiColor = '{$_G['style']['specialborder']}';
							{eval $k = 1;}
							<!--{loop $grids['slide'] $stid $svalue}-->
								slideImgs[<!--{echo $k}-->] = '$svalue[image]';
								slideImgLinks[<!--{echo $k}-->] = '{$svalue[url]}';
								slideImgTexts[<!--{echo $k}-->] = '$svalue[subject]';
								{eval $k++;}
							<!--{/loop}-->
							</script>
							<script language="javascript" type="text/javascript" src="{$_G[setting][jspath]}forum_slide.js?{VERHASH}"></script>
						</div>
					</div>
				</td>
			<!--{/if}-->
			<td valign="top" class="category_l2">
				<div class="subjectbox">
					<h4><span class="tit_subject"></span>{lang collection_lastthread}</h4>
					<ul class="category_newlist">
						<!--{loop $grids['newthread'] $thread}-->
						<!--{if !$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])}-->
							<!--{eval $thread[tid]=$thread[closed];}-->
						<!--{/if}-->
						<li><a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra"{if $thread['highlight']} $thread['highlight']{/if}{if $_G['setting']['grid']['showtips']} tip="{lang title}: <strong>$thread[oldsubject]</strong><br/>{lang author}: $thread[author] ($thread[dateline])<br/>{lang show}/{lang reply}: $thread[views]/$thread[replies]" onmouseover="showTip(this)"{else} title="$thread[oldsubject]"{/if}{if $_G['setting']['grid']['targetblank']} target="_blank"{/if}>$thread[subject]</a></li>
						<!--{/loop}-->
					 </ul>
				 </div>
			</td>
			<td valign="top" class="category_l3">
				<div class="replaybox">
					<h4><span class="tit_replay"></span>{lang show_newthreads}</h4>
					<ul class="category_newlist">
						<!--{loop $grids['newreply'] $thread}-->
						<!--{if !$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])}-->
							<!--{eval $thread[tid]=$thread[closed];}-->
						<!--{/if}-->
						<li><a href="forum.php?mod=redirect&tid=$thread[tid]&goto=lastpost#lastpost"{if $thread['highlight']} $thread['highlight']{/if}{if $_G['setting']['grid']['showtips']}tip="{lang title}: <strong>$thread[oldsubject]</strong><br/>{lang author}: $thread[author] ($thread[dateline])<br/>{lang show}/{lang reply}: $thread[views]/$thread[replies]" onmouseover="showTip(this)"{else} title="$thread[oldsubject]"{/if}{if $_G['setting']['grid']['targetblank']} target="_blank"{/if}>$thread[subject]</a></li>
						<!--{/loop}-->
					 </ul>
				 </div>
			</td>
			<td valign="top" class="category_l3">
				<div class="hottiebox">
					<h4><span class="tit_hottie"></span>{lang hot_thread}</h4>
					<ul class="category_newlist">
						<!--{loop $grids['hot'] $thread}-->
						<!--{if !$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])}-->
							<!--{eval $thread[tid]=$thread[closed];}-->
						<!--{/if}-->
						<li><a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra"{if $thread['highlight']} $thread['highlight']{/if}{if $_G['setting']['grid']['showtips']} tip="{lang title}: <strong>$thread[oldsubject]</strong><br/>{lang author}: $thread[author] ($thread[dateline])<br/>{lang show}/{lang reply}: $thread[views]/$thread[replies]" onmouseover="showTip(this)"{else} title="$thread[oldsubject]"{/if}{if $_G['setting']['grid']['targetblank']} target="_blank"{/if}>$thread[subject]</a></li>
						<!--{/loop}-->
					 </ul>
				 </div>
			</td>
			<!--{if $_G['setting']['grid']['gridtype']}-->
				<td valign="top" class="category_l4">
					<div class="goodtiebox">
						<h4><span class="tit_goodtie"></span>{lang post_digest_thread}</h4>
						<ul class="category_newlist">
							<!--{loop $grids['digest'] $thread}-->
								<!--{if !$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])}-->
									<!--{eval $thread[tid]=$thread[closed];}-->
								<!--{/if}-->
								<li><a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra"{if $thread['highlight']} $thread['highlight']{/if}{if $_G['setting']['grid']['showtips']} tip="{lang title}: <strong>$thread[oldsubject]</strong><br/>{lang author}: $thread[author] ($thread[dateline])<br/>{lang show}/{lang reply}: $thread[views]/$thread[replies]" onmouseover="showTip(this)"{else} title="$thread[oldsubject]"{/if}{if $_G['setting']['grid']['targetblank']} target="_blank"{/if}>$thread[subject]</a></li>
							<!--{/loop}-->
						 </ul>
					</div>
				</td>
			<!--{/if}-->
			</table>
		</div>
	</div>
</div>
<!-- index four grid end -->
<!--{/if}-->
<!--[diy=diy_chartkm]--><div id="diy_chartkm" class="area"></div><!--[/diy]-->
<!--{hook/index_top}-->
<div id="ct" class="wp cl{if $comiis_forum_right==1} ct2{/if}">
	<div class="mn comiis_rollzbox ityp">
	<!--{if empty($gid) && $announcements}-->
	<!--[diy=comiis_andiy]--><div id="comiis_andiy" class="area"></div><!--[/diy]-->
	<div id="pt" class="bm cl comiis_an">	
	<div id="an">
		<dl class="cl">
			<dt class="z xw1">社区{lang announcements}:</dt>
			<dd>
				<div id="anc"><ul id="ancl">$announcements</ul></div>
			</dd>
		</dl>
	</div>
	<script type="text/javascript">announcement();</script>	
	</div>
	<div style="clear:both;"></div>
	<!--{/if}-->
		<!--{if !empty($_G['cache']['heats']['message'])}-->
			<div class="bm">
				<div class="bm_h cl">
					<h2>{lang hotthreads_forum}</h2>
				</div>
				<div class="bm_c cl">
					<div class="heat z">
						<!--{loop $_G['cache']['heats']['message'] $data}-->
							<dl class="xld">
								<dt><!--{if $_G['adminid'] == 1}--><a class="d" href="forum.php?mod=misc&action=removeindexheats&tid=$data[tid]" onclick="return removeindexheats()">delete</a><!--{/if}-->
								<a href="forum.php?mod=viewthread&tid=$data[tid]" target="_blank" class="xi2">$data[subject]</a></dt>
								<dd>$data[message]</dd>
							</dl>
						<!--{/loop}-->
					</div>
					<ul class="xl xl1 heatl">
					<!--{loop $_G['cache']['heats']['subject'] $data}-->
						<li><!--{if $_G['adminid'] == 1}--><a class="d" href="forum.php?mod=misc&action=removeindexheats&tid=$data[tid]" onclick="return removeindexheats()">delete</a><!--{/if}-->&middot; <a href="forum.php?mod=viewthread&tid=$data[tid]" target="_blank" class="xi2">$data[subject]</a></li>
					<!--{/loop}-->
					</ul>
				</div>
			</div>
		<!--{/if}-->
		<!--{hook/index_catlist_top}-->
		<div class="fl bm">
			<!--{if !empty($collectiondata['follows'])}-->
			<!--{eval $forumscount = count($collectiondata['follows']);}-->
			<!--{eval $forumcolumns = 4;}-->
			<!--{eval $forumcolwidth = (floor(100 / $forumcolumns) - 0.1).'%';}-->
			<div class="bm bmw {if $forumcolumns} flg{/if} cl">
				<div class="bm_h cl">
					<span class="o">
						<img id="category_-1_img" src="{IMGDIR}/$collapse['collapseimg_-1']" title="{lang spread}" alt="{lang spread}" onclick="toggle_collapse('category_-1');" />
					</span>
					<h2><a href="forum.php?mod=collection&op=my">{lang my_order_collection}</a></h2>
				</div>
				<div id="category_-1" class="bm_c comiis_onebm_c" style="{echo $collapse['category_-1']}">
					<table cellspacing="0" cellpadding="0" class="fl_tb">
						<tr>
						<!--{eval $ctorderid = 0;}-->
						<!--{loop $collectiondata['follows'] $key $colletion}-->
							<!--{if $ctorderid && ($ctorderid % $forumcolumns == 0)}-->
								</tr>
								<!--{if $ctorderid < $forumscount}-->
									<tr class="fl_row">
								<!--{/if}-->
							<!--{/if}-->
							<td class="fl_g"{if $forumcolwidth} width="$forumcolwidth"{/if}>
							<div class="comiis_fl_g">
								<div class="fl_icn_g">
								<a href="forum.php?mod=collection&action=view&ctid={$colletion[ctid]}" target="_blank"><img src="{IMGDIR}/forum{if $followcollections[$key]['lastvisit'] < $colletion['lastupdate']}_new{/if}.gif" alt="$colletion[name]" /></a>
								</div>
								<dl>
									<dt><a href="forum.php?mod=collection&action=view&ctid={$colletion[ctid]}">$colletion[name]</a></dt>
									<dd><em>{lang forum_threads}: <!--{echo dnumber($colletion[threadnum])}--></em>, <em>{lang collection_commentnum}: <!--{echo dnumber($colletion[commentnum])}--></em></dd>
									<dd>
									<!--{if $colletion['lastpost']}-->
										<!--{if $forumcolumns < 3}-->
											<a href="forum.php?mod=redirect&tid=$colletion[lastpost]&goto=lastpost#lastpost" class="xi2"><!--{echo cutstr($colletion[lastsubject], 30)}--></a> <cite><!--{date($colletion[lastposttime])}--> <!--{if $colletion['lastposter']}-->$colletion['lastposter']<!--{else}-->$_G[setting][anonymoustext]<!--{/if}--></cite>
										<!--{else}-->
											<a href="forum.php?mod=redirect&tid=$colletion[lastpost]&goto=lastpost#lastpost">{lang forum_lastpost}: <!--{date($colletion[lastposttime])}--></a>
										<!--{/if}-->
									<!--{else}-->
										{lang never}
									<!--{/if}-->
									</dd>
									<!--{hook/index_followcollection_extra $colletion[ctid]}-->
								</dl>
							</div>
							</td>
							<!--{eval $ctorderid++;}-->
						<!--{/loop}-->
						<!--{if ($columnspad = $ctorderid % $forumcolumns) > 0}--><!--{echo str_repeat('<td class="fl_g"'.($forumcolwidth ? " width=\"$forumcolwidth\"" : '').'></td>', $forumcolumns - $columnspad);}--><!--{/if}-->
						</tr>
					</table>
				</div>
			</div>
			<!--{/if}-->
			<!--{if empty($gid) && !empty($forum_favlist)}-->
			<!--{eval $forumscount = count($forum_favlist);}-->
			<!--{eval $forumcolumns = $forumscount > 3 ? ($forumscount == 4 ? 4 : 5) : 1;}-->
			<!--{eval $forumcolwidth = (floor(100 / $forumcolumns) - 0.1).'%';}-->
			<div class="bm bmw {if $forumcolumns} flg{/if} cl">
				<div class="bm_h cl">
					<span class="o">
						<img id="category_0_img" src="{IMGDIR}/$collapse['collapseimg_0']" title="{lang spread}" alt="{lang spread}" onclick="toggle_collapse('category_0');" />
					</span>
					<h2><a href="home.php?mod=space&do=favorite&type=forum">{lang forum_myfav}</a></h2>
				</div>
				<div id="category_0" class="bm_c comiis_onebm_c" style="{echo $collapse['category_0']}">
					<table cellspacing="0" cellpadding="0" class="fl_tb">
						<tr>
						<!--{eval $favorderid = 0;}-->
						<!--{loop $forum_favlist $key $favorite}-->
						<!--{if $favforumlist[$favorite[id]]}-->
						<!--{eval $forum=$favforumlist[$favorite[id]];}-->
						<!--{eval $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];}-->
							<!--{if $forumcolumns>1}-->
								<!--{if $favorderid && ($favorderid % $forumcolumns == 0)}-->
									</tr>
									<!--{if $favorderid < $forumscount}-->
										<tr class="fl_row">
									<!--{/if}-->
								<!--{/if}-->
								<td class="fl_g"{if $forumcolwidth} width="$forumcolwidth"{/if}>
								<div class="comiis_fl_g">
									<div class="fl_icn_g"{if !empty($forum[extra][iconwidth]) && !empty($forum[icon])} style="width:80px;"{/if}>
									<!--{if $forum[icon]}-->
										$forum[icon]
									<!--{else}-->
										<a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}><img src="{IMGDIR}/forum{if $forum[folder]}_new{/if}.gif" alt="$forum[name]" /></a>
									<!--{/if}-->
									</div>
									<dl{if !empty($forum[extra][iconwidth]) && !empty($forum[icon])} style="margin-left:80px;"{/if}>
										<dt><a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}{if $forum[extra][namecolor]} style="color: {$forum[extra][namecolor]};"{/if}>$forum[name]</a><!--{if $forum[todayposts] && !$forum['redirect']}--><em class="xw0 xi1" title="{lang forum_todayposts}"> ($forum[todayposts])</em><!--{/if}--></dt>
										<!--{if empty($forum[redirect])}--><dd><em>{lang forum_threads}: <!--{echo dnumber($forum[threads])}--></em>, <em>{lang forum_posts}: <!--{echo dnumber($forum[posts])}--></em></dd><!--{/if}-->
										<dd>
										<!--{if $forum['permission'] == 1}-->
											{lang private_forum}
										<!--{else}-->
											<!--{if $forum['redirect']}-->
												<a href="$forumurl" class="xi2">{lang url_link}</a>
											<!--{elseif is_array($forum['lastpost'])}-->
												<!--{if $forumcolumns < 3}-->
													<a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost" class="xi2"><!--{echo cutstr($forum[lastpost][subject], 30)}--></a> <cite>$forum[lastpost][dateline] <!--{if $forum['lastpost']['author']}-->$forum['lastpost']['author']<!--{else}-->$_G[setting][anonymoustext]<!--{/if}--></cite>
												<!--{else}-->
													<a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost">{lang forum_lastpost}: $forum[lastpost][dateline]</a>
												<!--{/if}-->
											<!--{else}-->
												{lang never}
											<!--{/if}-->
										<!--{/if}-->
										</dd>
										<!--{hook/index_favforum_extra $forum[fid]}-->
									</dl>
								</div>
								</td>
								<!--{eval $favorderid++;}-->
							<!--{else}-->
								<td class="fl_icn" {if !empty($forum[extra][iconwidth]) && !empty($forum[icon])} style="width:80px;"{/if}>
									<!--{if $forum[icon]}-->
										$forum[icon]
									<!--{else}-->
										<a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}><img src="{IMGDIR}/forum{if $forum[folder]}_new{/if}.gif" alt="$forum[name]" /></a>
									<!--{/if}-->
								</td>
								<td>
									<h2><a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}{if $forum[extra][namecolor]} style="color: {$forum[extra][namecolor]};"{/if}>$forum[name]</a><!--{if $forum[todayposts] && !$forum['redirect']}--><em class="xw0 xi1" title="{lang forum_todayposts}"> ($forum[todayposts])</em><!--{/if}--></h2>
									<!--{if $forum[description]}--><p class="xg2">$forum[description]</p><!--{/if}-->
									<!--{if $forum['subforums']}--><p>{lang forum_subforums}: $forum['subforums']</p><!--{/if}-->
									<!--{if $forum['moderators']}--><p>{lang forum_moderators}: <span class="xi2">$forum[moderators]</span></p><!--{/if}-->
									<!--{hook/index_favforum_extra $forum[fid]}-->
								</td>
								<td class="fl_i">
									<!--{if empty($forum[redirect])}--><span class="xi2"><!--{echo dnumber($forum[threads])}--></span><span class="xg1"> / <!--{echo dnumber($forum[posts])}--></span><!--{/if}-->
								</td>
								<td class="fl_by">
									<div>
									<!--{if $forum['permission'] == 1}-->
										{lang private_forum}
									<!--{else}-->
										<!--{if $forum['redirect']}-->
											<a href="$forumurl" class="xi2">{lang url_link}</a>
										<!--{elseif is_array($forum['lastpost'])}-->
											<a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost" class="xi2"><!--{echo cutstr($forum[lastpost][subject], 30)}--></a> <cite>$forum[lastpost][dateline] <!--{if $forum['lastpost']['author']}-->$forum['lastpost']['author']<!--{else}-->$_G[setting][anonymoustext]<!--{/if}--></cite>
										<!--{else}-->
											{lang never}
										<!--{/if}-->
									<!--{/if}-->
									</div>
								</td>
							</tr>
							<tr class="fl_row">
							<!--{/if}-->
						<!--{/if}-->
						<!--{/loop}-->
						<!--{if ($columnspad = $favorderid % $forumcolumns) > 0}--><!--{echo str_repeat('<td class="fl_g"'.($forumcolwidth ? " width=\"$forumcolwidth\"" : '').'></td>', $forumcolumns - $columnspad);}--><!--{/if}-->
						</tr>
					</table>
				</div>
			</div>
			<!--{ad/intercat/bm a_c/-1}-->
		<!--{/if}-->
		<!--{loop $catlist $key $cat}-->
			<!--{hook/index_catlist $cat[fid]}-->
			<div class="bm bmw {if $cat['forumcolumns']} flg{/if} cl">
				<div class="bm_h cl">
					<span class="o">
						<img id="category_$cat[fid]_img" src="{IMGDIR}/$cat[collapseimg]" title="{lang spread}" alt="{lang spread}" onclick="toggle_collapse('category_$cat[fid]');" />
					</span>
					<!--{if $cat['moderators']}--><span class="y">{lang forum_category_modedby}: $cat[moderators]</span><!--{/if}-->
					<!--{eval $caturl = !empty($cat['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$cat['domain'].'.'.$_G['setting']['domain']['root']['forum'] : '';}-->
					<h2><a href="{if !empty($caturl)}$caturl{else}forum.php?gid=$cat[fid]{/if}" style="{if $cat[extra][namecolor]}color: {$cat[extra][namecolor]};{/if}">$cat[name]</a></h2>
				</div>
				<div id="category_$cat[fid]" class="bm_c<!--{if !$cat['forumcolumns']}--> comiis_onebm_c<!--{/if}-->" style="{echo $collapse['category_'.$cat[fid]]}">
					<table cellspacing="0" cellpadding="0" class="fl_tb">
						<tr>
						<!--{loop $cat[forums] $forumid}-->
						<!--{eval $forum=$forumlist[$forumid];}-->
						<!--{eval $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];}-->
						<!--{if $cat['forumcolumns']}-->
							<!--{if $forum['orderid'] && ($forum['orderid'] % $cat['forumcolumns'] == 0)}-->
								</tr>
								<!--{if $forum['orderid'] < $cat['forumscount']}-->
									<tr class="fl_row">
								<!--{/if}-->
							<!--{/if}-->
							<td class="fl_g" width="$cat[forumcolwidth]">
							<div class="comiis_fl_g">
								<div class="fl_icn_g"{if !empty($forum[extra][iconwidth]) && !empty($forum[icon])} style="width:80px;"{/if}>
								<!--{if $forum[icon]}-->
									$forum[icon]
								<!--{else}-->
									<a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}><img src="{IMGDIR}/forum{if $forum[folder]}_new{/if}.gif" alt="$forum[name]" /></a>
								<!--{/if}-->
								</div>
								<dl{if !empty($forum[extra][iconwidth]) && !empty($forum[icon])} style="margin-left:80px;"{/if}>
									<dt><a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}{if $forum[extra][namecolor]} style="color: {$forum[extra][namecolor]};"{/if}>$forum[name]</a><!--{if $forum[todayposts] && !$forum['redirect']}--><em class="xw0 xi1" title="{lang forum_todayposts}"> ($forum[todayposts])</em><!--{/if}--></dt>
									<!--{if empty($forum[redirect])}--><dd class="kmlineheight"><em>{lang forum_threads}: <!--{echo dnumber($forum[threads])}--></em>, <em>{lang forum_posts}: <!--{echo dnumber($forum[posts])}--></em></dd><!--{/if}-->
									<dd>
									<!--{if $forum['permission'] == 1}-->
										{lang private_forum}
									<!--{else}-->
										<!--{if $forum['redirect']}-->
											<a href="$forumurl" class="xi2">{lang url_link}</a>
										<!--{elseif is_array($forum['lastpost'])}-->
											<!--{if $cat['forumcolumns'] < 4}-->
												<a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost" class="xi2 comiis_km3ico"><!--{if $comiis_window_width==1 && $cat['forumcolumns']==3}--><!--{echo cutstr($forum[lastpost][subject], 40)}--><!--{elseif $comiis_window_width==0 && $cat['forumcolumns'] == 3}--><a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost">{lang forum_lastpost}: $forum[lastpost][dateline]</a><!--{else}--><!--{echo cutstr($forum[lastpost][subject], 70)}--><!--{/if}--></a>
											<!--{else}-->
												<a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost">{lang forum_lastpost}: $forum[lastpost][dateline]</a>
											<!--{/if}-->
										<!--{else}-->
											{lang never}
										<!--{/if}-->
									<!--{/if}-->
									</dd>
									<!--{hook/index_forum_extra $forum[fid]}-->
								</dl>
							</div>
							</td>
						<!--{else}-->
							<td class="fl_icn" {if !empty($forum[extra][iconwidth]) && !empty($forum[icon])} style="width:80px;"{/if}>
								<!--{if $forum[icon]}-->
									$forum[icon]
								<!--{else}-->
									<a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}><img src="{IMGDIR}/forum{if $forum[folder]}_new{/if}.gif" alt="$forum[name]" /></a>
								<!--{/if}-->
							</td>
							<td>
								<h2><a href="$forumurl"{if $forum[redirect]} target="_blank"{/if}{if $forum[extra][namecolor]} style="color: {$forum[extra][namecolor]};"{/if}>$forum[name]</a><!--{if $forum[todayposts] && !$forum['redirect']}--><em class="xw0 xi1" title="{lang forum_todayposts}"> ($forum[todayposts])</em><!--{/if}--></h2>
								<!--{if $forum[description]}--><p class="xg2">$forum[description]</p><!--{/if}-->
								<!--{if $forum['subforums']}--><p>{lang forum_subforums}: $forum['subforums']</p><!--{/if}-->
								<!--{if $forum['moderators']}--><p>{lang forum_moderators}: <span class="xi2">$forum[moderators]</span></p><!--{/if}-->
								<!--{hook/index_forum_extra $forum[fid]}-->
							</td>
							<td class="fl_i">
								<!--{if empty($forum[redirect])}--><span class="xi2"><!--{echo dnumber($forum[threads])}--></span><span class="xg1"> / <!--{echo dnumber($forum[posts])}--></span><!--{/if}-->
							</td>
							<td class="fl_by">
								<div>
								<!--{if $forum['permission'] == 1}-->
									{lang private_forum}
								<!--{else}-->
									<!--{if $forum['redirect']}-->
										<a href="$forumurl" class="xi2">{lang url_link}</a>
									<!--{elseif is_array($forum['lastpost'])}-->
										<a href="forum.php?mod=redirect&tid=$forum[lastpost][tid]&goto=lastpost#lastpost" class="xi2"><!--{echo cutstr($forum[lastpost][subject], 30)}--></a> <cite>$forum[lastpost][dateline] <!--{if $forum['lastpost']['author']}-->$forum['lastpost']['author']<!--{else}-->$_G[setting][anonymoustext]<!--{/if}--></cite>
									<!--{else}-->
										{lang never}
									<!--{/if}-->
								<!--{/if}-->
								</div>
							</td>
						</tr>
						<tr class="fl_row">
						<!--{/if}-->
						<!--{/loop}-->
						$cat['endrows']
						</tr>
					</table>
				</div>
			</div>
			<!--{ad/intercat/bm a_c/$cat[fid]}-->
		<!--{/loop}-->
			<!--{if !empty($collectiondata['data'])}-->
			<!--{eval $forumscount = count($collectiondata['data']);}-->
			<!--{eval $forumcolumns = 4;}-->
			<!--{eval $forumcolwidth = (floor(100 / $forumcolumns) - 0.1).'%';}-->
			<div class="bm bmw {if $forumcolumns} flg{/if} cl">
				<div class="bm_h cl">
					<span class="o">
						<img id="category_-2_img" src="{IMGDIR}/$collapse['collapseimg_-2']" title="{lang spread}" alt="{lang spread}" onclick="toggle_collapse('category_-2');" />
					</span>
					<h2><a href="forum.php?mod=collection">{lang recommend_collection}</a></h2>
				</div>
				<div id="category_-2" class="bm_c comiis_onebm_c" style="{echo $collapse['category_-2']}">
					<table cellspacing="0" cellpadding="0" class="fl_tb">
						<tr>
						<!--{eval $ctorderid = 0;}-->
						<!--{loop $collectiondata['data'] $key $colletion}-->
							<!--{if $ctorderid && ($ctorderid % $forumcolumns == 0)}-->
								</tr>
								<!--{if $ctorderid < $forumscount}-->
									<tr class="fl_row">
								<!--{/if}-->
							<!--{/if}-->
							<td class="fl_g"{if $forumcolwidth} width="$forumcolwidth"{/if}>
							<div class="comiis_fl_g">							
								<div class="fl_icn_g">
								<a href="forum.php?mod=collection&action=view&ctid={$colletion[ctid]}" target="_blank"><img src="{IMGDIR}/forum.gif" alt="$colletion[name]" /></a>
								</div>
								<dl>
									<dt><a href="forum.php?mod=collection&action=view&ctid={$colletion[ctid]}">$colletion[name]</a></dt>
									<dd><em>{lang forum_threads}: <!--{echo dnumber($colletion[threadnum])}--></em>, <em>{lang collection_commentnum}: <!--{echo dnumber($colletion[commentnum])}--></em></dd>
									<dd>
									<!--{if $colletion['lastpost']}-->
										<!--{if $forumcolumns < 3}-->
											<a href="forum.php?mod=redirect&tid=$colletion[lastpost]&goto=lastpost#lastpost" class="xi2"><!--{echo cutstr($colletion[lastsubject], 30)}--></a> <cite><!--{date($colletion[lastposttime])}--> <!--{if $colletion['lastposter']}-->$colletion['lastposter']<!--{else}-->$_G[setting][anonymoustext]<!--{/if}--></cite>
										<!--{else}-->
											<a href="forum.php?mod=redirect&tid=$colletion[lastpost]&goto=lastpost#lastpost">{lang forum_lastpost}: <!--{date($colletion[lastposttime])}--></a>
										<!--{/if}-->
									<!--{else}-->
										{lang never}
									<!--{/if}-->
									</dd>
									<!--{hook/index_datacollection_extra $colletion[ctid]}-->
								</dl>
							</div>
							</td>
							<!--{eval $ctorderid++;}-->
						<!--{/loop}-->
						<!--{if ($columnspad = $ctorderid % $forumcolumns) > 0}--><!--{echo str_repeat('<td class="fl_g"'.($forumcolwidth ? " width=\"$forumcolwidth\"" : '').'></td>', $forumcolumns - $columnspad);}--><!--{/if}-->
						</tr>
					</table>
				</div>
			</div>
			<!--{/if}-->
		</div>
		<!--{hook/index_middle}-->
		<div class="wp mtn">
			<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
		</div>
		<!--{if empty($gid) && $_G['setting']['whosonlinestatus']}-->
			<div id="online" class="bm oll">
				<div class="bm_h">
				<!--{if $detailstatus}-->
					<span class="o"><a href="forum.php?showoldetails=no#online" title="{lang spread}"><img src="{IMGDIR}/collapsed_no.gif" alt="{lang spread}" /></a></span>
					<h3>
						<strong><a href="home.php?mod=space&do=friend&view=online&type=member">{lang onlinemember}</a></strong>
						<span class="xs1">- <strong>$onlinenum</strong> {lang onlines}
						- <strong>$membercount</strong> {lang index_members}(<strong>$invisiblecount</strong> {lang index_invisibles}),
						<strong>$guestcount</strong> {lang index_guests}
						- {lang index_mostonlines} <strong>$onlineinfo[0]</strong> {lang on} <strong>$onlineinfo[1]</strong>.</span>
					</h3>
				<!--{else}-->
					<!--{if empty($_G['setting']['sessionclose'])}-->
						<span class="o"><a href="forum.php?showoldetails=yes#online" title="{lang spread}"><img src="{IMGDIR}/collapsed_yes.gif" alt="{lang spread}" /></a></span>
					<!--{/if}-->
					<h3>
						<strong>
							<!--{if !empty($_G['setting']['whosonlinestatus'])}-->
								{lang onlinemember}
							<!--{else}-->
								<a href="home.php?mod=space&do=friend&view=online&type=member">{lang onlinemember}</a>
							<!--{/if}-->
						</strong>
						<span class="xs1">- {lang total} <strong>$onlinenum</strong> {lang onlines}
						<!--{if $membercount}-->- <strong>$membercount</strong> {lang index_members},<strong>$guestcount</strong> {lang index_guests}<!--{/if}-->
						- {lang index_mostonlines} <strong>$onlineinfo[0]</strong> {lang on} <strong>$onlineinfo[1]</strong>.</span>
					</h3>
				<!--{/if}-->
				</div>
			<!--{if $_G['setting']['whosonlinestatus'] && $detailstatus}-->
				<dl id="onlinelist" class="bm_c">
					<dt class="ptm pbm bbda">$_G[cache][onlinelist][legend]</dt>
					<!--{if $detailstatus}-->
						<dd class="ptm pbm">
						<ul class="cl">
						<!--{if $whosonline}-->
							<!--{loop $whosonline $key $online}-->
								<li title="{lang time}: $online[lastactivity]">
								<img src="{STATICURL}image/common/$online[icon]" alt="icon" />
								<!--{if $online['uid']}-->
									<a href="home.php?mod=space&uid=$online[uid]">$online[username]</a>
								<!--{else}-->
									$online[username]
								<!--{/if}-->
								</li>
							<!--{/loop}-->
						<!--{else}-->
							<li style="width: auto">{lang online_only_guests}</li>
						<!--{/if}-->
						</ul>
					</dd>
					<!--{/if}-->
				</dl>
			<!--{/if}-->
			</div>
		<!--{/if}-->
		<!--{if empty($gid) && ($_G['cache']['forumlinks'][0] || $_G['cache']['forumlinks'][1] || $_G['cache']['forumlinks'][2])}-->
		<div class="bm lk">	
			<div class="bm_h cl">
				<h2>友情链接</h2>
			</div>
			<div id="category_lk" class="bm_c ptm">
				<!--{if $_G['cache']['forumlinks'][0]}-->
					<ul class="m mbn cl">$_G['cache']['forumlinks'][0]</ul>
				<!--{/if}-->
				<!--{if $_G['cache']['forumlinks'][1]}-->
					<div class="mbn cl">
						$_G['cache']['forumlinks'][1]
					</div>
				<!--{/if}-->
				<!--{if $_G['cache']['forumlinks'][2]}-->
					<ul class="x mbm cl">
						$_G['cache']['forumlinks'][2]
					</ul>
				<!--{/if}-->
			</div>
		</div>
		<!--{/if}-->
		<!--{hook/index_bottom}-->
	</div>
	<!--{if $comiis_forum_right==1}-->
		<div id="sd" class="sd comiis_main_r">
			<!--{hook/index_side_top}-->
			<div style="height:95px;overflow:hidden;">	
				<div class="comiis_irbox comiis_irftbtn cl" id="comiis_irftbtn">
					<a href="forum.php?mod=misc&action=nav" onclick="showWindow('nav', this.href, 'get', 0)" class="kmfbzt" title="发表主题"></a>
					<a href="/k_misign-sign.html" target="_blank" class="kmqd" title="签到"><script type="text/javascript">var dfsj = new Date();document.write('周'+'日一二三四五六'.charAt(new Date().getDay())+'<br>'+(dfsj.getMonth()+1)+'月'+dfsj.getDate()+'日');</script></a>
				</div>			
			</div>
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
			<!--{hook/index_side_bottom}-->
		</div>
	<!--{/if}-->
</div>
<!--{if $_G['group']['radminid'] == 1}-->
	<!--{eval helper_manyou::checkupdate();}-->
<!--{/if}-->
<!--{if empty($_G['setting']['disfixednv_forumindex']) }--><script>fixed_top_nv();</script><!--{/if}-->
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
<!--{template common/footer}-->