<?php
/*
Author:分.享.吧
Website:www.fx8.cc
Qq:154-6069-14
*/
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
/**
* 
*/
class mobileplugin_jameson_fx 
{
	// 自动跳转到带参数url
	function global_header_mobile(){
		global $_G;
		if( $_G['uid'] && $this->is_weixin() && ($_GET['mod']=='viewthread') && !isset($_GET['fxuid']) && $_GET['tid']){
			if($_GET['page']){
				header("location:./forum.php?mod=viewthread&tid=".$_GET['tid']."&page=".$_GET['page']."&fxuid=".$_G['uid']."&mobile=2");
			}else{
				header("location:./forum.php?mod=viewthread&tid=".$_GET['tid']."&fxuid=".$_G['uid']."&mobile=2");
			}
		}
	}

	function is_weixin(){ 
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ){
				return true;
		}
		return false;
	}
	// 显示手机版分享记录
	function global_footer_mobile(){
		global $_G;
		if($_GET['mod'] =='space' && ($_GET['do']=='profile') && ($_GET['mycenter'] == 1)){
					$wodefenxiang = lang('plugin/jameson_fx','wodefenxiang');
					$html =<<<EOF
					<script>
						function insertli(){
							var li = document.createElement('li');
							li.innerHTML = '<a href="./plugin.php?id=jameson_fx&contrl=touch&act=index">{$wodefenxiang}</a>';
							var div = document.getElementsByTagName('div');
							for(var i=0,len=div.length;i<len;i++){
								if(/myinfo_list/.test(div[i].getAttribute('class'))){
									div[i].getElementsByTagName('ul')[0].appendChild(li);
								}
							}
						}
						$(function(){
							insertli();
						});
					</script>
EOF;
				return $html;
				}
			}
}

/**
* 
*/
class mobileplugin_jameson_fx_forum extends mobileplugin_jameson_fx
{
// 底部显示分享图标
	function viewthread_bottom_mobile(){
			global $_G;
			require_once './source/plugin/jameson_fx/function/function_jamesonfx.php';
			init_jamesonfx();
			// 进行奖励判断和奖励操作
			// jangli start 
			$jsjl = '';
			if(!$_G['jameson_fx']['enablemobile'] || !in_array($_G['fid'],$_G['jameson_fx']['forum']) || (intval($_GET['fxuid'])<1) || ($_GET['fxuid'] == $_G['uid']) || (($_G['uid'] == $_G['thread']['authorid']) && !$_G['jameson_fx']['self'] ) || ($_G['clientip'] == DB::result_first('SELECT lastip FROM %t WHERE uid=%d',array('common_member_status',$_GET['fxuid']) )) ){
				$jsjl = '';
			}else{
				// 如过没有登录或不是本人
					// 今日开始时间
					$timestart = dmktime(date('Y-m-d',time()));
					// 本日0点开始已兑换积分数额
					$todayhas = C::t('#jameson_fx#jamesonfx_day')->count_today_byuid($_GET['fxuid'],$timestart);
					// 如果没有超过今日限额
					if($todayhas < $_G['jameson_fx']['top'] && !(DB::result_first('SELECT count(*) FROM %t WHERE fxuid=%d AND tid=%d AND ip=%s',array('jamesonfx_fx',$_GET['fxuid'],$_GET['tid'],$_G['clientip'])))){
						// 如今日奖励没超过限制则不进行奖励
						$time = intval($_G['jameson_fx']['time'])*1000;
						$hash = FORMHASH;
						$jsjl =<<<EOF
						<script>
							function jiangli(){
								setTimeout(function(){
									var url = "./plugin.php?id=jameson_fx:"+"ajax&optype=jiangli&formhash={$hash}&fxuid={$_GET['fxuid']}&tid={$_GET['tid']}";
									$.get(url);
								},{$time});
							}
							$(function(){
								jiangli();
							});
						</script>
EOF;
				}
			}
			
		// jiangli end
		// 当前版块是否开启了分享
		if(in_array($_G['fid'],$_G['jameson_fx']['forum']) && $_G['jameson_fx']['enablemobile']){

			$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
			if(preg_match("/fxuid=(\d+)[^\d]/", $url)){
				// 当前链接中存在fxuid 如果当前用户在登录状态则替换
				if($_G['uid']){
					$replacement = '${1}'.$_G['uid'].'${3}';
					$url = preg_replace("/(fxuid=)(\d+)([^\d])/", $replacement, $url);
				}
			}else if(stristr($url,'#') !== false){
				$url = str_replace('#','&fxuid='.$_G['uid'].'#',$url);
			}else{
				$url .= '&fxuid='.$_G['uid'];
			}
			$fxtishi1 = lang('plugin/jameson_fx','fxtishi1');
			$fxtishi2 = lang('plugin/jameson_fx','fxtishi2');
			$jsurl = $url;
			$url = urlencode($url);
			// 是否显示二维码
			if($_G['jameson_fx']['erweima']){
				$img = "<img  src='./plugin.php?id=jameson_fx:ajax&optype=erweima&url=".$url."' />";
			}else{
				$img = '';
			}
			$html = $floatimg = '';
			foreach ($_G['jameson_fx']['shoujibutton'] as $value) {
				if(trim($value) == 'google'){
					$html .= '<a id="google" target="_blank" href="https://plus.google.com/share?url='.$url.'"></a>';
				}else{
					$html .= '<a class="bds_'.$value.'" data-cmd="'.$value.'"></a>';
				}
				if((trim($value) != 'more')  && (trim($value) != 'count') &&(trim($value)!='google') ){
					$floatimg .= "'".$value."',";
				}
			}
			$floatimg = trim($floatimg,',');
			// 查询主题帖子的pid
			// 当前帖子内容信息
			$thethread = DB::fetch_first('SELECT * FROM %t  WHERE position=%d AND tid=%d',array('forum_post',1,$_GET['tid']));
			// 当前帖子的附件信息
			if($aidarray = DB::fetch_first('SELECT * FROM %t WHERE tid=%d AND pid=%d',array('forum_attachment',$_GET['tid'],$thethread['pid']))){
				if($_G['jameson_fx']['otherimg']){
					$imgser = trim($_G['jameson_fx']['otherimg']);
				}else{
					$imgser = 'http://'.$_SERVER['HTTP_HOST'].'/data/attachment/forum/';
				}
				$thethread['image'] = $imgser.DB::result_first('SELECT attachment FROM %t WHERE aid=%d',array('forum_attachment_'.$aidarray['tableid'],$aidarray['aid']));
			}elseif(preg_match("/\[img.*\](http.*)\[/i",$thethread['message'])){
				// 如果没有图片附件，则抓取外链图片
				preg_match("/\[img.*\](http.*)\[/i",$thethread['message'],$matchimg);
				$thethread['image'] = $matchimg[1];
			}else{
				$thethread['image'] = $_G['jameson_fx']['morenimage'];
			}
			// 帖子简介
			$thethread['desc'] = preg_replace(array("/\[[^\]]*\]([^\d]+)\[\/[^\]]+\]/m","/\[[^\]]*\]/m","/\[\/[^\]]+\]/m","/\s*/m","/\n/m","/\r/m","/\d{5,20}/"),array('$1','','','','','',''),$thethread['message']);
			$thethread['desc'] = addslashes(cutstr($thethread['desc'],80,'...'));
			$js =<<<EOF
			<style>
				.jamesonfx_erweima{margin: 10px auto;text-align:center;clear:both;}
				.jamesonfx_erweima p.cl { text-align:center;}
				.jamesonfx_erweima #fenxiangtubiao a {float:none !important; display: inline-block !important;}
				.jamesonfx_erweima #google { background:url('./source/plugin/jameson_fx/images/google.png') no-repeat center center; }
				.jamesonfx_erweima #fxtishiyu a {display:inline !important; background: none !important;float:none;margin:0;padding:0;}
			</style>
			<div id="jameson_fx_mobile" class="jamesonfx_erweima bdsharebuttonbox cl" data-tag="share_1">
				{$img}
				<p class="cl" id="fenxiangtubiao">{$html}</p>
				<p class="cl xs1 xg1" id="fxtishiyu">{$_G['jameson_fx']['tishiyu']}</p>
			</div>
			<script type="text/javascript">
				$(function(){
					$("div[id^=pid]").eq(0).append($("#jameson_fx_mobile"));
				});
				var wxdata = {
					title:"{$_G['thread']['subject']}",
					desc:"{$thethread['desc']}",
					link:'{$jsurl}',
					imgUrl:'{$thethread["image"]}'
				};
			</script>
			<script>
				window._bd_share_config = {
					common : {
						bdText : '{$_G["thread"]["subject"]}',	
						bdDesc : '{$thethread["desc"]}',	
						bdUrl : '{$jsurl}', 	
						bdPic : '{$thethread["image"]}'
					},
					share : [{
						"bdSize" : 32
					}]
				}
				with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
			</script>
EOF;
			$jsweixin = '';
			if($this->is_weixin() && $_G['jameson_fx']['appid'] && $_G['jameson_fx']['appsec']){
				require_once "./source/plugin/jameson_fx/class/Jssdk.class.php";
				$jssdk = new JSSDK($_G['jameson_fx']['appid'], $_G['jameson_fx']['appsec']);
				$signPackage = $jssdk->GetSignPackage();
				$jsweixin=<<<EOF
					<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
					<script>
					    wx.config({
					        debug: {$_G['jameson_fx']['debug']},
					        appId: '{$signPackage["appId"]}',
					        timestamp: {$signPackage["timestamp"]},
					        nonceStr: '{$signPackage["nonceStr"]}',
					        signature: '{$signPackage["signature"]}',
					        jsApiList: [
					            'onMenuShareTimeline',
					            'onMenuShareAppMessage'
					          ]
					    });
					wx.ready(function(){
						
					    wx.onMenuShareAppMessage({
					              title: wxdata.title,
					              desc: wxdata.desc,
					              link: wxdata.link,
					              imgUrl: wxdata.imgUrl,
					              success: function (res) {
					              },
					              cancel: function (res) {
					              }
					    });

			            wx.onMenuShareTimeline({
					              title: wxdata.title,
					              link: wxdata.link,
					              desc: wxdata.desc,
					              imgUrl: wxdata.imgUrl,
					              success: function (res) {
					              },
					              cancel: function (res) {
					              },
					            });
					});
					</script>
EOF;
			}
		}else{
			$js = $jsweixin = '';
		}
		return $jsjl.$js.$jsweixin;
	}
}