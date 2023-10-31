<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-16 17:54
 */
if(!defined('IN_DISCUZ')) exit('Access Denied');
require 'global.php';
$template = 'wi_chat/chat';
include template('diy:'.$template, '', $PL_TPL);
