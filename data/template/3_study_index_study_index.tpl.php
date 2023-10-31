<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<title><?php echo $splugin_setting['study_index_title'];?></title>
<meta name="keywords" content="<?php echo $splugin_setting['study_seo_keyword'];?>" />
<meta name="description" content="<?php echo $splugin_setting['study_seo_describe'];?>" />
<meta name="generator" content="MyIndex" />
<meta name="author" content="1314study.com" />
<meta name="copyright" content="2010-2013 1314study.com" />
<?php if($splugin_setting['study_bgsound']) { ?>
<bgsound src="source/plugin/study_index/sound/fallingstar.mid" loop="-1">
<?php } ?>
<link rel="stylesheet" href="source/plugin/study_index/images/homepage.css" type="text/css">
<link href="favicon.ico" rel="icon" type="image/x-icon" />
<script src="source/plugin/study_index/images/homepage.js" type="text/javascript"></script>
<script>
var aaa=r;
aaa.svcToolbarYSpritePosition={a1:"0",a2:"-37px",a3:"-74px",a4:"-111px",a5:"-148px",a6:"-185px",a7:"-222px"};
window.onload=aaa.init;
</script>
</head>
<body>
<!-- icon start -->
<div id="wrapper">
<div id="top">
<?php if($_G['uid']) { ?>
<strong class="vwmy">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank"><?php echo $_G['username'];?></a>
</strong>
<span class="pipe">|</span>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">ÍË³ö</a>
<?php } else { ?>
<a href="<?php echo $splugin_setting['study_reg'];?>" target="_blank"><?php echo $splugin_setting['study_reg_name'];?></a> | <a href="<?php echo $splugin_setting['study_log'];?>" target="_blank"><?php echo $splugin_setting['study_log_name'];?></a>
<?php } ?>
</div>

<div id="logo"><a href="#" title="<?php echo $splugin_setting['study_index_title'];?>"><img src="<?php echo $splugin_setting['study_logo'];?>" alt="<?php echo $splugin_setting['study_index_title'];?>" border="0" /></a></div>

<table id="svc-toolbar" class="bgp" cellpadding="3" cellspacing="2" border="0">
<tr>
<td><a target="_blank" id="a1-i" href="<?php echo $splugin_setting['study_link001'];?>" title="<?php echo $splugin_setting['study_explain001'];?>"><span class="bgp-fr"></span><span><?php echo $splugin_setting['study_daohang001'];?></span></a></td>
<td><a target="_blank" id="a2-i" href="<?php echo $splugin_setting['study_link002'];?>" title="<?php echo $splugin_setting['study_explain002'];?>"><span class="bgp-fr"></span><span><?php echo $splugin_setting['study_daohang002'];?></span></a></td>
<td><a target="_blank" id="a3-i" href="<?php echo $splugin_setting['study_link003'];?>" title="<?php echo $splugin_setting['study_explain003'];?>"><span class="bgp-fr"></span><span><?php echo $splugin_setting['study_daohang003'];?></span></a></td>
<td><a target="_blank" id="a4-i" href="<?php echo $splugin_setting['study_link004'];?>" title="<?php echo $splugin_setting['study_explain004'];?>"><span class="bgp-fr"></span><span><?php echo $splugin_setting['study_daohang004'];?></span></a></td>
<td><a target="_blank" id="a5-i" href="<?php echo $splugin_setting['study_link005'];?>" title="<?php echo $splugin_setting['study_explain005'];?>"><span class="bgp-fr"></span><span><?php echo $splugin_setting['study_daohang005'];?></span></a></td>
<td><a target="_blank" id="a6-i" href="<?php echo $splugin_setting['study_link006'];?>" title="<?php echo $splugin_setting['study_explain006'];?>"><span class="bgp-fr"></span><span><?php echo $splugin_setting['study_daohang006'];?></span></a></td>
<td><a target="_blank" id="a7-i" href="<?php echo $splugin_setting['study_link007'];?>" title="<?php echo $splugin_setting['study_explain007'];?>"><span class="bgp-fr"></span><span><?php echo $splugin_setting['study_daohang007'];?></span></a></td>
</tr>
</table>

<?php if($splugin_setting['study_search_radio']) { ?>
<div id="s">
    <form id="scbar_form" method="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?>get<?php } else { ?>post<?php } ?>" autocomplete="off" action="<?php if($_G['fid'] && !empty($searchparams['url'])) { ?><?php echo $searchparams['url'];?><?php } else { ?>search.php?searchsubmit=yes<?php } ?>" target="_blank" onsubmit="return CheckForm();">
    		<input type="hidden" name="mod" id="scbar_mod" value="search" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="srhlocality" value="<?php echo $_G['basescript'];?>::<?php echo CURMODULE;?>" />
<?php if(!empty($searchparams['params'])) { ?>
<input type="hidden" name="source" value="discuz" />
<input type="hidden" name="fId" id="srchFId" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="q" id="cloudsearchquery" value="" />
<?php } ?>
        <input type="text" name="srchtxt" id="s_input" value="ÇëÊäÈëËÑË÷ÄÚÈÝ" onclick="if(this.value=='ÇëÊäÈëËÑË÷ÄÚÈÝ'){this.value='';}" onblur="if(this.value==''){this.value='ÇëÊäÈëËÑË÷ÄÚÈÝ';}" autocomplete="off" x-webkit-speech speech />
        <input type="submit" name="searchsubmit" id="s_button" value="true"/>
    </form>
    <div id="smart_pop" style="display: none; "></div>
</div>
<?php } ?>

<div id="foot">
<a href="<?php echo $splugin_setting['study_flink001'];?>"><?php echo $splugin_setting['study_footer001'];?></a> | 
    <a href="<?php echo $splugin_setting['study_flink002'];?>"><?php echo $splugin_setting['study_footer002'];?></a>
    <?php if($splugin_setting['study_tongji']) { ?> | 
    <?php echo $splugin_setting['study_tongji'];?>
<?php } ?>
<p id="cp">
<?php echo $splugin_setting['study_copyright'];?>
      <?php if($splugin_setting['study_beian']) { ?>
 - <a style="color:#77c" href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $splugin_setting['study_beian'];?></a>
<?php } ?>
</p>
  </div>
</div>
<!-- icon end -->
<!-- tips start:don't changes these id-->
<div id="tt" class="ttm" style="display:none">
<div class="ttl"></div>
<div class="ttc">
<div class="ttdc">
<div class="ttdl"></div>
<div class="ttdr"></div>
</div>
<div class="tt-text"></div>
<div class="ttdc">
<div class="ttdl"></div>
<div class="ttdr"></div>
</div>
</div>
<div class="ttl"></div>
<div class="ttvc">
<div class="ttv"></div>
</div>
</div>
<!-- tips end -->
<script language="javascript">
<!--
function CheckForm(){
if (document.getElementById('s_input').value=='ÇëÊäÈëËÑË÷ÄÚÈÝ' || document.getElementById('s_input').value=='') {
      document.getElementById('s_input').value='';
      document.getElementById('s_input').focus();
      return false;
}
return true;
}
-->
</script>
</body>
</html>
