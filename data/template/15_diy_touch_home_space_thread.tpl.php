<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_thread');?><?php include template('common/header'); ?><!-- header start -->
<header class="header">
<a href="home.php?mod=space&amp;uid=1&amp;do=profile&amp;mycenter=1" class="goBack z">返回</a>
<h1>我的主题</h1>
</header>
<!-- header end -->
<!-- main threadlist start -->
<div class="threadlist">
<ul>
<?php if($list) { if(is_array($list)) foreach($list as $thread) { ?><li>
<?php if($viewtype == 'reply' || $viewtype == 'postcomment') { ?>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;ptid=<?php echo $thread['tid'];?>&amp;pid=<?php echo $thread['pid'];?>">
<h3 class="threadSubject"><?php echo $thread['subject'];?></h3>
<?php } else { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" <?php if($thread['displayorder'] == -1) { ?>class="grey"<?php } ?>>
<h3 class="threadSubject"><?php echo $thread['subject'];?></h3>
<?php } ?>
<div class="threadListTit">
<div class="h_avatar"><?php echo avatar($thread[authorid],small);?></div>
<h4>
<div class="count y">
<span class="views icon"><?php if($thread['isgroup'] != 1) { ?><?php echo $thread['views'];?><?php } else { ?><?php echo $groupnames[$thread['tid']]['views'];?><?php } ?></span>
<span class="replies icon"><?php echo $thread['replies'];?></span>
</div>
<?php echo $thread['author'];?>
<!--
<?php if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<span class="icon_top"><img src="<?php echo STATICURL;?>image/mobile/images/icon_top.png"></span>
<?php } elseif($thread['digest'] > 0) { ?>
<span class="icon_top"><img src="<?php echo STATICURL;?>image/mobile/images/icon_digest.png"></span>
<?php } elseif($thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0) { ?>
<span class="icon_tu"><img src="<?php echo STATICURL;?>image/mobile/images/icon_tu.png"></span>
<?php } ?>
-->
</h4>
<p>发布于 <?php echo $thread['dateline'];?></p>
</div>			
</a>
</li>
<?php } } else { ?>
<li class="noData">还没有相关的帖子</li>
<?php } ?>
</ul>
<?php echo $multi;?>
</div>
<!-- main threadlist end --><?php $nofooter = true;?><?php include template('common/footer'); ?><li>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>" <?php echo $thread['highlight'];?> >
<h3 class="threadSubject">
<?php echo $thread['subject'];?>
</h3>
<div class="threadListTit">
<div class="h_avatar"><?php echo avatar($thread[authorid],small);?></div>
<h4>
<div class="count y">
<span class="views icon"><?php if($thread['isgroup'] != 1) { ?><?php echo $thread['views'];?><?php } else { ?><?php echo $groupnames[$thread['tid']]['views'];?><?php } ?></span>
<span class="replies icon"><?php echo $thread['replies'];?></span>
</div>
<?php echo $thread['author'];?>
<!--
<?php if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<span class="icon_top"><img src="<?php echo STATICURL;?>image/mobile/images/icon_top.png"></span>
<?php } elseif($thread['digest'] > 0) { ?>
<span class="icon_top"><img src="<?php echo STATICURL;?>image/mobile/images/icon_digest.png"></span>
<?php } elseif($thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0) { ?>
<span class="icon_tu"><img src="<?php echo STATICURL;?>image/mobile/images/icon_tu.png"></span>
<?php } ?>
-->
</h4>
<p>发布于 <?php echo $thread['dateline'];?></p>
</div>
</a>
</li><?php include template('common/btfixed'); ?>