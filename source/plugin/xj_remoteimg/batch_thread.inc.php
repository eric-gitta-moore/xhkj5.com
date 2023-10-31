<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if($_GET['act']=='save'){
	if($_GET['fids']){
		$forums = $_GET['fids'];
	}else{
		$forums = implode(",",$_GET['inforum']);
	}
	$updatenum = intval($_GET['updatenum']);
	$pertask = intval($_GET['pertask']); //每个循环数
	$next = intval($_GET['next']);
	if($next){
		$current = $next;
	}else{
		$current = 0;
	}
	$nextcurrent = $current + ($pertask-1);
	$next = $nextcurrent+1;
	$nextlink = "action=plugins&operation=config&do=$pluginid&identifier=xj_remoteimg&pmod=batch_thread&act=save&next=$next&pertask=$pertask&starttime=$_GET[starttime]&endtime=$_GET[endtime]&fids=$forums";
	
	$starttime = strtotime($_GET['starttime'].' 00:00:00');
	$endtime = strtotime($_GET['endtime'].' 23:59:59');
	
	$forums = $forums?$forums:0;
	$counts = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE invisible>=0 and first=1 and dateline>=$starttime and dateline<=$endtime and fid in($forums)");
	$query = DB::query("SELECT * FROM ".DB::table('forum_post')." WHERE invisible>=0 and first=1 and dateline>=$starttime and dateline<=$endtime and fid in($forums) LIMIT $current,$pertask");
	require_once libfile('function/post');
	while($value = DB::fetch($query)){
		$message = remoteimg($value['message'],$value['authorid']);
		$pid = $value['pid'];
		$tid = $value['tid'];
		preg_match_all("/\[attachimg\]\s*([^\[\<\r\n]+?)\s*\[\/attachimg\]/is",$message,$match,PREG_SET_ORDER);
		foreach($match as $items){
			if(empty($attachnew[$items[1]])){
				$attachnew[$items[1]]['description'] = "";
			}
		}
		updateattach(0, $tid, $pid, $attachnew);
		$message = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $message);
		DB::query("UPDATE ".DB::table('forum_post')." SET message = '$message' WHERE pid=$pid");
	}
	if($current < $counts-1){
		cpmsg("$lang[counter_thread_cover]: ".cplang('counter_processing', array('current' => $current, 'next' => $nextcurrent)), $nextlink, 'loading');
	}else{
		cpmsg(lang('plugin/xj_remoteimg', 'clwb'), 'action=plugins&operation=config&do='.$pluginid.'&identifier=xj_remoteimg&pmod=batch_thread', 'succeed');
	}
}



$starttime = dgmdate($_G['timestamp'],'d');
$endtime = dgmdate($_G['timestamp'],'d');
shownav('plugin', lang('plugin/xj_remoteimg', 'yctpzdbdh'), lang('plugin/xj_remoteimg', 'tzplbdh'));
showformheader('plugins&operation=config&do='.$pluginid.'&identifier=xj_remoteimg&pmod=batch_thread&act=save&fid='.$fid);

showtableheader('');
echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
require_once libfile('function/forumlist');
showsetting(lang('plugin/xj_remoteimg', 'xzbk'), '', '', '<select name="inforum[]" multiple="multiple" size="10">'.forumselect(FALSE, 0, 0, TRUE).'</select>');
showsetting(lang('plugin/xj_remoteimg', 'mgxhcltzs'), 'pertask', 5, 'text');
showsetting(lang('plugin/xj_remoteimg', 'xzsjd'),array('starttime', 'endtime'), array($starttime, $endtime),'daterange');
showsubmit('submit',lang('plugin/xj_remoteimg', 'zhixing'));
showtablefooter();


showformfooter();



function remoteimg($message,$uid){
	global $_G;
	$message = str_replace(array("\r", "\n"), array($_GET['wysiwyg'] ? '' : '', "\n"), $message);
	preg_match_all("/\[img\]\s*([^\[\<\r\n]+?)\s*\[\/img\]|\[img=\d{1,4}[x|\,]\d{1,4}\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/is", $message, $image1, PREG_SET_ORDER);
	preg_match_all("/\<img.+src=('|\"|)?(.*)(\\1)([\s].*)?\>/ismUe", $message, $image2, PREG_SET_ORDER);
	$temp = $aids = $existentimg = array();
	if(is_array($image1) && !empty($image1)) {
		foreach($image1 as $value) {
			$temp[] = array(
				'0' => $value[0],
				'1' => trim(!empty($value[1]) ? $value[1] : $value[2])
			);
		}
	}
	if(is_array($image2) && !empty($image2)) {
		foreach($image2 as $value) {
			$temp[] = array(
				'0' => $value[0],
				'1' => trim($value[2])
			);
		}
	}
	require_once libfile('class/image');
	if(is_array($temp) && !empty($temp)) {
		$upload = new discuz_upload();
		$attachaids = array();

		foreach($temp as $value) {
			$imageurl = $value[1];
			$hash = md5($imageurl);
			if(strlen($imageurl)) {
				$imagereplace['oldimageurl'][] = $value[0];
				if(!isset($existentimg[$hash])) {
					$existentimg[$hash] = $imageurl;
					$attach['ext'] = $upload->fileext($imageurl);
					if(!$upload->is_image_ext($attach['ext'])) {
						continue;
					}
					$content = '';
					if(preg_match('/^(http:\/\/|\.)/i', $imageurl)) {
						$content = dfsockopen($imageurl);
					} elseif(preg_match('/^('.preg_quote(getglobal('setting/attachurl'), '/').')/i', $imageurl)) {
						$imagereplace['newimageurl'][] = $value[0];
					}
					if(empty($content)) continue;
					$patharr = explode('/', $imageurl);
					$attach['name'] =  trim($patharr[count($patharr)-1]);
					$attach['thumb'] = '';

					$attach['isimage'] = $upload -> is_image_ext($attach['ext']);
					$attach['extension'] = $upload -> get_target_extension($attach['ext']);
					$attach['attachdir'] = $upload -> get_target_dir('forum');
					$attach['attachment'] = $attach['attachdir'] . $upload->get_target_filename('forum').'.'.$attach['extension'];
					$attach['target'] = getglobal('setting/attachdir').'./forum/'.$attach['attachment'];

					if(!@$fp = fopen($attach['target'], 'wb')) {
						continue;
					} else {
						flock($fp, 2);
						fwrite($fp, $content);
						fclose($fp);
					}
					if(!$upload->get_image_info($attach['target'])) {
						@unlink($attach['target']);
						continue;
					}
					$attach['size'] = filesize($attach['target']);
					$upload->attach = $attach;
					$thumb = $width = 0;
					if($upload->attach['isimage']) {
						if($_G['setting']['thumbsource'] && $_G['setting']['sourcewidth'] && $_G['setting']['sourceheight']) {
							$image = new image();
							$thumb = $image->Thumb($upload->attach['target'], '', $_G['setting']['sourcewidth'], $_G['setting']['sourceheight'], 1, 1) ? 1 : 0;
							$width = $image->imginfo['width'];
							$upload->attach['size'] = $image->imginfo['size'];
						}
						if($_G['setting']['thumbstatus']) {
							$image = new image();
							$thumb = $image->Thumb($upload->attach['target'], '', $_G['setting']['thumbwidth'], $_G['setting']['thumbheight'], $_G['setting']['thumbstatus'], 0) ? 1 : 0;
							$width = $image->imginfo['width'];
						}
						if($_G['setting']['thumbsource'] || !$_G['setting']['thumbstatus']) {
							list($width) = @getimagesize($upload->attach['target']);
						}
						if($_G['setting']['watermarkstatus'] && empty($_G['forum']['disablewatermark'])) {
							$image = new image();
							$image->Watermark($attach['target'], '', 'forum');
							$upload->attach['size'] = $image->imginfo['size'];
						}
					}
					$aids[] = $aid = getattachnewaid();
					$setarr = array(
						'aid' => $aid,
						'dateline' => $_G['timestamp'],
						'filename' => $upload->attach['name'],
						'filesize' => $upload->attach['size'],
						'attachment' => $upload->attach['attachment'],
						'isimage' => $upload->attach['isimage'],
						'uid' => $uid,
						'thumb' => $thumb,
						'remote' => '0',
						'width' => $width
					);
					C::t("forum_attachment_unused")->insert($setarr);
					$attachaids[$hash] = $imagereplace['newimageurl'][] = '[attachimg]'.$aid.'[/attachimg]';

				} else {
					$imagereplace['newimageurl'][] = $attachaids[$hash];
				}
			}
		}
		if(!empty($aids)) {
			require_once libfile('function/post');
		}
		$message = str_replace($imagereplace['oldimageurl'], $imagereplace['newimageurl'], $message);
		//$message = addcslashes($message, '/"');
	}
	return $message;
}

?>