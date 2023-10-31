<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
loadcache('plugin');
$var = $_G['cache']['plugin']['csu_baidu'];
define('KEY',$var['api_key']);
define('SECRET',$var['api_secret']);
define('BAIDUAPI','https://openapi.baidu.com/rest/2.0/');
define('BAIDOAUTH','https://openapi.baidu.com/oauth/2.0/');
function getAuth($rd = ''){
	global $_G;
	if(empty($rd)) $rd = str_replace(array($_G['siteurl'],'./') ,'',dreferer());
	return BAIDOAUTH.'authorize?response_type=code&client_id='.KEY.'&redirect_uri='.urlencode($_G['siteurl'].$rd).(defined('IN_MOBILE') ? '&display=mobile' : '');
}
function getToken($code,$redirect_uri){
	global $_G;
	$op = dfsockopen( BAIDOAUTH.'token?grant_type=authorization_code&code='.$code.'&client_id='.KEY.'&client_secret='.SECRET.'&redirect_uri='.urlencode($_G['siteurl'].$redirect_uri));
	return $op;
}
function getbind($uid){
	return C::t('#csu_baidu#csu_baidu_connect')->fetch($uid);
}
function getinfo($access_token){
	return dfsockopen(BAIDUAPI.'passport/users/getInfo?access_token='.$access_token);
}
function refreshtoken($refresh_token){
	$op = dfsockopen( BAIDOAUTH.'token?grant_type=refresh_token&refresh_token='.$refresh_token.'&client_id='.KEY.'&client_secret='.SECRET);
	return $op;
}
function savecode(){
	$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$randnum = $str[rand(0,61)].$str[rand(0,61)].$str[rand(0,61)].$str[rand(0,61)].$str[rand(0,61)].$str[rand(0,61)];
	$data = C::t("#csu_baidu#csu_baidu_guest")->fetch($randnum);
	if($data['code']) $randnum = savecode();
	else return $randnum;
}
function tochar($variables, $in_charset="UTF-8", $out_charset=CHARSET) {
	if($in_charset==$out_charset) return $variables;
	else{
		if(is_array($variables)){
			foreach($variables as $_k => $_v) {
				if(is_array($_v)) $variables[$_k] = tochar($_v, $in_charset, $out_charset);
				elseif(is_string($_v)) $variables[$_k] = diconv($_v, $in_charset, $out_charset);
			}
		}else $variables = diconv($variables, $in_charset, $out_charset);
		return $variables;
	}
}
function objectToArray($obj){
    $arr = is_object($obj) ? get_object_vars($obj) : $obj;
    if(is_array($arr)){
        return array_map(__FUNCTION__, $arr);
    }else{
        return $arr;
    }
}

?>