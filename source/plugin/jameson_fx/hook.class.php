<?php
// WWW.fx8.cc
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

class plugin_jameson_fx {
	function global_header(){
		global $_G;
		if(!function_exists('init_jamesonfx')){
			require_once './source/plugin/jameson_fx/function/function_jamesonfx.php';
				init_jamesonfx();
		}
		if($_GET['mod']=='viewthread' && $_GET['tid'] && $_G['jameson_fx']['enablepc'] && in_array($_G['fid'],$_G['jameson_fx']['forum']) && in_array($_G['fid'], $_G['jameson_fx']['kejianbankuai']) && !( (!$_G['jameson_fx']['onlyone'] && getcookie('jamesonfx_'.$_GET['tid'].'_'.$_G['uid'])) || ($_G['jameson_fx']['onlyone'] && getcookie('jamesonfx_quanzhan')) ) ){
			// 如果作者不等于当前用户，并且启用了分享后可见，并且当前板块启用了分享可见
			$firstpid = $fxkjjs = '';
			if($_G['jameson_fx']['fenxiangkejian'] && ($_G['uid'] != $_G['thread']['authorid']) && ($firstpid = DB::result_first("SELECT pid FROM %t WHERE tid=%d AND position=%d",array('forum_post',$_G['thread']['tid'],1)))){
				$fxkjjs =<<<EOF
				<style>#postmessage_{$firstpid} {display:none}</style>
				<script>
					_attachEvent(window,'DOMContentLoaded',hidebody);
					function hidebody(){
						var td = document.createElement('td');
						td.innerHTML = '<div class="green message rq ptm pmb xs3" style="width:auto;height:auto;" id="youyincangneirong_div" data-pid="{$firstpid}">{$_G["jameson_fx"]["fxkjmessage"]}</div>';
						td.id="youyincangneirong";
						$("postmessage_{$firstpid}").parentNode.insertBefore(td,$("postmessage_{$firstpid}"));
						}
					</script>
EOF;
				return $fxkjjs;
			}
		}
	}
}
/**
* 
*/
class plugin_jameson_fx_forum extends plugin_jameson_fx
{

	function viewthread_postbottom (){
		global $_G;
		if(!function_exists('init_jamesonfx')){
			require_once './source/plugin/jameson_fx/function/function_jamesonfx.php';
			init_jamesonfx();
		}
		
		// jiagnli start
		$jsjl = '';
		/* 如果
		没有开启pc端 或者 
		当前版块没有开启 或者 
		不存在fxuid 或者 
		fxuid=uid 或者 
		分享者==帖子作者 但没有开启奖励本人
		当前ip等于fxuid最后登录的ip
		($_G['clientip'] == DB::result_first('SELECT lastip FROM %t WHERE uid=%d',array('common_member_status',$_GET['fxuid']) ))
		*/
		if(!$_G['jameson_fx']['enablepc'] || !in_array($_G['fid'],$_G['jameson_fx']['forum']) || (intval($_GET['fxuid'])<1) || ($_GET['fxuid']==$_G['uid']) || (($_GET['fxuid'] == $_G['thread']['authorid']) && !$_G['jameson_fx']['self'] ) || ($_G['clientip'] == DB::result_first('SELECT lastip FROM %t WHERE uid=%d',array('common_member_status',$_GET['fxuid']) )) ){
			$jsjl = '';
		}else{
			// 今日开始时间
			$timestart = dmktime(date('Y-m-d',time()));
			// 本日0点开始已兑换积分数额
			$todayhas = C::t('#jameson_fx#jamesonfx_day')->count_today_byuid($_GET['fxuid'],$timestart);
			// 如今日奖励未超过限制则，并且当前fxuid tid ip没奖励过不进行奖励
			if($todayhas < $_G['jameson_fx']['top'] && !(DB::result_first('SELECT count(*) FROM %t WHERE fxuid=%d AND tid=%d AND ip=%s',array('jamesonfx_fx',$_GET['fxuid'],$_GET['tid'],$_G['clientip'])))){
				$time = intval($_G['jameson_fx']['time'])*1000;
				$hash = FORMHASH;
				$jsjl =<<<EOF
							<script>
								function jiangli(){
									setTimeout(function(){
										var ajax = new Ajax('HTML');
										var url = "./plugin.php?id=jameson_fx:"+"ajax&optype=jiangli&formhash={$hash}&fxuid={$_GET['fxuid']}&tid={$_GET['tid']}";
										ajax.getHTML(url,function(res){
										});
									},{$time});
								}
								_attachEvent(window,'DOMContentLoaded',jiangli);
							</script>
EOF;
			}
	}
			// jiangli end
			// 如果PC端启用了分享并且当前版块启用了分享，则显示分享图标
			if($_G['jameson_fx']['enablepc'] && in_array($_G['fid'],$_G['jameson_fx']['forum'])){
				
				$url = $_G['siteurl'].'forum.php?mod=viewthread&tid='.$_GET['tid'];
				// 当前链接中存在fxuid 如果当前用户在登录状态则替换
				if($_G['uid']){
					$url .= '&fxuid='.$_G['uid'];
				}else{
					$url .= '&fxuid='.intval($_GET['fxuid']);
				}
				$fxtishi1 = lang('plugin/jameson_fx','fxtishi1');
				$fxtishi2 = lang('plugin/jameson_fx','fxtishi2');
				$jsurl = $url;
				$url = urlencode($url);
				// 如果启用了二维码则显示
				if($_G['jameson_fx']['pcerweima']){
					$img = "<img  src='./plugin.php?id=jameson_fx:ajax&optype=erweima&url=".$url."' />";
				}else{
					$img = '';
				}
				$html = $floatimg = '';
				foreach ($_G['jameson_fx']['button'] as $value) {
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
						// 如果开启了远程附件
						if($_G['jameson_fx']['otherimg']){
							$imgser = trim($_G['jameson_fx']['otherimg']);
						}else{
							$imgser = 'http://'.$_SERVER['HTTP_HOST'].'/data/attachment/forum/';
						}
						$thethread['image'] = $imgser.DB::result_first('SELECT attachment FROM %t WHERE aid=%d',array('forum_attachment_'.$aidarray['tableid'],$aidarray['aid']));
					}elseif(preg_match("/\[img.*\](http.*)\[/i",$thethread['message'])){
						// 如果没有图片附件，则抓取外链图片
						preg_match("/\[img.*\](http.*)?\[\/img/i",$thethread['message'],$matchimg);
						$thethread['image'] = $matchimg[1];
					}else{
						$thethread['image'] = $_G['jameson_fx']['morenimage'];
					}
					// 帖子简介
					$thethread['desc'] = preg_replace(array(
						"/\[[^\]]*\]/m",
						"/\[\/[^\]]*\]/m",
						"/\s*/m",
						"/\n*/m",
						"/\r*/m",
						"/\d{5,20}/m",
						"/\t*/m",
						"/(<br.*\/?>)*/mi",
						"/(&nbsp;)/mi",
						"/\[[^\]]*\](\D\W\S)*\[\/[^\]]*\]/m",
						"/[img[^\]][^]]*[\/img]/im",
						"/[url[^\]][^]]*[\/url]/im"),
					array(
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'',
						'$1',
						'',
						''),$thethread['message']);
					$thethread['desc'] = strip_tags($thethread['desc']);
					$thethread['desc'] = addslashes(cutstr($thethread['desc'],200,'...'));
				// 图片分享和划词分享
				if ($_G['jameson_fx']['pcimgfx']){
					$imgfx = ",image : [{
						viewType : 'list',
						viewPos : 'top',
						viewColor : 'black',
						viewSize : '16',
						viewList : [".$floatimg."]
					}]";
				}else{
					$imgfx = '';
				}
				if ($_G['jameson_fx']['pchuaci']){
					$huaci = ',selectShare : [{
					"bdselectMiniList" : ['.$floatimg.']
					}]';
				}else{
					$huaci = '';
				}
				// 如果启用了左右侧分享
				$celan = '';
				if($_G['jameson_fx']['celan'] && !in_array('no',$_G['jameson_fx']['celan'])){
					$celan = ',slide : [';
					if(in_array('left',$_G['jameson_fx']['celan'])){
						$celan .= '{	   
									bdImg : 0,
									bdPos : "left",
									bdTop : 100
								},';
					}
					if(in_array('right',$_G['jameson_fx']['celan'])){
						$celan .= '{
									bdImg : 0,
									bdPos : "right",
									bdTop : 100
								}';
					}
					$celan .= ']';
				}
				// 最新分享者
				$fxusershtml = '';
				if($_G['jameson_fx']['fxusers']){
					$fxusers = C::t('#jameson_fx#jamesonfx_fx')->fetch_new($_G['jameson_fx']['fxusers']);
					if($fxusers){
						$fxusershtml = '<div id="fxusershtml" class="ptm pbm cl wp">';
						foreach ($fxusers as $key => $value) {
							$fxusershtml .= '<a title="'.$value['username'].'" href="./?'.$value['fxuid'].'">'.avatar($value['fxuid'],'small').'<span class="xg1">'.$value['username'].'</span></a>';
						}
						$fxusershtml .= '</div>';
					}
				}
				$_G["thread"]["subject"] = addslashes($_G["thread"]["subject"]);
				$bixufenxiang = lang('plugin/jameson_fx','qingfenxianghouchakan');
				$js =<<<EOF
				<style>
					#p_btn .tshare { display: none !important; }
					.jamesonfx_erweima{margin: 10px auto;text-align:center;clear:both;}
					.jamesonfx_erweima p.cl { text-align:center;}
					.jamesonfx_erweima #fenxiangtubiao a {float:none !important; display: inline-block !important;}
					#postlistreply .jamesonfx_erweima {display: none;}
					.jamesonfx_erweima #google { background:url('./source/plugin/jameson_fx/images/google.png') no-repeat center center; }
					.jamesonfx_erweima #fxtishiyu a {display:inline !important; background: none !important;float:none;margin:0;padding:0;}
					#fxusershtml { background:#f4f5f6;text-align:center;}
					#fxusershtml img {border-radius: 50%;display:block;margin:auto; width:32px;}
					#fxusershtml a { display:inline-block;margin: 3px 5px; text-align:center;}
				</style>
				<div class="mtm mbm  jamesonfx_erweima bdsharebuttonbox cl" data-tag="share_1">
					{$img}
					<p class="cl" id="fenxiangtubiao">{$html}</p>
					<p class="cl xs1 xg1" id="fxtishiyu">{$_G['jameson_fx']['tishiyu']}</p>
				</div>
				{$fxusershtml}
				<script>
					window._bd_share_config = {
						common : {
							bdText : '{$_G["thread"]["subject"]}',	
							bdDesc : '{$thethread["desc"]}',	
							bdUrl : '{$jsurl}',
							bdPic : '{$thethread["image"]}',
							onBeforeClick:function(cmd,config){
								if(cmd=='fbook'){
									config.bdPic = '';
									return config;
								}
							},
							onAfterClick:function(cmd){
							if($("youyincangneirong")){
								$("youyincangneirong_div").innerHTML = "{$bixufenxiang}";
								setTimeout(function(){
									$("youyincangneirong").parentNode.removeChild($("youyincangneirong"));
									$("postmessage_{$thethread['pid']}").setAttribute('style','display:table-cell');
									setcookie('jamesonfx_{$thethread["tid"]}_{$_G["uid"]}','1',{$_G['jameson_fx']['jifenzhong']},'','','');
									setcookie('jamesonfx_quanzhan','1',{$_G['jameson_fx']['jifenzhong']},'','','');
								},15000);
							}
						}
						},
						
						share : [{
							"tag" : "share_1",
							"bdSize" : 32
						},{
							"tag" : "share_2",
							"bdSize" : 16
						}
						]
						{$imgfx}{$huaci}{$celan}
					}
					with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
				</script>
EOF;
			}else{
				// 当前版块没有开启
				$js = '';
			}
			return array($fxkjjs.$jsjl.$js);
		}
		// 显示排行榜
		function viewthread_sidebottom(){
			global $_G;
			if($_G['jameson_fx']['showpaihangbang'] && C::t('#jameson_fx#jamesonfx_fx')->count()){
				$fenxiangs = C::t('#jameson_fx#jamesonfx_fx')->fetch_paihang($_G['jameson_fx']['showpaihangbang']);
				$starttime = dmktime(date('Y-m-d',time()));
				$endtime = dmktime(date('Y-m-d',time()+3600*24));
				$jinris = C::t('#jameson_fx#jamesonfx_day')->fetch_jinri($_G['jameson_fx']['showpaihangbang'],$starttime,$endtime);
				include template("jameson_fx:hook");
				return array($return);
			}
		}
		function forumdisplay_bottom(){
			global $_G;
			if(!function_exists('init_jamesonfx')){
				require_once './source/plugin/jameson_fx/function/function_jamesonfx.php';
			}
			init_jamesonfx();
			if($_G['jameson_fx']['enablepc'] && in_array($_G['fid'],$_G['jameson_fx']['forum'])){
				$css = '<style>
						.previewPost  .jamesonfx_erweima { display:none !important;}
				</style>';
				return $css;
			}
		}
}

class plugin_jameson_fx_home extends plugin_jameson_fx
{
		// 用户个人空间 积分记录
		function spacecp_credit_bottom(){
			global $_G;
			
			$jiangli = lang('plugin/jameson_fx','fenxiangtiezijiangli');
			$js =<<<EOF
			<script>
				function jameson_fx(){
					var alla = $("ct").getElementsByTagName('a');
					for(var i=0,len=alla.length;i<len;i++){
						var href = alla[i].getAttribute('href');
						if(href.length>10 && (/optype=jmd/.test(href))){
							alla[i].setAttribute('href','javascript:;');
							alla[i].innerHTML = '{$jiangli}';
						}
					}
				}
				_attachEvent(window,'load',jameson_fx);
			</script>
EOF;
			return $js;
		}

}

// 门户
class plugin_jameson_fx_portal extends plugin_jameson_fx{
	function view_share_method(){
		// start
		global $_G;
		require_once './source/plugin/jameson_fx/function/function_jamesonfx.php';
		init_jamesonfx();
		// jiagnli start
		$jsjl = '';
		/* 如果
		没有开启pc端 或者 
		当前没有开启门户 或者 
		不存在fxuid 或者 
		fxuid=uid 或者 
		分享者==作者 但没有开启奖励本人
		当前ip等于fxuid最后登录的ip
		($_G['clientip'] == DB::result_first('SELECT lastip FROM %t WHERE uid=%d',array('common_member_status',$_GET['fxuid']) ))
		*/
		// 根据当前aid查询文章信息
		$thearticle = DB::fetch_first('SELECT * FROM %t WHERE aid=%d',array('portal_article_title',$_GET['aid']));
		if(!$_G['jameson_fx']['enablepc'] || !$_G['jameson_fx']['menhu'] || (intval($_GET['fxuid'])<1) || ($_GET['fxuid']==$_G['uid']) || (($_GET['fxuid'] == $thearticle['uid']) && !$_G['jameson_fx']['self'] ) || ($_G['clientip'] == DB::result_first('SELECT lastip FROM %t WHERE uid=%d',array('common_member_status',$_GET['fxuid']) )) ){
			$jsjl = '';
		}else{
			// 今日开始时间
					$timestart = dmktime(date('Y-m-d',time()));
					// 本日0点开始已兑换积分数额
					$todayhas = C::t('#jameson_fx#jamesonfx_day')->count_today_byuid($_GET['fxuid'],$timestart);
					// 如今日奖励未超过限制则，并且当前fxuid aid ip没奖励过不进行奖励
					if($todayhas < $_G['jameson_fx']['top'] && !(DB::result_first('SELECT count(*) FROM %t WHERE fxuid=%d AND aid=%d AND ip=%s',array('jamesonfx_fxpor',$_GET['fxuid'],$_GET['aid'],$_G['clientip'])))){
						$time = intval($_G['jameson_fx']['time'])*1000;
						$hash = FORMHASH;
						$jsjl =<<<EOF
							<script>
								function jiangli(){
									setTimeout(function(){
										var ajax = new Ajax('HTML');
										var url = "./plugin.php?id=jameson_fx:"+"ajax&optype=jiangli&formhash={$hash}&fxuid={$_GET['fxuid']}&aid={$_GET['aid']}";
										ajax.getHTML(url,function(res){
										});
									},{$time});
								}
								_attachEvent(window,'DOMContentLoaded',jiangli);
							</script>
EOF;
					}
		}
			// jiangli end
			// 如果PC端启用了分享并且门户启用了分享，则显示分享图标
			if($_G['jameson_fx']['enablepc'] && $_G['jameson_fx']['menhu']){
				$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
				if(preg_match("/fxuid=(\d+)[^\d]/", $url)){
					$replacement = '${1}'.$_G['uid'].'${3}';
					$url = preg_replace("/(fxuid=)(\d+)([^\d])/", $replacement, $url);
				}else if(stristr($url,'#') !== false){
					$url = str_replace('#','&fxuid='.$_G['uid'].'#',$url);
				}else{
					$url .= '&fxuid='.$_G['uid'];
				}
				$fxtishi1 = lang('plugin/jameson_fx','fxtishi1');
				$fxtishi2 = lang('plugin/jameson_fx','fxtishi2');
				$jsurl = $url;
				$url = urlencode($url);
				// 如果启用了二维码则显示
				if($_G['jameson_fx']['pcerweima']){
					$img = "<img  src='./plugin.php?id=jameson_fx:ajax&optype=erweima&url=".$url."' />";
				}else{
					$img = '';
				}
				$html = $floatimg = '';
				foreach ($_G['jameson_fx']['button'] as $value) {
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
				$thethread = array();
				// 当前帖子的附件信息
				if($thearticle['pic']){
					// 如果开启了远程附件
					if($_G['jameson_fx']['otherimg']){
						$imgser = trim($_G['jameson_fx']['otherimg']);
					}else{
						$imgser = 'http://'.$_SERVER['HTTP_HOST'].'/data/attachment/';
					}
					$thethread['image'] = $imgser.$thearticle['pic'];
				}else{
					$thethread['image'] = $_G['jameson_fx']['morenimage'];
				}
				// 帖子简介
				$thethread['desc'] = $thearticle['summary'];
				// 图片分享和划词分享
				if ($_G['jameson_fx']['pcimgfx']){
					$imgfx = ",image : [{
						viewType : 'list',
						viewPos : 'top',
						viewColor : 'black',
						viewSize : '16',
						viewList : [".$floatimg."]
					}]";
				}else{
					$imgfx = '';
				}
				if ($_G['jameson_fx']['pchuaci']){
					$huaci = ',selectShare : [{
					"bdselectMiniList" : ['.$floatimg.']
					}]';
				}else{
					$huaci = '';
				}
				// 最新分享者
				$fxusershtml = '';
				if($_G['jameson_fx']['fxusers']){
					$fxusers = C::t('#jameson_fx#jamesonfx_fxpor')->fetch_new($_G['jameson_fx']['fxusers']);
					if($fxusers){
						$fxusershtml = '<div id="fxusershtml" class="ptm pbm cl wp">';
						foreach ($fxusers as $key => $value) {
							$fxusershtml .= '<a title="'.$value['username'].'" href="./?'.$value['fxuid'].'">'.avatar($value['fxuid'],'small').'<span class="xg1">'.$value['username'].'</span></a>';
						}
						$fxusershtml .= '</div>';
					}
				}
				$js =<<<EOF
				<style>
					.jamesonfx_erweima{margin: 10px auto;text-align:center;clear:both;}
					.jamesonfx_erweima p.cl { text-align:center;}
					.jamesonfx_erweima #fenxiangtubiao a {float:none !important; display: inline-block !important;}
					#postlistreply .jamesonfx_erweima {display: none;}
					.jamesonfx_erweima #google { background:url('./source/plugin/jameson_fx/images/google.png') no-repeat center center; }
					.jamesonfx_erweima #fxtishiyu a {display:inline !important; background: none !important;float:none;margin:0;padding:0;}
					#fxusershtml { background:#f4f5f6;text-align:center;}
					#fxusershtml img {border-radius: 50%;display:block;margin:auto;}
					#fxusershtml a { display:inline-block;margin: 3px 5px; text-align:center;}
					.tshare strong { display:none;}
				</style>
				<div class="mtm mbm  jamesonfx_erweima bdsharebuttonbox cl" data-tag="share_1">
					{$img}
					<p class="cl" id="fenxiangtubiao">{$html}</p>
					<p class="cl xs1 xg1" id="fxtishiyu">{$_G['jameson_fx']['tishiyu']}</p>
				</div>
				{$fxusershtml}
				<script>
					window._bd_share_config = {
						common : {
							bdText : '{$thearticle["title"]}',	
							bdDesc : '{$thethread["desc"]}',	
							bdUrl : '{$jsurl}',
							bdPic : '{$thethread["image"]}'
						},
						share : [{
							"bdSize" : 32
						}]
						{$imgfx}{$huaci}
					}
					with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
				</script>
EOF;
			}else{
				// 当前版块没有开启
				$js = '';
			}
			return $jsjl.$js;
	}
}