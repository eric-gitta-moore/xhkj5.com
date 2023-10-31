<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/www/wwwroot/xhkj5.com/domain/application/index/view/admin/index.html";i:1518350231;s:71:"/www/wwwroot/xhkj5.com/domain/application/index/view/common/layout.html";i:1518350231;}*/ ?>
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
        <pre><h4>管理后台</h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading text-center">系统设置</div>
            <div class="panel-body">
                <div class="list-group text-center">
                    <a href="<?php echo U('webSet'); ?>" class="list-group-item">网站配置</a>
                    <a href="<?php echo U('apiSet'); ?>" class="list-group-item">API配置</a>
                </div>
            </div>
            <div class="panel-heading text-center">数据管理</div>
            <div class="panel-body">
                <div class="list-group text-center">
                    <a href="<?php echo U('userList'); ?>" class="list-group-item">用户列表</a>
                    <a href="<?php echo U('recordList'); ?>" class="list-group-item">记录列表</a>
                    <a href="<?php echo U('domainList'); ?>" class="list-group-item">域名列表</a>
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