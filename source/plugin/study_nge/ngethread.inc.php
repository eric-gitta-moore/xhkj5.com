<?php

/**
 * [Discuz!] (C)2001-2099 Comsenz Inc.
 *       This is NOT a freeware, use is subject to license terms
 * 
 *       $Id: admincp.inc.php 18582 2010-11-29 07:12:59Z zhugeyun $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$study_nge = $_G['cache']['plugin']['study_nge'];
$tid = intval($_GET[tid]);
if($tid) {
    if($study_nge['threadcard_select2'] == '4') {
        loadcache('forums');
        $post = DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid='$tid'");
        $post['dateline'] = gmdate('Y-m-d H:i', $post['dateline'] + $_G['setting']['timeoffset'] * 3600);
        $post['lastpost'] = gmdate('Y-m-d H:i', $post['lastpost'] + $_G['setting']['timeoffset'] * 3600);
    }else {
        require_once DISCUZ_ROOT . './source/plugin/study_nge/source/class/func.class.php';
        require_once libfile('function/discuzcode');
        loadcache('usergroups');
        $post = DB::fetch_first("SELECT * FROM " . DB::table('forum_post') . " WHERE tid='$tid' AND first=1");
        $post['message'] = study_nge_func::ngethread_messagecutstr(discuzcode(dhtmlspecialchars($post['message']), $post['smileyoff'], $post['bbcodeoff'], '0', '1'));
        $post['message'] = str_replace('&amp;', '&', $post['message']);

        $post['dateline'] = gmdate('Y-m-d H:i', $post['dateline'] + $_G['setting']['timeoffset'] * 3600);
        if($post['tid']) {
            $threadimage = DB::fetch_first("SELECT * FROM " . DB::table('forum_threadimage') . " WHERE tid='$post[tid]'");
            if($threadimage) {
                if($threadimage['remote']) {
                    $post['image'] = '<img src="' . $_G['setting']['ftp']['attachurl'] . 'forum/' . $threadimage['attachment'] . '" alt="" width="268px" />';
                }else {
                    $post['image'] = '<img src="' . $_G['setting']['attachurl'] . 'forum/' . $threadimage['attachment'] . '" alt="" width="268px" />';
                }
            }
            $thread = DB::fetch_first("SELECT views,replies FROM " . DB::table('forum_thread') . " WHERE tid='$post[tid]'");
            $post['views'] = $thread['views'];
            $post['replies'] = $thread['replies'];
        }
        $uid = $post['authorid'];
        if($uid) {
            study_nge_func::getonlinemember($uid);

            $space = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='$uid'");

            $space['group'] = $_G['cache']['usergroups'][$space['groupid']];
            $upgradecredit = $space['uid'] && $space['group']['type'] == 'member' && $space['group']['creditslower'] != 9999999 ? $space['group']['creditslower'] - $space['credits'] : false;
        }
    }
}
$lang = lang('plugin/study_nge');
include template('study_nge:default/thread_card');

?>