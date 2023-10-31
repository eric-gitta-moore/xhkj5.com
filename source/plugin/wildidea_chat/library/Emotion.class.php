<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-18 11:11
 */
namespace Wildidea\Plugin\Chat\Library;

if(!defined('IN_DISCUZ')) exit('Access Denied');

/**
 * Class Emotion
 * @package Wildidea\Plugin\Chat\Library
 */
class Emotion extends Base{
    /**
     * emotion
     * @var array
     */
    public static $emotion = array();

    /**
     * base path
     * @var string
     */
    public static $basePath;

    /**
     * default emotion
     * @var string
     */
    public static $defaultCate = 'default';

    /**
     * emotion cache file
     * @var string
     */
    public static $cacheFile;

    /**
     * construct
     * Emotion constructor.
     */
    public function __construct(){
        parent::__construct();
        self::initialize();
    }

    /**
     * init
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function initialize(){
        self::$basePath = self::$PL_STATIC.'/images/face';
        self::$emotion = self::$PL_G['emotion_relation'];
        $path = DISCUZ_ROOT.'data/wildidea/'.self::$PL_NAME;
        self::$cacheFile = $path.'/emotion_caches.php';
        if(!is_dir($path)) dmkdir($path);
        if(!file_exists(self::$cacheFile)) file_put_contents(self::$cacheFile, '');
    }

    /**
     * get emotion by category
     * @param string $name
     * @return array
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function getEmotion($name = 'default'){
        $emotions = require self::$cacheFile;
        if($emotions[$name]){
            return $emotions[$name];
        }else{
            return self::setEmotion(true, $name);
        }
    }

    /**
     * set cache ( file )
     * @param bool $isReturn
     * @param string $name
     * @return array
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public static function setEmotion($isReturn = false, $name = 'default'){
        $emotions = array();
        $dirs = glob(DISCUZ_ROOT.self::$basePath.'/*');
        if($dirs){
            foreach($dirs as $dir){
                $name = basename($dir);
                $emotion = self::parseEmotion($name, false);
                $emotions[$name] = $emotion;
            }
            if($emotions){
                file_put_contents(self::$cacheFile, '<?php'.PHP_EOL.'return '.var_export($emotions, true).';');
            }
            if($isReturn && $emotions[$name]) return $emotions[$name];
        }
        return array();
    }

    /**
     * parse emotion
     * @param $name
     * @param bool $default 是否返回默认($name无效的前提下)
     * @return array
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private static function parseEmotion($name, $default = true){
        /* path */
        $path = self::$basePath.'/'.$name;
        if(!is_dir($path)) $path = self::$basePath.'/default';
        $data = $tempCate = $emotion = array();
        /* categories */
        $flagCate = 0;
        $category = explode("\n", self::$PL_G['emotion_category']);
        foreach($category as $k => $v){
            $cate = explode('=', $v);
            if(trim($name) == trim($cate[0])){
                $flagCate = intval($k) + 1;
                $tempCate = $cate;
                break;
            }
        }
        /* return data */
        $data['path'] = $path;
        if($flagCate){
            /* return designated */
            $data['en_name'] = self::clearTag($tempCate[0]);
            $data['cn_name'] = self::clearTag($tempCate[1]);
            /* relationship */
            $tempRelation = explode(',', self::$PL_G['emotion_relation']);
            $tempRelate = $tempRelation[$flagCate - 1];
            if($tempRelate){
                /* has pair */
                $emotions = explode("\n", $tempRelate);
                foreach($emotions as $key => $var){
                    $tempEmotion = explode('=', $var);
                    $emotion[self::clearTag($tempEmotion[0])] = self::clearTag($tempEmotion[1]);
                }
                $data['emotion'] = $emotion;
            }else{
                $data['emotion'] = self::parseExistEmotion(DISCUZ_ROOT.$path.'/*');
            }
        }else{
            if($default){
                /* return default */
                $data['en_name'] = 'default';
                $data['cn_name'] = self::$PL_LANG['default'];
                $data['emotion'] = self::parseExistEmotion(DISCUZ_ROOT.$path.'/*');
            }else{
                $data = array();
            }
        }
        return $data;
    }

    /**
     * parse exist emotion ( non-setting )
     * @param $path
     * @return array
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private static function parseExistEmotion($path){
        $emotion = array();
        $existEmotion = glob($path);
        if($existEmotion){
            foreach($existEmotion as $k => $v){
                $v = str_replace(DISCUZ_ROOT, '', $v);
                $temp = explode('/', $v);
                $emotionName = $temp[count($temp) - 1];
                $tempName = explode('.', $emotionName);
                $emotionName = self::clearTag($tempName[0]);
                $emotion[$emotionName] = $emotionName;
            }
        }
        return $emotion;
    }
}