<?PHP exit('Access Denied');?>
</div>
<!--{if empty($topic) || ($topic[usefooter])}-->
<!--{eval $focusid = getfocus_rand($_G[basescript]);}-->
<!--{if $focusid !== null}-->
	<!--{eval $focus = $_G['cache']['focus']['data'][$focusid];}-->
	<!--{eval $focusnum = count($_G['setting']['focus'][$_G[basescript]]);}-->
	<div class="focus" id="sitefocus">
		<div class="bm">
			<div class="bm_h cl">
				<a href="javascript:;" onclick="setcookie('nofocus_$_G[basescript]', 1, $_G['cache']['focus']['cookie']*3600);$('sitefocus').style.display='none'" class="y" title="{lang close}">{lang close}</a>
				<h2>
					<!--{if $_G['cache']['focus']['title']}-->{$_G['cache']['focus']['title']}<!--{else}-->{lang focus_hottopics}<!--{/if}-->
					<span id="focus_ctrl" class="fctrl"><img src="{$_G['style']['styleimgdir']}/pic_nv_prev.gif" alt="{lang footer_previous}" title="{lang footer_previous}" id="focusprev" class="cur1" onclick="showfocus('prev');" /> <em><span id="focuscur"></span>/$focusnum</em> <img src="{$_G['style']['styleimgdir']}/pic_nv_next.gif" alt="{lang footer_next}" title="{lang footer_next}" id="focusnext" class="cur1" onclick="showfocus('next')" /></span>
				</h2>
			</div>
			<div class="bm_c" id="focus_con">
			</div>
		</div>
	</div>
	<!--{eval $focusi = 0;}-->
	<!--{loop $_G['setting']['focus'][$_G[basescript]] $id}-->
			<div class="bm_c" style="display: none" id="focus_$focusi">
				<dl class="xld cl bbda">
					<dt><a href="{$_G['cache']['focus']['data'][$id]['url']}" class="xi2" target="_blank">$_G['cache']['focus']['data'][$id]['subject']</a></dt>
					<!--{if $_G['cache']['focus']['data'][$id][image]}-->
					<dd class="m"><a href="{$_G['cache']['focus']['data'][$id]['url']}" target="_blank"><img src="{$_G['cache']['focus']['data'][$id]['image']}" alt="$_G['cache']['focus']['data'][$id]['subject']" /></a></dd>
					<!--{/if}-->
					<dd>$_G['cache']['focus']['data'][$id]['summary']</dd>
				</dl>
				<p class="ptn cl"><a href="{$_G['cache']['focus']['data'][$id]['url']}" class="xi2 y" target="_blank">{lang focus_show} &raquo;</a></p>
			</div>
	<!--{eval $focusi ++;}-->
	<!--{/loop}-->
	<script type="text/javascript">
		var focusnum = $focusnum;
		if(focusnum < 2) {
			$('focus_ctrl').style.display = 'none';
		}
		if(!$('focuscur').innerHTML) {
			var randomnum = parseInt(Math.round(Math.random() * focusnum));
			$('focuscur').innerHTML = Math.max(1, randomnum);
		}
		showfocus();
		var focusautoshow = window.setInterval('showfocus(\'next\', 1);', 5000);
	</script>
<!--{/if}-->
<!--{if $_G['uid'] && $_G['member']['allowadmincp'] == 1 && $_G['setting']['showpatchnotice'] == 1}-->
	<div class="focus patch" id="patch_notice"></div>
<!--{/if}-->
<!--{ad/footerbanner/wp a_f/1}--><!--{ad/footerbanner/wp a_f/2}--><!--{ad/footerbanner/wp a_f/3}-->
<!--{ad/float/a_fl/1}--><!--{ad/float/a_fr/2}-->
<!--{ad/couplebanner/a_fl a_cb/1}--><!--{ad/couplebanner/a_fr a_cb/2}-->
<!--{ad/cornerbanner/a_cn}-->
<!--{hook/global_footer}-->
<div class="comiis_kmzxk" style="clear:both;"></div>
<!--{if $comiis_ff==1}-->
<div class="comiis_dibox cl">
	<div id="ft" class="wp comiis_foot cl hytj">
		<dl>
			<dt>关于我们</dt>
			<dd><a href="#" target="_blank">关于我们</a></dd>
			<dd><a href="http://www.xhkj5.com/shenlan_link-flink.html" target="_blank">友情链接</a></dd>
			<dd><a href="http://wpa.qq.com/msgrd?V=3&uin=2444300667&Site=%20%D1%B6%BB%C3%CD%F8&Menu=yes&from=discuz" target="_blank">联系我们</a></dd>
		</dl>
		<dl>
			<dt>帮助中心</dt>
			<dd><a href="#" target="_blank">网友中心</a></dd>
			<dd><a href="#" target="_blank">购买须知</a></dd>
			<dd><a href="#" target="_blank">支付方式</a></dd>
		</dl>
		<dl>
			<dt>服务支持</dt>
			<dd><a href="#" target="_blank">资源下载</a></dd>
			<dd><a href="#" target="_blank">售后服务</a></dd>
			<dd><a href="#" target="_blank">定制流程</a></dd>
		</dl>	
		<dl>
			<dt>关注我们</dt>
			<dd><a href="http://weibo.com/xhkj5" target="_blank" class="kmweibo">官方微博</a></dd>
			<dd><a href="#" target="_blank" class="kmkongjian">官方空间</a></dd>
			<dd><a href="#" target="_blank" class="kmweixin">官方微信</a></dd>
		</dl>
		<div class="comiis_tel">
			<ul>
				<li class="item1">暂无客服电话</li>
				<li class="item2">周一到周日 8:30-20:30 (全年无休)</li>
				<li class="item3 cl">
					<a href="http://wpa.qq.com/msgrd?V=3&uin=2444300667&Site=%20%D1%B6%BB%C3%CD%F8&Menu=yes&from=discuz" target="_blank">7 x 24小时在线客服</a>
				</li>
			</ul> 
		</div> 
	</div>
	<div class="comiis_dilogo wp cl">
		<div class="comiis_minilogo"><a href="./"><img src="{IMGDIR}/comiis_minilogo.gif" alt="{$_G['setting']['sitename']}"></a></div>
		<div class="comiis_dinav">
		<!--{loop $_G['setting']['footernavs'] $nav}--><!--{if $nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) || !$nav['type'] && ($nav['id'] == 'stat' && $_G['group']['allowstatdata'] || $nav['id'] == 'report' && $_G['uid'] || $nav['id'] == 'archiver' || $nav['id'] == 'mobile' || $nav['id'] == 'darkroom'))}-->$nav[code]<!--{/if}--><!--{/loop}-->
		</div>
	</div>
</div>
<div class="wp comiis_copyright cl">
	<a href="#" target="_blank"><img src="{IMGDIR}/comiis_diico01.gif" alt="诚信网站"></a>
	<a href="#" target="_blank"><img src="{IMGDIR}/comiis_diico02.gif" alt="可信网站"></a>
	Powered by <a href="http://www.xhkj5.com" target="_blank">讯幻网</a>  &copy; 2008-2017 <a href="$_G['setting']['siteurl']" rel="nofollow" target="_blank">$_G['setting']['sitename']</a> 版权所有 <!--{if $_G['setting']['icp']}--><a href="http://www.miitbeian.gov.cn/" target="_blank">$_G['setting']['icp']</a><!--{/if}--> <!--{if $_G['setting']['site_qq']}--><a href="http://wpa.qq.com/msgrd?V=3&uin=$_G['setting']['site_qq']&Site=$_G['setting']['bbname']&Menu=yes&from=discuz" target="_blank" title="QQ">客服QQ: {$_G['setting']['site_qq']}</a><!--{/if}-->
	&nbsp;技术支持: <A href="http://www.xhkj5.com" target="_blank" rel="nofollow" title="讯幻网">讯幻网</A>	<!--{hook/global_footerlink}-->
</div>
<div id="ft" class="wp cl comiis_di01 hytj">
	<div id="flk" class="y">
		<p>
			<!--{if $_G['setting']['statcode']}-->$_G['setting']['statcode']<!--{/if}-->
		</p>
		<p class="xs0" style="position:absolute;  left:0; text-align:center; width:100%;">
			{lang time_now}
			<span id="debuginfo">
			<!--{if debuginfo()}-->, Processed in $_G[debuginfo][time] second(s), $_G[debuginfo][queries] queries
				<!--{if $_G['gzipcompress']}-->, Gzip On<!--{/if}--><!--{if C::memory()->type}-->, <!--{echo ucwords(C::memory()->type)}--> On<!--{/if}-->.
			<!--{/if}-->
			</span>
		</p>
	</div>
</div>
<!--{/if}-->
<!--{eval updatesession();}-->
<!--{if $_G['uid'] && $_G['group']['allowinvisible']}-->
<script type="text/javascript">
var invisiblestatus = '<!--{if $_G['session']['invisible']}-->{lang login_invisible_mode}<!--{else}-->{lang login_normal_mode}<!--{/if}-->';
var loginstatusobj = $('loginstatusid');
if(loginstatusobj != undefined && loginstatusobj != null) loginstatusobj.innerHTML = invisiblestatus;
</script>
<!--{/if}-->
<!--{/if}-->
<!--{if !$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry']}-->
<!--{if $_G[uid] && !isset($_G['cookie']['checkpm'])}-->
<script type="text/javascript" src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=$_G[timestamp]"></script>
<!--{/if}-->
<!--{if $_G[uid] && helper_access::check_module('follow') && !isset($_G['cookie']['checkfollow'])}-->
<script type="text/javascript" src="home.php?mod=spacecp&ac=follow&op=checkfeed&rand=$_G[timestamp]"></script>
<!--{/if}-->
<!--{if !isset($_G['cookie']['sendmail'])}-->
<script type="text/javascript" src="home.php?mod=misc&ac=sendmail&rand=$_G[timestamp]"></script>
<!--{/if}-->
<!--{if $_G[uid] && $_G['member']['allowadmincp'] == 1 && !isset($_G['cookie']['checkpatch'])}-->
<script type="text/javascript" src="misc.php?mod=patch&action=checkpatch&rand=$_G[timestamp]"></script>
<!--{/if}-->
<!--{/if}-->
<!--{if $_GET['diy'] == 'yes'}-->
<!--{if check_diy_perm($topic) && (empty($do) || $do != 'index')}-->
	<script type="text/javascript" src="{$_G[setting][jspath]}common_diy.js?{VERHASH}"></script>
	<script type="text/javascript" src="{$_G[setting][jspath]}portal_diy{if !check_diy_perm($topic, 'layout')}_data{/if}.js?{VERHASH}"></script>
<!--{/if}-->
<!--{if $space['self'] && CURMODULE == 'space' && $do == 'index'}-->
	<script type="text/javascript" src="{$_G[setting][jspath]}common_diy.js?{VERHASH}"></script>
	<script type="text/javascript" src="{$_G[setting][jspath]}space_diy.js?{VERHASH}"></script>
<!--{/if}-->
<!--{/if}-->
<!--{if $_G['uid'] && $_G['member']['allowadmincp'] == 1 && $_G['setting']['showpatchnotice'] == 1}-->
<script type="text/javascript">patchNotice();</script>
<!--{/if}-->
<!--{if $_G['uid'] && $_G['member']['allowadmincp'] == 1 && empty($_G['cookie']['pluginnotice'])}-->
<div class="focus plugin" id="plugin_notice"></div>
<script type="text/javascript">pluginNotice();</script>
<!--{/if}-->
<!--{if !$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry'] && $_G['setting']['disableipnotice'] != 1 && $_G['uid'] && !empty($_G['cookie']['lip'])}-->
<div class="focus plugin" id="ip_notice"></div>
<script type="text/javascript">ipNotice();</script>
<!--{/if}-->
<!--{if $_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G[uid]]) || $_G['cookie']['promptstate_'.$_G[uid]] != $_G['member']['newprompt']) && $_GET['do'] != 'notice'}-->
<script type="text/javascript">noticeTitle();</script>
<!--{/if}-->
<!--{if ($_G[member][newpm] || $_G[member][newprompt]) && empty($_G['cookie']['ignore_notice'])}-->
<script type="text/javascript" src="{$_G[setting][jspath]}html5notification.js?{VERHASH}"></script>
<script type="text/javascript">
var h5n = new Html5notification();
if(h5n.issupport()) {
	<!--{if $_G[member][newpm] && $_GET[do] != 'pm'}-->
	h5n.shownotification('pm', '$_G[siteurl]home.php?mod=space&do=pm', '<!--{avatar($_G[uid],small,true)}-->', '{lang newpm_subject}', '{lang newpm_notice_info}');
	<!--{/if}-->
	<!--{if $_G[member][newprompt] && $_GET[do] != 'notice'}-->
			<!--{loop $_G['member']['category_num'] $key $val}-->
				<!--{eval $noticetitle = lang('template', 'notice_'.$key);}-->
				h5n.shownotification('notice_$key', '$_G[siteurl]home.php?mod=space&do=notice&view=$key', '<!--{avatar($_G[uid],small,true)}-->', '$noticetitle ($val)', '{lang newnotice_notice_info}');
			<!--{/loop}-->
	<!--{/if}-->
}
</script>
<!--{/if}-->
<!--{eval userappprompt();}-->
<!--{if $_G['basescript'] != 'userapp'}-->
<div id="scrolltop">
<!--{if $_G[fid] && $_G['mod'] == 'viewthread'}-->
<span><a href="forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]&extra=$_GET[extra]&page=$page{if $_GET[from]}&from=$_GET[from]{/if}" onclick="showWindow('reply', this.href)" class="replyfast" title="{lang fastreply}"><b>{lang fastreply}</b></a></span>
<!--{/if}-->
<span hidefocus="true"><a title="{lang scrolltop}" onclick="window.scrollTo('0','0')" class="scrolltopa" href="javascript:;"><b>{lang scrolltop}</b></a></span>
<!--{if $_G[fid]}-->
<span>
	<!--{if $_G['mod'] == 'viewthread'}-->
	<a href="forum.php?mod=forumdisplay&fid=$_G[fid]" hidefocus="true" class="returnlist" title="{lang return_list}"><b>{lang return_list}</b></a>
	<!--{else}-->
	<a href="forum.php" hidefocus="true" class="returnboard" title="{lang return_forum}"><b>{lang return_forum}</b></a>
	<!--{/if}-->
</span>
<!--{/if}-->
</div>
<script type="text/javascript">_attachEvent(window, 'scroll', function () { new_showTopLink(); });checkBlind();</script>
<!--{/if}-->
<!--{if isset($_G['makehtml'])}-->
<script type="text/javascript" src="{$_G[setting][jspath]}html2dynamic.js?{VERHASH}"></script>
<script type="text/javascript">
	var html_lostmodify = {TIMESTAMP};
	htmlGetUserStatus();
	<!--{if isset($_G['htmlcheckupdate'])}-->
	htmlCheckUpdate();
	<!--{/if}-->
</script>
<!--{/if}-->
<script type="text/javascript">
<!--{if $comiis_dbss==1}-->
_attachEvent(document,'click',function(){hidecomiismenu('comiis_sousuo_menu');});
function hidecomiismenu(id) {
	var menuObj = $(id);
	var menu = $(menuObj.getAttribute('ctrlid'));
	if(ctrlclass = menuObj.getAttribute('ctrlclass')) {
		var reg = new RegExp(' ' + ctrlclass);
		menu.className = menu.className.replace(reg, '');
	}
	menuObj.style.display = 'none';
}
<!--{/if}-->
function new_showTopLink() {
	var ft = $('ft');
	if(ft){
		var scrolltop = $('scrolltop');
		var viewPortHeight = parseInt(document.documentElement.clientHeight);
		var scrollHeight = parseInt(document.body.getBoundingClientRect().top);
		var basew = parseInt(ft.clientWidth);
		var sw = scrolltop.clientWidth;
		if (basew < 1500) {
			var left = parseInt(fetchOffset(ft)['left']);
			left = left < sw ? left * 2 - sw : left;
			scrolltop.style.left = ( basew + left ) + 'px';
		} else {
			scrolltop.style.left = 'auto';
			scrolltop.style.right = 0;
		}
		if (BROWSER.ie && BROWSER.ie < 7) {
			scrolltop.style.top = viewPortHeight - scrollHeight - 150 + 'px';
		}
		if (scrollHeight < -100) {
			scrolltop.style.visibility = 'visible';
		} else {
			scrolltop.style.visibility = 'hidden';
		}
	}
}
if($("myrepeats") && $("comiis_key")){
	$("comiis_key").appendChild($("myrepeats"));
}
if($("qmenu_loop")){
	var qmenu_timer, qmenu_scroll_l;
	var qmenu_in = 0;
	var qmenu_width = 246;
	var qmenu_loop = $('qmenu_loop');
	var qmenu_all_width = 41 * $('qmenu_loopul').getElementsByTagName("li").length - qmenu_width;
	if(qmenu_all_width < 20){
		$('qmenu_an').style.display = 'none';
	}
}
function qmenu_move(qmenu_lr){
	if(qmenu_in == 0 && ((qmenu_lr == 1 && qmenu_loop.scrollLeft < qmenu_all_width) || (qmenu_lr == 0 && qmenu_loop.scrollLeft > 0))){
		qmenu_in = 1;
		qmenu_scroll_l = qmenu_loop.scrollLeft;
		qmenu_timer = setInterval(function(){
			qmenu_scroll(qmenu_lr);
		}, 10);
	}
}
function qmenu_scroll(qmenu_lr){
	if((qmenu_lr == 1 && qmenu_loop.scrollLeft >= qmenu_width + qmenu_scroll_l) || (qmenu_lr == 0 && ((qmenu_loop.scrollLeft <= qmenu_scroll_l - qmenu_width) || qmenu_loop.scrollLeft == 0))){
		clearInterval(qmenu_timer);
		qmenu_in = 0;
	}else{
		if(qmenu_lr == 1){
			qmenu_loop.scrollLeft += Math.round((qmenu_width + qmenu_scroll_l - qmenu_loop.scrollLeft) / 15) + 1;
		}else{
			qmenu_loop.scrollLeft -= Math.round((qmenu_width - (qmenu_scroll_l - qmenu_loop.scrollLeft)) / 15) + 1;
		}
	}
}
</script>
<!--{eval output();}-->
</body>
</html>