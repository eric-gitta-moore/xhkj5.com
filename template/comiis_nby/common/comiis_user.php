<?PHP exit('Access Denied');?>
<div class="comiis_um cl">
<!--{if $_G['uid']}-->	
	<div class="z comiis_cjpimg"></div>
	<div id="comiis_key" onMouseOver="showMenu({'ctrlid':this.id,'pos':'34!','ctrlclass':'on','duration':2});">
	<a href="home.php?mod=space&uid=$_G[uid]" title="{lang visit_my_space}" target="_blank" class="kmuser"><!--{avatar($_G[uid],small)}--><span>{$_G[member][username]}</span></a>{if $_G[member][newpm] || $_G[member][newprompt]}<span class="kmmsnon"></span>{else}<span class="kmmsn"></span>{/if}
	</div>
<!--{elseif !empty($_G['cookie']['loginuser'])}-->
	<strong><a id="loginuser" class="noborder"><!--{echo dhtmlspecialchars($_G['cookie']['loginuser'])}--></a></strong>
	<a href="member.php?mod=logging&action=login" onclick="showWindow('login', this.href)">{lang activation}</a>
	<a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a>
<!--{elseif !$_G[connectguest]}-->
	<div class="z qqdlico"><!--{hook/global_login_text}--></div>
	<div class="comiis_dlq"><a onclick="showWindow('login', this.href);return false;" href="member.php?mod=logging&action=login">µÇÂ¼</a> | <a href="member.php?mod={$_G[setting][regname]}">$_G['setting']['reglinkname']</a></div>
<!--{else}-->
	<strong class="vwmy qq">{$_G[member][username]}</strong>
	<!--{hook/global_usernav_extra1}-->
	<a href="home.php?mod=spacecp&ac=credit&showcredit=1">{lang credits}: 0</a>
	{lang usergroup}: $_G[group][grouptitle]
	<a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a>
<!--{/if}-->
</div>