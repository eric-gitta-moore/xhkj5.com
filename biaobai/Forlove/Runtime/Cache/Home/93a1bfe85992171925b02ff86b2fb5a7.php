<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>告白墙后台登陆</title>
	<link rel="stylesheet" href="/Public/Forlove/styleadmin.css">
</head>
<body>
<div class="main">
<div class="header">
	<div class="tophead">
		<h1>讯幻网出品</h1>
	</div>
	<img src="/Public/Forlove/logo.png" alt="告白墙" class="logo"><br>
	<a href="/index.php/home/admin/admin" class="butt">返回首页</a>
</div>
<div class="login">
	<form action="/index.php/home/admin/login" method="post">
		<p><input type="text" name="username"></p>
		<p><input type="password" name="password"></p>
		<p><input type="submit" value="登陆"></p>
	</form>
</div>
</div>
<div class="footer">
	<p>版权所有 &copy; 讯幻网</p>
	<p>Prowered by www.xhkj5.com</p>
	</div>
</body>
</html>