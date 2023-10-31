<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-24 13:22
 */
namespace Wildidea\Plugin\Chat\Library;

if(!defined('IN_DISCUZ')) exit('Access Denied');

/**
 * Class Api
 * @package Wildidea\Plugin\Chat\Library
 */
class Api extends Base{

    /**
     * member cache
     * @var string
     */
    private static $memberCacheFile;
    /**
     * construct
     * Api constructor.
     */
    public function __construct(){
        parent::__construct();
        $path = DISCUZ_ROOT.'data/'.self::$PL_COPYRIGHT.'/'.self::$PL_NAME;
        self::$memberCacheFile = $path.'/member_caches.php';
        if(!is_dir($path)) dmkdir($path);
        if(!file_exists(self::$memberCacheFile)) file_put_contents(self::$memberCacheFile, '');
    }

    /**
     * get latest 50 messages
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function _getMessage(){
        $info['status'] = 1;
        if(self::$_G['uid']){
            $sql = 'SELECT * FROM `'.\DB::table(self::$PL_PREFIX.'chat_content').'` ORDER BY `id` DESC LIMIT 0, 50';
            $data = \DB::fetch_all($sql);
            $data = self::parseMessage($data);
            $info['data'] = $data['data'];
            $info['times'] = $data['times'];
            $info['avatar'] = $data['avatar'];
            $info['latest'] = $data['latest'];
            $info['type'] = 'initialize';
            ksort($info['data']);
        }
        self::returnAjax($info);
    }

    /**
     * parse message(wrap)
     * @param array $data
     * @return array
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private static function parseMessage($data = array()){
        $temp = $showAll = $latest = $avatars = array();
        $current = intval(date('Ymd', TIMESTAMP));
        $memberCache = require self::$memberCacheFile;
        $url = self::$_G['siteurl'];
        foreach($data as $k => $v){
            $v['uid'] = $v['from_uid'];
            $v['uname'] = $v['from_uname'];
            unset($v['from_uid'], $v['from_uname'], $v['ip'], $v['state'], $v['id']);
            if(!$latest[$v['uid']]) $latest[$v['uid']] = $v['content'];
            if(!$avatars[$v['uid']]){
                if($memberCache['data'][$v['uid']]){
                    $avatars[$v['uid']] = $memberCache['data'][$v['uid']]['avatar'];
                }else{
                    $avatar = avatar($v['uid'], 'small', true);
                    $avatars[$v['uid']] = str_replace($url, '', $avatar);
                }
            }
            $ymd = intval(date('Ymd', $v['create_time']));
            $hm = intval(date('Hi', $v['create_time']));
            $key = intval(strval($ymd).sprintf('%04s', $hm));
            $tempData = array($temp[$key-2], $temp[$key-1], $temp[$key+1], $temp[$key+2]);
            if($current != $ymd){
                /* not today - show whole */
                if(!in_array($key, $showAll)){
                    $showAll[] = $key;
                }
            }
            foreach($tempData as $n => $value){
                if($value){
                    $key = $key + ($n > 1 ? $n - 1 : $n - 2);
                    break;
                }
            }
            if(!$temp[$key]) $temp[$key][] = $v;
            else array_unshift($temp[$key], $v);
        }
        return array('data' => $temp, 'avatar' => $avatars, 'latest' => $latest, 'times' => $showAll);
    }

    /**
     * send message
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function _saveMessage(){
        $info['status'] = 0;
        $post = $_POST['data'];
        $uid = intval($post['uid']);
        if(self::$_G['uid'] || $uid){
            $uname = trim($post['uname']);
            $content = self::clearTag($post['content']);
            $data = array(
                'from_uid' => $uid,
                'from_uname' => $uname,
                'content' => $content,
                'ip' => ip2long(self::getClientIp()),
                'create_time' => TIMESTAMP
            );
            $id = \DB::insert(self::$PL_PREFIX.'chat_content', $data, true);
            if($id){
                $info['status'] = 1;
                $info['message'] = self::$PL_LANG['sendSuccess'];
            }else{
                $info['status'] = 0;
                $info['message'] = self::$PL_LANG['sendFailed'];
            }
        }else{
            $info['message'] = self::$PL_LANG['visitorBan'];
        }
        self::returnAjax($info);
    }

    /**
     * join
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function _joinChat(){
        $info['status'] = 0;
        $uid = intval($_POST['uid']);
        if($uid){
            $uname = self::clearTag($_POST['uname']);
            $data = array(
                'user_id' => $uid,
                'user_name' => $uname,
                'ip' => ip2long(self::getClientIp()),
                'create_time' => TIMESTAMP
            );
            $sql = 'SELECT count(*) as `total` FROM `'.\DB::table(self::$PL_PREFIX.'chat_join').'`';
            $count = \DB::fetch_first($sql);
            $total = $count['total'];
            if($total){
                $cache = require self::$memberCacheFile;
                if(!$cache['data'][$uid]){
                    $sql = 'SELECT * FROM `'.\DB::table(self::$PL_PREFIX.'chat_join').'` WHERE `user_id` = '.$uid;
                    $exist = \DB::fetch_first($sql);
                    if(!$exist) \DB::insert(self::$PL_PREFIX.'chat_join', $data);
                    $info['status'] = 1;
                    $info['message'] = self::$PL_LANG['jSuccess'];
                    $cache = $cache['data'] ? $cache : array();
                    self::setMemberCache($data, $cache);
                }else{
                    if($cache['data']){
                        $time = date('Ymd', TIMESTAMP);
                        $cacheTotal = count($cache['data']);
                        if($cacheTotal < $total || intval($time) > $cache['time'] || $total < $cacheTotal){
                            self::setMemberCache();
                        }
                    }else{
                        self::setMemberCache();
                    }
                    $info['status'] = 1;
                    $info['message'] = self::$PL_LANG['uSuccess'];
                }
            }else{
                $id = \DB::insert(self::$PL_PREFIX.'chat_join', $data, true);
                if($id){
                    $info['status'] = 1;
                    $info['message'] = self::$PL_LANG['jSuccess'];
                }
                self::setMemberCache($data);
            }
        }
        self::returnAjax($info);
    }

    /**
     * get latest member
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function _getMember(){
        $cache = require self::$memberCacheFile;
        $data = array(
            'status' => 1,
            'data' => $cache['data'] ? $cache['data'] : array()
        );
        self::returnAjax($data);
    }

    /**
     * set member cache
     * @param array $data
     * @param array $cache
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private static function setMemberCache($data = array(), $cache = array()){
        if(!$data){
            $sql = 'SELECT * FROM `'.\DB::table(self::$PL_PREFIX.'chat_join').'`';
            $data = \DB::fetch_all($sql);
        }
        $member = array();
        $url = self::$_G['siteurl'];
        $ucenterUrl = self::$_G['setting']['ucenterurl'];
        if($data['user_id']){
            $temp = array(
                'uid' => $data['user_id'],
                'uname' => $data['user_name'],
                'avatar' => self::getAvatarUrl($data['user_id'])
            );
            if($cache) $member = $cache;
            $member['data'][$data['user_id']] = $temp;
        }else{
            foreach($data as $k => $v){
                $temp = array(
                    'uid' => $v['user_id'],
                    'uname' => $v['user_name'],
                    'avatar' => self::getAvatarUrl($v['user_id'])
                );
                $member[$v['user_id']] = $temp;
            }
        }
        $input = array(
            'time' => date('Ymd', TIMESTAMP),
            'data' => $member['data'] ? $member['data'] : $member
        );
        file_put_contents(self::$memberCacheFile, '<?php'.PHP_EOL.'return '.var_export($input, true).';');
    }
}