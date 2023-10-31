<?php
/**
 *	[远程图片自动本地化(xj_remoteimg.{modulename})] (C)2012-2099 Powered by 逍遥设计.
 *	Version: 2.5
 *	Date: 2014-4-8 23:56
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_xj_remoteimg{
	//TODO - Insert your code here
}


class plugin_xj_remoteimg_forum extends plugin_xj_remoteimg{
	function post_xj_remoteimg() {
		global $_G;
			if($_GET['topicsubmit']=='yes' or $_GET['replysubmit']=='yes' or $_GET['editsubmit']==true){

			
				$remote_forums = (array)unserialize($_G['cache']['plugin']['xj_remoteimg']['remote_forums']);
				if(in_array('', $remote_forums)) {
					$remote_forums = array();
				}
				$remote_groups = (array)unserialize($_G['cache']['plugin']['xj_remoteimg']['remote_groups']);
				if(in_array('', $remote_groups)) {
					$remote_groups = array();
				}
				
				
				if(in_array($_GET['fid'],$remote_forums) and in_array($_G['groupid'],$remote_groups)){
					$_GET['message'] = remoteimg($_GET['message']);
					preg_match_all("/\[attachimg\]\s*([^\[\<\r\n]+?)\s*\[\/attachimg\]/is",$_GET['message'],$match,PREG_SET_ORDER);
					foreach($match as $value){
						if(empty($_GET['attachnew'][$value[1]])){
							$_GET['attachnew'][$value[1]]['description'] = "";
						}
					}
				}
			}

	}
}

class plugin_xj_remoteimg_group extends plugin_xj_remoteimg{
	function post_xj_remoteimg() {
		global $_G;
		//print_r($_GET);
			if($_GET['topicsubmit']=='yes' or $_GET['replysubmit']=='yes' or $_GET['editsubmit']==true){
				if($_G['cache']['plugin']['xj_remoteimg']['group_radio']){
					$_GET['message'] = remoteimg($_GET['message']);
					preg_match_all("/\[attachimg\]\s*([^\[\<\r\n]+?)\s*\[\/attachimg\]/is",$_GET['message'],$match,PREG_SET_ORDER);
					foreach($match as $value){
						if(empty($_GET['attachnew'][$value[1]])){
							$_GET['attachnew'][$value[1]]['description'] = "";
						}
					}
				}
			}
	}
}

class plugin_xj_remoteimg_home extends plugin_xj_remoteimg{
	function spacecp_blog_xj_remoteimg(){
		global $_G;
		if($_GET['blogsubmit']){
			if($_G['cache']['plugin']['xj_remoteimg']['blog_radio']){
				$_POST['message'] = portal_remoteimg($_POST['message']);
			}
		}
	}
}


class plugin_xj_remoteimg_portal extends plugin_xj_remoteimg{
	function portalcp_xj_remoteimg(){
		global $_G;
		if($_GET['articlesubmit']){
			if($_G['cache']['plugin']['xj_remoteimg']['portal_radio']){
				$_POST['content'] = portal_remoteimg($_POST['content']);
			}
		}
	}
}




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


function remoteimg($message){
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
						'uid' => $_G['uid'],
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