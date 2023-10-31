<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__CHARSET = CHARSET;$return = <<<EOF


EOF;
 if($this->isbind && $this->adminsettings['sysncpushback']['pushbackshare'] && in_array($_G['uid'], $this->adminsettings['sysncpushback']['pushbackshare_uids'])) { 
$return .= <<<EOF

<a href="javascript:showWindow('sina_repost','plugin.php?id={$this->pluginid}:index&operation=share&tid={$thread['tid']}&do=new');"><i><img src="{$this->adminsettings['imgurl']}/icon_logo.png">分享到新浪微博</i></a>

EOF;
 } else { 
$return .= <<<EOF

<a href="javascript:void((function(s,d,e,r,l,p,t,z,c,o) {var f='http://service.weibo.com/share/share.php?appkey={$this->adminsettings['appkey']}',u=z||d.location,p=['&url=',e(u),'&title=',e(t||d.title),'&ralateUid=',o||'','&sourceUrl=',e(l),'&content=',c||'{$__CHARSET}','&pic=',e(p||'')].join('');function a(){if(!window.open([f,p].join(''),'mb', ['toolbar=0,status=0,resizable=1,width=440,height=430,left=',(s.width- 440)/2,',top=',(s.height-430)/2].join('')))u.href=[f,p].join('');}; if(/Firefox/.test(navigator.userAgent)){setTimeout(a,0);}else{a();}}) (screen,document,encodeURIComponent,'','','{$pic_path}','{$message}','','{$__CHARSET}', '{$this->usersettings['defaultsinauid']}'));" onclick="setTimeout('forstat()', 0);"><i><img src="{$this->adminsettings['imgurl']}/icon_logo.png">分享到新浪微博</i></a>

EOF;
 } 
$return .= <<<EOF


EOF;
?>
