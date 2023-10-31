<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-16 21:43
 */
namespace Wildidea\Plugin\Chat\Library;

if(!defined('IN_DISCUZ')) exit('Access Denied');

if(defined('IN_ADMINCP')) loadcache('plugin');

/**
 * Class Base
 * @package Wildidea\Plugin\Chat\Library
 */
class Base{
    /**
     * params
     * @var mixed
     */
    public static $PL_G, $_G, $PL_LIB, $PL_NAME, $PL_URL, $PL_STATIC, $PL_COPYRIGHT, $PL_PREFIX, $PL_TPL, $PL_REMOTE, $PL_LANG;

    /**
     * construct
     * Base constructor.
     */
    public function __construct(){
        self::initialize();
        self::$PL_LANG = self::lang();
    }

    /**
     * init
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function initialize(){
        $pluginDir = explode(DIRECTORY_SEPARATOR, dirname(__DIR__));
        global $_G;
        self::$_G = $_G;
        self::$PL_NAME = trim(end($pluginDir));
        self::$PL_G = self::$_G['cache']['plugin'][self::$PL_NAME];
        self::$PL_COPYRIGHT = 'wildidea';
        self::$PL_PREFIX = 'wi_';
        self::$PL_LIB = 'source/plugin/'.self::$PL_NAME.'/library';
        self::$PL_STATIC = 'source/plugin/'.self::$PL_NAME.'/static';
        self::$PL_URL = 'plugin.php?id='.self::$PL_NAME;
        self::$PL_TPL = 'source/plugin/'.self::$PL_NAME.'/template';
        self::$PL_REMOTE = 'plugin.php?id='.self::$PL_NAME.':api&fh='.FORMHASH.'&mod=';
    }

    /**
     * @param $str
     * @param string $allowable_tags
     * @return string
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function realStripTags($str, $allowable_tags = ''){
        $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
        return strip_tags($str, $allowable_tags);
    }

    /**
     * clear tag
     * @param $text
     * @return string
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function clearTag($text){
        $text = nl2br($text);
        $text = self::realStripTags($text);
        $text = addslashes($text);
        $text = trim($text);
        return $text;
    }

    /**
     * check formhash
     * @param int $ajax
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function checkFormHash($ajax = 0){
        $fh = $_GET['fh'] ? $_GET['fh'] : $_POST['fh'];
        $ajax = isset($_GET['ajax']) ? 1 : $ajax;
        if($fh != formhash()){
            $info['message'] = self::charsetIconv(self::$PL_LANG['overdue']);
            $info['status'] = 0;
            if($ajax) self::returnAjax($info);
            else showMessage($info['message']);
        }
    }

    /**
     * iconv
     * @param $string
     * @param string $inCharset
     * @param string $outCharset
     * @param string $_k
     * @return array|string
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     * @see diconv()
     */
    public static function charsetIconv($string, $inCharset = 'utf-8', $outCharset = CHARSET, $_k = ''){
        if(is_array($string)){
            foreach($string as $k => $v){
                if($_k){
                    $string[$k][$_k] = diconv($v[$_k], $inCharset, $outCharset);
                }else{
                    $string[$k] = diconv($v, $inCharset, $outCharset);
                }
            }
        }else{
            $string = diconv($string, $inCharset, $outCharset);
        }
        return $string;
    }

    /**
     * get avatar by uid
     * @param int $uid
     * @return string
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function getAvatarUrl($uid){
        $url = self::$_G['siteurl'];
        $ucenterUrl = self::$_G['setting']['ucenterurl'];
        $avatar = avatar($uid, 'small', true);
        if(strpos($avatar, 'avatar.php') === false){
            /* static */
            $temp = explode('/', $avatar);
            $openUC = false;
            foreach($temp as $k => $v){
                if(trim($v) == 'uc_server'){
                    $openUC = true;
                    break;
                }
            }
            if($openUC){
                $file = DISCUZ_ROOT.'uc_server'.str_replace($ucenterUrl, '', $avatar);
                if(file_exists($file)){
                    /* non-exist */
                    return str_replace($url, '', $avatar);
                }else{
                    /* return dynamic */
                    return str_replace($url, '', $ucenterUrl.'/avatar.php?uid='.$uid.'&size=small&type=real');
                }
            }else{
                if(file_exists(DISCUZ_ROOT.str_replace($url, '', $avatar))){
                    return str_replace($url, '', $avatar);
                }else{
                    return str_replace($url, '', $ucenterUrl.'/avatar.php?uid='.$uid.'&size=small&type=real');
                }
            }
        }else{
            /* dynamic */
            return str_replace($url, '', $avatar);
        }
    }

    /**
     * get key from array to new array
     * @param $pArray
     * @param string $pKey
     * @param string $pCondition
     * @return array|bool
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function getSubByKey($pArray, $pKey = '', $pCondition = ''){
        $result = array();
        if(is_array($pArray)){
            foreach($pArray as $temp_array){
                if(is_object($temp_array)){
                    $temp_array = (array)$temp_array;
                }
                if(('' != $pCondition && $temp_array[$pCondition[0]] == $pCondition[1]) || '' == $pCondition){
                    $result[] = ('' == $pKey) ? $temp_array : isset($temp_array[$pKey]) ? $temp_array[$pKey] : '';
                }
            }
            return $result;
        }else{
            return false;
        }
    }

    /**
     * get client ip
     * @return mixed
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function getClientIp(){
        $unknown = 'unknown';
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if(false !== strpos($ip, ',')) $ip = reset(explode(',', $ip));
        return $ip;
    }

    /**
     * parse lang
     * @param string $string
     * @param int $key
     * @return array
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function lang($string = '', $key = 0){
        if($key && !$string) return array();
        $setting = $string ? $string : self::$PL_G['lang'];
        $lang = array();
        if($setting){
            $settings = explode("\n", $setting);
            foreach($settings as $k => $v){
                $variable = explode('=', trim($v));
                $lang[trim($variable[0])] = trim($variable[1]);
            }
            if(!$key){
                $lang['extscore'] = self::$_G['setting']['extcredits'][self::$PL_G['consume_type']]['title'];
                $pLang = lang('plugin/'.self::$PL_NAME);
                if(is_array($pLang)) $lang = $lang + $pLang;
            }
        }
        return $lang;
    }

    /**
     * return json - ajax
     * @param array $response
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function returnAjax($response = array()){
        exit(json_encode($response));
    }
}