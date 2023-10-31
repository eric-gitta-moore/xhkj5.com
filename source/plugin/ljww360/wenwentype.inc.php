<?php
/*
 *	 
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
echo '<table class="tb tb2 " id="tips">
	<tr>
		<th  class="partition">'.lang('plugin/ljww360','type_6').'</th>
	</tr>
	<tr>
		<td class="tipsblock" s="1">
			<ul id="tipslis">
				<li>'.lang('plugin/ljww360','type_9').'</li>
				<li>'.lang('plugin/ljww360','type_10').'</li>
				<li>'.lang('plugin/ljww360','type_11').'</li>
			</ul>
		</td>
	</tr>
</table><br>';
if(file_exists(DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php')){
	include DISCUZ_ROOT . './data/sysdata/cache_wenwen_setting.php';
}else if(file_exists(DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php')){
	include DISCUZ_ROOT . './data/cache/cache_wenwen_setting.php';
}
$forums=C::t('forum_forum')->range();
$config = array();
foreach($pluginvars as $key => $val) {
	$config[$key] = $val['value'];
}
$_G['cache']['plugin']['ljtuandui'] = $config;
$tfid = unserialize($config['wenwenbk']);//<td><select name="td_class"><option value="4">未解决</option><option value="1" selected="">已解决</option>


$operation = $_GET['operation'];
if($operation == 'del') {
	$tid = intval($_GET['tid']);
	if($tid) {
		$upcid=C::t('#ljww360#plugin_ljwenwentype')->fetch($tid);
		$upcid=$upcid['upid'];
		if($upcid) {
			$subid=C::t('#ljww360#plugin_ljwenwentype')->fetch($upcid);
			$subid=$subid['subid'];
			$subarr = explode(",", $subid);
			foreach($subarr as $key=>$value) {
				if($value == $tid) {
					unset($subarr[$key]);
					break;
				}
			}
			DB::update('plugin_ljwenwentype', array('subid'=>implode(",", $subarr)), "id='$upcid'");
			//DB::query("UPDATE ".DB::table('plugin_ljwenwentype')." SET subid='".implode(",", $subarr)."' WHERE id='$upcid'");
		}
		C::t('#ljww360#plugin_ljwenwentype')->delete($tid);
		//DB::query("DELETE FROM ".DB::table('plugin_ljwenwentype')." WHERE id='{$tid}'");
	}
	cpmsg(lang('plugin/ljww360','wwtype1'), 'action=plugins&operation=config&do=82&identifier=ljww360&pmod=wenwentype', 'succeed');	
}

if(!submitcheck('editsubmit')) {	

?>
<script type="text/JavaScript">
var rowtypedata = [
	[[1,'<input type="text" class="txt" name="newcatorder[]" value="0" />', 'td25'], [2, '<input name="newcat[]" value="" size="20" type="text" class="txt" />']],
	[[1,'<input type="text" class="txt" name="newsuborder[{1}][]" value="0" />', 'td25'], [2, '<div class="board"><input name="newsubcat[{1}][]" value="" size="20" type="text" class="txt" /></div>']],
	
	];

function del(id) {
	if(confirm('Are you sure you want to delete it')) {
		window.location = '<?php echo ADMINSCRIPT;?>?action=plugins&operation=config&do=82&identifier=ljww360&pmod=wenwentype&operation=del&tid='+id;
	} else {
		return false;
	}
}
</script>
<?php
	showformheader('plugins&operation=config&do=82&identifier=ljww360&pmod=wenwentype');
	showtableheader('');
	showsubtitle(array(lang('plugin/ljww360','wwtype3'),lang('plugin/ljww360','wwtype4'), lang('plugin/ljww360','type_7'), lang('plugin/ljww360','wwtype5')));
	$threadtypes=C::t('forum_forumfield')->range();
	foreach($threadtypes as $ty){
		$ertypes=unserialize($ty[threadtypes]);
		foreach($ertypes[types] as $a=>$b){
			$santypes[$a]=$b;
		}
	}
	//debug($santypes);
echo <<<EOF
<script type="text/javascript">
function _on_select_z(id,fid){
	$('level_'+id).innerHTML = '';
	if(fid != "0"){
		ajaxget('plugin.php?id=ljww360:export&level=66&fid='+fid+'&catid='+id, 'level_'+id);
	}
	//$('fid').value = fid;
}
</script>
EOF;
	$brandtype = array();
	$query=C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid();
	foreach($query as $row){
		$brandtype[$row['id']] = $row;
		$squery=C::t('#ljww360#plugin_ljwenwentype')->fetch_ljwwtype_all_upid($row['id']);
		foreach($squery as $srow){
			$brandtype[$row['id']]['subtype'][$srow['id']] = $srow;
		}
	}
	
	if($brandtype) {
		foreach($brandtype as $id=>$type) {
			//debug($wcache['typeid'][$id]);
			if($wcache['typeid'][$id]){
				$ssarr='<select name="typeid['.$id.']" ><option value="'.$wcache['typeid'][$id].'">'.$santypes[$wcache['typeid'][$id]].'</option></select>';
			}
			$show = '<tr class="hover"><td class="td25"><input type="text" class="txt" name="order['.$id.']" value="'.$type['displayorder'].'" /></td><td><div class="parentboard"><input type="text" class="txt" name="name['.$id.']" value="'.$type['subject'].'"></div></td>';
			if(!$type['subid']) {
				$str='<td><select name="td_class['.$id.']" onchange="_on_select_z('.$id.',this.value)"><option value="" >'.lang('plugin/ljww360','type_8').'</option>';
				foreach($tfid as $key=>$fids){
						
						if($fids==$wcache['catid'][$id]){
								$select='selected';
							}
						$str.='<option value="'.$fids.'" '.$select.'>'.$forums[$fids]['name'].'</option>';
					unset($select);
				}
				$str.='</select><span id="level_'.$id.'">'.$ssarr.'</span></td>';
				unset($ssarr);
				$show.=$str;
				$show .= '<td><a  onclick="del('.$id.')" href="###">'.lang('plugin/ljww360','wwtype6').'</td></tr>';
			} else {
				$show .= '<td>&nbsp;</td></tr>';
			}
			echo $show;
			if($type['subtype']) {
				foreach($type['subtype'] as $subid=>$stype) {
					if($wcache['typeid'][$subid]){
						$ssssarr='<select name="typeid['.$subid.']" ><option value="'.$wcache['typeid'][$subid].'">'.$santypes[$wcache['typeid'][$subid]].'</option></select>';
					}
					$str='<td><select name="td_class['.$subid.']" onchange="_on_select_z('.$subid.',this.value)"><option value="" >'.lang('plugin/ljww360','type_8').'</option>';
					foreach($tfid as $key=>$fid){
						
							if($fid==$wcache['catid'][$subid]){
								$sel='selected';
							}
							
							$str.='<option value="'.$fid.'" '.$sel.'>'.$forums[$fid]['name'].'</option>';
							unset($sel);
					}
					
					$str.='</select><span id="level_'.$subid.'">'.$ssssarr.'</span></td>';
					unset($ssssarr);
					echo '<tr class="hover"><td class="td25"><input type="text" class="txt" name="order['.$subid.']" value="'.$stype['displayorder'].'" /></td><td><div class="board"><input type="text" class="txt" name="name['.$subid.']" value="'.$stype['subject'].'"></div></td>'.$str.'<td><a  onclick="del('.$subid.')" href="###">'.lang('plugin/ljww360','wwtype6').'</td></tr>';
				}
				
			}
			echo '<tr class="hover"><td class="td25">&nbsp;</td><td colspan="2" ><div class="lastboard"><a href="###" onclick="addrow(this, 1,'.$id.' )" class="addtr">'.lang('plugin/ljww360','wwtype7').'</a></div></td></tr>';
		}	
	}
	echo '<tr class="hover"><td class="td25">&nbsp;</td><td colspan="2" ><div><a href="###" onclick="addrow(this, 0)" class="addtr">'.lang('plugin/ljww360','wwtype8').'</a></div></td></tr>';
	

	showsubmit('editsubmit');
	showtablefooter();
	showformfooter();

} else {
	$order = daddslashes($_GET['order']);
	$name = daddslashes($_GET['name']);
	$newsubcat = daddslashes($_GET['newsubcat']);
	$newcat = daddslashes($_GET['newcat']);
	$newsuborder = daddslashes($_GET['newsuborder']);
	$newcatorder = daddslashes($_GET['newcatorder']);
	$wcache['catid']=daddslashes($_GET['td_class']);
	$wcache['typeid']=daddslashes($_GET['typeid']);
	foreach($wcache['catid'] as $keys=>$val){
		$wcache['cfid'][$val]=$keys;
	}
	if(is_array($wcache)) {
		require_once './source/function/function_cache.php';
		writetocache('wenwen_setting', getcachevars(array('wcache' => $wcache)));
	}
	
	//debug($wcache['cfid']);
	if(is_array($order)) {
		foreach($order as $key=>$value) {
			DB::update('plugin_ljwenwentype', array('displayorder'=>intval($value),'subject'=>$name[$key]), "id='$key'");
			//DB::query("UPDATE ".DB::table('plugin_ljwenwentype')." SET displayorder='".intval($value)."',subject='$name[$key]' WHERE id='$key'");
		}
	}

	if(is_array($newcat)) {
		foreach($newcat as $key=>$name) {
			if(empty($name)) {
				continue;
			}
			$cid = DB::insert('plugin_ljwenwentype', array('upid' => '0', 'subject' => $name, 'displayorder' => $newcatorder[$key]), 1);
		}
	}

	if(is_array($newsubcat)) {
		foreach($newsubcat as $cid=>$subcat) {
			$subid=C::t('#ljww360#plugin_ljwenwentype')->fetch($cid);
			$subtype =$subid['subid'];
			//$subtype = DB::result_first("SELECT subid FROM ".DB::table('plugin_ljwenwentype')." WHERE id='$cid'");
			foreach($subcat as $key=>$name) {
				$subid = DB::insert('plugin_ljwenwentype', array('upid' => $cid, 'subject' => $name, 'displayorder' => $newsuborder[$cid][$key]), 1);
				$subtype .= $subtype ? ','.$subid : $subid;
			}
			DB::update('plugin_ljwenwentype', array('subid'=>$subtype), "id='$cid'");
			//DB::query("UPDATE ".DB::table('plugin_ljwenwentype')." SET subid='$subtype' WHERE id='$cid'");
		}
	}

	//更新缓存
	cpmsg(lang('plugin/ljww360','wwtype9'), 'action=plugins&operation=config&do=82&identifier=ljww360&pmod=wenwentype', 'succeed');	
}

?>


