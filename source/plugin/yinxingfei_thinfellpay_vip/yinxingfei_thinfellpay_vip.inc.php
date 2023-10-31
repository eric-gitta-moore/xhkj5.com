<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if(is_mobile()&&$_POST['action'] != 'writeData'){
    header('Location: plugin.php?id=yinxingfei_thinfellpay_vip:m');
    exit;
}
$navtitle = "&#36141;&#20080;&#86;&#73;&#80;&#29992;&#25143;&#32452;";    //标题  
$metakeywords = "&#36141;&#20080;&#86;&#73;&#80;&#29992;&#25143;&#32452;,&#35759;&#24187;&#32593;";  //关键词  
$metadescription = "&#36141;&#20080;&#35759;&#24187;&#32593;&#86;&#73;&#80;&#29992;&#25143;&#32452;";  //页面SEO简介  
$pluginName='yinxingfei_thinfellpay_vip';
//获取站点ID和站点密匙  如果没有配置 则使用积分充值的配置
global $_G;
$myConf = $_G['cache']['plugin'][$pluginName];
$appID = trim($myConf['appID']);
$appKey = trim($myConf['appKey']);
$myConf = $_G['cache']['plugin'][$pluginName];
$yinxingfei_thinfellpay_rule = handleryinxingfei_thinfellpay_rule(explode("\r\n",trim($myConf['rule'])));
$yinxingfei_thinfellpay_note = explode("\r\n", $myConf['note']);
$yinxingfei_thinfellpay_isshow = $myConf['isshow'];
$gate_way=$myConf['gateway'];
$myname = $_G['username'];
$uid = $_G['uid'];
$grouptitle = $_G['group']['grouptitle'];
$myweiwang = getuserprofile(extcredits1);
$mymoey = getuserprofile(extcredits2);
$mygongxian = getuserprofile(extcredits3);
$moneyname = $_G['setting']['extcredits']['2']['title'];
$weiwangname = $_G['setting']['extcredits']['1']['title'];
$gongxianname = $_G['setting']['extcredits']['3']['title'];
//显示购买记录
if ($yinxingfei_thinfellpay_isshow == 1) {
    $order_completed_data = C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->fetch_ordercompleted_data();
    $ocdCount = count($order_completed_data);
    for ($i = 0; $i < $ocdCount; $i++) {
        $order_completed_data[$i]['adddate'] = date('Y-m-d H:i:s', $order_completed_data[$i]['adddate']);
    }
}

if ($_GET['action'] == 'buytrue') {
    //判断当前用户是否处于登录状态
    if (!$_G['uid']) {
        showmessage(lang('plugin/yinxingfei_thinfellpay_vip', 'login_status'), NULL, array(), array());
    }

    //判断当前用户组是否有购买权限
    $setgroups = $myConf['allowBuy'];
    $setgroupsr = unserialize($setgroups);
    if(!in_array($_G['groupid'],$setgroupsr)){
        showmessage(lang('plugin/'.$pluginName, 'You do not have permission to use this function in the user group'),
           '/plugin.php?id=yinxingfei_thinfellpay_vip',
          array(),
           array('locationtime'=>true,'refreshtime'=>5,'showdialog'=>1,'showmsg'=>true));
        return;
    }

    //判断当前站点 id是否设置正确
	if($appID==""){
		showmessage(lang('plugin/yinxingfei_thinfellpay_vip', 'eccontractinfo'),
            array(),
            array('locationtime'=>true,'refreshtime'=>5,'showdialog'=>1,'showmsg'=>true));
        return;
	}
	if($appKey==""){
		showmessage(lang('plugin/yinxingfei_thinfellpay_vip', 'eccontractinfo'),
            array(),
            array('locationtime'=>true,'refreshtime'=>5,'showdialog'=>1,'showmsg'=>true));
        return;
	}

    $buyIdKey = $_GET['buyId'];
    echo '<form id="payform" name="payform" action="plugin.php?id=yinxingfei_thinfellpay_vip" method="post"><input type="hidden" value="writeData" name="action"><input type="hidden" value="'.$buyIdKey.'" name="IDKey"><input type="hidden" id="formhash" name="formhash" value="'.FORMHASH.'" ></form><script type="text/javascript" reload="1">document.forms[\'payform\'].submit();</script>';
}

if ($_POST['action'] == 'writeData') {
    if (!submitcheck('action')) {
        echo "args error";
        return;
    }
    $buyIdKey = intval($_POST['IDKey']);
    //判断用户组是否真是存在
    $group_id=$yinxingfei_thinfellpay_rule[$buyIdKey][1];
    $user_group = C::t('common_usergroup')->fetch($group_id, false, 1);

    if (empty($user_group)) {
        showmessage(lang('plugin/yinxingfei_thinfellpay_vip', 'usergroup is not exists'),
            array(),
            array('locationtime'=>true,'refreshtime'=>5,'showdialog'=>1,'showmsg'=>true));
        return;
    }



    if (!isset($yinxingfei_thinfellpay_rule[$buyIdKey])) {
        echo $buyIdKey;
        exit('Access Denied');
    }



    $titleStr = '';
    if ($yinxingfei_thinfellpay_rule[$buyIdKey][3] == 0) {
        $titleStr = lang('plugin/yinxingfei_thinfellpay_vip', 'order_group_name') . $yinxingfei_thinfellpay_rule[$buyIdKey][0] . lang('plugin/yinxingfei_thinfellpay_vip', 'validityinfo');
    } else {
        $titleStr = lang('plugin/yinxingfei_thinfellpay_vip', 'order_group_name') . $yinxingfei_thinfellpay_rule[$buyIdKey][0] . $yinxingfei_thinfellpay_rule[$buyIdKey][3] . "_Day";
    }

   $pay_type = $_POST['pay_type'];
    $orderid = md5(uniqid(md5(microtime(true)),true));
	
    $insertdata = array(
        'order_id' =>$orderid,
        'order_status' => 1,
        'uid' => $uid,
        'username' => $myname,
        'trade_no' => '',
        'group_id' => $yinxingfei_thinfellpay_rule[$buyIdKey][1],
        'group_name' => $yinxingfei_thinfellpay_rule[$buyIdKey][0],
        'extcreditstitle' => $yinxingfei_thinfellpay_rule[$buyIdKey][4],
        'extcredits' => $yinxingfei_thinfellpay_rule[$buyIdKey][5],
        'price' => $yinxingfei_thinfellpay_rule[$buyIdKey][2],
        'expire' => $yinxingfei_thinfellpay_rule[$buyIdKey][3],
        'adddate' => time(),
        'editdate' => 0,
        'ip' => $_G['clientip'],
        'bankname' => $pay_type,
    );
    C::t('#yinxingfei_thinfellpay_vip#yinxingfei_thinfellpay_vip')->insert_data($insertdata);
	$args = array();
	$post_time = time();
	$args['fee'] = sprintf("%.2f", $insertdata['price']);
	$args['notifyUrl'] =$_G['siteurl'].'plugin.php?id=yinxingfei_thinfellpay_vip:callback';
    $args['returnUrl'] =$_G['siteurl'].'plugin.php?id=yinxingfei_thinfellpay_vip:returnback';
    $number = 0;
    $zhongwen = '购买VIP';
    $zhongwen = diconv($zhongwen, 'UTF-8', CHARSET);
    $subject = $_G['username'].$zhongwen.'['.$yinxingfei_thinfellpay_rule[$buyIdKey][0].']';//标题
    //生成订单
    $fee = $args['fee'];
    $post = array(
        'id' => $orderid,
        'creation_time' => $_G['timestamp'],
        'uid' => $_G['uid'],
        'number' => $number,
        'fee' => $fee,
        'extcredit' => 0,
        'state' => 0,
        'finish_time' => '0',
        'subject' => $subject,
        'paytype' => '0'
    );
		$timestamp = $_G['timestamp'];
		$sign = md5($appID.$timestamp.$appKey);
		$optional = array(
				'number' => $number,
				'extcredit' => 0,
		);
        $subject = diconv($subject, CHARSET, 'UTF-8');
        $subject = urlencode($subject);
		$para = array(
			'sign' => $sign,
			'appid' => $appID,
			'timestamp' => $timestamp,
			'total_fee' => intval($fee*100),//单位分
			'bill_no' => $orderid,
			'title' => $subject,
			'optional' => json_encode($optional),
			'return_url' => urlencode($args['returnUrl']),
			'notify_url' => urlencode($args['notifyUrl']),
			'bill_timeout' => '3600',//单位为秒
		);
		$para_get = createLinkstring($para);
		dheader('Location:'.trim($gate_way).'?'.$para_get);
}

include template('yinxingfei_thinfellpay_vip:index');


function handleryinxingfei_thinfellpay_rule($arrayrule)
{
	$rules = array();
	foreach($arrayrule as $value){
		$tmpArray = explode("||",$value);
		array_push($rules,$tmpArray);
	}
	return $rules;
}
function createLinkstring($para) {
	$arg  = "";
	while (list ($key, $val) = each ($para)) {
		$arg.=$key."=".$val."&";
	}

	$arg = substr($arg,0,count($arg)-2);
	

	if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}//如果存在转义字符，那么去掉转义
	
	return $arg;
}

function is_mobile()
{
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = '0';
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda','xda-'
    );
    if(in_array($mobile_ua, $mobile_agents))
        $mobile_browser++;
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
        $mobile_browser++;
    // Pre-final check to reset everything if the user is on Windows
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
        $mobile_browser=0;
    // But WP7 is also Windows, with a slightly different characteristic
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
        $mobile_browser++;
    if($mobile_browser>0)
        return true;
    else
        return false;
}
?>