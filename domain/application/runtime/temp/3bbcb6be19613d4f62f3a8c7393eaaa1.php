<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/www/web/xhkj5_com/public_html/domain/application/index/view/panel/profile.html";i:1461473274;s:79:"/www/web/xhkj5_com/public_html/domain/application/index/view/common/layout.html";i:1461473274;}*/ ?>
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
        <pre><h4>个人信息<a href="<?php echo U("index"); ?>" class="btn-xs btn-info" style="float: right;">返回</a></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                个人信息
            </div>
            <div class="panel-body tab-content">
                <form class="form-horizontal" action="#" method="post">
                    <input type="hidden" name="action" value="update">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">UID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $userInfo['uid']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $userInfo['user']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $userInfo['email']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">等级</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $userInfo['level']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">最大解析条数</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php if($userInfo['max']): echo $userInfo['max']; else: if(C('allowNum')): if(C('allowNum') == -1): ?>关闭自助解析<?php else: echo C('allowNum'); endif; else: ?>无限<?php endif; endif; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">修改密码</label>
                        <div class="col-sm-10">
                            <input type="text" name="pwd" class="form-control" placeholder="留空则不修改密码">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success btn-block">修改信息</button>
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