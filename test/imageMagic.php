<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018-03-10
 * Time: 下午 01:07
 */

$im = new imagick( './a.png' );

// resize by 200 width and keep the ratio

//$im->addimage(fopen('./a/png','r'));
$im->thumbnailImage( 200, 0);
// write to disk

$im->writeimage( 'a_thumbnail.jpg');

