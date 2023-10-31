<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$pluginid='ljww360';
$lang = array_merge($lang, $scriptlang[$pluginid]);

if(empty($_GET['ac'])) {

	if(!submitcheck('seosubmit')) {
		echo '<script type="text/javascript">
		function insertContent(obj, text) {
			var obj = obj.parentNode.parentNode.firstChild.lastChild;
			selection = document.selection;
			obj.focus();
			if(!isUndefined(obj.selectionStart)) {
				var opn = obj.selectionStart + 0;
				obj.value = obj.value.substr(0, obj.selectionStart) + text + obj.value.substr(obj.selectionEnd);
			} else if(selection && selection.createRange) {
				var sel = selection.createRange();
				sel.text = text;
				sel.moveStart(\'character\', -strlen(text));
			} else {
				obj.value += text;
			}
		}
		</script>';

		$ljww360_seo = dunserialize($_G['setting']['ljww360_seo']);
		$page = array(
			'index' => array('bbname'),
			'list' => array('bbname', 'cat', 'problem_state'),
			'view' => array('bbname', 'subject', 'message'),
		);
		showformheader('plugins&operation=config&identifier='.$pluginid.'&pmod=seo');
		showtableheader();
		foreach($page as $key => $value) {
			$code = cplang('code');
			foreach($value as $v) {
				$code .= '<a onclick="insertContent(this, \'{'.$v.'}\');return false;" href="javascript:;" title="'.cplang($v).'">{'.cplang($v).'}</a>';
			}
			showtitle('page_'.$key);
			showsetting('seotitle', 'ljww360_seo['.$key.'][seotitle]', $ljww360_seo[$key]['seotitle'], 'text', '', 0, $code);
			showsetting('seokeywords', 'ljww360_seo['.$key.'][seokeywords]', $ljww360_seo[$key]['seokeywords'], 'text', '', 0, $code);
			showsetting('seodescription', 'ljww360_seo['.$key.'][seodescription]', $ljww360_seo[$key]['seodescription'], 'text', '', 0, $code);
		}
		showsubmit('seosubmit');
		showtablefooter();
		showformfooter();
		
	} else {
		$ljww360_seo = serialize($_GET['ljww360_seo']);
		DB::query("REPLACE INTO ".DB::table('common_setting')." (skey, svalue) VALUES ('ljww360_seo', '$ljww360_seo')");
		updatecache('setting');

		cpmsg('seo_update_succeed', 'action=plugins&operation=config&identifier='.$pluginid.'&pmod=seo', 'succeed');
	}
}

?>