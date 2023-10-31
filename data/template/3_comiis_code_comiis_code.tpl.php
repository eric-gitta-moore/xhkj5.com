<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('comiis_code');?><?php include template('common/header'); ?><style>
.comiis_code_jcboxymky {border:1px solid #ddd;overflow:hidden;background:#fff;margin:10px auto 10px;font-size:16px;font-family:'Microsoft Yahei','Simsun',Tahoma}
.comiis_code_jcboxymky h2 {background:#f3f3f3;height:50px;line-height:50px;font-size:18px;font-weight:100;text-align:center;border-bottom:1px solid #e5e5e5;overflow:hidden;}
.comiis_code_jcboxymky ul {padding:20px 25px 25px;overflow:hidden;}
.comiis_code_jcboxymky ul li span {display:block;line-height:34px;color:green;}
.comiis_code_jcboxymky ul li span img {margin:5px 0 5px 30px;}
.comiis_code_jcboxymky ul li span.kmtit {font-size:18px;color:#db0000;}
</style>
<div class="wp cl">
<div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="Ê×Ò³"><?php echo $_G['setting']['bbname'];?></a><em>&raquo;</em><a href="forum.php"><?php echo $_G['setting']['navs']['2']['navname'];?></a><em>&raquo;</em><?php echo $plugindata['comiis_code_htmltitle'];?>
</div>
</div>
<div class="comiis_code_jcboxymky cl">
<h2><?php echo $plugindata['comiis_code_htmltitle'];?></h2>
<ul class="cl">
<li><?php echo $plugindata['comiis_code_htmlbody'];?></li>
</ul>
</div>
</div><?php include template('common/footer'); ?>