<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"/www/wwwroot/xhkj5.com/domain/application/index/view/admin/webSet.html";i:1518350231;s:71:"/www/wwwroot/xhkj5.com/domain/application/index/view/common/layout.html";i:1518350231;}*/ ?>
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
        <pre><h4>网站基本信息设置<a href="<?php echo U('index'); ?>" class="btn-xs btn-info" style="float: right;">返回</a></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading text-center">网站设置</div>
            <div class="panel-body">
                <div class="list-group text-success">
                    <form class="form-horizontal" action="#" method="post">
                        <input type="hidden" name="action" class="form-control" value="set">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">网站名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="webName" class="form-control" value="<?php echo C('webName'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">全局底部信息</label>
                            <div class="col-sm-10">
                                <textarea name="webFoot" class="form-control" rows="5"><?php echo getHtmlCode(C('webFoot'),true); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">最大解析数</label>
                            <div class="col-sm-10">
                                <input type="number" name="allowNum" class="form-control" value="<?php echo C('allowNum'); ?>" required>
                                <br><pre>最大解析数是指每个用户最多获取多少个二级域名(设置0为不限制,-1停止用户解析)</pre>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">禁止解析前缀</label>
                            <div class="col-sm-10">
                                <textarea name="forbidRecord" class="form-control" rows="5"><?php echo C('forbidRecord'); ?></textarea>
                                <br><pre>禁止用户解析的前缀，多个前缀用,隔开！</pre>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">修改后台密码</label>
                            <div class="col-sm-10">
                                <input type="text" name="webAdmin" class="form-control" placeholder="留空则不修改">
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