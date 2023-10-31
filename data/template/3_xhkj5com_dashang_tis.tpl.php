<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('tis');?><?php include template('common/header'); ?><div style=" padding:10px; width:270px; height:390px;position:relative;" id="ds">
<div class="dsbox">
<span><a title="<?php echo $lang_close;?>" onclick="hid()" class="flbc"  href="javascript:;" style=" position:absolute; right:18px; top:18px">close</a></span>
<h2><?php echo $dsy;?></h2>
<div class="tabList"> 
<div id="cont_one_1" class="one block" > 
<img src="<?php echo $wechat;?>" width="150" height="150" /></div> 
<div id="cont_one_2" class="one" style="display:none"> 
<img src="<?php echo $alipay;?>" width="150" height="150" /></div> 
</div> 
<p class="oooa"><?php echo $xhkj5com_dashang['tsa'];?></p>

<div class="tab" style="margin:20px auto 0px auto"> 
<ul> 
<li id="one1" class="on" onmouseover='setTab("one",1,2)' style="background:url(source/plugin/xhkj5com_dashang/template/img/wechat.jpg);background-repeat:no-repeat;background-position:center; "></li> 
<li id="one2" onmouseover='setTab("one",2,4)' style="background:url(source/plugin/xhkj5com_dashang/template/img/alipay.jpg);background-repeat:no-repeat;background-position:center;"></li> 
</ul> 
</div> 
<p class="ooo"><?php echo $xhkj5com_dashang['tsb'];?></p>
</div> 
</div>
<style>
#ds .dsbox{ background:<?php echo $qsbg;?>}
#ds h2{ color:#FFF; padding-left:10px;line-height:35px; height:35px; background:<?php echo $zsx;?>}
.ooo{font-size:12px;  text-align:center; line-height:45px; height:45px;width:100%;color:#999; font-family:"Microsoft Yahei"}
.tabList .one img{ padding:15px; border:3px dashed <?php echo $zsx;?>; border-radius:20px;}
.tab ul li.on{ border:<?php echo $zsx;?> 2px solid; color: #000;} 
.tab UL LI {border:2px solid #CCC;width: 110px; float: left; height: 30px; margin:0px 10px;border-radius:20px;text-align: center;}
.tabList .block {display: block;} 
.tabList .one{padding:40px 0px 0px 42px; margin:0px; }
.tab UL:after{display: block;height: 0px;visibility: hidden; clear: both; content: ""; } 
.tab UL {zoom: 1;clear: both; } 
.oooa{font-size:12px;  text-align:center; line-height:30px; height:30px;width:100%;color:#333; font-family:"Microsoft Yahei"}
</style>
<script>
function hid(){hideWindow('xhkj5com_dashang', 0, 1);}
function setTab(name,m,n){ 
for( var i=1;i<=n;i++){ 
var menu = document.getElementById(name+i); 
var showDiv = document.getElementById("cont_"+name+"_"+i); 
menu.className = i==m ?"on":""; 
showDiv.style.display = i==m?"block":"none"; 
} 
} 
</script> <?php include template('common/footer'); ?>