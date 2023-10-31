<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * From www.1314study.com
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT . './source/plugin/study_nge/source/class/func.class.php';
require_once DISCUZ_ROOT . './source/plugin/study_nge/source/class/mysql.class.php';
require_once DISCUZ_ROOT . './source/plugin/study_nge/source/class/get_data.class.php';

$splugin_setting = $_G['cache']['plugin']['study_nge'];
$splugin_lang = lang('plugin/study_nge');
$recpost_admin_gids = (array)unserialize($splugin_setting['recpost_admin_gids']);

if(in_array($_G['groupid'],$recpost_admin_gids)){
	require_once DISCUZ_ROOT . './source/plugin/study_nge/source/class/func.class.php';
	$tid = intval($_GET['tid']); 
  // 参数校验
  $thread = DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid = '$tid'");
  if($thread) {
      $recpost_fids = (array)unserialize($splugin_setting['recpost_fids']);
      if( !(empty($recpost_fids[0]) && count($recpost_fids) < 2) ){
      	if(!in_array($thread['fid'],$recpost_fids)) {
          showmessage($splugin_lang['slang_002']);
      	}
      }
  }else {
      showmessage($splugin_lang['slang_003']);
  }
	
	if(!submitcheck('setrecpostsubmit')) {
		$s_recpost = DB::fetch_first("SELECT * FROM " . DB::table('study_nge_recpost') . " WHERE tid = '$tid'");
		$s_recpost = dhtmlspecialchars(dstripslashes($s_recpost));
		include template('study_nge:recpost');
	}else{

    $subject = $_POST['subject'] ? $_POST['subject'] : $thread[subject];
		$data = array(
			'tid' => $tid,
			'uid' => $thread[authorid],
			'username' => daddslashes(dstripslashes($thread[author])),
			'subject' => daddslashes(dstripslashes($subject)),
		);

		$recposttid = DB::result_first("SELECT tid FROM " . DB::table('study_nge_recpost') . " WHERE tid = '$tid'");
		if($recposttid) {
			if($_POST['recpost_radio']){
					if($_POST['recpost_top']){
							$data['dateline'] = $_G['timestamp'];
					}
					DB::update('study_nge_recpost', $data, "tid='$tid'");
					study_nge::updatecache('recpost');
					showmessage($splugin_lang['slang_004'], dreferer());
			}else{
					DB::delete('study_nge_recpost', "tid='$tid'");
					study_nge::updatecache('recpost');
					showmessage($splugin_lang['slang_005'], dreferer());
			}
		}else{
				$data['dateline'] = $_G['timestamp'];
				DB::insert('study_nge_recpost', $data);
				study_nge::updatecache('recpost');
				if($_POST['recpost_send']){
						notification_add($thread['authorid'], 'system', str_replace(array('{tid}','{subject}'),array($thread[tid],dhtmlspecialchars($thread[subject])),$splugin_lang['slang_001']), '', 1);
				}
				showmessage($splugin_lang['slang_006'], dreferer());
		}
		
	}
}else{
	showmessage($splugin_lang['slang_007']);
}
?>