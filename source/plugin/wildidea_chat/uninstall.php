<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-16 17:54
 */
if(!defined('IN_DISCUZ')) exit('Access Denied');

$dir = explode(DIRECTORY_SEPARATOR, __DIR__);
$memberCache = DISCUZ_ROOT.'data/wildidea/'.trim(end($dir)).'/member_caches.php';
$emotionCache = DISCUZ_ROOT.'data/wildidea/'.trim(end($dir)).'/emotion_caches.php';
if(file_exists($memberCache)) file_put_contents($memberCache, '');
if(file_exists($emotionCache)) file_put_contents($emotionCache, '');

$tablePrefix = !empty($_G['config']['db'][1]['tablepre']) ? $_G['config']['db'][1]['tablepre'] : 'pre_';

$sql = <<<EOF

DROP TABLE IF EXISTS `{$tablePrefix}wi_chat_join`;
DROP TABLE IF EXISTS `{$tablePrefix}wi_chat_content`;

EOF;

runquery($sql);
$finish = true;