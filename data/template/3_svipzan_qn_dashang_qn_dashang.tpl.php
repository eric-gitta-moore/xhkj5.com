<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('qn_dashang');
0
|| checktplrefresh('./source/plugin/svipzan_qn_dashang/template/qn_dashang.htm', './template/default/common/header_ajax.htm', 1525607237, 'svipzan_qn_dashang', './data/template/3_svipzan_qn_dashang_qn_dashang.tpl.php', './source/plugin/svipzan_qn_dashang/template', 'qn_dashang')
|| checktplrefresh('./source/plugin/svipzan_qn_dashang/template/qn_dashang.htm', './template/default/common/footer_ajax.htm', 1525607237, 'svipzan_qn_dashang', './data/template/3_svipzan_qn_dashang_qn_dashang.tpl.php', './source/plugin/svipzan_qn_dashang/template', 'qn_dashang')
;?>
﻿<?php ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: text/xml; charset=".CHARSET);
echo '<?xml version="1.0" encoding="'.CHARSET.'"?>'."\r\n";?><root><![CDATA[<style type="text/css">
        
        .shang_payimg{width:140px;padding:10px;border:6px solid #EA5F00;margin:0 auto;border-radius:3px;height:140px;}
        .shang_payimg img{display:block;text-align:center;width:140px;height:140px; }
        .pay_explain{text-align:center;margin:10px auto;font-size:12px;color:#545454;}
        .radiobox{width: 16px;height: 16px;background: url('<?php echo $root;?>img/radio2.jpg');display: block;float: left;margin-top: 5px;margin-right: 14px;}
        .checked .radiobox{background:url('<?php echo $root;?>img/radio1.jpg');}
        .shang_payselect{text-align:center;margin:0 auto;margin-top:40px;cursor:pointer;height:60px;width:280px;}
        .shang_payselect .pay_item{display:inline-block;margin:10px 10px 0 0;float:left;}
        .shang_info{clear:both;}
        .shang_info p,.shang_info a{color:#C3C3C3;text-align:center;font-size:12px;text-decoration:none;line-height:2em;}
    </style>


<link href="<?php echo $root;?>css/index.css" rel="stylesheet" type="text/css" />
<div class="bm_h">
<table  width="400px">
<tr><td width="90%"  class="flb">
<em><?php echo $top_info;?></em> </td><td width="10%" align="right">
<span>
<a href="javascript:;" class="flbc" onclick="hideWindow('svipzan_qn_dashang'); return false;"
 title="close"></a>
</span></td></tr>
 </table>
 </div>



<br><br>

<div class="shang_payimg">
            <div id="alipayimg"><img src="<?php echo $alipay_url;?>" alt="alipay" title="alipay" /></div>
            <div id="wxpayimg" style="display:none"><img src="<?php echo $wxpay_url;?>" alt="wxpay" title="wxpay" /></div>
            <div id="qqpayimg" style="display:none"><img src="<?php echo $qqpay_url;?>" alt="qqpay" title="qqpay" /></div>
            <div id="bdpayimg" style="display:none"><img src="<?php echo $bdpay_url;?>" alt="bdpay" title="bdpay" /></div>
        </div>
            <div class="pay_explain"><?php echo $but_info;?></div>
        <div class="shang_payselect">
            <div class="pay_item" id="alipay" onclick=alipay();>
                <span class="radiobox" id="alipay1" style=""><img src="<?php echo $root;?>img/radio1.jpg"  /></span>
                <span class="radiobox" id="alipay0" style="display:none"><img src="<?php echo $root;?>img/radio2.jpg" /></span>
                <span class="pay_logo"><img src="<?php echo $root;?>img/alipay.jpg" alt="alipay" /></span>
            </div>
            <div class="pay_item" id="wxpay" onclick=wxpay();>
                <span class="radiobox" id="wxpay1" style="display:none"><img src="<?php echo $root;?>img/radio1.jpg" /></span>
                <span class="radiobox" id="wxpay0"style=""><img src="<?php echo $root;?>img/radio2.jpg" /></span>
                <span class="pay_logo"><img src="<?php echo $root;?>img/wechat.jpg" alt="wxpay" /></span>
            </div>
            <div class="pay_item" id="qqpay" onclick=qqpay();>
                <span class="radiobox" id="qqpay1" style="display:none"><img src="<?php echo $root;?>img/radio1.jpg" /></span>
                <span class="radiobox" id="qqpay0" style=""><img src="<?php echo $root;?>img/radio2.jpg" /></span>
                <span class="pay_logo"><img src="<?php echo $root;?>img/qqpay.jpg" alt="qqpay" /></span>
            </div>
            <div class="pay_item" id="bdpay" onclick=bdpay();>
                <span class="radiobox" id="bdpay1" style="display:none"><img src="<?php echo $root;?>img/radio1.jpg" /></span>
                <span class="radiobox" id="bdpay0" style=""><img src="<?php echo $root;?>img/radio2.jpg" /></span>
                <span class="pay_logo"><img src="<?php echo $root;?>img/bdpay.jpg" alt="bdpay" /></span>
            </div>
        </div><br><br>
        <div class="shang_info">
            <p><?php echo $copyright;?></p>
        </div>


<br><br>
<script type="text/javascript">
function alipay(){
                document.getElementById("alipayimg").style.display="";
                document.getElementById("wxpayimg").style.display="none";
                document.getElementById("qqpayimg").style.display="none";
                document.getElementById("bdpayimg").style.display="none";

                document.getElementById("alipay1").style.display=""; 
                document.getElementById("alipay0").style.display="none";
                document.getElementById("wxpay1").style.display="none"; 
                document.getElementById("wxpay0").style.display="";
                document.getElementById("qqpay1").style.display="none"; 
                document.getElementById("qqpay0").style.display="";
                document.getElementById("bdpay1").style.display="none"; 
                document.getElementById("bdpay0").style.display="";   
}
function wxpay(){
                document.getElementById("alipayimg").style.display="none";
                document.getElementById("wxpayimg").style.display="";
                document.getElementById("qqpayimg").style.display="none";
                document.getElementById("bdpayimg").style.display="none"; 

                document.getElementById("alipay1").style.display="none"; 
                document.getElementById("alipay0").style.display="";
                document.getElementById("wxpay1").style.display=""; 
                document.getElementById("wxpay0").style.display="none";
                document.getElementById("qqpay1").style.display="none"; 
                document.getElementById("qqpay0").style.display="";
                document.getElementById("bdpay1").style.display="none"; 
                document.getElementById("bdpay0").style.display="";
}
function qqpay(){
                document.getElementById("alipayimg").style.display="none";
                document.getElementById("wxpayimg").style.display="none";
                document.getElementById("qqpayimg").style.display="";
                document.getElementById("bdpayimg").style.display="none";

                document.getElementById("alipay1").style.display="none"; 
                document.getElementById("alipay0").style.display="";
                document.getElementById("wxpay1").style.display="none"; 
                document.getElementById("wxpay0").style.display="";
                document.getElementById("qqpay1").style.display=""; 
                document.getElementById("qqpay0").style.display="none";
                document.getElementById("bdpay1").style.display="none"; 
                document.getElementById("bdpay0").style.display="";
}
function bdpay(){
                document.getElementById("alipayimg").style.display="none";
                document.getElementById("wxpayimg").style.display="none";
                document.getElementById("qqpayimg").style.display="none";
                document.getElementById("bdpayimg").style.display="";

                document.getElementById("alipay1").style.display="none"; 
                document.getElementById("alipay0").style.display="";
                document.getElementById("wxpay1").style.display="none"; 
                document.getElementById("wxpay0").style.display="";
                document.getElementById("qqpay1").style.display="none"; 
                document.getElementById("qqpay0").style.display="";
                document.getElementById("bdpay1").style.display=""; 
                document.getElementById("bdpay0").style.display="none";
}
    </script><?php echo output_ajax(); ?>]]></root><?php exit;?></head>
<body onload="dashangToggle()">
    <div class="content">
    <div class="hide_box"></div>
    <div class="shang_box">
    	<a class="shang_close" href="javascript:history.go(-1);" onClick="dashangToggle()" title="!guanbi!"><img src="<?php echo $root;?>img/close.jpg" alt="!quxiao!" /></a>
        <img class="shang_logo" src="<?php echo $logo;?>" alt="logo" />
    	<div class="shang_tit">
    		<p><?php echo $top_txt;?></p>
    	</div>
    	<div class="shang_payimg">
    		<div id="alipayimg"><img src="<?php echo $alipayurl;?>" alt="!smzc!" title="!sys!" /></div>
            <div id="wxpayimg" style="display:none"><img src="<?php echo $wxpayurl;?>" alt="!smzc!" title="!sys!" /></div>
            <div id="qqpayimg" style="display:none"><img src="<?php echo $qqpayurl;?>" alt="!smzc!" title="!sys!" /></div>
    	</div>
    		<div class="pay_explain"><?php echo $but_txt;?></div>
    	<div class="shang_payselect">
    		<div class="pay_item checked" data-id="alipay">
    		<span class="radiobox"></span>
    		<span class="pay_logo"><img src="<?php echo $root;?>img/alipay.jpg" alt="!alipay!" /></span>
    		</div>
    		<div class="pay_item" data-id="wxpay">
    		<span class="radiobox"></span>
    		<span class="pay_logo"><img src="<?php echo $root;?>img/wechat.jpg" alt="!wxpay!" /></span>
    		</div>
            <div class="pay_item" data-id="qqpay">
                <span class="radiobox"></span>
                <span class="pay_logo"><img src="<?php echo $root;?>img/qqpay.jpg" alt="!qqpay!" /></span>
            </div>
    	</div>