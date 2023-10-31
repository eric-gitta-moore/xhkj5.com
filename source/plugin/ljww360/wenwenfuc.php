<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
function wenwendj($djuid) {
	global $_G;
	$config = $_G['cache']['plugin']['ljww360'];
	$wendajf='extcredits'.$config['wendajf'];
	//debug($djuid);
	if($djuid){
		$con="WHERE a.uid= ".$djuid;
	}else{
		$con="WHERE a.uid= ".$_G['uid'];
	}
	$brenmyarr = DB::fetch_first ( "select a.username,b.".$wendajf." from " . DB::table ( 'common_member' ) . " a left join " . DB::table ( 'common_member_count' ) . " b on a.uid=b.uid  $con " );
	$grade = $config ['grade'];
	$gg=explode("\r\n",$grade);
	foreach($gg as $k=>$zk){
		$ggarr[]=explode("=",$zk);
	}
	foreach($ggarr as $k=>$v){
		$arrgg[$v[0]]=$v[1];
	}
	//debug($arrgg);
	if($brenmyarr[$wendajf]>=$arrgg[1]&&$brenmyarr[$wendajf]<$arrgg[2]){
		$dj=1;
		$cha=$arrgg[2]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[2]&&$brenmyarr[$wendajf]<$arrgg[3]){
		$dj=2;
		$cha=$arrgg[3]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[3]&&$brenmyarr[$wendajf]<$arrgg[4]){
		$dj=3;
		$cha=$arrgg[4]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[4]&&$brenmyarr[$wendajf]<$arrgg[5]){
		$dj=4;
		$cha=$arrgg[5]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[5]&&$brenmyarr[$wendajf]<$arrgg[6]){
		$dj=5;
		$cha=$arrgg[6]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[6]&&$brenmyarr[$wendajf]<$arrgg[7]){
		$dj=6;
		$cha=$arrgg[7]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[7]&&$brenmyarr[$wendajf]<$arrgg[8]){
		$dj=7;
		$cha=$arrgg[8]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[8]&&$brenmyarr[$wendajf]<$arrgg[9]){
		$dj=8;
		$cha=$arrgg[9]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[9]&&$brenmyarr[$wendajf]<$arrgg[10]){
		$dj=9;
		$cha=$arrgg[10]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[10]&&$brenmyarr[$wendajf]<$arrgg[11]){
		$dj=10;
		$cha=$arrgg[11]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[11]&&$brenmyarr[$wendajf]<$arrgg[12]){
		$dj=11;
		$cha=$arrgg[12]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[12]&&$brenmyarr[$wendajf]<$arrgg[13]){
		$dj=12;
		$cha=$arrgg[13]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[13]&&$brenmyarr[$wendajf]<$arrgg[14]){
		$dj=13;
		$cha=$arrgg[14]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[14]&&$brenmyarr[$wendajf]<$arrgg[15]){
		$dj=14;
		$cha=$arrgg[15]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[15]&&$brenmyarr[$wendajf]<$arrgg[16]){
		$dj=15;
		$cha=$arrgg[16]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[16]&&$brenmyarr[$wendajf]<$arrgg[17]){
		$dj=16;
		$cha=$arrgg[17]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[17]&&$brenmyarr[$wendajf]<$arrgg[18]){
		$dj=17;
		$cha=$arrgg[18]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[18]&&$brenmyarr[$wendajf]<$arrgg[19]){
		$dj=18;
		$cha=$arrgg[19]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[19]&&$brenmyarr[$wendajf]<$arrgg[20]){
		$dj=19;
		$cha=$arrgg[20]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[20]&&$brenmyarr[$wendajf]<$arrgg[21]){
		$dj=20;
		$cha=$arrgg[21]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[21]&&$brenmyarr[$wendajf]<$arrgg[22]){
		$dj=21;
		$cha=$arrgg[22]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[22]&&$brenmyarr[$wendajf]<$arrgg[23]){
		$dj=22;
		$cha=$arrgg[23]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[23]&&$brenmyarr[$wendajf]<$arrgg[24]){
		$dj=23;
		$cha=$arrgg[24]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[24]&&$brenmyarr[$wendajf]<$arrgg[25]){
		$dj=24;
		$cha=$arrgg[25]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[25]&&$brenmyarr[$wendajf]<$arrgg[26]){
		$dj=25;
		$cha=$arrgg[26]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[26]&&$brenmyarr[$wendajf]<$arrgg[27]){
		$dj=26;
		$cha=$arrgg[27]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[27]&&$brenmyarr[$wendajf]<$arrgg[28]){
		$dj=27;
		$cha=$arrgg[28]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[28]&&$brenmyarr[$wendajf]<$arrgg[29]){
		$dj=28;
		$cha=$arrgg[29]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[29]&&$brenmyarr[$wendajf]<$arrgg[30]){
		$dj=29;
		$cha=$arrgg[30]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[30]&&$brenmyarr[$wendajf]<$arrgg[31]){
		$dj=30;
		$cha=$arrgg[31]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[31]&&$brenmyarr[$wendajf]<$arrgg[32]){
		$dj=31;
		$cha=$arrgg[32]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[32]&&$brenmyarr[$wendajf]<$arrgg[33]){
		$dj=32;
		$cha=$arrgg[33]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[33]&&$brenmyarr[$wendajf]<$arrgg[34]){
		$dj=33;
		$cha=$arrgg[34]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[34]&&$brenmyarr[$wendajf]<$arrgg[35]){
		$dj=34;
		$cha=$arrgg[35]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[35]&&$brenmyarr[$wendajf]<$arrgg[36]){
		$dj=35;
		$cha=$arrgg[36]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[36]&&$brenmyarr[$wendajf]<$arrgg[37]){
		$dj=36;
		$cha=$arrgg[37]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[37]&&$brenmyarr[$wendajf]<$arrgg[38]){
		$dj=37;
		$cha=$arrgg[38]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[38]&&$brenmyarr[$wendajf]<$arrgg[39]){
		$dj=38;
		$cha=$arrgg[39]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[39]&&$brenmyarr[$wendajf]<$arrgg[40]){
		$dj=39;
		$cha=$arrgg[40]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[40]&&$brenmyarr[$wendajf]<$arrgg[41]){
		$dj=40;
		$cha=$arrgg[41]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[41]&&$brenmyarr[$wendajf]<$arrgg[42]){
		$dj=41;
		$cha=$arrgg[42]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[42]&&$brenmyarr[$wendajf]<$arrgg[43]){
		$dj=42;
		$cha=$arrgg[43]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[43]&&$brenmyarr[$wendajf]<$arrgg[44]){
		$dj=43;
		$cha=$arrgg[44]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[44]&&$brenmyarr[$wendajf]<$arrgg[45]){
		$dj=44;
		$cha=$arrgg[45]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[45]&&$brenmyarr[$wendajf]<$arrgg[46]){
		$dj=45;
		$cha=$arrgg[46]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[46]&&$brenmyarr[$wendajf]<$arrgg[47]){
		$dj=46;
		$cha=$arrgg[47]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[47]&&$brenmyarr[$wendajf]<$arrgg[48]){
		$dj=47;
		$cha=$arrgg[48]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[48]&&$brenmyarr[$wendajf]<$arrgg[49]){
		$dj=48;
		$cha=$arrgg[49]-$brenmyarr[$wendajf];
	}else if($brenmyarr[$wendajf]>=$arrgg[49]){
		$dj=49;
		$cha='';
	}
	$wendadj[]=$dj;
	$wendadj[]=$cha;
	return $wendadj;
}
?>