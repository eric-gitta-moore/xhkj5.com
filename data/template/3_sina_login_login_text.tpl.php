<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF


EOF;
 if(!$this->isbind && in_array('fastlogin', $this->adminsettings['showoption'])) { 
$return .= <<<EOF

<a href="{$this->adminsettings['initurl']}">
<img src="{$this->adminsettings['imgurl']}/weibo_login.png" alt="ÐÂÀËÎ¢²©µÇÂ½" class="vm">
</a>

EOF;
 } 
$return .= <<<EOF


EOF;
?>