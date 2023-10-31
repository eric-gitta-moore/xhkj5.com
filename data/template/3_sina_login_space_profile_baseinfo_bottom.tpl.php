<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF


EOF;
 if($sinausers) { 
$return .= <<<EOF

<div class="pbm mbm bbda cl">
<h2 class="mbn">ĞÂÀËÎ¢²©ÕËºÅ</h2>
<p class="md_ctrl">
EOF;
 if(is_array($sinausers)) foreach($sinausers as $sinauser) { 
$return .= <<<EOF
<a href="http://weibo.com/u/{$sinauser['sina_uid']}" target="_blank">
<img border="0" src="http://service.t.sina.com.cn/widget/qmd/{$sinauser['sina_uid']}/sdfds/1.png"/>
</a>

EOF;
 } 
$return .= <<<EOF

</p>
</div>

EOF;
 } 
$return .= <<<EOF


EOF;
?>