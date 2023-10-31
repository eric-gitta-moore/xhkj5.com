<?php
 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
echo '<table class="tb tb2 " id="tips">
	<tr>
		<th  class="partition">'.lang('plugin/ljww360','admin_wwgl_1').'</th>
	</tr>
	<tr>
		<td class="tipsblock" s="1">
			<ul id="tipslis">
				<li>'.lang('plugin/ljww360','admin_wwgl_2').'</li>
				<li>'.lang('plugin/ljww360','admin_wwgl_3').'</li>
				<li>'.lang('plugin/ljww360','admin_wwgl_4').'</li>
				<li>'.lang('plugin/ljww360','admin_wwgl_13').'</li>
			</ul>
		</td>
	</tr>
</table><br>';
include template ( 'ljww360:nav' );
if($_GET['lj']=='reply'){
	if(!submitcheck('submit')) {
		
		
		showformheader('plugins&operation=config&do=$do&identifier=ljww360&pmod=admin_wwgl&lj=reply');
		showtableheader();
		include template('ljww360:admin_keyword_reply');
		showsubtitle(array('','pid','tid',lang('plugin/ljww360','admin_wwgl_14'),lang('plugin/ljww360','admin_wwgl_15'),lang('plugin/ljww360','admin_wwgl_16')));
		
		$currpage=$_GET['page']?$_GET['page']:1;
		$perpage=25;
		$start=($currpage-1)*$perpage;
		$con=" where 1";
		if(submitcheck('num_submit')) {
			$tid=intval($_GET['tid']);
			$pid=intval($_GET['pid']);
			$kaishi=strtotime($_GET['kaishi']);
			$jiesu=strtotime($_GET['jiesu']);
			if($tid){
				$con.=" and tid =$tid";
			}
			if($pid){
				$con.=" and pid =$pid";
			}
			if($kaishi&&$jiesu){
				$con.=" and dateline >= $kaishi and dateline <= $jiesu";
			}
		}
		$num=C::t('#ljww360#plugin_lj_post')->count_by_id($con);
		//debug($num);
		$counts=C::t('#ljww360#plugin_lj_post')->range_by_id($con,$start,$perpage,'desc');
		//debug($counts);
		$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&identifier=ljww360&pmod=admin_wwgl&lj=reply&tid='.$_GET['tid'].'&pid='.$_GET['pid'].'&kaishi='.$_GET['kaishi'].'&jiesu='.$_GET['jiesu'], 0, 10, false, false);
		foreach($counts as $row){
			$start=date('Y-m-d H:i:s',$row['dateline']);
			
			$end=date('Y-m-d H:i:s',$row['end']);
			showtablerow('', array('', 'class="td_m"', 'class="td_k"', 'class="td_l"','class="td_l"','class="td_l"'), array(							
							"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[".$row[pid]."]\" value=\"$row[id]\"><input type=\"hidden\" value=\"$row[pid]\" name=\"pids[]\" >",	
							$row['pid'],	
							$row['tid'],		
							$row['message'],		
							$row['author'],		
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
				C::t('#ljww360#plugin_lj_post')->delete($id);
			}
		}
		if(is_array($_POST['delete'])) {
			foreach($_POST['delete'] as $apid=>$wid) {
				$atid = intval(trim($apid));
				DB::update('forum_post', array('invisible'=>'-1'), "pid='$atid'");
			}
		}
		cpmsg(lang('plugin/ljww360','wwtype1'), 'action=plugins&operation=config&identifier=ljww360&pmod=admin_wwgl&lj=reply', 'succeed');
	}
}else if($_GET['lj']=='thread_qk'){
	if($_GET['formhash']==formhash()){
		C::t('#ljww360#plugin_lj_thread')->truncate();
		C::t('#ljww360#plugin_lj_post')->truncate();
		cpmsg(lang('plugin/ljww360','admin_wwgl_12'), 'action=plugins&operation=config&identifier=ljww360&pmod=admin_wwgl', 'succeed');
	}
}else{
	if(!submitcheck('submit')) {
		
		
		showformheader('plugins&operation=config&do='.$do.'&identifier=ljww360&pmod=admin_wwgl');
		showtableheader(lang('plugin/ljww360','admin_wwgl_5').'<a href="admin.php?action=plugins&operation=config&identifier=ljww360&pmod=admin_wwgl&lj=thread_qk&formhash='.FORMHASH.'">'.lang('plugin/ljww360','admin_wwgl_17').'</a>');
		include template('ljww360:admin_keyword');
		showsubtitle(array('',lang('plugin/ljww360','admin_wwgl_6'),lang('plugin/ljww360','admin_wwgl_7'),lang('plugin/ljww360','admin_wwgl_8'),lang('plugin/ljww360','admin_wwgl_9'),lang('plugin/ljww360','admin_wwgl_10'),lang('plugin/ljww360','admin_wwgl_11')));
		
		$currpage=$_GET['page']?$_GET['page']:1;
		$perpage=25;
		$start=($currpage-1)*$perpage;
		$con=" where 1";
		if(submitcheck('num_submit')) {
			$username=$_GET['username'];
			$kaishi=strtotime($_GET['kaishi']);
			$jiesu=strtotime($_GET['jiesu']);
			if($username){
				$con.=" and author ='$username'";
			}
			if($kaishi&&$jiesu){
				$con.=" and dateline >= $kaishi and dateline <= $jiesu";
			}
		}
		$num=C::t('#ljww360#plugin_lj_thread')->count_by_id($con);
		//debug($con);
		$counts=C::t('#ljww360#plugin_lj_thread')->range_by_id($con,$start,$perpage,'desc');
		$paging = helper_page :: multi($num, $perpage, $currpage, 'admin.php?action=plugins&operation=config&identifier=ljww360&pmod=admin_wwgl&username='.$username.'&kaishi='.$kaishi.'&jiesu='.$jiesu, 0, 10, false, false);
		$typearr=C::t('#ljww360#plugin_ljwenwentype')->range();//分类
		//问答分类
		$fenleiarr = C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid();
		include template('ljww360:admin_tc');
		showtablefooter();
		showformfooter();
		
		
	}else{
		//debug($_GET);
		if($_GET['wd_del']=='1'||$_GET['fourm_del']=='1'){
			if(is_array($_POST['idarray'])&&$_GET['wd_del']=='1') {
				foreach($_POST['idarray'] as  $wid) {
					$wid = intval(trim($wid));
					C::t('#ljww360#plugin_lj_thread')->delete($wid);
					C::t('#ljww360#plugin_lj_post')->fetch_by_del($wid);
				}
			}
			if(is_array($_POST['idarray'])&&$_GET['fourm_del']=='1') {
				foreach($_POST['idarray'] as $atid=>$wwid) {
					$atid = intval(trim($atid));
					//debug($atid);
					DB::update('forum_post', array('invisible'=>'-1'), "tid='$atid'");
					DB::update('forum_thread', array('displayorder'=>'-1'), "tid='$atid'");
				}
			}
			cpmsg(lang('plugin/ljww360','wwtype1'), 'action=plugins&operation=config&do='.$do.'&identifier=ljww360&pmod=admin_wwgl', 'succeed');
		}
		if($_GET['wdfl']='1'){
			if(is_array($_POST['idarray'])) {
				foreach($_POST['idarray'] as $id) {
					$id = intval(trim($id));
					$catid2=$_GET['id_3'];
					$catid=$_GET['catid'];
					if($catid2){
						$catid=$catid2;
					}
					DB::update('plugin_lj_thread',array('catid'=>$catid,'catid2'=>$catid2),"id ='$id'");
				}
			}
			cpmsg(lang('plugin/ljww360','admin_wwgl_12'), 'action=plugins&operation=config&do='.$do.'&identifier=ljww360&pmod=admin_wwgl', 'succeed');
		}
	}
}
?>
