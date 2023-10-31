<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/www/web/xhkj5_com/public_html/domain/application/index/view/admin/domainList.html";i:1461473274;s:79:"/www/web/xhkj5_com/public_html/domain/application/index/view/common/layout.html";i:1461473274;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <title><?php if(isset($webTitle)): echo $webTitle; ?>-<?php endif; echo C("webName"); ?></title>
    <meta name="keywords" content="<?php echo C("webKeywords"); ?>" />
    <meta name="description" content="<?php echo C("webDescription"); ?>" />
    <script src="/assets/jquery/jquery-2.2.3.min.js"></script>
    <script src="/assets/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <link href="/assets/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/sweetalert/sweetalert.css"/>
</head>
<body>
<div class="container">
    
<div class="row">
    <div class="col-xs-12">
        <pre><h4>域名列表<a href="<?php echo U('index'); ?>" class="btn-xs btn-info" style="float: right;">返回</a></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center">域名列表</div>
            <div class="panel-body">
                <div class="list-group text-success">
                    <?php if(is_array($domains)): $i = 0; $__LIST__ = $domains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$domain): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo U('recordList'); ?>?id=<?php echo $domain['domain_id']; ?>" class="list-group-item list-group-item-info">
                        <?php if($domain['dns'] == 'dnspod'): ?>
                        <img src="/assets/images/dnspod.jpg" width=50 height=18>
                        <?php elseif($domain['dns'] == 'aliyun'): ?>
                        <img src="/assets/images/aliyun.jpg" width=50 height=18>
                        <?php elseif($domain['dns'] == 'cloudxns'): ?>
                        <img src="/assets/images/cloudxns.jpg" width=50 height=18>
                        <?php endif; ?>
                        &nbsp;&nbsp;<?php echo $domain['name']; ?>&nbsp;&nbsp;<span class="text-warning">[level:<?php echo $domain['level']; ?>]</span>
                        <span class="badge"><?php echo $domain['count']; ?></span>
                    </a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="list-group text-center">
                    <a href="<?php echo U('addDomain'); ?>" class="list-group-item list-group-item-warning">添加域名</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <footer class="footer text-center">
	<pre><?php echo getHtmlCode(C('webFoot')); ?></pre>
    </footer>
</div>
<script src="/assets/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript"><?php if(isset($alert)): echo $alert; endif; ?></script>

</body>
</html>