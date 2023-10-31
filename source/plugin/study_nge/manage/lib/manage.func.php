<?php

/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('http://bbs.daozei.net/');
}

function study_subtitle($menus, $type, $mid){
	if(is_array($menus)) {
		if(!$mid){
				$actives[$type] = ' class="active"';
				showtableheader('','study_tb');
				$s .='<div class="study_tab study_tab_min">';
				foreach($menus as $k => $menu){
						$s .= '<a href="'.ADMINSCRIPT.'?action='.STUDY_MANAGE_URL.'&type1314='.$menu[1].'" '.$actives[$menu[1]].'><i></i><ins></ins>'.$menu[0].'</a>';
				}                                           
				$s .= '</div>';
				showtablerow('', array(''), array($s));
				showtablefooter();
		}else{
				$actives[$mid] = ' class="current" ';
				showtableheader('', 'study_tb');
				$s = '<div class="study_tab_mid"><ul class="tab1">';
				foreach($menus as $k => $menu){
						$s .= '
						<li '.$actives[$menu[1]].'>
						<a href="'.ADMINSCRIPT.'?action='.STUDY_MANAGE_URL.'&type1314='.$type.'&mid='.$menu[1].'">
						<span>'.$menu[0].'</span>
						</a>
						</li>';
				}
				$s .= '</ul></div>';
				echo "\n".'<tr><th style="height:5px; padding:5px 0 0;"></th></tr>';
				showtitle($s);
				showtablefooter();
		}
	}
}

function s_updatecache($item){
		$file = DISCUZ_ROOT . './data/cache/cache_study_nge_' . $item . '_data.php'; 
		clearstatcache();
		if(file_exists($file)) {
		  $result = @unlink ($file);
		  if ($result == false) {
		      exit('Can not update to cache files, please check directory ./data/ and ./data/cache/ .');
		  }
		}
}

function s_writetocache($script, $cachedata, $prefix = 'cache_') {
	global $_G;

	$dir = DISCUZ_ROOT.'./data/cache/';
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if($fp = @fopen("$dir$prefix$script.php", 'wb')) {
		fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: ".md5($prefix.$script.'.php'.$cachedata.$_G['config']['security']['authkey'])."\n\n$cachedata?>");
		fclose($fp);
	} else {
		exit('Can not write to cache files, please check directory ./data/ and ./data/cache/ .');
	}
}

?>