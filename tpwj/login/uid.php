<?php
    header("Content-type: text/html; charset=gbk");
    $ljsql=@mysql_connect("localhost","xhkj5","2030016184drx");//php改成你自己的就可以了。
    $db=@mysql_select_db("xhkj5");//自己的库

$name=@$_GET['name'];
if($name==""){
    echo "1";//帐号为空返回1
    return;
}
$cxzh="SELECT * FROM `pre_ucenter_members` WHERE `username` = '".$name."'";
$cx=mysql_query($cxzh);
$du=mysql_fetch_array($cx);
if($du['uid']==""){
    echo "3";//帐号不存在
    return;
}else{
    echo $du['uid'];
}
?>