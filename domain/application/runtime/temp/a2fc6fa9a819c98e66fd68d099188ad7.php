<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"/www/web/xhkj5_com/public_html/domain/application/index/view/panel/index.html";i:1461473274;s:79:"/www/web/xhkj5_com/public_html/domain/application/index/view/common/layout.html";i:1461473274;}*/ ?>
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
        <pre><h4>域名控制台 <span style="float: right;"><a href="<?php echo U('profile'); ?>" class="btn-xs glyphicon glyphicon-user"><?php echo $userInfo['user']; ?></a> <a href="<?php echo U('index/Index/logout'); ?>" class="btn-xs btn-warning">退出</a></span></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="col-xs-6 text-center active"><a href="#list" data-toggle="tab">记录列表</a></li>
                    <li class="col-xs-6 text-center"><a href="#add" data-toggle="tab" id="addtab">添加解析</a></li>
                </ul>
            </div>
            <div class="panel-body tab-content">
                <div class="table-responsive tab-pane fade in active" id="list">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>域名</th>
                            <th>类型</th>
                            <th>记录值</th>
                            <th class="text-right">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($records)): $i = 0; $__LIST__ = $records;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$record): $mod = ($i % 2 );++$i;?>
                        <tr id="Record_<?php echo $record['record_id']; ?>">
                            <td><?php echo $record['name']; ?>.<?php echo $record['domain']; ?></td>
                            <td><?php echo $record['type']; ?></td>
                            <td><?php echo $record['value']; ?></td>
                            <td align="right">
                                <a href="<?php echo U('update',array('id'=>$record['record_id'])); ?>" class="dns-btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<span class="dns-btn btn-warning delRecord" record_id="<?php echo $record['record_id']; ?>"><span class="glyphicon glyphicon-trash"></span></span></td></tr>

                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="add">
                    <form class="form-horizontal" action="#" method="post">
                        <input type="hidden" name="action" value="addrecord">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">域名</label>
                            <div class="col-sm-10">
                                <select name="domain_id" class="form-control">
                                    <?php if(is_array($domains)): $i = 0; $__LIST__ = $domains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$domain): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $domain['domain_id']; ?>"><?php echo $domain['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">记录</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="二级前缀" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">类型</label>
                            <div class="col-sm-10">
                                <select name="type" class="form-control">
                                    <option value="A">A记录</option>
                                    <option value="CNAME">CANME记录</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">记录值</label>
                            <div class="col-sm-10">
                                <input type="text" name="value" class="form-control" placeholder="127.0.0.1" required>
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
                                <button type="submit" class="btn btn-success btn-block">添加记录</button>
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

<?php if(isset($isAdd)  && $isAdd): ?><script type="text/javascript">$("#addtab").click();</script><?php endif; ?>
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
        $(document).on("click",".delRecord",function(){
            var record_id=$(this).attr('record_id');
            var url="<?php echo U('index/Ajax/delRecord'); ?>?id="+record_id;
            loadScript(url);
        });
    });
</script>

</body>
</html>