<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/www/web/xhkj5_com/public_html/domain/application/index/view/admin/apiSet.html";i:1461473274;s:79:"/www/web/xhkj5_com/public_html/domain/application/index/view/common/layout.html";i:1461473274;}*/ ?>
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
        <pre><h4>API配置<a href="<?php echo U('index'); ?>" class="btn-xs btn-info" style="float: right;">返回</a></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading text-center">DnsPod Token配置-[<a href="https://www.dnspod.cn/User/Security" target="_Blank">获取</a>]-[<a href="https://support.dnspod.cn/Kb/showarticle/tsid/227/" target="_Blank">帮助</a>]</div>
            <div class="panel-body">
                <div class="list-group text-success">
                    <form class="form-horizontal" action="#" method="post">
                        <input type="hidden" name="action" class="form-control" value="dnspod">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">TokenID</label>
                            <div class="col-sm-10">
                                <input type="text" name="DnspodTokenID" class="form-control" placeholder="DnsPod的TokenID" value="<?php echo C('DnspodTokenID'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">TokenID</label>
                            <div class="col-sm-10">
                                <input type="text" name="DnspodToken" class="form-control" placeholder="DnsPod的Token" value="<?php echo C('DnspodToken'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">保存配置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading text-center">AliYun AccessKey配置-[<a href="https://ak-console.aliyun.com/index#/accesskey" target="_Blank">获取</a>]</div>
            <div class="panel-body">
                <div class="list-group text-success">
                    <form class="form-horizontal" action="#" method="post">
                        <input type="hidden" name="action" class="form-control" value="aliyun">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AccessKeyId</label>
                            <div class="col-sm-10">
                                <input type="text" name="AliyunAccessKeyId" class="form-control" placeholder="AccessKeyId" value="<?php echo C('AliyunAccessKeyId'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">AccessKeySecret</label>
                            <div class="col-sm-10">
                                <input type="text" name="AliyunAccessKeySecret" class="form-control" placeholder="AccessKeySecret" value="<?php echo C('AliyunAccessKeySecret'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">保存配置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading text-center">CloudXNS API KEY配置-[<a href="https://www.cloudxns.net/AccountManage/apimanage.html" target="_Blank">获取</a>]</div>
            <div class="panel-body">
                <div class="list-group text-success">
                    <form class="form-horizontal" action="#" method="post">
                        <input type="hidden" name="action" class="form-control" value="cloudxns">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">API KEY</label>
                            <div class="col-sm-10">
                                <input type="text" name="CloudXnsApiKey" class="form-control" placeholder="CloudXNS的API KEY" value="<?php echo C('CloudXnsApiKey'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">SECRET KEY</label>
                            <div class="col-sm-10">
                                <input type="text" name="CloudXnsSecretKey" class="form-control" placeholder="CloudXNS的SECRET KEY" value="<?php echo C('CloudXnsSecretKey'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">保存配置</button>
                            </div>
                        </div>
                    </form>
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