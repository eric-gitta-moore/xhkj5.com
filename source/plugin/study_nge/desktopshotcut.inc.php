<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

Header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . str_replace(array(',', '"', '&quot;', ';'), array('_', '_', '_'), diconv($_G['setting']['bbname'], CHARSET, 'GBK')) . ".url;");
echo "[InternetShortcut] 
URL=" . $_G['setting']['siteurl'] . "
IDList= 
[{000214A0-0000-0000-C000-000000000046}] 
Prop3=19,2 
";

?>
