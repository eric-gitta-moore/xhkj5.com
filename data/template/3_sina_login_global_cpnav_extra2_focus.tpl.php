<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

<iframe scrolling="no" border="0" width="{$this->adminsettings['weibofollow']['focus_width']}" height="22" style="padding:1px 0 0 0" class="z" frameborder="0" allowtransparency="true"  src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&amp;width={$this->adminsettings['weibofollow']['focus_width']}&amp;height=22&amp;uid={$this->adminsettings['weibofollow']['officialuid']}&amp;style={$this->adminsettings['weibofollow']['focus_style']}&amp;btn=
EOF;
 if($this->adminsettings['weibofollow']['focus_color']) { 
$return .= <<<EOF
red
EOF;
 } else { 
$return .= <<<EOF
light
EOF;
 } 
$return .= <<<EOF
&amp;dpc=1"></iframe>

EOF;
?>
