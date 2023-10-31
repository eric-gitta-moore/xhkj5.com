<?php
require './config.php';
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>VIP电影视频在线播放 - 优酷VIP视频,爱奇艺VIP视频,腾讯VIP视频,乐视VIP视频,芒果VIP视频,全网视频免费看,VIP在线看,视频VIP在线看 -讯幻网</title>
	<meta name="keywords" content="优酷VIP视频,爱奇艺VIP视频,腾讯VIP视频,乐视VIP视频,芒果VIP视频,全网视频免费看,VIP在线看,视频VIP在线看">
	<meta name="description" content="本站为广大网友提供优酷VIP解析,爱奇艺VIP解析,腾讯VIP解析,乐视VIP解析,芒果VIP解析等解析服务,让你省去购买视频VIP费用,欢迎大家收藏本站,并将它介绍给您的朋友!">
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
	<link href="style/css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="bookmark" href="favicon.ico" />
    <!--<STYLE type="text/css">body{cursor:url('style/img/S1.cur'), auto;} a{cursor:url('style/img/S2.cur'), auto;}</STYLE>-->
    <!--[if lt IE 9]>
      <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
      <script src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
  <body>
<div class="topbar">
<div class="container">
<div class="logo">
<a href="/" target="_self"><img src="http://www.xhkj5.com/template/comiis_nby/img/comiis_logo.gif">
</a>
</div>
<div class="txt">讯幻网VIP视频解析！</div>
<ul>
<li><a href="http://www.xhkj5.com/"><i></i>讯幻网</a></li>
<li><a href="http://ym.xhkj5.com/"><i></i>免费域名</a></li>
<li><a href="http://ma.xhkj5.com/"><i></i>二维码制作</a></li>
</ul>
</div>
</div>
    <br />
    <div class="container" style="padding-top:0px;">

	  <section data-id="86013" class="_135editor" style="border: 0px none; padding: 0px; position: relative;">
    <section style=" border: 8px solid rgb(255, 255, 255); box-shadow: rgb(230, 230, 220) 0px 1px 2px 2px; border-radius: 0; background-color: rgba(255, 255, 255, 0.6);">
        <p style="text-align: center;">
            <img style="border-top-left-radius: 2%; border-top-right-radius: 2%; vertical-align: middle; display: inline; width: 100%; visibility: visible !important;" src="http://image.xhkj5.com/tpwj/vipsp/1.jpg" width="100%" height="" border="0" mapurl="" title="" alt="">
        </p>
        <section style="padding: 20px 10px; border-width: 5px 0px 0px; border-style: solid none none; border-left-color: rgb(219, 219, 219); border-top-color: rgb(255, 255, 255); border-bottom-left-radius: 2%; border-bottom-right-radius: 2%;" class="135brush">
            <p style="letter-spacing: 1px; text-align: center;">
                <span style="color: #FE8B1F;display: block;text-align:center; font-weight: bold;">免费全网VIP视频会员免广告看电影！亲们如果觉得好用，请帮我们传播！ 若播放异常，刷新，更换接口尝试哦！ 
</span>
            </p>
			

        </section>
    </section>
</section>
<br>
	        <div class="col-md-14 column">
          <div class="panel-body" style="padding: 0px;padding-bottom: 15px;margin-top: -8px;">
        <form method="get">
        <div class="col-md-3" style="margin-top: 8px;">
			<div class="input-group" style="width: 100%;">
            	<select class="form-control input-lg" name="jk">
                    	<?
						foreach($apijk as $k=>$v){
							@list($apiurl, $apiname)  = explode('|', $v);
							
							echo '<option value="'.$k.'"';
							if (!empty($_GET['jk']) && $k == 0) {
								echo ' selected="selected"';
							} elseif ($_GET['jk'] == $k) {
								echo ' selected="selected"';
							}
							echo '>'.$apiname.'</option>';
						}
						?>
                	</select>
</div>
</div>
		<div class="col-md-7" style="margin-top: 8px;">
          <div class="input-group" style="width: 100%;">
            <input class="form-control input-lg" type="text" 
			<?php if (!empty($_GET['url'])) {
				echo 'value="'.stripslashes($_GET['url']).'" ';
			} 
			?>
			name="url" placeholder="输入播放地址"></div></div>
          <div>
            <div class="col-md-2" style="margin-top: 8px;">
          <div class="col-md-14 column">

      </div>
            <button type="submit" class="btn btn-default btn-lg btn-block">立即播放</button></div></div>
        </form>
      </div></div>

      <div class="col-md-14 column">
        <div class="panel panel-default">
          <div class="panel-body">
          <? if(!isset($_GET['url'])){
			  echo '<h3>使用说明:</h3>
<h4>把视频地址粘贴到上面的播放地址里面，点“立刻播放”即可</h4>
<h4>使用教程:<a href="http://www.xhkj5.com/forum.php?mod=viewthread&tid=1983" target="_blank">演示教程</a></h4>
<h4>如果由于有些接口验证问题，出现空白及英文，更换接口即可</h4>
<h4>磁力连接解析说明：输入磁力链接后40位代码即可</h4>
<h4>请记住我们的网址：<a href="http://tv.xhkj5.com/">tv.xhkj5.com</a></h4>
<h4>手机如果播放不了请用QQ浏览器</h4>
<h4>郑重声明：播放器内的所有广告并非本站所有，本站不承担播放器的广告所造成的一切后果</h4>
<h4>技术支持——<a href="http://www.xhkj5.com/" target="_blank">讯幻网</a></h4>'; 
		  }else{ 
			  echo '<iframe width="100%" height="450px" allowTransparency="true" frameborder="0" scrolling="no" src="'.$jk.$url.'"></iframe>';
		  }?>
			
          </div>
        </div>
      </div>

    <div class="tips">
<div class="col-md-12"><div style="border-radius: 0;" class="alert alert-success" role="alert"><p style="text-align: center;">本站视频源于互联网视频网站，系互联网抓取所得，仅供学习交流。已支持以下网站视频播放(包含VIP电影)等</p></div></div>
<br>
<div class="logos_lists">
<dl>
<dt><a target="_blank" href="http://www.le.com/"  rel="nofollow"><img src="style/img/letvlogo.png"></a></dt>
<dd>乐视TV视频</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://v.qq.com/" rel="nofollow"><img src="style/img/qqlogo.png" width="150" height="35"></a></dt>
<dd>腾讯视频</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.iqiyi.com/" rel="nofollow"><img src="style/img/iqiyi.png" width="110" height="35"></a></dt>
<dd>爱奇艺视频</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.youku.com/" rel="nofollow"><img src="style/img/youkulogo.png"></a></dt>
<dd>优酷视频</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.tudou.com/" rel="nofollow"><img src="style/img/tudoulogo.png"></a></dt>
<dd>土豆视频</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.mgtv.com/" rel="nofollow"><img src="style/img/hunantvlogo.png"></a></dt>
<dd>芒果TV视频</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://tv.sohu.com/" rel="nofollow"><img src="style/img/sohulogo.png"></a></dt>
<dd>搜狐视频</dd>
</dl>
<dl>
<dt><img src="style/img/ykcloud.png" width="110" height="35"></dt>
<dd>优酷云C</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.acfun.tv/" rel="nofollow"><img src="style/img/acfun.png" width="110" height="35"></a></dt>
<dd>Ac弹幕网</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.bilibili.com/" rel="nofollow"><img src="style/img/bilibili.png" width="110" height="35"></a></dt>
<dd>哔哩哔哩</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.fun.tv/" rel="nofollow"><img src="style/img/fengxing.gif" width="110" height="35"></a></dt>
<dd>风行网</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.wasu.cn/" rel="nofollow"><img src="style/img/wasulogo.png"></a></dt>
<dd>WASU华数视频</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.56.com/" rel="nofollow"><img src="style/img/56logo.png"></a></dt>
<dd>56</dd>
</dl>
<dl>
<dt><a target="_blank" href="http://www.yinyuetai.com/" rel="nofollow"><img src="style/img/yinyuetailogo.png"></a></dt>
<dd>音悦台MV</dd>
</dl>
</div>
</div>
    </div>

<div class="copyright">
      <div class="container">
        <div class="row text-center">
          <div class="col-sm-12">
            <br>
<span>Powered by <a href="http://www.xhkj5.com/" target="_blank">讯幻网</a> &copy; 2008-2017 讯幻网 版权所有 </div></div><br>

      </div>
    </div>
	<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?513504605137f1f6c20dcdfefb2bf95d";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["copy","mshare","qzone","tsina","bdysc","weixin","tqq","bdxc","tieba","tqf","douban","bdhome","sqq","ibaidu","youdao","qingbiji","mail","isohu","ty","print"],"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"100"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
  </body>
</html>

        
        
        
        
        