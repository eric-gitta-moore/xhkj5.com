<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/www/wwwroot/xhkj5.com/domain/application/index/view/index/index.html";i:1518350231;s:71:"/www/wwwroot/xhkj5.com/domain/application/index/view/common/layout.html";i:1518350231;}*/ ?>
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
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo C("webName"); ?></div>
        </div>
    </div>
    <?php if(C('notice_index')): ?>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body"><?php echo C('notice_index'); ?></div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="col-xs-6 text-center active"><a href="#login" data-toggle="tab">登录</a></li>
                    <li class="col-xs-6 text-center"><a href="#register" data-toggle="tab" id="regtab">注册</a></li>
                </ul>
            </div>
            <div class="panel-body tab-content">
                <div class="tab-pane fade in active" id="login">
                    <form class="form-horizontal" action="#" method="post">
                        <input type="hidden" name="action" class="form-control" value="login">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" name="user" class="form-control" placeholder="输入用户名或者邮箱账号" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-10">
                                <input type="password" name="pwd" class="form-control" placeholder="输入账号密码" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">立即登录</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="register">
                    <form class="form-horizontal" action="#" method="post">
                        <input type="hidden" name="action" class="form-control" value="reg">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" name="user" class="form-control" placeholder="最短需要3位" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-10">
                                <input type="password" name="pwd" class="form-control" placeholder="长度不能低于6" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" placeholder="有效邮箱地址" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">验证码</label>
                            <label class="col-sm-2 control-label"><img src="/code.php" onclick="this.src='/code.php?'+Math.random();" title="点击更换验证码"></label>
                            <div class="col-sm-8">
                                <input type="text" name="code" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">免费注册</button>
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
<?php if(isset($isReg) && $isReg): ?><script type="text/javascript">$("#regtab").click();</script><?php endif; ?>
</body>
</html>