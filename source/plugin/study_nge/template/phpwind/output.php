<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if($study_nge['pic_select'] != 1 && $study_nge['pic_way'] == 'flash') {
    $study_slide['title_0xcolor'] = $study_nge['pic_color'] ? str_replace('#', '0x', $study_nge['pic_color']) : '0x0099ff';
    $study_slide['title_0xbgcolor'] = $study_nge['pic_bgcolor'] ? str_replace('#', '0x', $study_nge['pic_bgcolor']) : '0xFF0000';

    if($study_slide['title_radio']) {
        $flash_pic[pic] = implode('|', $nge_data['content']['image']['new']['pic']);
        $flash_pic[text] = implode('|', $nge_data['content']['image']['new']['text']);
        $flash_pic[url] = implode('|', $nge_data['content']['image']['new']['url']);
        $flash_pic[pic] = str_replace('&', '%26', $flash_pic[pic]);
        $flash_pic[text] = str_replace('&quot;', '', $flash_pic[text]);
        $flash_pic[text] = str_replace('&', '%26', $flash_pic[text]);
        $flash_pic[url] = str_replace('&', '%26', $flash_pic[url]);
    }else {
        $flash_pic[pic] = implode('|', $nge_data['content']['image']['new']['pic']);
        $flash_pic[url] = implode('|', $nge_data['content']['image']['new']['url']);
        $flash_pic[pic] = str_replace('&', '%26', $flash_pic[pic]);
        $flash_pic[text] = '';
        $flash_pic[url] = str_replace('&', '%26', $flash_pic[url]);
    }
}
foreach($nge_data['content']['members'] as $key => $value) {
    if($key == 'posts' && $nge_config['posts_way'] == '2') {
        $nge_data['content']['members'][$key] = array_slice($value, 0, 3, false);
    }else {
        $nge_data['content']['members'][$key] = array_slice($value, 0, $thread_num, false);
    }
}
foreach($nge_data['content']['bottom_avatar'] as $key => $value) {
    $nge_data['content']['bottom_avatar'][$key] = array_slice($value, 0, 16);
}
$nge_data['lastid']['threads'] = end($nge_data['id']['threads']);
$nge_data['lastid']['members'] = end($nge_data['id']['members']);
//本插件由1314学习网制作，盗版必究
?>