<?PHP exit('Access Denied');?>
<!--{subtemplate common/header}-->
<style id="diy_style" type="text/css"></style>
<!--[diy=comiis_ibox_top]--><div id="comiis_ibox_top" class="area"></div><!--[/diy]-->
<div class="comiis_slider box">
	<!--[diy=comiis_ibox_swf]--><div id="comiis_ibox_swf" class="area"></div><!--[/diy]-->
</div>
<div class="comiis_main cl">
	<div class="comiis_main_l">
		<div class="comiis_main_l_box cl">
			<div class="comiis_irbox_tit cl">
				<span><!--[diy=comiis_izbox_tq]--><div id="comiis_izbox_tq" class="area"></div><!--[/diy]--></span>
				<h2>焦点播报</h2>
			</div>
			<div class="comiis_izbox_hot cl">
				<div class="kmnr">
					<!--[diy=comiis_izbox_hot]--><div id="comiis_izbox_hot" class="area"></div><!--[/diy]-->
				</div>
				<div class="kmimg">
					<!--[diy=comiis_izbox_swf]--><div id="comiis_izbox_swf" class="area"></div><!--[/diy]-->
				</div>
			</div>
			<!--[diy=comiis_izbox_01]--><div id="comiis_izbox_01" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox_tit cl">
				<span><a href="#" target="_blank">更多</a></span>
				<h2>社区精选</h2>
			</div>
			<!--[diy=comiis_isqjx]--><div id="comiis_isqjx" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox_tits cl">
				<ul>				
					<li class="kmon" id="comiis_db_tab_1" onMouseOver="switchTab('comiis_db_tab',1,2,'kmon');"><a href="forum.php?mod=forumdisplay&fid=90" target="_blank">Discuz商业插件</a></li>
					<li id="comiis_db_tab_2" onMouseOver="switchTab('comiis_db_tab',2,2,'kmon');"><a href="forum.php?mod=forumdisplay&fid=93" target="_blank">Discuz模板风格</a></li>
				</ul>
			</div>
			<div class="cl" id="comiis_db_tab_c_1">
				<!--[diy=comiis_wzx]--><div id="comiis_wzx" class="area"></div><!--[/diy]-->
			</div>
			<div class="cl" id="comiis_db_tab_c_2" style="display:none">
				<!--[diy=comiis_izbox_02]--><div id="comiis_izbox_02" class="area"></div><!--[/diy]-->
			</div>
		</div>
	</div>
	<div class="comiis_main_r">	
			<div style="height:95px;overflow:hidden;">	
				<div class="comiis_irbox comiis_irftbtn cl" id="comiis_irftbtn">
					<a href="forum.php?mod=misc&action=nav" onclick="showWindow('nav', this.href, 'get', 0)" class="kmfbzt" title="发表主题"></a>
					<a href="/k_misign-sign.html" target="_blank" class="kmqd" title="签到"><script type="text/javascript">var dfsj = new Date();document.write('周'+'日一二三四五六'.charAt(new Date().getDay())+'<br>'+(dfsj.getMonth()+1)+'月'+dfsj.getDate()+'日');</script></a>
				</div>			
			</div>
			<!--[diy=comiis_irbox_diy01]--><div id="comiis_irbox_diy01" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox comiis_irbox_ss cl">
				<!--[diy=comiis_irbox_video]--><div id="comiis_irbox_video" class="area"></div><!--[/diy]-->
				<!--{if $comiis_navss==0 || $comiis_navss==2}-->
					<div id="sckm">
					<!--{subtemplate common/comiis_navss}-->
					</div>
				<!--{/if}-->
				<!--{if $comiis_navss==2 && $_G['setting']['search'] && $slist}-->
					<ul id="comiis_twtsc_type_menu" class="p_pop" style="display: none;"><!--{echo implode('', $slist);}--></ul>
					<script type="text/javascript">
						initSearchmenu('comiis_twtsc', '$searchparams[url]');
					</script>
				<!--{/if}-->
				<!--{if $comiis_navss==2}-->
				<div id="scbar_hot" class="cl">
					<!--{if $_G['setting']['srchhotkeywords']}-->
						<span class="z">{lang hot_search}：</span>
						<!--{loop $_G['setting']['srchhotkeywords'] $val}-->
							<!--{if $val=trim($val)}-->
								<!--{eval $valenc=rawurlencode($val);}-->
								<!--{block srchhotkeywords[]}-->
									<!--{if !empty($searchparams['params'])}-->
										<!--{eval $srchotquery='';}--> 
										<!--{loop $searchparams['params'] $key $value}--> 
											<!--{eval $srchotquery .= '&' . $key . '=' . rawurlencode($value);}--> 
										<!--{/loop}-->
									<!--{/if}-->
									<!--{if !empty($searchparams[url])}-->
										<a href="$searchparams[url]?q=$valenc&source=hotsearch{$srchotquery}" target="_blank" sc="1">$val</a>
									<!--{else}-->
										<a href="search.php?mod=forum&srchtxt=$valenc&formhash={FORMHASH}&searchsubmit=true&source=hotsearch" target="_blank" sc="1">$val</a>
									<!--{/if}-->
								<!--{/block}-->
							<!--{/if}-->
						<!--{/loop}-->
						<!--{echo implode('', $srchhotkeywords);}-->
					<!--{/if}-->
				</div>
				<!--{/if}-->
			</div>
			<!--[diy=comiis_irbox_diy02]--><div id="comiis_irbox_diy02" class="area"></div><!--[/diy]-->
			<div class="comiis_bkbox">
				<div class="comiis_bkbox_tab">
					<ul>
						<li class="kmon" id="comiis_bkbox_tab1_1" onMouseOver="switchTab('comiis_bkbox_tab1',1,2,'kmon');">版块推荐</li>
						<li id="comiis_bkbox_tab1_2" onMouseOver="switchTab('comiis_bkbox_tab1',2,2,'kmon');">百宝箱</li>
					</ul>
				</div>
				<div id="comiis_bkbox_tab1_c_1" class="comiis_bkbox_list cl">
					<!--[diy=comiis_irbox_02]--><div id="comiis_irbox_02" class="area"></div><!--[/diy]-->
				</div>
				<div id="comiis_bkbox_tab1_c_2" class="comiis_bkbox_list cl" style="display:none">
					<!--[diy=comiis_irbox_03]--><div id="comiis_irbox_03" class="area"></div><!--[/diy]-->
				</div>	
			</div>
			<!--[diy=comiis_irbox_nby07]--><div id="comiis_irbox_nby07" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox cl">
				<div class="comiis_irbox_tit cl" id="comiis_keys">
					<h2>精彩推荐</h2>
				</div>
				<div class="comiis_irbox_jctj cl">
					<!--[diy=comiis_irbox_nbyjctj]--><div id="comiis_irbox_nbyjctj" class="area"></div><!--[/diy]-->
				</div>
				<!--[diy=comiis_irbox_nby00]--><div id="comiis_irbox_nby00" class="area"></div><!--[/diy]-->
			</div>
			<!--[diy=comiis_irbox_nby01]--><div id="comiis_irbox_nby01" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox cl">
				<div class="comiis_irbox_tit cl">
					<span><a href="#" target="_blank">更多</a></span><h2>易编程</h2>
				</div>
				<!--[diy=comiis_irbox_nby02]--><div id="comiis_irbox_nby02" class="area"></div><!--[/diy]-->
			</div>
			<!--[diy=comiis_irbox_nby03]--><div id="comiis_irbox_nby03" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox cl">
				<div class="comiis_irbox_tit cl">
					<span><a href="#" target="_blank">详细</a></span><h2>官方微博</h2>
				</div>
				<!--[diy=comiis_irbox_nby04]--><div id="comiis_irbox_nby04" class="area"></div><!--[/diy]-->
			</div>
			<!--[diy=comiis_irbox_diy04]--><div id="comiis_irbox_diy04" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox">
				<div class="comiis_irbox_tit cl">
					<span><a href="#" target="_blank">更多</a></span><h2>热门活动</h2>
				</div>
				<!--[diy=comiis_irbox_05]--><div id="comiis_irbox_05" class="area"></div><!--[/diy]-->
			</div>
			<!--[diy=comiis_irbox_diy05]--><div id="comiis_irbox_diy05" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox">
				<div class="comiis_irbox_tit cl">
					<span><a href="#" target="_blank">更多</a></span><h2>图片精选</h2>
				</div>
				<div class="comiis_irbox_ssp cl">
					<!--[diy=comiis_irbox_pai]--><div id="comiis_irbox_pai" class="area"></div><!--[/diy]-->
				</div>
			</div>
			<!--[diy=comiis_irbox_diy07]--><div id="comiis_irbox_diy07" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox cl">
				<div class="comiis_irbox_tit cl">
					<span><a href="/forum-57-1.html" target="_blank">更多</a></span><h2>C/C++编程</h2>
				</div>
				<!--[diy=comiis_irbox_07]--><div id="comiis_irbox_07" class="area"></div><!--[/diy]-->	
			</div>			
			<!--[diy=comiis_irbox_diy03]--><div id="comiis_irbox_diy03" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox">
				<div class="comiis_irbox_tit cl">
					<span><a href="#" target="_blank">更多</a></span><h2>精华帖</h2>
				</div>
				<div class="comiis_irbox_list cl">
					<!--[diy=comiis_irbox_04]--><div id="comiis_irbox_04" class="area"></div><!--[/diy]-->
				</div>
			</div>
			<!--[diy=comiis_irbox_nby05]--><div id="comiis_irbox_nby05" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox kmtch cl">
				<div class="comiis_irbox_tit cl">
					<span><a href="group.php" target="_blank">更多</a></span><h2>热门同城会</h2>
				</div>
				<!--[diy=comiis_irbox_nby06]--><div id="comiis_irbox_nby06" class="area"></div><!--[/diy]-->
			</div>
			<!--[diy=comiis_irbox_diy06]--><div id="comiis_irbox_diy06" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox">
				<div class="comiis_irbox_tit cl">
					<span><a href="#" target="_blank">更多</a></span><h2>玩机</h2>
				</div>
				<!--[diy=comiis_irbox_06]--><div id="comiis_irbox_06" class="area"></div><!--[/diy]-->
			</div>
			<!--[diy=comiis_irbox_diy08]--><div id="comiis_irbox_diy08" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox">
				<div class="comiis_irbox_tit cl">
					<span><a href="misc.php?mod=ranklist&type=member" target="_blank">更多</a></span><h2>会员Show</h2>
				</div>
				<div class="comiis_irbox_user cl">
					<!--[diy=comiis_irbox_08]--><div id="comiis_irbox_08" class="area"></div><!--[/diy]-->
				</div>
			</div>
			<!--[diy=comiis_irbox_diy09]--><div id="comiis_irbox_diy09" class="area"></div><!--[/diy]-->
			<div class="comiis_irbox" style="margin-bottom:0;">
				<div class="comiis_irbox_tit cl">
					<span><a href="#" target="_blank">更多</a></span><h2>客服中心</h2>
				</div>
				<div class="comiis_irbox_tel cl">
					<!--[diy=comiis_irbox_tel]--><div id="comiis_irbox_tel" class="area"></div><!--[/diy]-->
				</div>
				<div class="comiis_irbox_qqwb cl">
					<!--[diy=comiis_irbox_qqwb]--><div id="comiis_irbox_qqwb" class="area"></div><!--[/diy]-->
				</div>
				<!--[diy=comiis_irbox_nbyewm]--><div id="comiis_irbox_nbyewm" class="area"></div><!--[/diy]-->
			</div>
			<!--[diy=comiis_irbox_diy10]--><div id="comiis_irbox_diy10" class="area"></div><!--[/diy]-->
		</div>
</div>
<!--[diy=comiis_ibox_ad03]--><div id="comiis_ibox_ad03" class="area"></div><!--[/diy]-->
<div class="comiis_ibox kmmb0 cl">
	<div class="comiis_ibox_tit cl">
		<span><a href="plugin.php?id=nimba_linkhelper:addlink" target="_blank">+ 申请友情链接</a></span><h2>友情链接</h2>
	</div>
	<!--[diy=comiis_ibox_link]--><div id="comiis_ibox_link" class="area"></div><!--[/diy]-->
</div>
<!--[diy=comiis_ibox_ad05]--><div id="comiis_ibox_ad05" class="area"></div><!--[/diy]-->
<script src="{$_G['style']['styleimgdir']}/jquery.min.js" type="text/javascript"></script>
<script src="{$_G['style']['styleimgdir']}/xmSlide.js" type="text/javascript"></script>
<script src="{$_G['style']['styleimgdir']}/responsiveslides.min.js" type="text/javascript"></script>
<!--{eval $topsss = ($comiis_header_fx ? ($comiis_header ? '63' : '50') : '0');}-->
<style>.comiis_btn{top:{$topsss}px;}</style>
<script>
var comiis_irftbtn = $('comiis_irftbtn');
var comiis_irftbtnoffset = parseInt(fetchOffset(comiis_irftbtn)['top']);
_attachEvent(window, 'scroll', function () {
var comiis_scrollTopk = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
if(comiis_scrollTopk >= comiis_irftbtnoffset - {$topsss}){
	comiis_irftbtn.className = 'comiis_irbox comiis_irftbtn cl comiis_btn';
	if (BROWSER.ie && BROWSER.ie < 7) {
		comiis_irftbtn.style.position = 'absolute';
		comiis_irftbtn.style.top = (comiis_scrollTopk + {$topsss}) + 'px';
	}else{
		comiis_irftbtn.style.position = 'fixed';
	}
}else{
	comiis_irftbtn.style.position = 'static';
	comiis_irftbtn.className = 'comiis_irbox comiis_irftbtn cl';
}
});
</script>
<!--{subtemplate common/footer}-->