<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if($_GET['act']=='save'){

	$catid = intval($_GET['catid']);
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
	$nextlink = "action=plugins&operation=config&do=$pluginid&identifier=xj_remoteimg&pmod=batch_article&act=save&next=$next&pertask=$pertask&starttime=$_GET[starttime]&endtime=$_GET[endtime]&fids=$forums";
	
	$starttime = strtotime($_GET['starttime'].' 00:00:00');
	$endtime = strtotime($_GET['endtime'].' 23:59:59');
	
	if($catid){
		$sql = "and A.catid = $catid";
	}
	
	$counts = DB::result_first("SELECT count(*) FROM ".DB::table('portal_article_title')." A,".DB::table('portal_article_content')." B WHERE A.aid=B.aid AND A.dateline>=$starttime and A.dateline<=$endtime $sql");
	$query = DB::query("SELECT * FROM ".DB::table('portal_article_title')." A,".DB::table('portal_article_content')." B WHERE A.aid=B.aid AND A.dateline>=$starttime and A.dateline<=$endtime $sql LIMIT $current,$pertask");
	while($value = DB::fetch($query)){
		$aid = $value['aid'];
		$content = portal_remoteimg($value['content']);
		DB::query("UPDATE ".DB::table('portal_article_content')." SET content = '$content' WHERE aid=$aid");
	}
	if($current < $counts-1){
		cpmsg("$lang[counter_thread_cover]: ".cplang('counter_processing', array('current' => $current, 'next' => $nextcurrent)), $nextlink, 'loading');
	}else{
		cpmsg(lang('plugin/xj_remoteimg', 'clwb'), 'action=plugins&operation=config&do='.$pluginid.'&identifier=xj_remoteimg&pmod=batch_article', 'succeed');
	}
}



$starttime = dgmdate($_G['timestamp'],'d');
$endtime = dgmdate($_G['timestamp'],'d');
shownav('plugin', lang('plugin/xj_remoteimg', 'yctpzdbdh'), lang('plugin/xj_remoteimg', 'tzplbdh'));
showformheader('plugins&operation=config&do='.$pluginid.'&identifier=xj_remoteimg&pmod=batch_article&act=save&fid='.$fid);

showtableheader('');
echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
include_once libfile('function/portalcp');
showsetting(lang('plugin/xj_remoteimg', 'xzbk'), '', '', category_showselect('portal', 'catid', true, $_GET['catid']));
showsetting(lang('plugin/xj_remoteimg', 'mgxhcltzs'), 'pertask', 5, 'text');
showsetting(lang('plugin/xj_remoteimg', 'xzsjd'),array('starttime', 'endtime'), array($starttime, $endtime),'daterange');
showsubmit('submit',lang('plugin/xj_remoteimg', 'zhixing'));
showtablefooter();


showformfooter();


function portal_remoteimg($message){
	global $_G,$_GET;
	$upload = new discuz_upload();
	$arrayimageurl = $temp = $imagereplace = array();
	$string = $message;
	$downremotefile = true;
	preg_match_all("/\<img.+src=('|\"|)?(.*)(\\1)([\s].*)?\>/ismUe", $string, $temp, PREG_SET_ORDER);
	if(is_array($temp) && !empty($temp)) {
		foreach($temp as $tempvalue) {
			$tempvalue[2] = str_replace('\"', '', $tempvalue[2]);
			if(strlen($tempvalue[2])){
				$arrayimageurl[] = $tempvalue[2];
			}
		}
		$arrayimageurl = array_unique($arrayimageurl);
		if($arrayimageurl) {
			foreach($arrayimageurl as $tempvalue) {
				$imageurl = $tempvalue;
				$imagereplace['oldimageurl'][] = $imageurl;
				$attach['ext'] = $upload->fileext($imageurl);
				if(!$upload->is_image_ext($attach['ext'])) {
					continue;
				}
				$content = '';
				if(preg_match('/^(http:\/\/|\.)/i', $imageurl)) {
					$content = dfsockopen($imageurl);
				} elseif(checkperm('allowdownlocalimg')) {
					if(preg_match('/^data\/(.*?)\.thumb\.jpg$/i', $imageurl)) {
						$content = file_get_contents(substr($imageurl, 0, strrpos($imageurl, '.')-6));
					} elseif(preg_match('/^data\/(.*?)\.(jpg|jpeg|gif|png)$/i', $imageurl)) {
						$content = file_get_contents($imageurl);
					}
				}
				if(empty($content)) continue;
				$temp = explode('/', $imageurl);

				$attach['name'] =  trim($temp[count($temp)-1]);
				$attach['thumb'] = '';

				$attach['isimage'] = $upload -> is_image_ext($attach['ext']);
				$attach['extension'] = $upload -> get_target_extension($attach['ext']);
				$attach['attachdir'] = $upload -> get_target_dir('portal');
				$attach['attachment'] = $attach['attachdir'] . $upload->get_target_filename('portal').'.'.$attach['extension'];
				$attach['target'] = getglobal('setting/attachdir').'./portal/'.$attach['attachment'];

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
				$attachs[] = daddslashes($attach);
			}
		}
	}


	if($attachs) {
		$_GET['conver'] = addslashes(serialize(array('pic'=>'portal/'.$attachs[0]['attachment'], 'thumb'=>$attachs[0]['thumb'], 'remote'=>$attachs[0]['remote'])));
		foreach($attachs as $attach) {
			if($attach['isimage'] && empty($_G['setting']['portalarticleimgthumbclosed'])) {
				require_once libfile('class/image');
				$image = new image();
				$thumbimgwidth = $_G['setting']['portalarticleimgthumbwidth'] ? $_G['setting']['portalarticleimgthumbwidth'] : 300;
				$thumbimgheight = $_G['setting']['portalarticleimgthumbheight'] ? $_G['setting']['portalarticleimgthumbheight'] : 300;
				$attach['thumb'] = $image->Thumb($attach['target'], '', $thumbimgwidth, $thumbimgheight, 2);
				$image->Watermark($attach['target'], '', 'portal');
			}
	
			if(getglobal('setting/ftp/on') && ((!$_G['setting']['ftp']['allowedexts'] && !$_G['setting']['ftp']['disallowedexts']) || ($_G['setting']['ftp']['allowedexts'] && in_array($attach['ext'], $_G['setting']['ftp']['allowedexts'])) || ($_G['setting']['ftp']['disallowedexts'] && !in_array($attach['ext'], $_G['setting']['ftp']['disallowedexts']))) && (!$_G['setting']['ftp']['minsize'] || $attach['size'] >= $_G['setting']['ftp']['minsize'] * 1024)) {
				if(ftpcmd('upload', 'portal/'.$attach['attachment']) && (!$attach['thumb'] || ftpcmd('upload', 'portal/'.getimgthumbname($attach['attachment'])))) {
					@unlink($_G['setting']['attachdir'].'/portal/'.$attach['attachment']);
					@unlink($_G['setting']['attachdir'].'/portal/'.getimgthumbname($attach['attachment']));
					$attach['remote'] = 1;
				} else {
					if(getglobal('setting/ftp/mirror')) {
						@unlink($attach['target']);
						@unlink(getimgthumbname($attach['target']));
						portal_upload_error(lang('portalcp', 'upload_remote_failed'));
					}
				}
			}
	
			$setarr = array(
				'uid' => $_G['uid'],
				'filename' => $attach['name'],
				'attachment' => $attach['attachment'],
				'filesize' => $attach['size'],
				'isimage' => $attach['isimage'],
				'thumb' => $attach['thumb'],
				'remote' => $attach['remote'],
				'filetype' => $attach['extension'],
				'dateline' => $_G['timestamp'],
				'aid' => $aid
			);
			$setarr['attachid'] = C::t('portal_attachment')->insert($setarr, true);
			if($downremotefile) {
				$attach['url'] = ($attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl']).'portal/';
				$imagereplace['newimageurl'][] = $attach['url'].$attach['attachment'];
			}
			//portal_upload_show($setarr);
		}
		if($downremotefile && $imagereplace) {
			//$string = preg_replace(array("/\<(script|style|iframe)[^\>]*?\>.*?\<\/(\\1)\>/si", "/\<!*(--|doctype|html|head|meta|link|body)[^\>]*?\>/si"), '', $string);
			$string = str_replace($imagereplace['oldimageurl'], $imagereplace['newimageurl'], $string);
			//$string = str_replace(array("\r", "\n", "\r\n"), '', addcslashes($string, '/"\\\''));
		}
	}
	return $string;
}

?>