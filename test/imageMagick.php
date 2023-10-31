<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018-03-10
 * Time: 下午 01:07
 */

$im = new imagick( 'http://www.ymg6.com/static/style/logo.png' );

// resize by 200 width and keep the ratio

$im->add_text('wwww',10,10);

// write to disk

$im->save_to( 'a_thumbnail.jpg');

