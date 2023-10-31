<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include './hook_class';

$a = new plugin_xhkj5_urlseo();

$a->_show404_re();

?>