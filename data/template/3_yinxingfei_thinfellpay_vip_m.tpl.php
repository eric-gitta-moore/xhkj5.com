<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo $navMenu;?>">
    <meta name="keywords" content="<?php echo $navMenu;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $navMenu;?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="source/plugin/yinxingfei_thinfellpay_vip/template/m/css/amazeui.min.css">
    <link rel="stylesheet" href="source/plugin/yinxingfei_thinfellpay_vip/template/m/css/app.css">
</head>
<body>
    <header data-am-widget="header" class="am-header am-header-default">
        <h1 class="am-header-title">
            <a href="#title-link" class=""><?php echo $navMenu;?></a>
        </h1>
        <div class="am-header-left am-header-nav">
            <a href="javascript:;" onclick="javascript :history.back(-1);">
                <img class="am-header-icon-custom" src="data:image/svg+xml;charset=utf-8,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 12 20&quot;&gt;&lt;path d=&quot;M10,0l2,2l-8,8l8,8l-2,2L0,10L10,0z&quot; fill=&quot;%23fff&quot;/&gt;&lt;/svg&gt;"
                     alt="" />
            </a>
        </div>
        <div class="am-header-right am-header-nav">
            <div class="am-dropdown" data-am-dropdown>
                <button class="am-btn am-btn-primary am-dropdown-toggle" data-am-dropdown-toggle>
                    <img class="am-header-icon-custom" src="data:image/svg+xml;charset=utf-8,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 42 26&quot; fill=&quot;%23fff&quot;&gt;&lt;rect width=&quot;4&quot; height=&quot;4&quot;/&gt;&lt;rect x=&quot;8&quot; y=&quot;1&quot; width=&quot;34&quot; height=&quot;2&quot;/&gt;&lt;rect y=&quot;11&quot; width=&quot;4&quot; height=&quot;4&quot;/&gt;&lt;rect x=&quot;8&quot; y=&quot;12&quot; width=&quot;34&quot; height=&quot;2&quot;/&gt;&lt;rect y=&quot;22&quot; width=&quot;4&quot; height=&quot;4&quot;/&gt;&lt;rect x=&quot;8&quot; y=&quot;23&quot; width=&quot;34&quot; height=&quot;2&quot;/&gt;&lt;/svg&gt;"
                         alt="" />
                </button>
                <ul class="am-dropdown-content">
                    <?php if(is_array($mnav)) foreach($mnav as $k => $v) { ?>                    <li><a href="<?php echo $v['1'];?>"><?php echo $v['0'];?></a></li>
                    <?php } ?>
                </ul>
            </div>

        </div>
    </header>

    <div class="am-panel-group" id="accordion">
        <?php $ix=0;?>        <?php if(is_array($yinxingfei_thinfellpay_rule)) foreach($yinxingfei_thinfellpay_rule as $key => $value) { ?>        <div class="am-panel am-panel-primary">
            <div class="am-panel-hd">
                <h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-<?php echo $ix;?>'}">
                    <?php echo $value['0'];?>
                </h4>
            </div>
            <div id="do-not-say-<?php echo $ix;?>" class="am-panel-collapse am-collapse am-in">
                <div class="am-panel-bd">
                    <table class="am-table am-table-striped am-table-radius">
                        <tbody>
                            <tr>
                                <td rowspan=3 class="am-primary"><img class="am-radius" src="source/plugin/yinxingfei_thinfellpay_vip/images/vip_m.png" width="120" /></td>
                                <td >赠送礼包:<?php echo $value['4'];?></td>
                            </tr>
                            <tr>
                                <td>有效期限:<?php if($value['3']>0) { ?><?php echo $value['3'];?>天<?php } else { ?>永久<?php } ?></td>
                            </tr>
                            <tr>
                                <td>优惠价格:<?php echo $value['2'];?>元</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <a href="plugin.php?id=yinxingfei_thinfellpay_vip:m&amp;action=buytrue&amp;buyId=<?php echo $ix;?>" class="am-btn am-btn-warning">立即购买</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php $ix++?>        <?php } ?>
    </div>
    <!-- <?php if($yinxingfei_thinfellpay_isshow==1) { ?> -->
    <div class="am-panel am-panel-primary">
        <div class="am-panel-hd">
            <h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-<?php echo $ix;?>'}">
                最新VIP会员
            </h4>
        </div>
        <div class='bm_c txtstyle'>
            <?php $i=0;?>            <?php if(is_array($order_completed_data)) foreach($order_completed_data as $ordervalue) { ?>            <div class="dashed">
                <?php echo $ordervalue['submitdate'];?> <?php echo $ordervalue['username'];?>, 开通了
                <?php echo $ordervalue['group_name'];?>
                <?php if($i<3) { ?>

                <img src='source/plugin/yinxingfei_thinfellpay_vip/images/new.gif'>
                <?php } ?>
            </div>
            <?php ++$i;?>            <?php } ?>

        </div>
    </div>

    <!-- <?php } ?> -->

    <!--[if lt IE 9]>
    <script src="source/plugin/yinxingfei_thinfellpay_pay/template/m/js/jquery.1.11.js" type="text/javascript"></script>
    <script src="source/plugin/yinxingfei_thinfellpay_pay/template/m/js/modernizr_p.js" type="text/javascript"></script>
    <script src="source/plugin/yinxingfei_thinfellpay_pay/template/m/js/polyfill/rem.min.js" type="text/javascript"></script>
    <script src="source/plugin/yinxingfei_thinfellpay_pay/template/m/js/polyfill/respond.min.js" type="text/javascript"></script>
    <script src="source/plugin/yinxingfei_thinfellpay_pay/template/m/js/amazeui.legacy.js" type="text/javascript"></script>
    <![endif]-->
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="source/plugin/yinxingfei_thinfellpay_vip/template/m/js/jquery.min.js" type="text/javascript"></script>
    <script src="source/plugin/yinxingfei_thinfellpay_vip/template/m/js/amazeui.min.js" type="text/javascript"></script>
    <!--<![endif]-->
</body>
</html>