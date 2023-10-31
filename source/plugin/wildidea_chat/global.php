<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-16 21:54
 */
if(!defined('IN_DISCUZ')) exit('Access Denied');
use Wildidea\Plugin\Chat\Library\Emotion;
use Wildidea\Plugin\Chat\Library\Api;
require 'autoload.php';
global $_G;
$api = new Api();
$emotion = new Emotion();
$PL_G = $api::$PL_G;
$PL_NAME = $api::$PL_NAME;
$PL_TPL = $api::$PL_TPL;
$PL_STATIC = $api::$PL_STATIC;
$PL_EMOTION = $emotion::getEmotion();
$PL_LANG = $api::$PL_LANG;
$SITE_URL = $_G['siteurl'];
$language = json_encode($PL_LANG);
$avatar = $api::getAvatarUrl($_G['uid']);
$prefix = $api::$PL_PREFIX;
$remote = $api::$PL_REMOTE;
$emotionPath = $PL_EMOTION['path'];
$emotionMap = json_encode($PL_EMOTION['emotion']);
$emotionSwitch = intval($PL_G['emotion_switch']) ? true : false;
$enableCtrlEnter = intval($PL_G['emotion_ctrl_enter']) ? true : false;
$host = trim($PL_G['listen_domain']) ? trim($PL_G['listen_domain']) : $_SERVER['HTTP_HOST'];
$port = intval($PL_G['listen_port']);
$_G['setting']['bbname'] = $PL_G['group_name'] ? $PL_G['group_name'] : $_G['setting']['bbname'];
$metakeywords = $PL_LANG['keywords'];
$metadescription = $PL_LANG['description'];
$_G['config']['output']['iecompatible'] = 11;