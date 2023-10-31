<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-16 21:42
 */
function autoload($class){
    static $import = array();
    $class = strtolower($class);
    if(strpos($class, '_') !== false){
        list($folder) = explode('_', $class);
        $file = 'class/'.$folder.'/'.substr($class, strlen($folder) + 1);
    }else{
        $file = 'class/'.$class;
    }
    $key = md5($class);
    if(!isset($import[$key])){
        $path = DISCUZ_ROOT.'source';
        if(strpos($file, '/') !== false){
            $pre = basename(dirname($file));
            $filename = dirname($file).'/'.$pre.'_'.basename($file).'.php';
        }else{
            $filename = $file.'.php';
        }
        if(is_file($path.'/'.$filename)){
            /* core */
            require "$path/$filename";
            $import[$key] = true;
        }else{
            /* plugin */
            $name = explode('\\', $class);
            $path = DISCUZ_ROOT.'source/plugin/'.basename(__DIR__).'/';
            $total = count($name);
            $temp = array();
            for($i = 0; $i < $total; $i++){
                if($i > 2) $temp[] = $name[$i];
            }
            foreach($temp as $k => $v){
                if($k == count($temp) - 1) $path .= ucfirst($temp[$k]).'.class.php';
                else $path .= strtolower($temp[$k]).'/';
            }
            if(file_exists($path)) require "$path";
        }
    }
}
if(function_exists('spl_autoload_register')){
    spl_autoload_register('autoload', '', true);
}else{
    function __autoload($class){
        autoload($class);
    }
}