<?php
 if(!defined('IN_DISCUZ')){
 	exit('Access Denied');
 }

$set = $_G['cache']['plugin']['drc_wake'];
$offset = $set['offset'];
$admins = explode(",", $set['admins']);
$notice = $set['notice'];
if($offset != 1){
	showmessage(lang('plugin/drc_wake', 'offset1'));
}elseif($_G['adminid'] != 1){
	showmessage(lang('plugin/drc_wake', 'offset2'));
}elseif(!in_array($_G['uid'], $admins)){
	showmessage(lang('plugin/drc_wake', 'offset3'));
}else{
	if($_G['gp_mod'] == 'send' || empty($_G['gp_mod'])){
		$plugin_nav = lang('plugin/drc_wake', 'nav_send');
		require_once libfile('function/discuzcode');
		$timecycle = intval($_G['gp_timecycle']);
		$waketype = intval($_G['gp_waketype']);
		$stepnum = intval($_G['gp_stepnum']);
		$startnum = intval($_G['gp_startnum']);
		$waketitle = dhtmlspecialchars($_G['gp_waketitle']);
		$wakemessage = discuzcode($_G['gp_wakemessage'], 1, 0, 0, 0, 1, 1, 0, 0, 1);
		if(submitcheck('sendsubmit')){
			if(!in_array($timecycle, array(3,7,10,30,60,90,180))){
				showmessage(lang('plugin/drc_wake', 'senderr_time'), dreferer());
			}elseif(!in_array($waketype, array(1,2,3))){
				showmessage(lang('plugin/drc_wake', 'senderr_type'), dreferer());
			}elseif($stepnum < 1){
				showmessage(lang('plugin/drc_wake', 'senderr_stepnum'), dreferer());
			}elseif(empty($waketitle)){
				showmessage(lang('plugin/drc_wake', 'senderr_waketitle'), dreferer());
			}elseif(empty($wakemessage)){
				showmessage(lang('plugin/drc_wake', 'senderr_waketmessage'), dreferer());
			}else{
				$insertid = DB::insert('drc_wakelog', array('timecycle' => $timecycle, 'waketype' => $waketype, 'operatorid' => $_G['uid'], 'operator' => $_G['member']['username'], 'title' => $waketitle, 'message' => $wakemessage, 'dateline' => TIMESTAMP), 1);
				showmessage(lang('plugin/drc_wake', 'send_message1'), "plugin.php?id=drc_wake:main&mod=send&timecycle={$timecycle}&waketype={$waketype}&startnum=0&stepnum={$stepnum}&insertid={$insertid}");
			}
		}else{

			if($stepnum){
				$typewhere = '';
				if($waketype == 1){
					$typewhere = 'lastvisit';
				}elseif($waketype == 2){
					$typewhere = 'lastactivity';
				}elseif($waketype == 3){
					$typewhere = 'lastpost';
				}
				$insertid = intval($_G['gp_insertid']);
				$sql = "SELECT m.uid, m.username, m.email FROM ".DB::table('common_member_status ')." ms LEFT JOIN ".DB::table('common_member')." m ON ms.uid=m.uid WHERE ms.{$typewhere}<$_G[timestamp] -($timecycle * 86400) LIMIT $startnum,  $stepnum";
				$email = DB::fetch_first("SELECT title, message FROM ".DB::table('drc_wakelog')." WHERE id='$insertid'");
				$query = DB::query($sql);
				$uids = $uid_list = array();
				include_once libfile('function/mail');
				while($uids = DB::fetch($query)){
					sendmail("$uids[username] <$uids[email]>", $email['title'], $email['message']);
					$uid_list[] = $uids['uid'];
				}
				if(count($uid_list) < $stepnum){
					showmessage(lang('plugin/drc_wake', 'sendsuccess'), 'plugin.php?id=drc_wake:main');
				}else{
					$showstart = $startnum+1;
					$showend = $startnum + count($uid_list);
					$startnum += $stepnum;
					$endnum = $startnum+$stepnum;
					showmessage(lang('plugin/drc_wake', 'send_message21').$showstart.' -- '.$showend.lang('plugin/drc_wake', 'send_message22'), "plugin.php?id=drc_wake:main&timecycle={$timecycle}&waketype={$waketype}&startnum={$startnum}&stepnum={$stepnum}&insertid={$insertid}");
				}
			}
		}
	}elseif($_G['gp_mod'] == 'check'){
		$plugin_nav = lang('plugin/drc_wake', 'nav_check');
		if(submitcheck('checksubmit')){
			require_once libfile('function/discuzcode');
			$checkmessage = discuzcode($_G['gp_checkmessage'], 1, 0, 0, 0, 1, 1, 0, 0, 1);
			if(!isemail($_G['gp_checkemail'])){
				showmessage(lang('plugin/drc_wake', 'check_message1'), dreferer());
			}elseif(empty($checkmessage)){
				showmessage(lang('plugin/drc_wake', 'check_message2'), dreferer());
			}else{
				include_once libfile('function/mail');
				sendmail($_G['gp_checkemail'], lang('plugin/drc_wake', 'check_title'), $checkmessage);
				showmessage(lang('plugin/drc_wake', 'check_success'), dreferer());
			}
		}
	}elseif($_G['gp_mod'] == 'log'){
		$plugin_nav = lang('plugin/drc_wake', 'nav_log');
		$page = empty($_G['page']) ? 1 : $_G['page'];
		$perpage = 10;
		$lognum = DB::result_first("SELECT COUNT(*) FROM ".DB::table('drc_wakelog'));
		$start_limit = ($page - 1) * $perpage;
		$multipage = multi($lognum, $perpage, $page, 'plugin.php?id=drc_wake:main&mod=log', 0, 10);
		$sql = "SELECT * FROM ".DB::table('drc_wakelog')." ORDER BY dateline DESC LIMIT $start_limit, $perpage";
		$query = DB::query($sql);
		$loglist = $loglists = array();
		while($loglist = DB::fetch($query)){
			$loglist['dateline'] = dgmdate($loglist['dateline'], 'u');
			$loglist['message'] = addslashes($loglist['message']);
			$loglists[] = $loglist;
		}
	}else{
		showmessage('undefined_action');
	}
	include template('drc_wake:main');
}
?>
