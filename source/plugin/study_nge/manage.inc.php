<?php

/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('http://bbs.daozei.net/');
}

define('STUDY_MANAGE_URL', 'plugins&operation=config&do='.$pluginid.'&identifier='.trim($_GET['identifier']).'&pmod=manage');

require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/manage.func.php';
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/pluginvar.func.php';
require DISCUZ_ROOT.'./source/plugin/study_nge/manage/lib/setting_default.php';

$splugin_lang = lang('plugin/study_nge');
$type1314 = in_array($_GET['type1314'], array('common','left', 'middle','right','bottom')) ? $_GET['type1314'] : 'common';

echo '<link href="./source/plugin/study_nge/images/manage.css?'.VERHASH.'" rel="stylesheet" type="text/css" />';
study_subtitle(array(
	array('&#x516C;&#x5171;&#x8BBE;&#x7F6E;', 'common'),
	array('&#x56FE;&#x7247;&#x6A21;&#x5757;', 'left'),
	array('&#x5E16;&#x5B50;&#x6A21;&#x5757;', 'middle'),
	array('&#x4F1A;&#x5458;&#x6A21;&#x5757;', 'right'),
	array('&#x5E95;&#x90E8;&#x6A21;&#x5757;', 'bottom'),
),$type1314);
if($type1314 == 'common'){
	require DISCUZ_ROOT.'./source/plugin/study_nge/manage/manage_common.php';
}else{
	require DISCUZ_ROOT.'./source/plugin/study_nge/manage/manage_mid.php';
}
?>