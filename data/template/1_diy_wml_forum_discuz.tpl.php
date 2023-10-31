<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('discuz');?><?php include template('common/header'); ?><?php if(!empty($_G['setting']['pluginhooks']['index_top_mobile'])) echo $_G['setting']['pluginhooks']['index_top_mobile'];?>
<p>
<?php if($_G['setting']['mobile']['mobilehotthread']) { if($_GET['forumlist'] != 1) { dheader('Location:forum.php?mod=guide&view=hot');exit;?><?php } ?>
<a href="forum.php?mod=guide&amp;view=hot">热帖</a>
<a href="forum.php">版块列表</a>
<?php } if($forum_favlist) { ?>
<b>我收藏的版块</b><?php if(is_array($forum_favlist)) foreach($forum_favlist as $key => $val) { $favfids[$val[id]] = $val[id];?><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $val['id'];?>"><?php echo $val['title'];?></a><br/>
<?php } } if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><?php echo $cat['name'];?><br/>
    <?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { $forum=$forumlist[$forumid];?><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>" <?php if($forum_favlist[$forumid]) { ?>class="xi1"<?php } ?>><?php echo $forum['name'];?></a>
<br/>
<?php } } ?>
</p>
<?php if(!empty($_G['setting']['pluginhooks']['index_middle_mobile'])) echo $_G['setting']['pluginhooks']['index_middle_mobile'];?><?php include template('common/footer'); ?>