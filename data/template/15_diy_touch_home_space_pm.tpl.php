<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_pm');
0
|| checktplrefresh('./template/xhkj5.com_iuni/touch/home/space_pm.htm', './template/default/touch/home/space_pm_node.htm', 1525280339, 'diy', './data/template/15_diy_touch_home_space_pm.tpl.php', './template/xhkj5.com_iuni', 'touch/home/space_pm')
;?>
<?php $_G['home_tpl_titles'] = array('短消息');?><?php include template('common/header'); if(in_array($filter, array('privatepm')) || in_array($_GET['subop'], array('view'))) { if(in_array($filter, array('privatepm'))) { ?>

<!-- header start -->
<header class="header">
<a class="iconEdit y" href="home.php?mod=spacecp&amp;ac=pm">发消息</a>
    <a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1" class="goBack z"></a>
<h1><span class="name">消息</span></h1>
</header>
<!-- header end -->
<!-- main pmlist start -->
<div class="pmbox pb">
<ul><?php if(is_array($list)) foreach($list as $key => $value) { ?><li>
<a href="<?php if($value['touid']) { ?>home.php?mod=space&do=pm&subop=view&touid=<?php echo $value['touid'];?><?php } else { ?>home.php?mod=space&do=pm&subop=view&plid=<?php echo $value['plid'];?>&type=1<?php } ?>">
<div class="avatar_img">
<img src="<?php if($value['pmtype'] == 2) { ?><?php echo STATICURL;?>image/common/grouppm.png<?php } else { ?><?php echo avatar($value[touid] ? $value[touid] : ($value[lastauthorid] ? $value[lastauthorid] : $value[authorid]), small, true);?><?php } ?>" />
</div>				
<div class="cfix">
<span class="time y"><?php echo dgmdate($value[dateline], 'u');?></span>
<?php if($value['new']) { ?><span class="num"><?php echo $value['pmnum'];?></span><?php } if($value['touid']) { if($value['msgfromid'] == $_G['uid']) { ?>
<span class="name">我 对 <?php echo $value['tousername'];?> 说:</span>
<?php } else { ?>
<span class="name"><?php echo $value['tousername'];?> 对我 说:</span>
<?php } } elseif($value['pmtype'] == 2) { ?>
<span class="name">发起者:<?php echo $value['firstauthor'];?></span>
<?php } ?>
</div>
<div class="cfix grey">						
<span><?php if($value['pmtype'] == 2) { ?>[群聊]<?php if($value['subject']) { ?><?php echo $value['subject'];?><br><?php } } if($value['pmtype'] == 2 && $value['lastauthor']) { ?><div style="padding:0 0 0 20px;">......<br><?php echo $value['lastauthor'];?> : <?php echo $value['message'];?></div><?php } else { ?><?php echo $value['message'];?><?php } ?></span>
</div>
</a>
</li>
<?php } ?>
</ul>
</div>
<!-- main pmlist end -->

<?php } elseif(in_array($_GET['subop'], array('view'))) { ?>

<!-- header start -->
<header class="header">
<a href="home.php?mod=space&amp;do=pm" class="goBack z">返回</a>
<h1>查看消息</h1>
</header>
<!-- header end -->
<!-- main viewmsg_box start -->
<div class="wp">
<div class="msgbox">
<?php if(!$list) { ?>
当前没有相应的短消息
<?php } else { if(is_array($list)) foreach($list as $key => $value) { ?><style>.btFixed{display:none;}</style><?php if($value['msgfromid'] != $_G['uid']) { ?>
<div class="friend_msg cl">
<div class="avat z"><img style="height:32px;width:32px;" src="<?php echo avatar($value[msgfromid], small, true);?>" /></div>
<div class="dialog_green z">
<div class="dialog_c">
<div class="dialog_t"><?php echo $value['message'];?></div>
</div>
<div class="dialog_b"></div>
<div class="date"><?php echo dgmdate($value[dateline], 'u');?></div>
</div>
</div>
<?php } else { ?>
<div class="self_msg cl">
<div class="avat y"><img style="height:32px;width:32px;" src="<?php echo avatar($value[msgfromid], small, true);?>" /></div>
<div class="dialog_white y">			
<div class="dialog_c">
<div class="dialog_t"><?php echo $value['message'];?></div>
</div>
<div class="dialog_b"></div>
<div class="date"><?php echo dgmdate($value[dateline], 'u');?></div>
</div>
</div>
<?php } } ?>
<?php echo $multi;?>
<?php } ?>
</div>
<?php if($list) { ?>
<form id="pmform" class="pmform" name="pmform" method="post" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;pmid=<?php echo $pmid;?>&amp;daterange=<?php echo $daterange;?>&amp;pmsubmit=yes&amp;mobile=2" >
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if(!$touid) { ?>
<input type="hidden" name="plid" value="<?php echo $plid;?>" />
<?php } else { ?>
<input type="hidden" name="touid" value="<?php echo $touid;?>" />
<?php } ?>
<input type="text" value="" class="inp z" autocomplete="off" id="replymessage" name="message">
<input type="button" name="pmsubmit" id="pmsubmit" class="formdialog btn1 y" value="回复" />
</form>
<?php } ?>
</div>
<!-- main viewmsg_box end -->

<?php } } else { ?>
<div class="bm_c">
手机版不支持复杂短消息操作，请返回<a href="home.php?mod=space&amp;do=pm&amp;filter=privatepm">我的短消息</a>
</div>
<?php } $nofooter = true;?><?php include template('common/btfixed'); include template('common/footer'); ?>