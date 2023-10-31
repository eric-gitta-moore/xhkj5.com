<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

<label><input type="checkbox" name="synctosina" id="synctosina" value="true" class="pc"
EOF;
 if($this->adminsettings['syncpublish']['sync_checked']) { 
$return .= <<<EOF
 checked
EOF;
 } 
$return .= <<<EOF
>
同步到新浪微博<img src="{$this->adminsettings['imgurl']}/icon_logo.png" /></label>

EOF;
?>