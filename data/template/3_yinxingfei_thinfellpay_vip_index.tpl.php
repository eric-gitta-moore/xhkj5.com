<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css"
      href="source/plugin/yinxingfei_thinfellpay_vip/css/style.css"/>
<div id="pt" class="bm cl">
    <div class="z">
        <a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a>
        <em>&rsaquo;</em><a href="./plugin.php?id=yinxingfei_thinfellpay_vip">购买VIP用户组</a>
    </div>
</div>
<div class="yinxingfei_thinfellpay_bank">
    <div>
        <div class="left">
            <div class="tabcont" id="finance_cont">
                <div class="product_hd_wp">
                    <h2>
                        开通VIP会员
                    </h2>
                </div>
                <section class="carousel_sec">

                    <!--carousel-->
                    <div class="carousel_wpper">
                        <!--有固定活动时，添加.fixedItem类名-->
                        <div class="carousel_wp fixedItem ani">
                            <div class="item_wp">
                                <ul class="item_list carousel_list" id="ban_carousel">
                                    <?php if(is_array($yinxingfei_thinfellpay_rule)) foreach($yinxingfei_thinfellpay_rule as $key => $value) { ?>                                    <li class="item  runInRight">
                                        <div style="border: 1px solid red;border-radius:5px;">


                                            <?php if($value['6']!='') { ?>
                                            <mark class="mark <?php echo $value['6'];?>"></mark>
                                            <?php } ?>

                                            <div class="tit"><span class="act_name">   <?php echo $value['0'];?></span></div>
                                            <div class="subtxt"><img src="/source/plugin/yinxingfei_thinfellpay_vip/images/line.png" style="width: 178px;margin-bottom: 10px;"></div>
                                            <div class="subtxt act_detail">
                                                赠送礼包
                                            </div>
                                            <div class="subtxt act_detail">
                                                <font><?php echo $value['4'];?></font>
                                            </div>
                                            <div class="subtxt act_detail">
                                                有效期限:<font>
                                                <?php if($value['3']>0) { ?>
                                                <?php echo $value['3'];?>天<?php } else { ?>永久<?php } ?></font>
                                            </div>
                                            <div class="subtxt act_detail">
                                                优惠价格:<font><?php echo $value['2'];?>元</font>
                                            </div>
                                            <div class="buy_wp">
                                                <?php if($_G['uid']) { ?>
                                                <a href="plugin.php?id=yinxingfei_thinfellpay_vip&amp;action=buytrue&amp;buyId=<?php echo $key;?>"
                                                   class="btn_buy act_wx_buy" target="_blank">立即购买</a>
                                                <?php } else { ?>
                                                <a href="javascript:;"
                                                   onclick="showWindow('login','member.php?mod=logging&amp;action=login');"
                                                   class="btn_buy act_wx_buy" target="_blank">立即购买</a>

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--casousel end-->
                </section>
                <div class="modwp" id="j_huoqi_div">
                    <div class="product_list_wp" id="j_dingqi_div">
                        <div class="product_hd_wp">
                            <h2>注意事项!</h2>
                        </div>
<!--开始位置  -->
<div class="bm_h cl">
<h2> <font color="red">VIP特权总览</font> </h2>
</div>
<style>


.shangyemain tr td.w11em {
text-align: right;
padding-right: 15px;
width: 183px;
border: 1px solid #eee;
}
.shangyemain tr td {
border: 1px solid #eee;
padding: 6px 0px;
text-align: center;
font-size: 13px;
}

</style>
<div class="shangyemain">
<style>


.baojia-table td.w11em3{ background:#F0FFF7}
.baojia-table td.w11em4{ background:#F0FFF7}
</style>
<table border="1" class="baojia-table" width="100%" cellpadding="0" cellspacing="1">
<tbody>
<tr class="hsd">
<td class="w11em h24s" style="color:#555;font-size:14px;width: 20%"><strong>特权对比</strong></td>
<td class="h24s" style="color:#888;font-size:14px;width: 20%"><strong>普通用户</strong></td>
<td class="h24s" style="color:#555;font-size:14px;width: 20%"><strong>赞助VIP</strong></td>
<td class="h24s" style="color:red;font-size:14px;width: 20%"><strong>年费VIP</strong></td>
<td class="h24s" style="color:blue;font-size:14px;width: 20%"><strong>终身VIP</strong></td>

</tr>

<tr>
<td class="w11em">身份铭牌</td>
<td class="w11em1">/</td>
<td class="w11em2"><img src="data/attachment/common/37/common_23_usergroup_icon.gif?IJ3j1j"></td>
<td><img src="data/attachment/common/1f/common_24_usergroup_icon.gif?VK52p6"></td>
<td class="w11em4"><img src="data/attachment/common/8e/common_25_usergroup_icon.gif?tbZi8a"></td>

</tr>
<tr>
<td class="w11em">赞助认证图标(永久)</td>
<td class="w11em1">/</td>
<td class="w11em2"><img src="tpwj/common_4_verify_icon.png" alt="赞助过本站" title="赞助过本站"></td>
<td><img src="tpwj/common_2_verify_icon.png" alt="赞助过本站" title="赞助过本站"></td>
<td class="w11em4"><img src="tpwj/common_2_verify_icon.png" alt="赞助过本站" title="赞助过本站"></td>

</tr>
<tr>
<td class="w11em">资源下载次数</td>
<td class="w11em3"><a style="color:red"><b></b></a>随用户组上升</td>
<td class="w11em3"><a style="color:red"><b>7</b></a>次/天</td>
<td class="w11em3"><a style="color:red"><b>11</b></a>次/天</td>
<td class="w11em4"><a style="color:red"><b>15</b></a>次/天</td>

</tr>

<tr>
<td class="w11em">用户出售资源免购买下载</td>
<td class="w11em1"><img src="tpwj/c.png"></td>
<td class="w11em3"><img src="tpwj/c.png"></td>
<td class="w11em3"><a style="color:red"><b>1</b></a>个/天</td>
<td class="w11em4"><a style="color:red"><b>3</b></a>个/天</td>
</tr>

<tr>
<td class="w11em">免费资源下载</td>
<td><img src="tpwj/sure.png"></td>
<td><img src="tpwj/sure.png"></td>
<td><img src="tpwj/sure.png"></td>
<td class="w11em4"><img src="tpwj/sure.png"></td>
</tr>
<tr>
<td class="w11em">赞助资源下载</td>
<td><img src="tpwj/c.png"></td>
<td><img src="tpwj/sure.png"></td>
<td><img src="tpwj/sure.png"></td>
<td class="w11em4"><img src="tpwj/sure.png"></td>
</tr>
<tr>
<td class="w11em">年费资源下载</td>
<td><img src="tpwj/c.png"></td>
<td><img src="tpwj/c.png"></td>
<td><img src="tpwj/sure.png"></td>
<td class="w11em4"><img src="tpwj/sure.png"></td>
</tr>
<tr>
<td class="w11em">H币资源下载</td>
<td><img src="tpwj/c.png"></td>
<td><img src="tpwj/c.png"></td>
<td><img src="tpwj/c.png"></td>
<td class="w11em4"><img src="tpwj/sure.png"></td>
</tr>

                   <tr>
<td class="w11em">服务周期</td>
<td class="w11em1">/</td>
<td class="w11em3"><a style="color:red"><b>30</b></a>天</td>
<td class="w11em3"><a style="color:red"><b>365</b></a>天</td>
<td class="w11em4"><a style="color:red"><b>终身</b></a></td>
  </tr>	
<tr>
<td class="w11em">服务费用原价</td>
<td class="w11em1">/</td>
<td class="w11em3"><a style="color:#999;font-size:14px"><del><b>30元</b></del></a>/周期</td>
<td class="w11em3"><a style="color:#999;font-size:14px"><del><b>128元</b></del></a>/周期</td>
<td class="w11em4"><a style="color:#999;font-size:14px"><del><b>388元</b></del></a>/终身</td>
</tr>
<tr>				
<td class="w11em">服务费用</td>
<td class="w11em1">/</td>
<td class="w11em3"><a style="color:red;font-size:16px"><b>15元</b></a>/周期</td>
<td class="w11em3"><a style="color:red;font-size:16px"><b>64元</b></a>/周期</td>
<td class="w11em4"><a style="color:red;font-size:16px"><b>194元/终身</b></a></td>
  </tr>			
<tr>
<td class="w11em"><a style="color:red">昵称红名显示</a></td>
<td><img src="tpwj/c.png"></td>
<td><img src="tpwj/sure.png"></td>
<td><img src="tpwj/sure.png"></td>
<td class="w11em4"><img src="tpwj/sure.png"></td>
</tr>
<tr>
<td class="w11em4">无广告<a style="color:blue;font-size:9px">(赞助商广告除外)</a></td>
<td><img src="tpwj/c.png"></td>
<td><img src="tpwj/c.png"></td>
<td><img src="tpwj/sure.png"></td>
<td class="w11em4"><img src="tpwj/sure.png"></td>
</tr>
<tr>
<td class="w11em">求资源</td>
<td><img src="tpwj/sure.png"></td>
<td><img src="tpwj/sure.png"></td>
<td><img src="tpwj/sure.png"></td>
<td class="w11em4"><img src="tpwj/sure.png"></td>
</tr>		
<tr>
<td class="w11em">补充说明:</td>
<td colspan="4">未完待续。。。<img src="tpwj/sure.png">表示有权限，<img src="tpwj/c.png">表示无权限</td>
</tr>
</tbody>
</table>
</div>
<!--结束位置  -->
                        
                    </div>
                </div>

            </div>

        </div>
        <div class="right">
            <div>
                <div class="product_hd_wp">
                    <h2>
                        用户信息
                    </h2>
                </div>
                <!-- <?php if(!$_G['uid']) { ?> -->
                <div class='bm_c txtstyle'>
                    <br/>
                    <br/>
                    <center>
                        您需要登录后才可以购买用户组哟！<br/> <a
                            href="member.php?mod=logging&amp;action=login"
                            onclick="showWindow('login', this.href)" class="xi2"> 登录</a> | <a
                            href="member.php?mod=register" class="xi2"> 注册</a>
                    </center>
                    <br/>
                    <br/>
                </div>
                <!-- <?php } else { ?> -->
                <div class='bm_c txtstyle'>
                    <div class="dashed">用户名: <?php echo $myname;?></div>
                    <div class="dashed">当前用户组: <?php echo $grouptitle;?></div>
                    <div class="dashed"><?php echo $moneyname;?>: <?php echo $mymoey;?></div>
                </div>
                <?php } ?>
            </div>

            <!-- <?php if($yinxingfei_thinfellpay_isshow==1) { ?> -->
            <div>
                <div class="product_hd_wp">
                    <h2>
                        最新VIP会员
                    </h2>
                </div>
                <div class='bm_c txtstyle'>
                    <?php $i=0;?>                    <?php if(is_array($order_completed_data)) foreach($order_completed_data as $ordervalue) { ?>                    <div class="dashed">
                        <?php echo $ordervalue['submitdate'];?> <?php echo $ordervalue['username'];?>, 开通了
                        <?php echo $ordervalue['group_name'];?>
                        <?php if($i<3) { ?>

                        <img src='source/plugin/yinxingfei_thinfellpay_vip/images/new.gif'>
                        <?php } ?>
                    </div>
                    <?php ++$i;?>                    <?php } ?>

                </div>
            </div>

            <!-- <?php } ?> -->
        </div>

    </div>
    <div class="yinxingfei_thinfellpay_bank_clear"></div>
</div><?php include template('common/footer'); ?>