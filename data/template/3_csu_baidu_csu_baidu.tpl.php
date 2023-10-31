<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($bind['status']==1) { ?>
<p class="pbm bbda xi1">您已将本站帐号 <strong><?php echo $_G['member']['username'];?></strong> 与百度帐号绑定</p>
<form action="home.php?mod=spacecp&amp;ac=plugin&amp;id=csu_baidu:csu_baidu" method="post" autocomplete="off" class="mbw bbda">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
<table cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th>绑定的百度帐号</th>
<td>
            <?php echo dhtmlspecialchars($info[username]);?>    </td>
    </tr>
<tr>
<th>绑定时间</th>
<td>
            <?php echo dgmdate($at[3]-$at[2],'dt');?>    </td>
    </tr>
<tr>
<th>有效期</th>
<td>
            <?php echo dgmdate($at[3],'dt');?>&nbsp;<a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=csu_baidu:csu_baidu&amp;formhash=<?php echo FORMHASH;?>&amp;refresh=true" class="xi1" ><strong>点此续期</strong></a>
    </td>
    </tr>
<tr>
<th></th>
<td><img src="http://tb.himg.baidu.com/sys/portrait/item/<?php echo $info['portrait'];?>" /></td>
</tr>
<tr>
<th></th>
<td>
<button type="submit" name="unbindsubmit" value="yes" class="pn pnc" onclick="javascript:confirm('您确定要解除绑定吗？')"><strong>解除绑定</strong></button>
    </td>
    </tr>
    </table>
  </form>
<br />

<?php } else { ?>
<div class="mtw bm2 cl">
<div class="bm2_b bw0 hm" style="padding-top: 70px;">
<a href="csu_baidu.php?mod=login&amp;op=init"><img src="source/plugin/csu_baidu/images/login-long.png" class="vm"/></a>
<p class="mtn xg1">使用百度帐号绑定本站，您可以...</p>
</div>
<div class="bm2_b bm2_b_y bw0">
<dl class="xld">
<h2 class="xi1 xs2">用百度帐号轻松登录</h2>
<dt>无需记住本站的帐号和密码，随时使用百度帐号密码轻松登录</dt>
<dd class="xg1">当前已有<?php echo $count;?>名会员绑定了百度帐号</dd>
</dl>
</div>
</div>
<?php } ?>