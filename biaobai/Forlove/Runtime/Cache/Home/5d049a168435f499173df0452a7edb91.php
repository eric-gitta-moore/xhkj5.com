<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo W('info/info',array('sitename'));?></title>
	<link rel="stylesheet" href="/Public/Forlove/style.css">
	<script type="text/javascript" src="/Public/Js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/Public/Forlove/forlove.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<script>
	var URL = "/index.php/home/index";
    var APP = "/index.php";
    $(function(){
    	if(<?php echo W('info/info',array('noticflag'));?>==1){
    		$.get('/index.php/home/index/nc', function(data) {
    		$(".wenc").html(data);
    		$(".ncmask").fadeIn(200);
    		});
    	}
    })
	</script>
</head>
<body>
	<div class="header">
		<div class="tophead">
			<h1><?php echo W('info/info',array('sitename'));?></h1>
		</div>
		<img src="/Public/Forlove/logo.png" alt="告白墙" class="logo"><br>
		<a href="javascript:" class="butt">我要表白</a>
		<div class="nav">
			<ul>
				<li><a href="javascript:" id="ilink">首页</a></li>
				<li><a href="javascript:" id="slink">搜索</a></li>
				<li><a href="javascript:" id="alink">关于</a></li>
			</ul>
		</div>
	</div>
	<div class="search">
		<form action="" onsubmit="return false" class="sform">
			<input type="text" name="sinput" placeholder="请输入您要搜索姓名" class="his sin">
			<div class="sjiao">搜索</div>
		</form>
	</div>
<div class="ncmask">
	<div class="allnotic">
	<div class="cls"><a href="javascript:cls()" class="node">X</a></div>
	<div class="wenc">
		提示
	</div>
</div>
</div>
<div class="wrap">
<div class="main">
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="point">
		<div class="zzan">
			<a href="javascript:" class="jzan"><span id="<?php echo ($vo["id"]); ?>"><?php echo ($vo["zan"]); ?></span><img src="/Public/Forlove/zan.png" alt="" class="zan"></a>	
		</div>
			<div class="ptop">
				<img src="http://q.qlogo.cn/headimg_dl?dst_uin=<?php echo ($vo["avatar"]); ?>&spec=100" alt="" class="avatar">
				<div class="pp">
				<span class="pname"><?php echo ($vo["realname"]); ?></span><br><span class="ptime"><?php echo ($vo["lastdate"]); ?></span>
				</div>
			</div>
			<div class="pmain">
				<p><span class="towho"><?php echo ($vo["towho"]); ?></span><?php echo ($vo["content"]); ?></p>
			</div>
			<div class="pf">
				<ul id="reply-<?php echo ($vo["id"]); ?>" class="hidethis">
					<?php if(is_array($vo["reply"])): $i = 0; $__LIST__ = $vo["reply"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li class='replys'><p><span class='replyname'><?php echo ($vo1["nname"]); ?></span>：<?php echo ($vo1["reply"]); ?></p></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<a href="javascript:" class="more">点击展开更多...</a>
				<script>
				$(function(){
					if($("#reply-<?php echo ($vo["id"]); ?>").height()>100){
								$("#reply-<?php echo ($vo["id"]); ?>").css({"height":"100px","overflow":"hidden"});
								$("#reply-<?php echo ($vo["id"]); ?>").next().show();
							}
				})
				</script>
				<form action="" method="post" onsubmit="return false">
					<div class="line">
						<input type="text" name="reply" placeholder="我也说两句" class="pliu">
						<div class="pjiao" id="<?php echo ($vo["id"]); ?>">提交</div>
					</div>
				</form>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="page"><?php echo ($data); ?></div>
</div>
<div class="notic">测试测试</div>
<div class="hidemask2">
<div class="hideform">
	<form action="" id="reply2" onsubmit="return false">
		<p>请填写您的相关信息<span class="close"><a href="javascript:closes()" class="node">X</a></span></p>
		<input type="hidden" name="id" value="" id="hiid">
		<input type="hidden" name="reply" value="" id="hireply">
		<p><input type="text" name="email" id="email" placeholder="邮箱（必填）" class="his"></p>
		<p><input type="text" name="nname" id="realname" placeholder="昵称（必填）" class="his"></p>
		<p><input type="submit" value="提交" class="hisu"></p>
	</form>
</div>
</div>
<div class="hidemask">
<div class="hidegaobai">
	<form action="" onsubmit="return false" id="gaobai">
		<p>我要告白<span class="close"><a href="javascript:closes()" class="node">X</a></span></p>
		<p><input type="text" name="email" placeholder="邮箱（必填）" class="his" id="gemail" value="<?php echo (session('email')); ?>"></p>
		<p><input type="text" name="qq" id="qq" placeholder="QQ（用于获取头像）" class="his" value="<?php echo (session('qq')); ?>"></p>
		<p><input type="text" name="realname" placeholder="我的名称..." class="his" id="grealname" value="<?php echo (session('nname')); ?>"></p>
		<p><input type="text" name="towho" placeholder="告白对象..." class="his" id="gtowho"></p>
		<p><textarea name="content" cols="30" rows="5" placeholder="这是我要说的话" class="his" id="gcontent"></textarea></p>
		<p><input type="submit" value="发布" class="hidegaobaisubmit"></p>
	</form>
</div>
</div>
<div class="load">
	<div class="spinner">
	  <div class="rect1"></div>
	  <div class="rect2"></div>
	  <div class="rect3"></div>
	  <div class="rect4"></div>
	  <div class="rect5"></div>
	</div>	
</div>
</div>
	<div class="footer">
	<p>版权所有 &copy; <?php echo W('info/info',array('sitename'));?></p>
	<p>Prowered by <a href="http://www.www.xhkj5.com" target="_blank" style="color: #fff;text-decoration: none;">www.xhkj5.com</a></p>
	</div>
</body>
</html>