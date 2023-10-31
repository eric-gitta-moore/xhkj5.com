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
		function shanchu(){
		if(confirm("确定删除？")){
			return true;
		}else{
			return false;
		}
	}
</script>
<div class="admin">
	<table class="am-table am-table-bordered">
		<thead>
			<tr>
				<th>告白者</th>
				<th>被告白者</th>
				<th>内容</th>
				<th>email</th>
				<th>ip</th>
				<th width="70px">删除</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($vo["realname"]); ?></td>
					<td><?php echo ($vo["towho"]); ?></td>
					<td><?php echo ($vo["content"]); ?></td>
					<td><?php echo ($vo["email"]); ?></td>
					<td><?php echo ($vo["ip"]); ?></td>
					<td><a href="/index.php/home/admin/del/id/<?php echo ($vo["id"]); ?>" onclick="return shanchu()">删除</a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<?php echo ($data); ?>
</div>
</div>
<div class="footer">
	<p>版权所有 &copy; 讯幻网</p>
	<p>Prowered by www.xhkj5.com</p>
	</div>
</body>
</html>