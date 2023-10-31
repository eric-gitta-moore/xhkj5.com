<?php
/**
 *      [Liangjian] (C)2001-2099 Liangjian Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: ljbrand.inc.php liangjian $
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$yi=C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid();
//$pxcon=DB::result_first("select count(*) from ".DB::table('plugin_ljwenwentype')." where subid!=''");
//debug($pxcon);
$i=0;
foreach($yi as $kk=>$vv){
		$av=$vv['subid'];
		if($av){
			
			$er=C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_id($av);
					$typestr1 = '[';
			$checksign = 1;
			foreach ( $er as $k => $v ) {
				
				$typestr1 .= '"' . $v[subject] . '|' . $v[id] . '",';
				if(!$config['istwo']){
					if ($checksign >= 2) {
						break;
					}
				}
				$checksign ++;
			}
			
			$typestr1 .= ']';
			//debug($typestr1);
			$checksign = 1;
			if(!$config['istwo']){
				if (count ( $er ) > 2) {
					$typestr2 = '[';
					foreach ( $er as $k => $v ) {
						if ($checksign > 2) {
							$typestr2 .= '"' . $v[subject] . '|' . $v[id] . '",';
						}
						$checksign ++;
					}
					$typestr2 .= ']';
				} else {
					$typestr2 = '[]';	
				}
			}else{
				$typestr2 = '[]';
			}
		
	}
	//debug();
	//}
	if(!$av){
		$typestr1 = '[]';
		$typestr2 = '[]';
	}
	$str.="[".'"'.$vv['subject'].'|'.$vv['id'].'",'.$typestr1.','.$typestr2.'],';
}


?>