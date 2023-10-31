<?PHP
$mm=@$_GET['mingwenmima'];
$mm1=@$_GET['salt'];
$md51=md5($mm);
$jg=$md51.$mm1;
echo md5($jg);
?>