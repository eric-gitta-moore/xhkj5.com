<?php

/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('http://bbs.daozei.net/');
}

$mid = $_GET['mid'] ? trim($_GET['mid']) : $pluginvars_array['modules'][$type1314][0][1];
if($mid){
	if(strlen($mid) > 40 || !ispluginkey($mid) || !isset($pluginvars_array['mid'][$mid])) {
		cpmsg('&#x6A21;&#x5757;'.$mid.'&#x4E0D;&#x5B58;&#x5728;&#x6216;&#x4E0D;&#x5408;&#x6CD5;', '', 'error');
	}
	if(!submitcheck('editsubmit')) {
	    if ($pluginvars) {
	        showformheader(STUDY_MANAGE_URL.'&type1314='.$type1314.'&mid='.$mid);
		      study_subtitle($pluginvars_array['modules'][$type1314],$type1314,$mid);
		      showtableheader();
	        //showtitle($lang['plugins_config']);
	        $extra = array();
	        $extra = s_showsettings($pluginvars,$pluginvars_array['mid'][$mid]);
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
	    s_updatecache($mid);
	    updatecache(array('plugin', 'setting', 'styles'));
	    cpmsg('plugins_setting_succeed', 'action='.STUDY_MANAGE_URL.'&type1314='.$type1314.'&mid='.$mid, 'succeed');
	}
}else{
	cpmsg('&#x53C2;&#x6570;&#x4E0D;&#x5408;&#x6CD5;&#xFF0C;&#x8BF7;&#x5230;www.1314study.com&#x53CD;&#x9988;', '', 'error');
}
?>