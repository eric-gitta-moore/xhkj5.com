<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
</div>
<?php if(empty($topic) || ($topic['usefooter'])) { $focusid = getfocus_rand($_G[basescript]);?><?php if($focusid !== null) { $focus = $_G['cache']['focus']['data'][$focusid];?><?php $focusnum = count($_G['setting']['focus'][$_G[basescript]]);?><div class="focus" id="sitefocus">
<div class="bm">
<div class="bm_h cl">
<a href="javascript:;" onclick="setcookie('nofocus_<?php echo $_G['basescript'];?>', 1, <?php echo $_G['cache']['focus']['cookie'];?>*3600);$('sitefocus').style.display='none'" class="y" title="关闭">关闭</a>
<h2>
<?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?>
<span id="focus_ctrl" class="fctrl"><img src="<?php echo $_G['style']['styleimgdir'];?>/pic_nv_prev.gif" alt="上一条" title="上一条" id="focusprev" class="cur1" onclick="showfocus('prev');" /> <em><span id="focuscur"></span>/<?php echo $focusnum;?></em> <img src="<?php echo $_G['style']['styleimgdir'];?>/pic_nv_next.gif" alt="下一条" title="下一条" id="focusnext" class="cur1" onclick="showfocus('next')" /></span>
</h2>
</div>
<div class="bm_c" id="focus_con">
</div>
</div>
</div><?php $focusi = 0;?><?php if(is_array($_G['setting']['focus'][$_G['basescript']])) foreach($_G['setting']['focus'][$_G['basescript']] as $id) { ?><div class="bm_c" style="display: none" id="focus_<?php echo $focusi;?>">
<dl class="xld cl bbda">
<dt><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2" target="_blank"><?php echo $_G['cache']['focus']['data'][$id]['subject'];?></a></dt>
<?php if($_G['cache']['focus']['data'][$id]['image']) { ?>
<dd class="m"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" target="_blank"><img src="<?php echo $_G['cache']['focus']['data'][$id]['image'];?>" alt="<?php echo $_G['cache']['focus']['data'][$id]['subject'];?>" /></a></dd>
<?php } ?>
<dd><?php echo $_G['cache']['focus']['data'][$id]['summary'];?></dd>
</dl>
<p class="ptn cl"><a href="<?php echo $_G['cache']['focus']['data'][$id]['url'];?>" class="xi2 y" target="_blank">查看 &raquo;</a></p>
</div><?php $focusi ++;?><?php } ?>
<script type="text/javascript">
var focusnum = <?php echo $focusnum;?>;
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
<?php } ?><?php echo adshow("footerbanner/wp a_f/1");?><?php echo adshow("footerbanner/wp a_f/2");?><?php echo adshow("footerbanner/wp a_f/3");?><?php echo adshow("float/a_fl/1");?><?php echo adshow("float/a_fr/2");?><?php echo adshow("couplebanner/a_fl a_cb/1");?><?php echo adshow("couplebanner/a_fr a_cb/2");?><?php echo adshow("cornerbanner/a_cn");?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer'];?>
<div class="comiis_kmzxk" style="clear:both;"></div>
<?php if($comiis_ff==1) { ?>
<div class="comiis_dibox cl">
<div id="ft" class="wp comiis_foot cl hytj">
<dl>
<dt>关于我们</dt>
<dd><a href="#" target="_blank">关于我们</a></dd>
<dd><a href="plugin.php?id=nimba_linkhelper:addlink" target="_blank">友情链接</a></dd>
<dd><a href="http://wpa.qq.com/msgrd?V=3&amp;uin=2444300667&amp;Site=%20%D1%B6%BB%C3%CD%F8&amp;Menu=yes&amp;from=discuz" target="_blank">联系我们</a></dd>
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
<a href="http://wpa.qq.com/msgrd?V=3&amp;uin=2444300667&amp;Site=%20%D1%B6%BB%C3%CD%F8&amp;Menu=yes&amp;from=discuz" target="_blank">7 x 24小时在线客服</a>
</li>
</ul> 
</div> 
</div>
<div class="comiis_dilogo wp cl">
<div class="comiis_minilogo"><a href="./"><img src="<?php echo IMGDIR;?>/comiis_minilogo.gif" alt="<?php echo $_G['setting']['sitename'];?>"></a></div>
<div class="comiis_dinav"><?php if(is_array($_G['setting']['footernavs'])) foreach($_G['setting']['footernavs'] as $nav) { if($nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) || !$nav['type'] && ($nav['id'] == 'stat' && $_G['group']['allowstatdata'] || $nav['id'] == 'report' && $_G['uid'] || $nav['id'] == 'archiver' || $nav['id'] == 'mobile' || $nav['id'] == 'darkroom'))) { ?><?php echo $nav['code'];?><?php } } ?>
</div>
</div>
</div>
<div class="wp comiis_copyright cl">
<a href="#" target="_blank"><img src="<?php echo IMGDIR;?>/comiis_diico01.gif" alt="诚信网站"></a>
<a href="#" target="_blank"><img src="<?php echo IMGDIR;?>/comiis_diico02.gif" alt="可信网站"></a>
Powered by <a href="http://www.xhkj5.com" target="_blank">讯幻网</a>  &copy; 2008-2017 <a href="<?php echo $_G['setting']['siteurl'];?>" target="_blank"><?php echo $_G['setting']['sitename'];?></a> 版权所有 <?php if($_G['setting']['icp']) { ?><a href="http://www.miitbeian.gov.cn/" rel="nofollow" target="_blank"><?php echo $_G['setting']['icp'];?></a><?php } ?> <?php if($_G['setting']['site_qq']) { ?><a href="http://wpa.qq.com/msgrd?V=3&amp;uin=<?php echo $_G['setting']['site_qq'];?>&amp;Site=<?php echo $_G['setting']['bbname'];?>&amp;Menu=yes&amp;from=discuz" rel="nofollow" target="_blank" title="QQ">客服QQ: <?php echo $_G['setting']['site_qq'];?></a><?php } ?>
&nbsp;技术支持: <A href="http://www.xhkj5.com" target="_blank" title="讯幻网">讯幻网</A>	<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink'];?>
</div>

<div id="ft" class="wp cl comiis_di01 hytj">
<div style="text-align:center;">
<p>
<?php if($_G['setting']['statcode']) { ?><?php echo $_G['setting']['statcode'];?><?php } ?>
</p>
<?php if($_G['adminid']) { ?>
<p class="xs0" style="position:absolute;  left:0; text-align:center; width:100%;">
GMT<?php echo $_G['timenow']['offset'];?>, <?php echo $_G['timenow']['time'];?>
<span id="debuginfo">
<?php if(debuginfo()) { ?>, Processed in <?php echo $_G['debuginfo']['time'];?> second(s), <?php echo $_G['debuginfo']['queries'];?> queries
<?php if($_G['gzipcompress']) { ?>, Gzip On<?php } if(C::memory()->type) { ?>, <?php echo ucwords(C::memory()->type); ?> On<?php } ?>.
<?php } ?>
</span>
</p>
<?php } ?>
</div>
</div>
<?php } updatesession();?><?php if($_G['uid'] && $_G['group']['allowinvisible']) { ?>
<script type="text/javascript">
var invisiblestatus = '<?php if($_G['session']['invisible']) { ?>隐身<?php } else { ?>在线<?php } ?>';
var loginstatusobj = $('loginstatusid');
if(loginstatusobj != undefined && loginstatusobj != null) loginstatusobj.innerHTML = invisiblestatus;
</script>
<?php } } if(!$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if($_G['uid'] && helper_access::check_module('follow') && !isset($_G['cookie']['checkfollow'])) { ?>
<script src="home.php?mod=spacecp&ac=follow&op=checkfeed&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes') { if(check_diy_perm($topic) && (empty($do) || $do != 'index')) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>portal_diy<?php if(!check_diy_perm($topic, 'layout')) { ?>_data<?php } ?>.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($space['self'] && CURMODULE == 'space' && $do == 'index') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } } if($_G['uid'] && $_G['member']['allowadmincp'] == 1 && empty($_G['cookie']['pluginnotice'])) { ?>
<div class="focus plugin" id="plugin_notice"></div>
<script type="text/javascript">pluginNotice();</script>
<?php } if(!$_G['setting']['bbclosed'] && !$_G['member']['freeze'] && !$_G['member']['groupexpiry'] && $_G['setting']['disableipnotice'] != 1 && $_G['uid'] && !empty($_G['cookie']['lip'])) { ?>
<div class="focus plugin" id="ip_notice"></div>
<script type="text/javascript">ipNotice();</script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_GET['do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } if(($_G['member']['newpm'] || $_G['member']['newprompt']) && empty($_G['cookie']['ignore_notice'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>html5notification.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var h5n = new Html5notification();
if(h5n.issupport()) {
<?php if($_G['member']['newpm'] && $_GET['do'] != 'pm') { ?>
h5n.shownotification('pm', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=pm', '<?php echo avatar($_G[uid],small,true);?>', '新的短消息', '有新的短消息，快去看看吧');
<?php } if($_G['member']['newprompt'] && $_GET['do'] != 'notice') { if(is_array($_G['member']['category_num'])) foreach($_G['member']['category_num'] as $key => $val) { $noticetitle = lang('template', 'notice_'.$key);?>h5n.shownotification('notice_<?php echo $key;?>', '<?php echo $_G['siteurl'];?>home.php?mod=space&do=notice&view=<?php echo $key;?>', '<?php echo avatar($_G[uid],small,true);?>', '<?php echo $noticetitle;?> (<?php echo $val;?>)', '有新的提醒，快去看看吧');
<?php } } ?>
}
</script>
<?php } userappprompt();?><?php if($_G['basescript'] != 'userapp') { ?>
<div id="scrolltop">
<?php if($_G['fid'] && $_G['mod'] == 'viewthread') { ?>
<span><a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?><?php if($_GET['from']) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>" onclick="showWindow('reply', this.href)" class="replyfast" title="快速回复"><b>快速回复</b></a></span>
<?php } ?>
<span hidefocus="true"><a title="返回顶部" onclick="window.scrollTo('0','0')" class="scrolltopa" href="javascript:;"><b>返回顶部</b></a></span>
<?php if($_G['fid']) { ?>
<span>
<?php if($_G['mod'] == 'viewthread') { ?>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" hidefocus="true" class="returnlist" title="返回列表"><b>返回列表</b></a>
<?php } else { ?>
<a href="forum.php" hidefocus="true" class="returnboard" title="返回版块"><b>返回版块</b></a>
<?php } ?>
</span>
<?php } ?>
</div>
<script type="text/javascript">_attachEvent(window, 'scroll', function () { new_showTopLink(); });checkBlind();</script>
<?php } if(isset($_G['makehtml'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>html2dynamic.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var html_lostmodify = <?php echo TIMESTAMP;?>;
htmlGetUserStatus();
<?php if(isset($_G['htmlcheckupdate'])) { ?>
htmlCheckUpdate();
<?php } ?>
</script>
<?php } ?>
<script type="text/javascript">
<?php if($comiis_dbss==1) { ?>
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
<?php } ?>
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
</script><?php output();?></body>
</html>