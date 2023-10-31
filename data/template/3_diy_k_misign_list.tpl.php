<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('k_misign_list');
0
|| checktplrefresh('source/plugin/k_misign/template/default/k_misign_list.htm', './template/default/common/header_ajax.htm', 1524237124, 'diy', './data/template/3_diy_k_misign_list.tpl.php', 'source/plugin/k_misign/template/default', 'k_misign_list')
|| checktplrefresh('source/plugin/k_misign/template/default/k_misign_list.htm', './template/default/common/footer_ajax.htm', 1524237124, 'diy', './data/template/3_diy_k_misign_list.tpl.php', 'source/plugin/k_misign/template/default', 'k_misign_list')
;?>
<?php ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: text/xml; charset=".CHARSET);
echo '<?xml version="1.0" encoding="'.CHARSET.'"?>'."\r\n";?><root><![CDATA[<div class="left_tit">

<ul class="paihang J_phbtn cl">

<li <?php if($_GET['op'] == '') { ?>class="active"<?php } ?>><a href="javascript:;" onclick="ajaxget('<?php echo $setting['pluginurl'];?>sign&operation=list', 'ranklist')">今日排行</a></li>

        <li <?php if($_GET['op'] == 'month') { ?>class="active"<?php } ?>><a href="javascript:;" onclick="ajaxget('<?php echo $setting['pluginurl'];?>sign&operation=list&op=month', 'ranklist')">本月排行</a></li>

        <li <?php if($_GET['op'] == 'zong') { ?>class="active"<?php } ?>><a href="javascript:;" onclick="ajaxget('<?php echo $setting['pluginurl'];?>sign&operation=list&op=zong', 'ranklist')">总排行</a></li>

<?php if($setting['rewardlistopen']) { ?><li <?php if($_GET['op'] == 'rewardlist') { ?>class="active"<?php } ?>><a href="javascript:;" onclick="ajaxget('<?php echo $setting['pluginurl'];?>sign&operation=list&op=rewardlist', 'ranklist')">奖励排行</a></li><?php } ?> 

</ul>

</div>

<div class="arr_detail">

<table id="J_list_detail">

<tbody>

<tr>

            <th>昵称</th>

            <th style="width:70px;">总天数</th>

            <th style="width:70px;">月天数</th>

            <th style="width:150px;">上次签到时间</th>

            <th style="width:120px;">目前等级</th>

            <?php if($_GET['op'] == '' || $_GET['op'] == 'month' || $_GET['op'] == 'zong') { ?>

            <th style="width:80px;">上次奖励</th>

        	<?php } elseif($_GET['op'] == 'rewardlist') { ?>

            <th style="width:80px;">总奖励</th>

        	<?php } ?>            

</tr>

        <?php if($mrcs) { ?>

        <?php if(is_array($mrcs)) foreach($mrcs as $mrc) { ?><tr>

            <td><div style="width:160px;display: inline-block;"><a href="home.php?mod=space&amp;uid=<?php echo $mrc['uid'];?>" target="_blank"><?php echo $mrc['username'];?></a></div></td>

            <td><?php echo $mrc['days'];?></td>

            <td><?php echo $mrc['mdays'];?></td>

            <td><?php echo $mrc['time'];?></td>

            <td><?php echo $mrc['level'];?></td>

            <?php if($_GET['op'] == '' || $_GET['op'] == 'month' || $_GET['op'] == 'zong') { ?>

            <td><?php echo $mrc['lastreward'];?> <?php echo $_G['setting']['extcredits'][$setting['nrcredit']]['unit'];?><?php echo $_G['setting']['extcredits'][$setting['nrcredit']]['title'];?></td>

        	<?php } elseif($_GET['op'] == 'rewardlist') { ?>

            <td><?php echo $mrc['reward'];?> <?php echo $_G['setting']['extcredits'][$setting['nrcredit']]['unit'];?><?php echo $_G['setting']['extcredits'][$setting['nrcredit']]['title'];?></td>

        	<?php } ?>   

        </tr>

        <?php } if(!empty($multipage)) { ?><tr><td colspan="8"><div class="btns"><?php echo $multipage;?></div></td></tr><?php } ?>

        <?php } else { ?>

<tr><td colspan="9">暂无内容</td></tr>

        <?php } ?>

</tbody>

</table>

</div><?php echo output_ajax(); ?>]]></root><?php exit;?>