<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF


EOF;
 if($_G['cookie']['sina_'.$this->pluginid]) { 
$return .= <<<EOF

<div class="fastlg_fm y" style="margin-right: 10px; padding-right: 10px">
<p>
<img src="{$this->adminsettings['imgurl']}/sina_logo_1.png" alt="" style="margin-bottom:-3px;">
<a href="member.php?mod={$_G['setting']['regname']}" class="xi2 xw1">完善账号信息</a>|<a href="member.php?mod=logging&amp;action=login" class="xi2 xw1">绑定账号</a>
</p>
</div>

EOF;
 } elseif(in_array('headerlogin', $this->adminsettings['showoption'])) { 
$return .= <<<EOF

<div class="fastlg_fm y" style="margin-right: 10px; padding-right: 10px">
<p><a href="{$this->adminsettings['initurl']}"><img src="{$this->adminsettings['imgurl']}/weibo_login.png" alt="新浪微博登陆"></a></p>
<p class="hm xg1" style="padding-top: 2px;">只需一步, 快速开始</p>
</div>

EOF;
 } 
$return .= <<<EOF


EOF;
?>