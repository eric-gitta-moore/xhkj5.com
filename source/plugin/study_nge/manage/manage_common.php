<?php

/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('http://bbs.daozei.net/');
}
if(!submitcheck('editsubmit')) {
    if ($pluginvars) {
        showformheader(STUDY_MANAGE_URL.'&type1314='.$type1314);
        showtableheader();
        showtitle($lang['plugins_config']);
        $extra = array();
        $extra = s_showsettings($pluginvars,$pluginvars_array[$type1314]);
        showsubmit('editsubmit');
        showtablefooter();
        showformfooter();
        echo implode('', $extra);
    }
}else {
		// 入库前处理
    $postdata = daddslashes(dstripslashes($_POST['varsnew']));
		if (is_array($postdata)) {
      foreach ($postdata as $variable => $value) {
        if(isset($pluginvars[$variable])) {
					if($pluginvars[$variable]['type'] == 'number') {
						$value = (float)$value;
					} elseif(in_array($pluginvars[$variable]['type'], array('forums', 'groups', 'selects'))) {
						$value = addslashes(serialize($value));
					}
					DB::query("UPDATE ".DB::table('common_pluginvar')." SET value='$value' WHERE pluginid='$pluginid' AND variable='$variable'");
				}
      }
    }
    updatecache(array('plugin', 'setting', 'styles'));
    cpmsg('plugins_setting_succeed', 'action='.STUDY_MANAGE_URL.'&type1314='.$type1314, 'succeed');
}

?>