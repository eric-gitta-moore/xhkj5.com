<?php
/**
 * Created by 讯幻网-www.xhkj5.com.
 * User: Administrator
 * Date: 2018-02-02
 * Time: 下午 10:15
 * File Name: index.php
 * Project Name: xhkj5com_control_school
 */

if (!empty($_POST['key']))
{
    $arr = array(
        'key' => $_POST['key'],
        'terminal' =>$_POST['terminal'],
        'method' => $_POST['method'],
        'param' => array(
            'target' => $_POST['param_target'],
            'msg' => array(
                'link' => $_POST['param_msg_link'],
                'method' => $_POST['param_msg_method'],
                isset($_POST['param_msg_key'])?strval($_POST['param_msg_key']):'' => isset($_POST['param_msg_value'])?strval($_POST['param_msg_value']):''
            ),
        ),
    );
    $value = json_encode($arr);

} else
{
    $value = null;
}

$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>xhkj5_control_school</title>
</head><body><form method="post" action="index.php">
key: <input type="password" name="key" 
HTML;
echo $html;
if (!empty($_POST['key'])){echo 'value="'.$_POST['key'].'"';}else{echo 'value="123456"';};
echo '><br><br>';

echo '
terminal: 
<select name="terminal">
<option value="server">server</option>
<option value="client">client</option>
</select><br><br>

method: 
<select name="method">
<option value="post_msg">post_msg</option>
<option value="get_info">get_info</option>
<option value="bind">bind</option>
</select><br><br>

param_target: <input type="text" name="param_target" ';
if (!empty($_POST['param_target']))echo 'value="'.$_POST['param_target'].'"';
echo '><br><br>
param_msg_link: <input type="text" name="param_msg_link" ';
if (!empty($_POST['param_msg_link']))echo 'value="'.$_POST['param_msg_link'].'"';
echo '><br><br>
param_msg_method: <input type="text" name="param_msg_method" ';
if (empty($_POST['param_msg_method'])){echo 'value="setPlaySong"';} else {echo 'value="'.$_POST['param_msg_method'].'"';}
echo '><br><br>
param_msg_key: <input type="text" name="param_msg_key" ';
if (!empty($_POST['param_msg_key']))echo 'value="'.$_POST['param_msg_key'].'"';
echo '><br><br>
param_msg_value: <input type="text" name="param_msg_value" ';
if (!empty($_POST['param_msg_value']))echo 'value="'.$_POST['param_msg_value'].'"';
echo '><br><br>
<br><br>
<textarea id="area" cols="30" rows="10">'.$value.'</textarea><br>
<button type="submit">提交</button>&nbsp;&nbsp;
<button type="reset">重置</button>
</form>
<br>
<a href="get_qqmusic.php">QQ音乐链接获取</a>
</body></html>';



