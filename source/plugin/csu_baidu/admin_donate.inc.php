<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
include_once('csulang/'.currentlang().'.php');
$domain = 'http://www.dzcsu.com/';
$identifier = $_GET['identifier'];
echo '<script type="text/JavaScript">
parent.document.title = \''.$csulang[0].'\';
if(parent.$(\'admincpnav\')) parent.$(\'admincpnav\').innerHTML=\''.$csulang[1].' <a href="'.$domain.'" target="_blank" >Coder Student Union</a> '.$csulang[2].' <a href="'.$domain.'plugin.php?id=application&op=new&mod=ticket&addonid='.$identifier.'.plugin" target="_blank">'.$csulang[3].'</a> <span style="color:red"><b>'.$csulang[4].'me@dzcsu.com</b></span>\';
</script>';
$data =getdata($domain.'plugin.php?id=application1:randaddon&op=addons&charest='.CHARSET);
$addon =getdata($domain.'plugin.php?id=application1:randaddon&op=addon&addonid='.$identifier.'.plugin&charest='.CHARSET);
?>
<h3>Coder Student Union <?=$csulang['5']?></h3><div class="infobox">
<?php
if($addon['aid']){
?><a href="http://addon.discuz.com/?ac=donate&id=<?=$addon['aid']?>" target="_blank"><h4 class="infotitle2"><?=$csulang['6']?></h4></a>
<p class="marginbot"><?=$csulang['7']?></p>
<?php
}
?>
<p class="marginbot"><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=8a673b1cab2447c05367f73056252f69740a226a0804387654d3c842d57f1dee"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png"></a></p>
<p class="marginbot"><?=$csulang['8']?></p>
<?php
$table = array();
foreach ($data as $k=>$v){
	$n = floor($k/6);
	$table[$n*2][] = '<a href="'.$domain.'plugin.php?id=application&addonid='.$v['ID'].'" target="_blank"><img src="'.$v['logo'].'" /></a>';
	$table[($n*2+1)][] ='<a href="'.$domain.'plugin.php?id=application&addonid='.$v['ID'].'" target="_blank">'.$v['name'].'</a>';
}
?>
<style type="text/css">
</style>
<table width="700px" border="0" align="center">
<?php
foreach($table as $v){
	echo "<tr>";
	foreach($v as $d){
		echo "<td align=\"center\">{$d}</td>";
	}
	echo "</tr>";	
}
?>
</table>
</div>
<?php
function getdata($url){
	return(dunserialize(dfsockopen($url)));
}
?>