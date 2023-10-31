<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
// $nge_config = array();
$nge_config['nge_temp'] = 'xshow';
$nge_config['output_file'] = 'output';
// 帖子右侧信息开关study
$nge_config['tiezi_right_radio'] = '1';
// 幻灯片宽度1314
// $study_slide['width'] = '230';
$study_slide['height'] = $thread_num * 25;

$nge_config['threadcard_select'] = $study_nge['threadcard_select2'];

$nge_config['td_row'] = '30%';

?>