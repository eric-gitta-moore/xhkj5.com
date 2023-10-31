<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"/www/wwwroot/xhkj5.com/domain/application/index/view/admin/userList.html";i:1518350231;s:71:"/www/wwwroot/xhkj5.com/domain/application/index/view/common/layout.html";i:1518350231;}*/ ?>
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
        <pre><h4>用户列表<a href="<?php echo U('index'); ?>" class="btn-xs btn-info" style="float: right;">返回</a></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-body tab-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>#UID</th>
                            <th>用户名</th>
                            <th>邮箱</th>
                            <th>等级</th>\
                            <th>已解析数</th>
                            <th>最大解析数</th>
                            <th>注册时间</th>
                            <th class="text-right">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
                        <tr id="User_<?php echo $user['uid']; ?>">
                            <td><?php echo $user['uid']; ?></td>
                            <td><?php echo $user['user']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['level']; ?></td>
                            <td><a href="<?php echo U('recordList',array('uid'=>$user['uid'])); ?>" class="btn-xs btn-block btn-info text-center"><?php echo $user['count']; ?></a></td>
                            <td><?php echo $user['max']; ?></td>
                            <td><?php echo $user['regtime']; ?></td>
                            <td align="right">
                                <a href="<?php echo U('userInfo',array('uid'=>$user['uid'])); ?>" target="_blank" class="btn-xs btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;<span class="btn-xs btn-warning delUser" uid="<?php echo $user['uid']; ?>"><span class="glyphicon glyphicon-trash"></span></span></td></tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <td align="center" colspan="8"><?php echo $pageList->showPage(); ?></td>
                        </tbody>
                    </table>
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
        //改变域名选择
        $('#domainSelect').change(function(){
            var id=$(this).children('option:selected').val();
            if( id == 0){
                window.location.href="<?php echo U('recordList'); ?>";
            }else{
                window.location.href="?id="+id;
            }

        });
        $(document).on("click",".delUser",function(){
            if(confirm("'删除该用户不会删除解析的记录，确定删除？")) {
                var uid = $(this).attr('uid');
                var url = "<?php echo U('index/Ajax/delUser'); ?>?uid=" + uid;
                loadScript(url);
            }
        });
    });
</script>

</body>
</html>