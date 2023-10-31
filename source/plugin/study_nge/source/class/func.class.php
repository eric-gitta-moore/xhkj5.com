<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class study_nge_func {
    function sethighlight($string) {
        $colorarray = array('', '#EE1B2E', '#EE5023', '#996600', '#3C9D40', '#2897C5', '#2B65B7', '#8F2A90', '#EC1282');
        $string = sprintf('%02d', $string);
        $stylestr = sprintf('%03b', $string[0]);
        $highlight = ' style="';
        $highlight .= $stylestr[0] ? 'font-weight: bold;' : '';
        $highlight .= $stylestr[1] ? 'font-style: italic;' : '';
        $highlight .= $stylestr[2] ? 'text-decoration: underline;' : '';
        $highlight .= $string[1] ? 'color: ' . $colorarray[$string[1]] . ';' : '';
        $highlight .= '"';
        return $highlight;
    }
    function deal_thread($thread) {
        global $_G;
        $study_nge = $_G['cache']['plugin']['study_nge'];
        $thread['subject'] = cutstr(strip_tags($thread['subject']), $study_nge['subject_length'], '');
        $thread['dateline'] = gmdate('Y-m-d H:i', $thread['dateline'] + $_G['setting']['timeoffset'] * 3600);
        $thread['lastpost'] = gmdate('Y-m-d H:i', $thread['lastpost'] + $_G['setting']['timeoffset'] * 3600);
        $thread['author'] = strip_tags($thread['author']);
        $thread['lastposter'] = strip_tags($thread['lastposter']);
        if(in_array('home_space', $_G['setting']['rewritestatus'])) {
            $thread['url_lastposter'] = urlencode($thread['lastposter']);
            //!$_G['setting']['rewritecompatible'] && $thread['url_lastposter'] = rawurlencode($thread['url_lastposter']);
        }else {
            $thread['url_lastposter'] = $thread['lastposter'];
        }
        $thread['highlight'] = ($thread['highlight'] && $study_nge['highlight_radio']) ? study_nge_func::sethighlight($thread['highlight']) : '';
        return $thread;
    } 
    // 添加已解决
    // if($threads[fid]==243){
    // $bainfo = DB::fetch_first("SELECT * FROM ".DB::table('study_ba_infos')." WHERE tid='".$threads[tid]."'");
    // 
    // if(!empty($bainfo) && $bainfo[tid] == $threads[tid]){
    // $result['subject'] = cutstr($threads['subject'], $study_nge['subject_length']-6, '');
    // $result['subject'] = 20120717152gt30PCAp7'[<font color=red>已解决</font>]'.$threads['subject'];
    // }else{
    // $result['subject'] = cutstr($threads['subject'], $study_nge['subject_length']-6, '');
    // $result['subject'] = '[<font color=gren>待解决</font>]'.$threads['subject'];
    // }
    // }else{
    // $result['subject'] = cutstr($threads['subject'], $study_nge['subject_length'], '');
    // }
    // $result['subject'] = cutstr(strip_tags($threads['subject']), $study_nge['subject_length'], '');
    function image_thumb($thumb_param) {
        $md5 = md5($thumb_param['filename']);
        $thumbfile_name = 's' . 't' . 'u' . 'd' . 'y' . '_' . 'n' . 'g' . 'e' . '/' . $thumb_param['type'] . '_' . $md5 . '_' . $thumb_param['w'] . '_' . $thumb_param['h'] . '_' . 'P' . 'o' . 'w' . 'e' . 'r' . 'e' . 'd' . '_' . 'b' . 'y' . '_' . 'w' . 'w' . 'w' . '.' . '1' . '3' . '1' . '4' . 's' . 't' . 'u' . 'd' . 'y' . '.' . 'c' . 'o' . 'm' . '.' . 'j' . 'p' . 'g';
        $thumbfile = $thumb_param['attachurl'] . $thumbfile_name;
        if(!file_exists($_G['setting']['attachdir'] . $thumbfile_name)) {
            $img = new image;
            if(!$img->Thumb($thumb_param['filename'], $thumbfile_name, $thumb_param['w'], $thumb_param['h'], $thumb_param['thumbtype'])) {
                $thumbfile = $_G['siteurl'] . 'static/image/common/none.gif';
            }
        }
        return $thumbfile;
    }

    function list_array($fids_show) {
        $result = '';
        if(is_array($fids_show)) {
            $i = '1314';
            foreach ($fids_show as $id => $fid) {
                if(!empty($fid) && $fid) {
                    if($i == '1314') {
                        $result .= $fid;
                        $i = 'DIY';
                    }else {
                        $result .= ',' . $fid;
                    }
                }
            }
        }
        return $result;
    }

    function get_where_fids($fids, $string = ' AND fid IN({fids}) ') {
        global $_G;
        $fids_show = study_nge_func::list_array((array)unserialize($fids));
        if(!$fids_show) {
            $fids_show = study_nge_func::list_array((array)unserialize($_G['cache']['plugin']['study_nge']['fids_show']));
        }
        $where_fids = $fids_show ? str_replace('{fids}', $fids_show, $string) : '';
        return $where_fids;
    }
    function get_where_groupids($groupids, $string = ' AND m.groupid IN({groupids}) ') {
        global $_G;
        $groupids_show = study_nge_func::list_array((array)unserialize($groupids));
        $where_groupids = $groupids_show ? str_replace('{groupids}', $groupids_show, $string) : '';
        return $where_groupids;
    }

    function get_where_tids($tids, $string = ' AND tid IN({tids}) ') {
        global $_G;
        $tids_show = study_nge_func::list_array((array)unserialize($tids));
        $where_tids = $fids_show ? str_replace('{tids}', $tids_show, $string) : '';
        return $where_fids;
    } 
    // 过滤编辑器代码
    function ngethread_messagecutstr($str) {
        global $_G;
        $sppos = strpos($str, chr(0) . chr(0) . chr(0));
        if($sppos !== false) {
            $str = substr($str, 0, $sppos);
        }
        $language = lang('forum/misc'); 
        // print_r($language);
        loadcache(array('bbcodes_display', 'bbcodes', 'smileycodes', 'smilies', 'smileytypes', 'domainwhitelist'));
        $bbcodesclear = 'email|code|free|table|tr|td|img|swf|flash|attach|media|audio|payto' . ($_G['cache']['bbcodes_display'][$_G['groupid']] ? '|' . implode('|', array_keys($_G['cache']['bbcodes_display'][$_G['groupid']])) : '');
        $str = preg_replace(array("/\[hide=?\d*\](.*?)\[\/hide\]/is",
                "/\[quote](.*?)\[\/quote]/si",
                $language['post_edit_regexp'],
                "/\[url=?.*?\](.+?)\[\/url\]/si",
                "/\[($bbcodesclear)=?.*?\].+?\[\/\\1\]/si",
                ), array("[b]$language[post_hidden][/b]",
                '',
                '',
                '\\1',
                '',
                ), $str);
        return trim($str);
    } 
    // 过滤不解析的编辑器代码
    function messagecutstr($str, $length = 0, $dot = ' ...') {
        global $_G;
        $sppos = strpos($str, chr(0) . chr(0) . chr(0));
        if($sppos !== false) {
            $str = substr($str, 0, $sppos);
        }
        $language = lang('forum/misc');
        loadcache(array('bbcodes_display', 'bbcodes', 'smileycodes', 'smilies', 'smileytypes', 'domainwhitelist'));
        $bbcodes = 'b|i|u|p|color|size|font|align|list|indent|float';
        $bbcodesclear = 'email|code|free|table|tr|td|img|swf|flash|attach|media|audio|payto' . ($_G['cache']['bbcodes_display'][$_G['groupid']] ? '|' . implode('|', array_keys($_G['cache']['bbcodes_display'][$_G['groupid']])) : '');
        $str = strip_tags(preg_replace(array("/\[hide=?\d*\](.*?)\[\/hide\]/is",
                    "/\[quote](.*?)\[\/quote]/si",
                    $language['post_edit_regexp'],
                    "/\[url=?.*?\](.+?)\[\/url\]/si",
                    "/\[($bbcodesclear)=?.*?\].+?\[\/\\1\]/si",
                    "/\[($bbcodes)=?.*?\]/i",
                    "/\[\/($bbcodes)\]/i",
                    ), array("[b]$language[post_hidden][/b]",
                    '',
                    '',
                    '\\1',
                    '',
                    '',
                    '',
                    ), $str));
        $str = preg_replace($_G['cache']['smilies']['searcharray'], '', $str);
        return trim($str);
    }

    /**
     * 返回：本年的开始日期的时间戳
     */

    function get_y_start() {
        return mktime(0, 0, 0, 1, 1, date('Y'));
    }

    /**
     * 返回：本日的开始日期的时间戳
     */

    function get_d_start() {
        return mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    }

    /**
     * 返回：本周的开始日期的时间戳
     */

    function get_w_start() {
        $gdate = date("Y-m-d"); 
        // 取得一周的第几天
        $w = date("w", strtotime($gdate)); 
        // 要减去的天数
        $dn = $w ? $w - 1 : 6; 
        // 本周开始日期
        $st = strtotime("$gdate -" . $dn . " days"); 
        // 返回开始
        return $st;
    }

    /**
     * 返回：本月的开始日期的时间戳
     */

    function get_m_start() {
        // date('Y-m-d', mktime(0,0,0,date('m'),1,date('Y')));
        return mktime(0, 0, 0, date('m'), 1, date('Y'));
    }

    /**
     * 返回：返回指定时间段的时间戳
     */

    function get_date($day) {
        if(in_array(strtolower($day), array('y', 'm', 'w', 'd'))) {
            $fuc_name = 'get_' . $day . '_start';
            $return = study_nge_func::$fuc_name();
        }elseif($day == '1314') {
            $return = '0';
        }else {
            $return = intval($day) ? (strtotime(date('Y-m-d', time())) - (intval($day) - 1) * 86400) : '0';
        }
        return $return;
    }

    /**
     * 返回：会员在线状态
     */
    function getonlinemember($uid) {
        global $_G;
        if ($uid && empty($_G['ols'])) {
            $_G['ols'] = array();
            $value = DB::fetch_first("SELECT * FROM " . DB::table('common_session') . " WHERE uid =" . $uid);
            if(!$value['invisible']) {
                $_G['ols'][$uid] = $value['lastactivity'];
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
					fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: ".md5($prefix.$script.'.php'.$cachedata.$_G['config']['security']['authkey'])."\n\n ".'if(!defined(\'IN_DISCUZ\')) {exit(\'Access Denied Powered by www.1314study.com http://www.dqyzbbs.com/\');}'."\n\n$cachedata?>");
					fclose($fp);
				} else {
					exit('Can not write to cache files, please check directory ./data/ and ./data/cache/ .');
				}
		}
    
}

?>
