<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE HTML>
<html>
<head>
<title>啊哦,你来晚了,找不到该贴子了 - <?php echo $bbname;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>" />
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
}	
a {
color: #161616;
text-decoration: none;
}
.wrap{
margin:0 auto;
width: 960px;
}
.logo{
text-align:center;
margin-top:150px;
}
.logo img {
width:350px;
}
.logo p {
color:#272727;
font-size:40px;
margin-top:1px;
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
<p><?php echo $pc_tip;?></p>
<img src="source/plugin/xhkj5_urlseo/images/404-1.png"/>
<div class="sub">
<p>
<a href="<?php echo $siteurl;?>">返回首页</a>
</p>
</div>
</div>

<style type = "text/css">
.himickey_supernews {
position: relative;
border: solid 1px #CDCDCD;
border-radius: 5px;
margin: 20px 0;
<?php if(!$hot_open) { ?>
display: none;
<?php } ?>
}
.sn_corner {
width: 93px;
height: 92px;
position: absolute;
left: 0;
top: 0;
z-index: 10000;
background: url('source/plugin/xhkj5_urlseo/images/corner.png') no-repeat;
}
#himickey_scroll {
overflow:hidden; 
height: 162px; 
padding: 0px 10px;
margin-bottom: 15px;
}
#himickey_scroll li {
float: left;
box-shadow: 0 0 10px #CCC;
margin: 15px 15px 0px 0px;
border-radius: 5px;
padding: 5px;
width: 132px;
height: 134px;
overflow: hidden;
border: solid 1px #DFDFDF;
transition:transform 0.2s;
}

#himickey_scroll li:hover {
transform:rotate(360deg); 
}

#himickey_scroll li p {
width: 132px; 
height: 20px;
text-indent: 5px;
line-height: 20px;
overflow: hidden;
text-align: center; 
}

#himickey_scroll li a:hover {
text-decoration: none;
color: #369;
}
#himickey_scroll li:hover {
border: solid 1px #369; 
}

#himickey_scrollin{
float: left;
width: 500%;
}
#himickey_scroll1, #himickey_scroll2 {
float: left;
}
</style>

<div class="himickey_supernews">
<div class = "sn_corner"></div>
<div id="himickey_scroll">
<div id="himickey_scrollin">
<div id="himickey_scroll1">
<ul><?php if(is_array($rs)) foreach($rs as $v) { ?> 
<li>
<?php if(in_array('forum_viewthread', $_G['setting']['rewritestatus'])) { ?>
<a href='thread-<?php echo $v['tid'];?>-1-1.html'>
<?php } else { ?>
<a href='forum.php?mod=viewthread&tid=<?php echo $v['tid'];?>'>
<?php } ?>
<img src='http://image.xhkj5.com/<?php echo $_G['setting']['attachurl'];?>forum/<?php echo $v['attachment'];?>' width = '132px' height = '112px' onerror="this.src='<?php echo $_G['setting']['attachurl'];?>forum/<?php echo $v['attachment'];?>'" />
<p><?php echo $v['subject'];?></p>
</a>
</li>
<?php } ?>
</ul>
</div>
<div id="himickey_scroll2"></div>
</div>
</div>
</div>
<script>
var speed= 30;
var tabObj = document.getElementById("himickey_scroll");
var tabObj1 = document.getElementById("himickey_scroll1");
var tabObj2 = document.getElementById("himickey_scroll2");
tabObj2.innerHTML=tabObj1.innerHTML;
function marquee() {
if(tabObj2.offsetWidth - tabObj.scrollLeft <= 0) {
tabObj.scrollLeft -= tabObj1.offsetWidth;
} else {
tabObj.scrollLeft++;
}
}
var q = setInterval(marquee, speed);
tabObj.onmouseover = function() {
clearInterval(q)
};
tabObj.onmouseout=function() {
q = setInterval(marquee, speed)
};
</script>

</div>	


<div class="footer">
&copy <a href="<?php echo $siteurl;?>"><?php echo $bbname;?></a>
</div>

</body>
</html>