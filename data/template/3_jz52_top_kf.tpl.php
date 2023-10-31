<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('kf');?><?php include template('common/header'); ?>    <div class="imc_access_pop">



    <h2 style="cursor: move;" id="tlt_close" class="flb">
<em fwin="reply" id="return_reply"  class="tlt"><i class="icon icon_imc_logo"></i>客服中心<span>（部分服务需要通过QQ或旺旺进行沟通，请确认启动相关软件。）</span></em>
<?php if($_G['inajax']) { ?>
<span><a href="javascript:;" class="icon icon_close" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" title="关闭">关闭</a></span>
<?php } ?>
</h2>

        <div class="container1">
        	<div class="cont_container1">
                <div class="cont">
                    <div class="base_ser">
                        <h3 class="title"><em class="tlt">常用功能</em></h3>
                        <ul>
<?php echo $jz52_kfzxdm;?>	
                        </ul>
                    </div>
                    <div class="game_ser">
                        <h3 class="title"><em class="tlt">在线客服</em></h3>
                        <ul <?php if($jz52_kfzxwbwx) { ?>style="float: left; width: 500px;"<?php } else { } ?>>
                       <?php if($jz52_qqlist1) { ?>	                   
   <?php if(is_array($jz52_qqlists)) foreach($jz52_qqlists as $jz52_qqlists_out) { ?>                        <li>  
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $jz52_qqlists_out['qq'];?>&amp;site=qq&amp;menu=yes"><span class="span_i"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $jz52_qqlists_out['qq'];?>:52" alt="点击这里联系在线客服" title="点击这里联系在线客服"/></span><span class="span_t"><?php echo $jz52_qqlists_out['name'];?></span></a>
                        </li>
        <?php } ?>	
<?php } ?>	
                        <?php if($jz52_wangwang1) { if(is_array($jz52_wangwangs)) foreach($jz52_wangwangs as $jz52_wangwangs_out) { ?>        <li>  
                        <a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&amp;touid=<?php echo $jz52_wangwangs_out['zh'];?>&amp;siteid=cntaobao&amp;status=1&amp;charset=utf8" ><span class="span_w"><img border="0" src="http://amos.alicdn.com/online.aw?v=2&amp;uid=<?php echo $jz52_wangwangs_out['zh'];?>
&amp;site=cntaobao&amp;s=2&amp;charset=utf-8" alt="点击这里联系在线客服" /></span><span class="span_t"><?php echo $jz52_wangwangs_out['name'];?></span></a>
                        </li>
<?php } ?>  
                        <?php } ?>						
                        </ul>
<?php echo $jz52_kfzxwbwx;?>
</div>
                </div>
    
            </div>
        </div>
    </div><?php include template('common/footer'); ?>