<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/www/web/xhkj5_com/public_html/domain/application/index/view/panel/update.html";i:1461473274;s:79:"/www/web/xhkj5_com/public_html/domain/application/index/view/common/layout.html";i:1461473274;}*/ ?>
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
        <pre><h4>修改解析<a href="<?php echo U("index"); ?>" class="btn-xs btn-info" style="float: right;">返回</a></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php echo $record['name']; ?>.<?php echo $record['domain']; ?>-修改
            </div>
            <div class="panel-body tab-content">
                <form class="form-horizontal" action="#" method="post">
                    <input type="hidden" name="action" value="update">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">域名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $record['domain']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">记录</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="<?php echo $record['name']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">类型</label>
                        <div class="col-sm-10">
                            <select name="type" class="form-control" size="1">
                                <option value="A">A记录</option>
                                <option value="CNAME" <?php if($record['type'] == 'CNAME'): ?>selected<?php endif; ?>>CANME记录</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">记录值</label>
                        <div class="col-sm-10">
                            <input type="text" name="value" class="form-control" value="<?php echo $record['value']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success btn-block">修改记录</button>
                        </div>
                    </div>
                </form>
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