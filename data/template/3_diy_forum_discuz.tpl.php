<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('discuz');
0
|| checktplrefresh('data/diy/./template/comiis_nby//forum/discuz.htm', './template/comiis_nby/common/comiis_navss.htm', 1524236883, 'diy', './data/template/3_diy_forum_discuz.tpl.php', 'data/diy/./template/comiis_nby/', 'forum/discuz')
;
block_get('115,114,123,122,116,117,118,119,120,121,166');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="y">
<?php if(!empty($_G['setting']['pluginhooks']['index_nav_extra'])) echo $_G['setting']['pluginhooks']['index_nav_extra'];?>
<?php if($_G['uid']) { ?><a href="forum.php?mod=guide&amp;view=my" title="我的帖子">我的帖子</a><?php } if(!empty($_G['setting']['search']['forum']['status'])) { if($_G['uid']) { ?><span class="pipe">|</span><?php } ?><a href="forum.php?mod=guide&amp;view=new" title="最新回复">最新回复</a><?php } ?>
</div>
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a><em>&raquo;</em><a href="forum.php"><?php echo $_G['setting']['navs']['2']['navname'];?></a><?php echo $navigation;?>
</div>
<div class="z"><?php if(!empty($_G['setting']['pluginhooks']['index_status_extra'])) echo $_G['setting']['pluginhooks']['index_status_extra'];?></div>
</div>
<?php if(empty($gid)) { ?><?php echo adshow("text/wp a_t");?><?php } ?>
<style id="diy_style" type="text/css">#portal_block_118 { margin-top:5px !important;margin-right:0px !important;margin-bottom:12px !important;margin-left:0px !important;}#portal_block_115 { margin-top:14px !important;margin-right:0px !important;margin-bottom:0px !important;margin-left:14px !important;}</style>
<?php if(empty($gid)) { ?>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<?php } if(empty($gid)) { ?>
<div class="comiis_chart">
<ul class="comiis_chart_box">
<li><em><?php echo $todayposts;?></em>今日发帖数</li>
<li><em><?php echo $postdata['0'];?></em>昨日发帖数</li>
<li><em><?php echo $posts;?></em>总帖数</li>
<li<?php if(!$_G['cache']['userstats']['newsetuser']) { ?> class="norx"<?php } ?>><em><?php echo $_G['cache']['userstats']['totalmembers'];?></em>会员总数</li>
<?php if($_G['cache']['userstats']['newsetuser']) { ?><li class="norx"><em><a href="home.php?mod=space&amp;username=<?php echo rawurlencode($_G['cache']['userstats']['newsetuser']); ?>" target="_blank"><?php echo $_G['cache']['userstats']['newsetuser'];?></a></em>欢迎新会员</li><?php } ?>
</ul>
</div>
<?php } ?>
<!--[diy=diy_chart]--><div id="diy_chart" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['grid']['showgrid'])) { ?>
<!-- index four grid -->
<div class="fl bm">
<div class="bm bmw cl">
<div id="category_grid" class="bm_c" >
<table cellspacing="0" cellpadding="0"><tr>
<?php if(!$_G['setting']['grid']['gridtype']) { ?>
<td valign="top" class="category_l1">
<div class="newimgbox">
<h4><span class="tit_newimg"></span>最新图片</h4>
<div class="module cl slidebox_grid comiis_ngswfk">
<script type="text/javascript">
var slideSpeed = 5000;
<?php if($comiis_window_width!=0) { ?>
if(screen.width>1210){
var slideImgsize = [268,230];
}else{
var slideImgsize = [218,230];
}
<?php } else { ?>
var slideImgsize = [218,230];
<?php } ?>
var slideBorderColor = '<?php echo $_G['style']['specialborder'];?>';
var slideBgColor = '<?php echo $_G['style']['commonbg'];?>';
var slideImgs = new Array();
var slideImgLinks = new Array();
var slideImgTexts = new Array();
var slideSwitchColor = '<?php echo $_G['style']['tabletext'];?>';
var slideSwitchbgColor = '<?php echo $_G['style']['commonbg'];?>';
var slideSwitchHiColor = '<?php echo $_G['style']['specialborder'];?>';<?php $k = 1;?><?php if(is_array($grids['slide'])) foreach($grids['slide'] as $stid => $svalue) { ?>slideImgs[<?php echo $k; ?>] = '<?php echo $svalue['image'];?>';
slideImgLinks[<?php echo $k; ?>] = '<?php echo $svalue['url'];?>';
slideImgTexts[<?php echo $k; ?>] = '<?php echo $svalue['subject'];?>';<?php $k++;?><?php } ?>
</script>
<script src="<?php echo $_G['setting']['jspath'];?>forum_slide.js?<?php echo VERHASH;?>" type="text/javascript"></script>
</div>
</div>
</td>
<?php } ?>
<td valign="top" class="category_l2">
<div class="subjectbox">
<h4><span class="tit_subject"></span>最新主题</h4>
<ul class="category_newlist"><?php if(is_array($grids['newthread'])) foreach($grids['newthread'] as $thread) { if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread[tid]=$thread[closed];?><?php } ?>
<li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>"<?php if($thread['highlight']) { ?> <?php echo $thread['highlight'];?><?php } if($_G['setting']['grid']['showtips']) { ?> tip="标题: <strong><?php echo $thread['oldsubject'];?></strong><br/>作者: <?php echo $thread['author'];?> (<?php echo $thread['dateline'];?>)<br/>查看/回复: <?php echo $thread['views'];?>/<?php echo $thread['replies'];?>" onmouseover="showTip(this)"<?php } else { ?> title="<?php echo $thread['oldsubject'];?>"<?php } if($_G['setting']['grid']['targetblank']) { ?> target="_blank"<?php } ?>><?php echo $thread['subject'];?></a></li>
<?php } ?>
 </ul>
 </div>
</td>
<td valign="top" class="category_l3">
<div class="replaybox">
<h4><span class="tit_replay"></span>最新回复</h4>
<ul class="category_newlist"><?php if(is_array($grids['newreply'])) foreach($grids['newreply'] as $thread) { if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread[tid]=$thread[closed];?><?php } ?>
<li><a href="forum.php?mod=redirect&amp;tid=<?php echo $thread['tid'];?>&amp;goto=lastpost#lastpost"<?php if($thread['highlight']) { ?> <?php echo $thread['highlight'];?><?php } if($_G['setting']['grid']['showtips']) { ?>tip="标题: <strong><?php echo $thread['oldsubject'];?></strong><br/>作者: <?php echo $thread['author'];?> (<?php echo $thread['dateline'];?>)<br/>查看/回复: <?php echo $thread['views'];?>/<?php echo $thread['replies'];?>" onmouseover="showTip(this)"<?php } else { ?> title="<?php echo $thread['oldsubject'];?>"<?php } if($_G['setting']['grid']['targetblank']) { ?> target="_blank"<?php } ?>><?php echo $thread['subject'];?></a></li>
<?php } ?>
 </ul>
 </div>
</td>
<td valign="top" class="category_l3">
<div class="hottiebox">
<h4><span class="tit_hottie"></span>热帖</h4>
<ul class="category_newlist"><?php if(is_array($grids['hot'])) foreach($grids['hot'] as $thread) { if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread[tid]=$thread[closed];?><?php } ?>
<li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>"<?php if($thread['highlight']) { ?> <?php echo $thread['highlight'];?><?php } if($_G['setting']['grid']['showtips']) { ?> tip="标题: <strong><?php echo $thread['oldsubject'];?></strong><br/>作者: <?php echo $thread['author'];?> (<?php echo $thread['dateline'];?>)<br/>查看/回复: <?php echo $thread['views'];?>/<?php echo $thread['replies'];?>" onmouseover="showTip(this)"<?php } else { ?> title="<?php echo $thread['oldsubject'];?>"<?php } if($_G['setting']['grid']['targetblank']) { ?> target="_blank"<?php } ?>><?php echo $thread['subject'];?></a></li>
<?php } ?>
 </ul>
 </div>
</td>
<?php if($_G['setting']['grid']['gridtype']) { ?>
<td valign="top" class="category_l4">
<div class="goodtiebox">
<h4><span class="tit_goodtie"></span>精华帖子</h4>
<ul class="category_newlist"><?php if(is_array($grids['digest'])) foreach($grids['digest'] as $thread) { if(!$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])) { $thread[tid]=$thread[closed];?><?php } ?>
<li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>"<?php if($thread['highlight']) { ?> <?php echo $thread['highlight'];?><?php } if($_G['setting']['grid']['showtips']) { ?> tip="标题: <strong><?php echo $thread['oldsubject'];?></strong><br/>作者: <?php echo $thread['author'];?> (<?php echo $thread['dateline'];?>)<br/>查看/回复: <?php echo $thread['views'];?>/<?php echo $thread['replies'];?>" onmouseover="showTip(this)"<?php } else { ?> title="<?php echo $thread['oldsubject'];?>"<?php } if($_G['setting']['grid']['targetblank']) { ?> target="_blank"<?php } ?>><?php echo $thread['subject'];?></a></li>
<?php } ?>
 </ul>
</div>
</td>
<?php } ?>
</table>
</div>
</div>
</div>
<!-- index four grid end -->
<?php } ?>
<!--[diy=diy_chartkm]--><div id="diy_chartkm" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['index_top'])) echo $_G['setting']['pluginhooks']['index_top'];?>
<div id="ct" class="wp cl<?php if($comiis_forum_right==1) { ?> ct2<?php } ?>">
<div class="mn comiis_rollzbox ityp">
<?php if(empty($gid) && $announcements) { ?>
<!--[diy=comiis_andiy]--><div id="comiis_andiy" class="area"></div><!--[/diy]-->
<div id="pt" class="bm cl comiis_an">	
<div id="an">
<dl class="cl">
<dt class="z xw1">社区公告:</dt>
<dd>
<div id="anc"><ul id="ancl"><?php echo $announcements;?></ul></div>
</dd>
</dl>
</div>
<script type="text/javascript">announcement();</script>	
</div>
<div style="clear:both;"></div>
<?php } if(!empty($_G['cache']['heats']['message'])) { ?>
<div class="bm">
<div class="bm_h cl">
<h2><?php echo $_G['setting']['navs']['2']['navname'];?>热点</h2>
</div>
<div class="bm_c cl">
<div class="heat z"><?php if(is_array($_G['cache']['heats']['message'])) foreach($_G['cache']['heats']['message'] as $data) { ?><dl class="xld">
<dt><?php if($_G['adminid'] == 1) { ?><a class="d" href="forum.php?mod=misc&amp;action=removeindexheats&amp;tid=<?php echo $data['tid'];?>" onclick="return removeindexheats()">delete</a><?php } ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $data['tid'];?>" target="_blank" class="xi2"><?php echo $data['subject'];?></a></dt>
<dd><?php echo $data['message'];?></dd>
</dl>
<?php } ?>
</div>
<ul class="xl xl1 heatl"><?php if(is_array($_G['cache']['heats']['subject'])) foreach($_G['cache']['heats']['subject'] as $data) { ?><li><?php if($_G['adminid'] == 1) { ?><a class="d" href="forum.php?mod=misc&amp;action=removeindexheats&amp;tid=<?php echo $data['tid'];?>" onclick="return removeindexheats()">delete</a><?php } ?>&middot; <a href="forum.php?mod=viewthread&amp;tid=<?php echo $data['tid'];?>" target="_blank" class="xi2"><?php echo $data['subject'];?></a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_catlist_top'])) echo $_G['setting']['pluginhooks']['index_catlist_top'];?>
<div class="fl bm">
<?php if(!empty($collectiondata['follows'])) { $forumscount = count($collectiondata['follows']);?><?php $forumcolumns = 4;?><?php $forumcolwidth = (floor(100 / $forumcolumns) - 0.1).'%';?><div class="bm bmw <?php if($forumcolumns) { ?> flg<?php } ?> cl">
<div class="bm_h cl">
<span class="o">
<img id="category_-1_img" src="<?php echo IMGDIR;?>/<?php echo $collapse['collapseimg_-1'];?>" title="收起/展开" alt="收起/展开" onclick="toggle_collapse('category_-1');" />
</span>
<h2><a href="forum.php?mod=collection&amp;op=my">我订阅的专辑</a></h2>
</div>
<div id="category_-1" class="bm_c comiis_onebm_c" style="<?php echo $collapse['category_-1']; ?>">
<table cellspacing="0" cellpadding="0" class="fl_tb">
<tr><?php $ctorderid = 0;?><?php if(is_array($collectiondata['follows'])) foreach($collectiondata['follows'] as $key => $colletion) { if($ctorderid && ($ctorderid % $forumcolumns == 0)) { ?>
</tr>
<?php if($ctorderid < $forumscount) { ?>
<tr class="fl_row">
<?php } } ?>
<td class="fl_g"<?php if($forumcolwidth) { ?> width="<?php echo $forumcolwidth;?>"<?php } ?>>
<div class="comiis_fl_g">
<div class="fl_icn_g">
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $colletion['ctid'];?>" target="_blank"><img src="<?php echo IMGDIR;?>/forum<?php if($followcollections[$key]['lastvisit'] < $colletion['lastupdate']) { ?>_new<?php } ?>.gif" alt="<?php echo $colletion['name'];?>" /></a>
</div>
<dl>
<dt><a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $colletion['ctid'];?>"><?php echo $colletion['name'];?></a></dt>
<dd><em>主题: <?php echo dnumber($colletion['threadnum']); ?></em>, <em>评论: <?php echo dnumber($colletion['commentnum']); ?></em></dd>
<dd>
<?php if($colletion['lastpost']) { if($forumcolumns < 3) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $colletion['lastpost'];?>&amp;goto=lastpost#lastpost" class="xi2"><?php echo cutstr($colletion['lastsubject'], 30); ?></a> <cite><?php echo dgmdate($colletion[lastposttime]);?> <?php if($colletion['lastposter']) { ?><?php echo $colletion['lastposter'];?><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } ?></cite>
<?php } else { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $colletion['lastpost'];?>&amp;goto=lastpost#lastpost">最后发表: <?php echo dgmdate($colletion[lastposttime]);?></a>
<?php } } else { ?>
从未
<?php } ?>
</dd>
<?php if(!empty($_G['setting']['pluginhooks']['index_followcollection_extra'][$colletion[ctid]])) echo $_G['setting']['pluginhooks']['index_followcollection_extra'][$colletion[ctid]];?>
</dl>
</div>
</td><?php $ctorderid++;?><?php } if(($columnspad = $ctorderid % $forumcolumns) > 0) { echo str_repeat('<td class="fl_g"'.($forumcolwidth ? " width=\"$forumcolwidth\"" : '').'></td>', $forumcolumns - $columnspad);; } ?>
</tr>
</table>
</div>
</div>
<?php } if(empty($gid) && !empty($forum_favlist)) { $forumscount = count($forum_favlist);?><?php $forumcolumns = $forumscount > 3 ? ($forumscount == 4 ? 4 : 5) : 1;?><?php $forumcolwidth = (floor(100 / $forumcolumns) - 0.1).'%';?><div class="bm bmw <?php if($forumcolumns) { ?> flg<?php } ?> cl">
<div class="bm_h cl">
<span class="o">
<img id="category_0_img" src="<?php echo IMGDIR;?>/<?php echo $collapse['collapseimg_0'];?>" title="收起/展开" alt="收起/展开" onclick="toggle_collapse('category_0');" />
</span>
<h2><a href="home.php?mod=space&amp;do=favorite&amp;type=forum">我收藏的版块</a></h2>
</div>
<div id="category_0" class="bm_c comiis_onebm_c" style="<?php echo $collapse['category_0']; ?>">
<table cellspacing="0" cellpadding="0" class="fl_tb">
<tr><?php $favorderid = 0;?><?php if(is_array($forum_favlist)) foreach($forum_favlist as $key => $favorite) { if($favforumlist[$favorite['id']]) { $forum=$favforumlist[$favorite[id]];?><?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];?><?php if($forumcolumns>1) { if($favorderid && ($favorderid % $forumcolumns == 0)) { ?>
</tr>
<?php if($favorderid < $forumscount) { ?>
<tr class="fl_row">
<?php } } ?>
<td class="fl_g"<?php if($forumcolwidth) { ?> width="<?php echo $forumcolwidth;?>"<?php } ?>>
<div class="comiis_fl_g">
<div class="fl_icn_g"<?php if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="width:80px;"<?php } ?>>
<?php if($forum['icon']) { ?>
<?php echo $forum['icon'];?>
<?php } else { ?>
<a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } ?>><img src="<?php echo IMGDIR;?>/forum<?php if($forum['folder']) { ?>_new<?php } ?>.gif" alt="<?php echo $forum['name'];?>" /></a>
<?php } ?>
</div>
<dl<?php if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="margin-left:80px;"<?php } ?>>
<dt><a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } if($forum['extra']['namecolor']) { ?> style="color: <?php echo $forum['extra']['namecolor'];?>;"<?php } ?>><?php echo $forum['name'];?></a><?php if($forum['todayposts'] && !$forum['redirect']) { ?><em class="xw0 xi1" title="今日"> (<?php echo $forum['todayposts'];?>)</em><?php } ?></dt>
<?php if(empty($forum['redirect'])) { ?><dd><em>主题: <?php echo dnumber($forum['threads']); ?></em>, <em>帖数: <?php echo dnumber($forum['posts']); ?></em></dd><?php } ?>
<dd>
<?php if($forum['permission'] == 1) { ?>
私密版块
<?php } else { if($forum['redirect']) { ?>
<a href="<?php echo $forumurl;?>" class="xi2">链接到外部地址</a>
<?php } elseif(is_array($forum['lastpost'])) { if($forumcolumns < 3) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $forum['lastpost']['tid'];?>&amp;goto=lastpost#lastpost" class="xi2"><?php echo cutstr($forum['lastpost']['subject'], 30); ?></a> <cite><?php echo $forum['lastpost']['dateline'];?> <?php if($forum['lastpost']['author']) { ?><?php echo $forum['lastpost']['author'];?><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } ?></cite>
<?php } else { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $forum['lastpost']['tid'];?>&amp;goto=lastpost#lastpost">最后发表: <?php echo $forum['lastpost']['dateline'];?></a>
<?php } } else { ?>
从未
<?php } } ?>
</dd>
<?php if(!empty($_G['setting']['pluginhooks']['index_favforum_extra'][$forum[fid]])) echo $_G['setting']['pluginhooks']['index_favforum_extra'][$forum[fid]];?>
</dl>
</div>
</td><?php $favorderid++;?><?php } else { ?>
<td class="fl_icn" <?php if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="width:80px;"<?php } ?>>
<?php if($forum['icon']) { ?>
<?php echo $forum['icon'];?>
<?php } else { ?>
<a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } ?>><img src="<?php echo IMGDIR;?>/forum<?php if($forum['folder']) { ?>_new<?php } ?>.gif" alt="<?php echo $forum['name'];?>" /></a>
<?php } ?>
</td>
<td>
<h2><a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } if($forum['extra']['namecolor']) { ?> style="color: <?php echo $forum['extra']['namecolor'];?>;"<?php } ?>><?php echo $forum['name'];?></a><?php if($forum['todayposts'] && !$forum['redirect']) { ?><em class="xw0 xi1" title="今日"> (<?php echo $forum['todayposts'];?>)</em><?php } ?></h2>
<?php if($forum['description']) { ?><p class="xg2"><?php echo $forum['description'];?></p><?php } if($forum['subforums']) { ?><p>子版块: <?php echo $forum['subforums'];?></p><?php } if($forum['moderators']) { ?><p>版主: <span class="xi2"><?php echo $forum['moderators'];?></span></p><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_favforum_extra'][$forum[fid]])) echo $_G['setting']['pluginhooks']['index_favforum_extra'][$forum[fid]];?>
</td>
<td class="fl_i">
<?php if(empty($forum['redirect'])) { ?><span class="xi2"><?php echo dnumber($forum['threads']); ?></span><span class="xg1"> / <?php echo dnumber($forum['posts']); ?></span><?php } ?>
</td>
<td class="fl_by">
<div>
<?php if($forum['permission'] == 1) { ?>
私密版块
<?php } else { if($forum['redirect']) { ?>
<a href="<?php echo $forumurl;?>" class="xi2">链接到外部地址</a>
<?php } elseif(is_array($forum['lastpost'])) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $forum['lastpost']['tid'];?>&amp;goto=lastpost#lastpost" class="xi2"><?php echo cutstr($forum['lastpost']['subject'], 30); ?></a> <cite><?php echo $forum['lastpost']['dateline'];?> <?php if($forum['lastpost']['author']) { ?><?php echo $forum['lastpost']['author'];?><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } ?></cite>
<?php } else { ?>
从未
<?php } } ?>
</div>
</td>
</tr>
<tr class="fl_row">
<?php } } } if(($columnspad = $favorderid % $forumcolumns) > 0) { echo str_repeat('<td class="fl_g"'.($forumcolwidth ? " width=\"$forumcolwidth\"" : '').'></td>', $forumcolumns - $columnspad);; } ?>
</tr>
</table>
</div>
</div><?php echo adshow("intercat/bm a_c/-1");?><?php } if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><?php if(!empty($_G['setting']['pluginhooks']['index_catlist'][$cat[fid]])) echo $_G['setting']['pluginhooks']['index_catlist'][$cat[fid]];?>
<div class="bm bmw <?php if($cat['forumcolumns']) { ?> flg<?php } ?> cl">
<div class="bm_h cl">
<span class="o">
<img id="category_<?php echo $cat['fid'];?>_img" src="<?php echo IMGDIR;?>/<?php echo $cat['collapseimg'];?>" title="收起/展开" alt="收起/展开" onclick="toggle_collapse('category_<?php echo $cat['fid'];?>');" />
</span>
<?php if($cat['moderators']) { ?><span class="y">分区版主: <?php echo $cat['moderators'];?></span><?php } $caturl = !empty($cat['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$cat['domain'].'.'.$_G['setting']['domain']['root']['forum'] : '';?><h2><a href="<?php if(!empty($caturl)) { ?><?php echo $caturl;?><?php } else { ?>forum.php?gid=<?php echo $cat['fid'];?><?php } ?>" style="<?php if($cat['extra']['namecolor']) { ?>color: <?php echo $cat['extra']['namecolor'];?>;<?php } ?>"><?php echo $cat['name'];?></a></h2>
</div>
<div id="category_<?php echo $cat['fid'];?>" class="bm_c<?php if(!$cat['forumcolumns']) { ?> comiis_onebm_c<?php } ?>" style="<?php echo $collapse['category_'.$cat['fid']]; ?>">
<table cellspacing="0" cellpadding="0" class="fl_tb">
<tr><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { $forum=$forumlist[$forumid];?><?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];?><?php if($cat['forumcolumns']) { if($forum['orderid'] && ($forum['orderid'] % $cat['forumcolumns'] == 0)) { ?>
</tr>
<?php if($forum['orderid'] < $cat['forumscount']) { ?>
<tr class="fl_row">
<?php } } ?>
<td class="fl_g" width="<?php echo $cat['forumcolwidth'];?>">
<div class="comiis_fl_g">
<div class="fl_icn_g"<?php if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="width:80px;"<?php } ?>>
<?php if($forum['icon']) { ?>
<?php echo $forum['icon'];?>
<?php } else { ?>
<a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } ?>><img src="<?php echo IMGDIR;?>/forum<?php if($forum['folder']) { ?>_new<?php } ?>.gif" alt="<?php echo $forum['name'];?>" /></a>
<?php } ?>
</div>
<dl<?php if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="margin-left:80px;"<?php } ?>>
<dt><a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } if($forum['extra']['namecolor']) { ?> style="color: <?php echo $forum['extra']['namecolor'];?>;"<?php } ?>><?php echo $forum['name'];?></a><?php if($forum['todayposts'] && !$forum['redirect']) { ?><em class="xw0 xi1" title="今日"> (<?php echo $forum['todayposts'];?>)</em><?php } ?></dt>
<?php if(empty($forum['redirect'])) { ?><dd class="kmlineheight"><em>主题: <?php echo dnumber($forum['threads']); ?></em>, <em>帖数: <?php echo dnumber($forum['posts']); ?></em></dd><?php } ?>
<dd>
<?php if($forum['permission'] == 1) { ?>
私密版块
<?php } else { if($forum['redirect']) { ?>
<a href="<?php echo $forumurl;?>" class="xi2">链接到外部地址</a>
<?php } elseif(is_array($forum['lastpost'])) { if($cat['forumcolumns'] < 4) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $forum['lastpost']['tid'];?>&amp;goto=lastpost#lastpost" class="xi2 comiis_km3ico"><?php if($comiis_window_width==1 && $cat['forumcolumns']==3) { echo cutstr($forum['lastpost']['subject'], 40); } elseif($comiis_window_width==0 && $cat['forumcolumns'] == 3) { ?><a href="forum.php?mod=redirect&amp;tid=<?php echo $forum['lastpost']['tid'];?>&amp;goto=lastpost#lastpost">最后发表: <?php echo $forum['lastpost']['dateline'];?></a><?php } else { echo cutstr($forum['lastpost']['subject'], 70); } ?></a>
<?php } else { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $forum['lastpost']['tid'];?>&amp;goto=lastpost#lastpost">最后发表: <?php echo $forum['lastpost']['dateline'];?></a>
<?php } } else { ?>
从未
<?php } } ?>
</dd>
<?php if(!empty($_G['setting']['pluginhooks']['index_forum_extra'][$forum[fid]])) echo $_G['setting']['pluginhooks']['index_forum_extra'][$forum[fid]];?>
</dl>
</div>
</td>
<?php } else { ?>
<td class="fl_icn" <?php if(!empty($forum['extra']['iconwidth']) && !empty($forum['icon'])) { ?> style="width:80px;"<?php } ?>>
<?php if($forum['icon']) { ?>
<?php echo $forum['icon'];?>
<?php } else { ?>
<a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } ?>><img src="<?php echo IMGDIR;?>/forum<?php if($forum['folder']) { ?>_new<?php } ?>.gif" alt="<?php echo $forum['name'];?>" /></a>
<?php } ?>
</td>
<td>
<h2><a href="<?php echo $forumurl;?>"<?php if($forum['redirect']) { ?> target="_blank"<?php } if($forum['extra']['namecolor']) { ?> style="color: <?php echo $forum['extra']['namecolor'];?>;"<?php } ?>><?php echo $forum['name'];?></a><?php if($forum['todayposts'] && !$forum['redirect']) { ?><em class="xw0 xi1" title="今日"> (<?php echo $forum['todayposts'];?>)</em><?php } ?></h2>
<?php if($forum['description']) { ?><p class="xg2"><?php echo $forum['description'];?></p><?php } if($forum['subforums']) { ?><p>子版块: <?php echo $forum['subforums'];?></p><?php } if($forum['moderators']) { ?><p>版主: <span class="xi2"><?php echo $forum['moderators'];?></span></p><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_forum_extra'][$forum[fid]])) echo $_G['setting']['pluginhooks']['index_forum_extra'][$forum[fid]];?>
</td>
<td class="fl_i">
<?php if(empty($forum['redirect'])) { ?><span class="xi2"><?php echo dnumber($forum['threads']); ?></span><span class="xg1"> / <?php echo dnumber($forum['posts']); ?></span><?php } ?>
</td>
<td class="fl_by">
<div>
<?php if($forum['permission'] == 1) { ?>
私密版块
<?php } else { if($forum['redirect']) { ?>
<a href="<?php echo $forumurl;?>" class="xi2">链接到外部地址</a>
<?php } elseif(is_array($forum['lastpost'])) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $forum['lastpost']['tid'];?>&amp;goto=lastpost#lastpost" class="xi2"><?php echo cutstr($forum['lastpost']['subject'], 30); ?></a> <cite><?php echo $forum['lastpost']['dateline'];?> <?php if($forum['lastpost']['author']) { ?><?php echo $forum['lastpost']['author'];?><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } ?></cite>
<?php } else { ?>
从未
<?php } } ?>
</div>
</td>
</tr>
<tr class="fl_row">
<?php } } ?>
<?php echo $cat['endrows'];?>
</tr>
</table>
</div>
</div><?php echo adshow("intercat/bm a_c/$cat[fid]");?><?php } if(!empty($collectiondata['data'])) { $forumscount = count($collectiondata['data']);?><?php $forumcolumns = 4;?><?php $forumcolwidth = (floor(100 / $forumcolumns) - 0.1).'%';?><div class="bm bmw <?php if($forumcolumns) { ?> flg<?php } ?> cl">
<div class="bm_h cl">
<span class="o">
<img id="category_-2_img" src="<?php echo IMGDIR;?>/<?php echo $collapse['collapseimg_-2'];?>" title="收起/展开" alt="收起/展开" onclick="toggle_collapse('category_-2');" />
</span>
<h2><a href="forum.php?mod=collection">淘专辑推荐</a></h2>
</div>
<div id="category_-2" class="bm_c comiis_onebm_c" style="<?php echo $collapse['category_-2']; ?>">
<table cellspacing="0" cellpadding="0" class="fl_tb">
<tr><?php $ctorderid = 0;?><?php if(is_array($collectiondata['data'])) foreach($collectiondata['data'] as $key => $colletion) { if($ctorderid && ($ctorderid % $forumcolumns == 0)) { ?>
</tr>
<?php if($ctorderid < $forumscount) { ?>
<tr class="fl_row">
<?php } } ?>
<td class="fl_g"<?php if($forumcolwidth) { ?> width="<?php echo $forumcolwidth;?>"<?php } ?>>
<div class="comiis_fl_g">							
<div class="fl_icn_g">
<a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $colletion['ctid'];?>" target="_blank"><img src="<?php echo IMGDIR;?>/forum.gif" alt="<?php echo $colletion['name'];?>" /></a>
</div>
<dl>
<dt><a href="forum.php?mod=collection&amp;action=view&amp;ctid=<?php echo $colletion['ctid'];?>"><?php echo $colletion['name'];?></a></dt>
<dd><em>主题: <?php echo dnumber($colletion['threadnum']); ?></em>, <em>评论: <?php echo dnumber($colletion['commentnum']); ?></em></dd>
<dd>
<?php if($colletion['lastpost']) { if($forumcolumns < 3) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $colletion['lastpost'];?>&amp;goto=lastpost#lastpost" class="xi2"><?php echo cutstr($colletion['lastsubject'], 30); ?></a> <cite><?php echo dgmdate($colletion[lastposttime]);?> <?php if($colletion['lastposter']) { ?><?php echo $colletion['lastposter'];?><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } ?></cite>
<?php } else { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $colletion['lastpost'];?>&amp;goto=lastpost#lastpost">最后发表: <?php echo dgmdate($colletion[lastposttime]);?></a>
<?php } } else { ?>
从未
<?php } ?>
</dd>
<?php if(!empty($_G['setting']['pluginhooks']['index_datacollection_extra'][$colletion[ctid]])) echo $_G['setting']['pluginhooks']['index_datacollection_extra'][$colletion[ctid]];?>
</dl>
</div>
</td><?php $ctorderid++;?><?php } if(($columnspad = $ctorderid % $forumcolumns) > 0) { echo str_repeat('<td class="fl_g"'.($forumcolwidth ? " width=\"$forumcolwidth\"" : '').'></td>', $forumcolumns - $columnspad);; } ?>
</tr>
</table>
</div>
</div>
<?php } ?>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['index_middle'])) echo $_G['setting']['pluginhooks']['index_middle'];?>
<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<?php if(empty($gid) && $_G['setting']['whosonlinestatus']) { ?>
<div id="online" class="bm oll">
<div class="bm_h">
<?php if($detailstatus) { ?>
<span class="o"><a href="forum.php?showoldetails=no#online" title="收起/展开"><img src="<?php echo IMGDIR;?>/collapsed_no.gif" alt="收起/展开" /></a></span>
<h3>
<strong><a href="home.php?mod=space&amp;do=friend&amp;view=online&amp;type=member">在线会员</a></strong>
<span class="xs1">- <strong><?php echo $onlinenum;?></strong> 人在线
- <strong><?php echo $membercount;?></strong> 会员(<strong><?php echo $invisiblecount;?></strong> 隐身),
<strong><?php echo $guestcount;?></strong> 位游客
- 最高记录是 <strong><?php echo $onlineinfo['0'];?></strong> 于 <strong><?php echo $onlineinfo['1'];?></strong>.</span>
</h3>
<?php } else { if(empty($_G['setting']['sessionclose'])) { ?>
<span class="o"><a href="forum.php?showoldetails=yes#online" title="收起/展开"><img src="<?php echo IMGDIR;?>/collapsed_yes.gif" alt="收起/展开" /></a></span>
<?php } ?>
<h3>
<strong>
<?php if(!empty($_G['setting']['whosonlinestatus'])) { ?>
在线会员
<?php } else { ?>
<a href="home.php?mod=space&amp;do=friend&amp;view=online&amp;type=member">在线会员</a>
<?php } ?>
</strong>
<span class="xs1">- 总计 <strong><?php echo $onlinenum;?></strong> 人在线
<?php if($membercount) { ?>- <strong><?php echo $membercount;?></strong> 会员,<strong><?php echo $guestcount;?></strong> 位游客<?php } ?>
- 最高记录是 <strong><?php echo $onlineinfo['0'];?></strong> 于 <strong><?php echo $onlineinfo['1'];?></strong>.</span>
</h3>
<?php } ?>
</div>
<?php if($_G['setting']['whosonlinestatus'] && $detailstatus) { ?>
<dl id="onlinelist" class="bm_c">
<dt class="ptm pbm bbda"><?php echo $_G['cache']['onlinelist']['legend'];?></dt>
<?php if($detailstatus) { ?>
<dd class="ptm pbm">
<ul class="cl">
<?php if($whosonline) { if(is_array($whosonline)) foreach($whosonline as $key => $online) { ?><li title="时间: <?php echo $online['lastactivity'];?>">
<img src="<?php echo STATICURL;?>image/common/<?php echo $online['icon'];?>" alt="icon" />
<?php if($online['uid']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $online['uid'];?>"><?php echo $online['username'];?></a>
<?php } else { ?>
<?php echo $online['username'];?>
<?php } ?>
</li>
<?php } } else { ?>
<li style="width: auto">当前只有游客或隐身会员在线</li>
<?php } ?>
</ul>
</dd>
<?php } ?>
</dl>
<?php } ?>
</div>
<?php } if(empty($gid) && ($_G['cache']['forumlinks']['0'] || $_G['cache']['forumlinks']['1'] || $_G['cache']['forumlinks']['2'])) { ?>
<div class="bm lk">	
<div class="bm_h cl">
<h2>友情链接</h2>
</div>
<div id="category_lk" class="bm_c ptm">
<?php if($_G['cache']['forumlinks']['0']) { ?>
<ul class="m mbn cl"><?php echo $_G['cache']['forumlinks']['0'];?></ul>
<?php } if($_G['cache']['forumlinks']['1']) { ?>
<div class="mbn cl">
<?php echo $_G['cache']['forumlinks']['1'];?>
</div>
<?php } if($_G['cache']['forumlinks']['2']) { ?>
<ul class="x mbm cl">
<?php echo $_G['cache']['forumlinks']['2'];?>
</ul>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['index_bottom'])) echo $_G['setting']['pluginhooks']['index_bottom'];?>
</div>
<?php if($comiis_forum_right==1) { ?>
<div id="sd" class="sd comiis_main_r">
<?php if(!empty($_G['setting']['pluginhooks']['index_side_top'])) echo $_G['setting']['pluginhooks']['index_side_top'];?>
<div style="height:95px;overflow:hidden;">	
<div class="comiis_irbox comiis_irftbtn cl" id="comiis_irftbtn">
<a href="forum.php?mod=misc&amp;action=nav" onclick="showWindow('nav', this.href, 'get', 0)" class="kmfbzt" title="发表主题"></a>
<a href="/k_misign-sign.html" target="_blank" class="kmqd" title="签到"><script type="text/javascript">var dfsj = new Date();document.write('周'+'日一二三四五六'.charAt(new Date().getDay())+'<br>'+(dfsj.getMonth()+1)+'月'+dfsj.getDate()+'日');</script></a>
</div>			
</div>
<!--[diy=comiis_irbox_diy01]--><div id="comiis_irbox_diy01" class="area"></div><!--[/diy]-->
<div class="comiis_irbox comiis_irbox_ss cl">
<!--[diy=comiis_irbox_video]--><div id="comiis_irbox_video" class="area"><div id="frameS1w515" class="cl_frame_bm frame move-span cl frame-1"><div id="frameS1w515_left" class="column frame-1-c"><div id="frameS1w515_left_temp" class="move-span temp"></div><?php block_display('115');?></div></div></div><!--[/diy]-->
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
<!--[diy=comiis_irbox_02]--><div id="comiis_irbox_02" class="area"><div id="framezeUUyJ" class="cl_frame_bm frame move-span cl frame-1"><div id="framezeUUyJ_left" class="column frame-1-c"><div id="framezeUUyJ_left_temp" class="move-span temp"></div><?php block_display('114');?></div></div></div><!--[/diy]-->
</div>
<div id="comiis_bkbox_tab1_c_2" class="comiis_bkbox_list cl" style="display:none">
<!--[diy=comiis_irbox_03]--><div id="comiis_irbox_03" class="area"><div id="frameW1x9pN" class="cl_frame_bm frame move-span cl frame-1"><div id="frameW1x9pN_left" class="column frame-1-c"><div id="frameW1x9pN_left_temp" class="move-span temp"></div><?php block_display('123');?></div></div></div><!--[/diy]-->
</div>	
</div>
<!--[diy=comiis_irbox_nby07]--><div id="comiis_irbox_nby07" class="area"></div><!--[/diy]-->
<div class="comiis_irbox cl">
<div class="comiis_irbox_tit cl" id="comiis_keys">
<h2>图文热点</h2>
</div>
<div class="comiis_irbox_jctj cl">
<!--[diy=comiis_irbox_nbyjctj]--><div id="comiis_irbox_nbyjctj" class="area"><div id="framej7V6Ky" class="cl_frame_bm frame move-span cl frame-1"><div id="framej7V6Ky_left" class="column frame-1-c"><div id="framej7V6Ky_left_temp" class="move-span temp"></div><?php block_display('122');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_nby00]--><div id="comiis_irbox_nby00" class="area"></div><!--[/diy]-->
</div>		
<!--[diy=comiis_irbox_diy03]--><div id="comiis_irbox_diy03" class="area"></div><!--[/diy]-->
<div class="comiis_irbox">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span><h2>精华推荐</h2>
</div>
<div class="comiis_irbox_list cl">
<!--[diy=comiis_irbox_04]--><div id="comiis_irbox_04" class="area"><div id="frameygpKPp" class="cl_frame_bm frame move-span cl frame-1"><div id="frameygpKPp_left" class="column frame-1-c"><div id="frameygpKPp_left_temp" class="move-span temp"></div><?php block_display('116');?></div></div></div><!--[/diy]-->
</div>
</div>
<!--[diy=comiis_irbox_diy08]--><div id="comiis_irbox_diy08" class="area"></div><!--[/diy]-->
<div class="comiis_irbox">
<div class="comiis_irbox_tit cl">
<span><a href="misc.php?mod=ranklist&amp;type=member" target="_blank">更多</a></span><h2>社区学堂</h2>
</div>
<div class="comiis_irbox_user cl">
<!--[diy=comiis_irbox_08]--><div id="comiis_irbox_08" class="area"><div id="framejJDdpp" class="cl_frame_bm frame move-span cl frame-1"><div id="framejJDdpp_left" class="column frame-1-c"><div id="framejJDdpp_left_temp" class="move-span temp"></div><?php block_display('117');?><?php block_display('118');?></div></div></div><!--[/diy]-->
</div>
</div>
<!--[diy=comiis_irbox_diy09]--><div id="comiis_irbox_diy09" class="area"></div><!--[/diy]-->
<div class="comiis_irbox" style="margin-bottom:0;">
<div class="comiis_irbox_tit cl">
<span><a href="#" target="_blank">更多</a></span><h2>客服中心</h2>
</div>
<div class="comiis_irbox_tel cl">
<!--[diy=comiis_irbox_tel]--><div id="comiis_irbox_tel" class="area"><div id="frameoAtF2K" class="cl_frame_bm frame move-span cl frame-1"><div id="frameoAtF2K_left" class="column frame-1-c"><div id="frameoAtF2K_left_temp" class="move-span temp"></div><?php block_display('119');?></div></div></div><!--[/diy]-->
</div>
<div class="comiis_irbox_qqwb cl">
<!--[diy=comiis_irbox_qqwb]--><div id="comiis_irbox_qqwb" class="area"><div id="framewNlF7k" class="cl_frame_bm frame move-span cl frame-1"><div id="framewNlF7k_left" class="column frame-1-c"><div id="framewNlF7k_left_temp" class="move-span temp"></div><?php block_display('120');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_nbyewm]--><div id="comiis_irbox_nbyewm" class="area"><div id="frameJ46nan" class="cl_frame_bm frame move-span cl frame-1"><div id="frameJ46nan_left" class="column frame-1-c"><div id="frameJ46nan_left_temp" class="move-span temp"></div><?php block_display('121');?></div></div></div><!--[/diy]-->
</div>
<!--[diy=comiis_irbox_diy10]--><div id="comiis_irbox_diy10" class="area"><div id="frameUF8GEl" class="frame move-span cl frame-1"><div class="frame-title title"><span class="titletext">讯幻网邮箱登录</span></div><div id="frameUF8GEl_left" class="column frame-1-c"><div id="frameUF8GEl_left_temp" class="move-span temp"></div><?php block_display('166');?></div></div></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['index_side_bottom'])) echo $_G['setting']['pluginhooks']['index_side_bottom'];?>
</div>
<?php } ?>
</div>
<?php if($_G['group']['radminid'] == 1) { helper_manyou::checkupdate();?><?php } if(empty($_G['setting']['disfixednv_forumindex']) ) { ?><script>fixed_top_nv();</script><?php } ?>
<script src="<?php echo $_G['style']['styleimgdir'];?>/jquery.min.js" type="text/javascript" type="text/javascript"></script>
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
</script><?php include template('common/footer'); ?>