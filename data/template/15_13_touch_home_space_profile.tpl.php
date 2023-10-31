<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_profile');?>
<?php if($_GET['mycenter'] && !$_G['uid']) { dheader('Location:member.php?mod=logging&action=login');exit;?><?php } include template('common/header'); if(!$_GET['mycenter']) { ?>
<!-- header start -->
<div class="userHead header">
<a href="javascript:;" onclick="history.go(-1);" class="goBack z"></a>
<h1><?php if($_G['uid'] == $space['uid']) { ?>我的资料<?php } else { ?><?php echo $space['username'];?>的资料<?php } ?></h1>
<div class="user_avatar">
<div class="avatar_m"><img src="<?php echo avatar($space[uid], middle, true);?>" /></div>
<h2><?php echo $space['username'];?><span><?php echo $_G['group']['grouptitle'];?></span></h2>
</div>
</div>
<!-- header end -->
<!-- userinfo start -->
<div class="userProfile">
<div class="myinfo_list cl">
<ul>
<li><a href="javascript:;"><span><?php echo $space['credits'];?></span>积分</a></li><?php if(is_array($_G['setting']['extcredits'])) foreach($_G['setting']['extcredits'] as $key => $value) { if($value['title']) { ?>
<li><a href="javascript:;"><span><?php echo $space["extcredits$key"];?> <?php echo $value['unit'];?></span><?php echo $value['title'];?></a></li>
<?php } } ?>
</ul>
</div>
<?php if($space['uid'] == $_G['uid']) { ?>
<p><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" class="btn3">退出登录</a></p>
<?php } ?>
</div>
<!-- userinfo end -->

<?php } else { ?>

<!-- header start -->

<?php if($_G['setting']['domain']['app']['mobile']) { $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];?><?php } else { $nav = "forum.php";?><?php } ?>

<!-- header end -->
<div class="userHead header">
<a href="javascript:;" onclick="history.go(-1);" class="goBack z">返回</a>
<h1>个人中心</h1>
<div class="user_avatar">
<div class="avatar_m"><img src="<?php echo avatar($_G[uid], middle, true);?>" /></div>
<h2><?php echo $_G['username'];?><span><?php echo $_G['group']['grouptitle'];?></span></h2>
</div>
</div>

<!-- userInfoNv start -->
<div class="userInfoNv">
<div class="myinfo_list cl">
<ul>
<li class="unv1"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=favorite&amp;view=me&amp;type=thread"><span></span>我的收藏</a></li>
<li class="unv2"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me"><span></span>我的主题</a></li>
<li class="unv3"><a href="home.php?mod=space&amp;do=pm"><span></span>我的消息<?php if($_G['member']['newpm']) { ?><img src="<?php echo STATICURL;?>image/mobile/images/icon_msg.png" /><?php } ?></a></li>
<li class="unv4"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile"><span></span>我的资料</a></li>
</ul>
</div>
<p><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" class="btn3">退出登录</a></p>
</div>
<!-- userInfoNv end -->
<!-- header end -->

<?php } $nofooter = true;?><?php include template('common/btfixed'); include template('common/footer'); ?>