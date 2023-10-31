<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-24 13:24
 */
if(!defined('IN_DISCUZ')) exit('Access Denied');
require 'global.php';
$mod = trim($_GET['mod']) ? trim($_GET['mod']) : (trim($_POST['mod']) ? trim($_POST['mod']) : 'run');
$act = trim($_GET['act']) ? trim($_GET['act']) : (trim($_POST['act']) ? trim($_POST['act']) : 'init');
$info['status'] = 0;
$func = '_'.lcfirst($act).ucfirst($mod);
$params = isset($_POST) ? $_POST : array();
if(!$_G['uid']){
    $info['message'] = $PL_LANG['noLogin'];
    $api::returnAjax($info);
}
if(!method_exists($api, $func)){
    $info['message'] = $PL_LANG['sorry'].$PL_LANG['comma'].$PL_LANG['lBracket'].' '.$func.' '.$PL_LANG['rBracket'].' '.$PL_LANG['nonExist'];
    $api::returnAjax($info);
}
$api::checkFormHash(true);
call_user_func_array(array($api, $func), $params);