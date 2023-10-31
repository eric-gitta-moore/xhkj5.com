<?php
function setthreadpic($tid,$num,$type=''){
	if($type == 'piccount') {
	foreach (DB::fetch_all('SELECT tableid FROM '.DB::table('forum_attachment').' WHERE tid = '.$tid) as $setthread){
		foreach ($getdata = DB::fetch_all('SELECT * FROM '.DB::table('forum_attachment_'.$setthread['tableid'].'').' WHERE isimage=1 and tid = '.$tid . '  LIMIT  0 ,5') as $setthreadpic){
			
	
				$setthreadpicarray[$setthreadpic['aid']] = getforumimg($setthreadpic['aid'],'0','160','160');
		
		}
		break;
	}
	return count($setthreadpicarray);
	}
	foreach (DB::fetch_all('SELECT tableid FROM '.DB::table('forum_attachment').' WHERE tid = '.$tid) as $setthread){
		foreach ($getdata = DB::fetch_all('SELECT * FROM '.DB::table('forum_attachment_'.$setthread['tableid'].'').' WHERE isimage=1 and tid = '.$tid . '  LIMIT  0 ,'.$num) as $setthreadpic){
			
			if($type == 'piclist'){
				$setthreadpicarray[$setthreadpic['aid']] = getforumimg($setthreadpic['aid'],'0','500','500');
			}else{
				$setthreadpicarray[$setthreadpic['aid']] = getforumimg($setthreadpic['aid'],'0','160','160');
			}
		}
		break;
	}
	return $setthreadpicarray;
}
//WWW.fx8.cc
?>


