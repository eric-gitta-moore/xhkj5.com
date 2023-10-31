<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/www/web/xhkj5_com/public_html/domain/application/index/view/admin/recordList.html";i:1461473274;s:79:"/www/web/xhkj5_com/public_html/domain/application/index/view/common/layout.html";i:1461473274;}*/ ?>
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
        <pre><h4><?php if(isset($uid)): ?>用户UID:<?php echo $uid; ?>的<?php endif; ?>记录列表<a href="<?php if(isset($uid)): echo U('userList'); else: echo U('index'); endif; ?>" class="btn-xs btn-info" style="float: right;">返回</a></h4></pre>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                选择域名:<select class="btn-xs btn-success dropdown-toggle" id="domainSelect">
                <option value ="0">全部</option>
                <?php if(is_array($domains)): $i = 0; $__LIST__ = $domains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$domain): $mod = ($i % 2 );++$i;?>
                <option value ="<?php echo $domain['domain_id']; ?>"<?php if(isset($domainId) && $domainId == $domain['domain_id']): ?>selected<?php endif; ?>><?php echo $domain['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <?php if(isset($domainId)): ?>
                <span class="btn-xs btn-danger delDomain" id="<?php echo $domainId; ?>" style="float: right;">删除</span>
                <?php endif; ?>
            </div>
            <div class="panel-body tab-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>域名</th>
                            <th>所属用用户</th>
                            <th>更新时间</th>
                            <th class="text-right">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($records)): $i = 0; $__LIST__ = $records;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$record): $mod = ($i % 2 );++$i;?>
                        <tr id="Record_<?php echo $record['record_id']; ?>">
                            <td><?php echo $record['record_id']; ?></td>
                            <td><?php echo $record['name']; ?>.<?php echo $record['domain_name']; ?></td>
                            <td><?php echo $record['user']; ?> [UID:<?php echo $record['uid']; ?>]</td>
                            <td><?php echo $record['updatetime']; ?></td>
                            <td align="right">
                                <a href="http://<?php echo $record['name']; ?>.<?php echo $record['domain_name']; ?>" target="_blank" class="btn-xs btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;<span class="btn-xs btn-warning delRecord" record_id="<?php echo $record['record_id']; ?>"><span class="glyphicon glyphicon-trash"></span></span></td></tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <td align="center" colspan="5"><?php echo $pageList->showPage(); ?></td>
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
        $(document).on("click",".delDomain",function(){
            if(confirm("'删除域名不会删除已解析的记录，确定删除？")) {
                var id = $(this).attr('id');
                var url = "<?php echo U('index/Ajax/delDomain'); ?>?id=" + id;
                loadScript(url);
            }
        });
        $(document).on("click",".delRecord",function(){
            var record_id=$(this).attr('record_id');
            var url="<?php echo U('index/Ajax/delRecord'); ?>?type=admin&id="+record_id;
            loadScript(url);
        });
    });
</script>

</body>
</html>