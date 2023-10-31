<?php
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


	if(!submitcheck('submit')) {
		
		
		showformheader('plugins&operation=config&do='.$do.'&identifier=ljww360&pmod=ts');
		showtableheader();
		showsubtitle(array('','tid',lang('plugin/ljww360','ts_1'),lang('plugin/ljww360','ts_2'),lang('plugin/ljww360','ts_3'),lang('plugin/ljww360','ts_4')));
		//include template('ljhuitie:admin_keyword');
		$currpage=$_GET['page']?$_GET['page']:1;
		$perpage=25;
		$start=($currpage-1)*$perpage;
		$num=C::t('#ljww360#plugin_ljwenwen_ts')->count_by_id($con);
		//debug($con);
		$counts=C::t('#ljww360#plugin_ljwenwen_ts')->range_by_id($con,$start,$perpage,'desc');
		$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&identifier=ljww360&pmod=ts', 0, 10, false, false);
		foreach($counts as $row){
			$start=date('Y-m-d H:i:s',$row['timestamp']);
			if($row['ziti']==1){
				$ziti=lang('plugin/ljww360','ts_5');
			}else{
				$ziti=lang('plugin/ljww360','ts_6');
			}
			$end=date('Y-m-d H:i:s',$row['end']);
			showtablerow('', array('', 'class="td_m"', 'class="td_k"', 'class="td_l"','class="td_l"','class="td_l"'), array(							
							"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$row[wid]\">",	
							$row['tid'],	
							$row['subject'],	
							$row['lunzhuan'],	
							$ziti,		
							$start,			
							));
		}
		
		
		showsubmit('submit', 'submit', 'del','',$paging);
		showtablefooter();
		showformfooter();
		
		
	}else{
		
		if(is_array($_POST['delete'])) {
			foreach($_POST['delete'] as $id) {
				$id = intval(trim($id));
				C::t('#ljww360#plugin_ljwenwen_ts')->delete($id);
			}
		}
		cpmsg(lang('plugin/ljww360','ts_7'), 'action=plugins&operation=config&do='.$do.'&identifier=ljww360&pmod=ts', 'succeed');
	}

?>
