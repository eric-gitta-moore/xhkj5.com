<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE HTML>
<html>
<head>
<title>啊哦,你来晚了,找不到该贴子了 - <?php echo $bbname;?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0.1,maximum-scale=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>"/>
<?php if($auto_to_home) { ?>
<meta http-equiv="refresh" content="<?php echo $delay;?>;url=<?php echo $siteurl;?>" />
<?php } ?>
<style type="text/css">
* {
margin: 0;
padding: 0;
font-size: 12px;
}

body{
background:#eaeaea;
color:#272727;
}	
a {
color:#272727;
text-decoration: none;
}
.wrap {
margin:0 auto;
width: 60%;
}
.logo {
text-align:center;
margin-top: 50%;
}

.logo h3 {
padding: 15px;
text-align: center;
}	
.logo .sub {
margin-top: 50px;
}
.sub a{
color:#fff;
background:#272727;
padding: 10px 20px;
font-size: 13px;
font-family: arial, serif;
font-weight: bold;
border-radius: .5em;
}

.footer{
margin-top: 20px;
text-align: center;
}	

</style>
</head>
<body>

<div class="wrap">
<div class="logo">
<h3 class = "title"><?php echo $mobile_tip;?></h3>
<img src="source/plugin/xhkj5_urlseo/images/404-1.png" width = "100%"/>
<div class="sub">
<p>
<a href="<?php echo $siteurl;?>">返回首页</a>
</p>
</div>
</div>
</div>	

<div class="footer">
&copy <a href="<?php echo $siteurl;?>"><?php echo $bbname;?></a>
</div>
</body>
</html>