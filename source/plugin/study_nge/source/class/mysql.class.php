<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class study_nge_db {
    function fetch_all($sql) {
        $data = array();
        $query = DB::query($sql);
        while ($row = DB::fetch($query)) {
            $data[] = $row;
        }
        DB::free_result($query);
        // print_R($data);
        return $data;
    }
    
    
    function get_att_info($condition, $num, $select_way = '1') {
    	
    	if($select_way == '1'){
    		//图片附件查询方式一
    		return study_nge_db::fetch_all("SELECT i.*,t.subject FROM ".DB::table('forum_threadimage')." i INNER JOIN ".DB::table('forum_thread')." t ON t.tid=i.tid WHERE 1 $condition ORDER BY t.tid DESC LIMIT 0, $num");
    	}else{
    		// 图片附件查询方式二
        $data = $return = $subject_array = $image = array();
        $thread_num = $num * 2;
        $query = DB::query("SELECT tid,subject FROM " . DB::table('forum_thread') . " WHERE 1 $condition ORDER BY tid DESC LIMIT 0, $thread_num");
        while ($row = DB::fetch($query)) {
            $data[] = $row[tid];
            $subject_array[$row[tid]] = $row['subject'];
        }
        DB::free_result($query);

        $in_tids = implode(',', $data);
        if($in_tids) {
            $query = DB::query("SELECT * FROM " . DB::table('forum_threadimage') . " WHERE tid in($in_tids) ORDER BY tid DESC LIMIT 0, $num");
            while ($image = DB::fetch($query)) {
                $image['subject'] = $subject_array[$image['tid']];
                $return[] = $image;
            }
	        	DB::free_result($query);
        }
        return $return;
      }
    }
    // attachment
    // ext_image
    function get_ext_image_info($condition, $num) {
        return study_nge_db::fetch_all("SELECT pid, tid, subject, message FROM " . DB::table('forum_post') . " WHERE 1 $condition ORDER BY pid DESC LIMIT 0, $num");
    }
    // forum_thread
    function forum_thread_fetch_by_tid($tid) {
        return DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid=$tid");
    }
    // forum_post
    // invisible -5删除
    // status 1 屏蔽 2 警告
    function get_thread_info($condition) {
        return study_nge_db::fetch_all("SELECT * FROM " . DB::table('forum_thread') . " WHERE displayorder >=0 AND isgroup <> 1  $condition");
        // return study_nge_db::fetch_all("SELECT * FROM ".DB::table('forum_thread')."t INNER JOIN ".DB::table('forum_post')."p WHERE t.displayorder >=0 AND p.status=0 $condition");
    }
    // forum_forum
    function forum_forum_fetch_by_fid($fid) {
        return DB::result_first("SELECT name FROM " . DB::table('forum_forum') . " WHERE fid=$fid");
    }
    
    // forum_forum
    function get_thread_recpost($num = 10) {
    		$return = array();
        $query = DB::query("SELECT * FROM " . DB::table('study_nge_recpost') . " ORDER BY dateline DESC LIMIT $num");
        while ($row = DB::fetch($query)) {
            $thread = DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid = '$row[tid]' ORDER BY tid DESC");
            $thread['subject'] = $row['subject'];
            $return[] = $thread;
        }
        DB::free_result($query);
        return $return;
    }
    
    // forum_post
    // function get_lastreply_uid($tid) {
    // return DB::result_first("SELECT authorid FROM ".DB::table('forum_post')." WHERE first<>1 AND tid=$tid AND author <> '' AND authorid <> '' ORDER BY pid DESC");
    // }
    function get_member_posts_info($condition) {
        return study_nge_db::fetch_all("select count(f.pid) as num, m.uid, m.username from " . DB::table('forum_post') . " f INNER JOIN " . DB::table('common_member') . " m ON f.authorid =m.uid WHERE 1 $condition");
    }
    // common_member
    function common_member_fetch_all_by_uid($uid) {
        return DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid=$uid ORDER BY uid");
    }
    // 20120717152gt30PCAp7
    function get_newmember_info($condition, $num) {
        return study_nge_db::fetch_all("SELECT uid,username,regdate FROM " . DB::table('common_member') . " WHERE 1 $condition ORDER BY regdate DESC limit 0, $num");
    }
    // common_member_count
    function get_member_online_info($num) {
        return study_nge_db::fetch_all("SELECT uid,oltime FROM " . DB::table('common_member_count') . " ORDER BY oltime DESC limit 0, $num");
    }
    // common_member
    function get_member_credits_info($num) {
        // WHERE groupid not in(4,5,6,7,8,9)
        return study_nge_db::fetch_all("SELECT uid,username,credits FROM " . DB::table('common_member') . " ORDER BY credits DESC limit 0, $num");
    }
    
    function get_member_extcredit_info($num,$extid = 1) {
        return study_nge_db::fetch_all("SELECT uid,extcredits$extid as credits FROM " . DB::table('common_member_count') . " ORDER BY extcredits$extid DESC limit $num");
    }

    function get_membername_by_uid($uid) {
        return DB::result_first("SELECT username FROM " . DB::table('common_member') . " WHERE uid=$uid ORDER BY uid");
    }

    function get_membercredits_by_uid($uid) {
        return DB::result_first("SELECT credits FROM " . DB::table('common_member') . " WHERE uid=$uid ORDER BY uid");
    }
}

?>
