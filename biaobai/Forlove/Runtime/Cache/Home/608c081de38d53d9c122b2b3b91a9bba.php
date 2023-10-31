<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>网站设置</title>
	<link rel="stylesheet" href="/Public/Forlove/styleadmin.css">
	<script type="text/javascript" src="/Public/Js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/we/css/wangEditor.min.css">
	<script type="text/javascript" src="/Public/we/js/wangEditor.min.js"></script>
</head>
<body>
<div class="main">
<div class="header">
	<div class="tophead">
		<h1>讯幻网出品</h1>
	</div>
	<img src="/Public/Forlove/logo.png" alt="告白墙" class="logo"><br>
	<a href="/index.php/home/admin/admin" class="butt">返回首页</a>
	<a href="/index.php/home/admin/siteconfig" class="butt">网站设置</a>
</div>
<script>
	$(function(){

		var editor = new wangEditor('wedit');
		editor.config.menus = [
        'source',
        '|',
        'bold',
        'underline',
        'italic',
        'strikethrough',
        'eraser',
        'forecolor',
        'bgcolor',
        '|',
        'quote',
        'fontfamily',
        'fontsize',
        'unorderlist',
        'orderlist',
        'alignleft',
        'aligncenter',
        'alignright',
        '|',
        'link',
        'unlink',
        'table',
        'emotion',
        '|',
        'img',
        'video',
        '|',
        'undo',
        'redo',
		];
		editor.create();
		var flag = <?php echo ($res["noticflag"]); ?>;
		if(flag=='0'){
			$('#noticflag').val('0');
		}
	})
</script>
<div class="admin">
	<h2>网站设置</h2>
	<table class="am-table am-table-bordered">
		<tbody>
		<form action="/index.php/home/admin/doinfo" method="post">
			<tr>
				<th width="150px">网站名称：</th>
				<td><input type="text" name="sitename" id="" value="<?php echo ($res["sitename"]); ?>"></td>
			</tr>
			<tr>
				<th>是否开启公告：</th>
				<td><select name="noticflag" id="noticflag">
					<option value="1">是</option>
					<option value="0">否</option>
				</select></td>
			</tr>
			<tr>
				<th>公告内容：</th>
				<td><textarea name="notic" id="" cols="30" rows="10"><?php echo ($res2["notic"]); ?></textarea></td>
			</tr>
			<tr>
				<th>关于我们：</th>
				<td>
					<textarea name="about" id="wedit" cols="30" rows="60"><?php echo ($res2["about"]); ?></textarea>
				</td>
				
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="保存"></td>
			</tr>
			</form>
		</tbody>
	</table>
</div>
</div>
<div class="footer">
	<p>版权所有 &copy; 讯幻网</p>
	<p>Prowered by www.xhkj5.com</p>
</div>
</body>
</html>