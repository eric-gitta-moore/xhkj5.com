<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__CHARSET = CHARSET;$return = <<<EOF


EOF;
 if($this->adminsettings['syncpublish']['forwarding']) { if($this->isbind && $this->adminsettings['sysncpushback']['pushbackshare'] && in_array($_G['uid'], $this->adminsettings['sysncpushback']['pushbackshare_uids'])) { 
$return .= <<<EOF

<a class="oshr" style="background:white url({$this->adminsettings['imgurl']}/icon_logo.png) no-repeat 5px 50%;" href="javascript:void((function(s,d,e,r,l,p,t,z,c,o) {var f='http://service.weibo.com/share/share.php?appkey={$this->adminsettings['appkey']}',u=z||d.location,p=['&amp;url=',e(u),'&amp;title=',e(t||d.title),'&amp;ralateUid=',o||'','&amp;sourceUrl=',e(l),'&amp;content=',c||'{$__CHARSET}','&amp;pic=',e(p||'')].join('');function a(){if(!window.open([f,p].join(''),'mb', ['toolbar=0,status=0,resizable=1,width=440,height=430,left=',(s.width- 440)/2,',top=',(s.height-430)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent)){setTimeout(a,0);}else{a();}}) (screen,document,encodeURIComponent,'','','{$pic_path}','{$title}','','{$__CHARSET}', '{$this->usersettings['defaultsinauid']}'));">分享到新浪微博</a>

EOF;
 } else { 
$return .= <<<EOF

<a class="oshr" style="background:white url({$this->adminsettings['imgurl']}/icon_logo.png) no-repeat 5px 50%;" href="javascript:void((function(s,d,e,r,l,p,t,z,c,o) {var f='http://service.weibo.com/share/share.php?appkey={$this->adminsettings['appkey']}',u=z||d.location,p=['&amp;url=',e(u),'&amp;title=',e(t||d.title),'&amp;ralateUid=',o||'','&amp;sourceUrl=',e(l),'&amp;content=',c||'{$__CHARSET}','&amp;pic=',e(p||'')].join('');function a(){if(!window.open([f,p].join(''),'mb', ['toolbar=0,status=0,resizable=1,width=440,height=430,left=',(s.width- 440)/2,',top=',(s.height-430)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent)){setTimeout(a,0);}else{a();}}) (screen,document,encodeURIComponent,'','','{$pic_path}','{$title}','','{$__CHARSET}', '{$this->usersettings['defaultsinauid']}'));">分享到新浪微博</a>

EOF;
 } } if($syncurl) { 
$return .= <<<EOF

<script type="text/javascript">
EOF;
 if(is_array($syncdata)) foreach($syncdata as $key => $rs) { 
$return .= <<<EOF
var x{$key} = new Ajax();
var data{$key} = '{$rs}';
x{$key}.post('{$syncurl}', data{$key}, function(msg) {});

EOF;
 } 
$return .= <<<EOF

</script>

EOF;
 } 
$return .= <<<EOF


EOF;
?>