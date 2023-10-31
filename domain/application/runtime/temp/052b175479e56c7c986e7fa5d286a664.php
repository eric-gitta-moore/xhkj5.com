<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/www/web/xhkj5_com/public_html/domain/application/index/view/admin/addDomain.html";i:1461473274;s:79:"/www/web/xhkj5_com/public_html/domain/application/index/view/common/layout.html";i:1461473274;}*/ ?>
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
        <pre><h4>添加域名<a href="<?php echo U('domainList'); ?>" class="btn-xs btn-info" style="float: right;">返回</a></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="list-group text-success">
                    <form class="form-horizontal" action="#" method="post">
                        <input type="hidden" name="action" class="form-control" value="add">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">解析平台</label>
                            <div class="col-sm-10">
                                <select name="dns" class="form-control ropdown-toggle" id="dnsSelect">
                                    <option value ="dnspod">DnsPod</option>
                                    <option value ="aliyun">AliYun</option>
                                    <option value ="cloudxns">CloudXNS</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">域名</label>
                            <div class="col-sm-8 col-xs-8">
                                <select name="domain" class="form-control ropdown-toggle" id="domainSelect"></select>
                            </div>
                            <div class="col-sm-2 col-xs-4">
                                <span class="btn btn-warning" id="reloadBtn">刷新</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-12 control-label">解析等级</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="level" value="0" required>
                                <pre>用户等级大于等于解析等级的时候才能解析此域名！0代表所有人都可以解析！</pre>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">确认添加</button>
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

<script type="text/javascript">
    function loadScript(c) {
        var a = document.createElement("script");
        a.onload = a.onreadystatechange = function() {
            if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") {
                a.onload = a.onreadystatechange = null;
                if (a.parentNode) {
                    a.parentNode.removeChild(a)
                }
            }
        };
        a.src = c;
        document.getElementsByTagName("head")[0].appendChild(a)
    }
    $(function () {
        $(document).on("click","#reloadBtn",function(){
            var dns = $('#dnsSelect').val();
            var url="<?php echo U('index/Ajax/domainList'); ?>?dns="+dns;
            loadScript(url);
        });
    });
</script>

</body>
</html>