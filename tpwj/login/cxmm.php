<?php
    header("Content-type: text/html; charset=gbk");
    $ljsql=@mysql_connect("localhost","xhkj5","2030016184drx");//同上
    $db=@mysql_select_db("xhkj5");//同上
    //if($ljsql){
      //  echo "0";//成功返回0
    //}else{
      //  echo "2";//失败返回1
   // }

$name=@$_GET['name'];
$mima=@$_GET['mima'];
if($name==""){
    echo "1";//帐号为空返回1
    return;
}elseif($mima==""){
    echo "2";//密码为空返回2
    return;
}

$cxzh="SELECT * FROM `pre_ucenter_members` WHERE `username` = '".$name."' AND `password` = '".$mima."'";
$cx=mysql_query($cxzh);
$du=mysql_fetch_array($cx);
if($du['password']==""){
   
    echo "3";//密码错误返回3
    
    return;
}else{
    echo "4";//成功返回4
}
?>