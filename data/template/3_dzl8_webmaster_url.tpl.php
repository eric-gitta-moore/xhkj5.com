<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<link rel="stylesheet" href="source/plugin/dzl8_webmaster/image/css.css">
<div class="rztop">
    <div id="rzlc" class="rzlc">
        <div class="bz bz1">填写域名</div>

            <div class="bz bz2">验证文件</div>

            <div class="bz bz3">域名核实</div>

            <div class="bz bz4">验证成功</div>
        <?php if($add['url']||$add['name']) { ?>
        <div id="s1" class="s s1"></div>
            <?php if($add['verify']==1) { ?>
            <div id="s2" class="s s2"></div>
            <div id="s3" class="s s3"></div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<?php if($add['url']||$add['name']) { ?>
    <?php if($add['verify']==0) { ?>
        <table cellspacing="0" cellpadding="0" class="tfm" id="profilelist">
            <tbody>
            <tr>
                <th>网站名称:</th>
                <td><?php echo $add['name'];?></td>
            </tr>
            <tr>
                <th>网站地址:</th>
                <td><?php echo $add['url'];?></td>
            </tr>
            <tr>
                <th>下载验证文件：</th>
                <td>
                    <a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=dzl8_webmaster:url&amp;down=yes" class="down">点击下载</a>
                </td>
            </tr>
            <tr>
                <th>请先访问地址</th>
                <td>
                    <a href="<?php echo $add['url'];?>/<?php echo $tname;?>.txt" target="_blank"><?php echo $add['url'];?>/<?php echo $tname;?>.txt</a>
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td>
                    <a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=dzl8_webmaster:url&amp;yz=yes" class="down">立刻验证</a>
                </td>
            </tr>
            </tbody>
        </table>
    <?php } else { ?>
    <table cellspacing="0" cellpadding="0" class="tfm" id="profilelist">
        <tbody>
        <tr>
            <th>网站名称:</th>
            <td><?php echo $add['name'];?></td>
        </tr>
        <tr>
            <th>网站地址:</th>
            <td><?php echo $add['url'];?></td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>恭喜你认证成功</td>
        </tr>
        </tbody>
    </table>
    <?php } } else { ?>
<table cellspacing="0" cellpadding="0" class="tfm">
    <form action="home.php?mod=spacecp&amp;ac=plugin&amp;id=dzl8_webmaster:url" method="post">
    <input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
        <tbody>
        <tr>
            <th><span class="rq" >*</span>网站名称:</th>
            <td style="width:400px;">
                <input type="text" name="name" id="name" class="px" value="<?php if($add['url']||$add['name']) { ?><?php echo $add['name'];?><?php } ?>">
            </td>
            <td>请填写中文或英文名称</td>
        </tr>
        <tr>
            <th><span class="rq" >*</span>网站地址:</th>
            <td style="width:400px;">
                <input type="text" name="url" id="url" class="px"  value="<?php if($add['url']||$add['name']) { ?><?php echo $add['url'];?><?php } ?>" >
            </td>
            <td>请填写网址如：<font color="red">http://</font>www.baidu.com</td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>
                <button name="next" type="submit" value="true" id="subbtn" class="pn pnc">
                    <strong>下一步</strong>
                </button>
            </td>
        </tr>
        </tbody>
    </form>
</table>
<?php } ?>