<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');
block_get('76,164,163,78,80,81');?><?php include template('common/header'); ?><header class="header p_header">
<a class="topMenu fl" href="#mainNv">菜单</a>
<?php if(!$_G['uid'] && !$_G['connectguest']) { ?>
<a class="topLogin fr" href="member.php?mod=logging&amp;action=login"></a>
<?php } else { ?>
<a class="topLogin fr" href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1"><?php echo avatar($_G[uid]);?></a>
<?php } ?>
<h1 class="logo"><img  src="template/xhkj5.com_iuni/touch/images/img/logo.png"></h1>
</header>
<div class="container">
<script src="template/xhkj5.com_iuni/touch/images/js/TouchSlide.1.1.js" type="text/javascript" type="text/javascript"></script>

<!--焦点图-->
<div class="xrSlider" id="xrSlider"><?php block_display('76');?></div>
<script type="text/javascript">
TouchSlide({ 
slideCell:"#xrSlider",
titCell:".sliderNum li",
mainCell:".sliderCon ul", 
effect:"leftLoop",
autoPlay:true //自动播放
});
</script>

<!--二级导航-->
<div class="nvBar">
<div class="subNv">
<ul>
<li><a href="forum.php?mod=forumdisplay&amp;fid=90&amp;mobile=2">dz插件</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=93&amp;mobile=2">dz模版</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=94&amp;mobile=2">dz教程</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=72&amp;mobile=2">网站源码</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=103&amp;mobile=2">wp模板</a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=105&amp;mobile=2">html模板</a></li>
</ul>
</div>
</div>

<!--最新插件-->
<div class="pb">
<div class="hdTit cfix">
<h2>最新插件</h2>
<span><a href="forum.php?mod=forumdisplay&amp;fid=2&amp;mobile=2">更多&gt;&gt;</a></span>
</div>
<div class="newPosts"><?php block_display('164');?></div>
</div>

<!--热门模版-->
<div class="pb">
<div class="hdTit cfix">
<h2>热门模版</h2>
</div>
<div class="ausPt cfix" id="ausPt"><?php block_display('163');?></div>
<script type="text/javascript">
TouchSlide({ 
slideCell:"#ausPt",
titCell:".ausPtNum li",
mainCell:".ausPtCon", 
effect:"leftLoop"
});
</script>
</div>

<!--热帖推荐-->
<div class="hotPosts cfix pb"><?php block_display('78');?></div>


<!--最新主题-->
<div class="pb">
<div class="hdTit cfix">
<h2>最新主题</h2>
<span><a href="forum.php?mod=guide&amp;view=newthread">更多&gt;&gt;</a></span>
</div>
<div class="newPosts"><?php block_display('80');?></div>
</div>


<!--版块导航-->
<div class="pb">
<div class="hdTit cfix">
<h2>版块导航</h2>
<span><a href="forum.php?forumlist=1&amp;mobile=2">更多&gt;&gt;</a></span>
</div>
<div class="coluNv cfix"><?php block_display('81');?></div>
</div>

<?php if(!$_G['uid'] && !$_G['connectguest']) { ?>
<div class="pb indexLogin">
<p>登录之后可以体验更多功能！</p>
<a href="member.php?mod=logging&amp;action=login">立即登录</a>
</div>
<?php } ?>
</div><?php include template('common/btfixed'); include template('common/footer'); ?>