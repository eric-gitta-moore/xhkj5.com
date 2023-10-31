<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_forumselect');?><?php include template('touch/common/header'); ?><!-- header start -->
<header class="header">
<a href="forum.php?forumlist=1" class="goBack fl">返回</a>
<h1>选择您要发帖的板块</h1>
</header>
<!-- header end -->

<div class="forumSelect cfix">
<ul>
 <?php if(is_array($_G['cache']['forums'])) foreach($_G['cache']['forums'] as $forum) { ?>      <?php if($forum['type']!='group' && $forum['status']=='1') { ?>
      <li><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $forum['fid'];?>"><?php echo $forum['name'];?></a></li>
      <?php } ?>
      <?php } ?>
  </ul>
</div><?php include template('common/btfixed'); include template('touch/common/footer'); ?>