<?php
$navtitle = "购买VIP用户组";    //标题  
$metakeywords = "购买VIP用户组,讯幻网";  //关键词  
$metadescription = "购买讯幻网VIP用户组";  //页面SEO简介  
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
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
if(is_mobile()&&$_POST['action'] != 'writeData'){
    header('Location: plugin.php?id=yytd_vip:m');
    exit;
}

loadcache('plugin');
//获取站点ID和站点密匙  如果没有配置 则使用积分充值的配置
$my_conf = $_G['cache']['plugin']['yytd_vip'];
$parter_id = trim($my_conf['parter_id']);
$parter_sign = trim($my_conf['parter_sign']);




if ($parter_id==='' or $parter_sign===''){
    $pluginName = 'yinxingfei_thinfellpay_client';
    $set = $_G['cache']['plugin'][$pluginName];
    $parter_id = $set['appid'];;
    $parter_sign = $set['secret'];;


}
$setContent = $_G['cache']['plugin']['yytd_vip'];
$yytd_rule = handleryytd_rule(explode("\r\n",trim($setContent['yytd_rule'])));
$yytd_note = explode("\r\n", $setContent['yytd_note']);
$yytd_isshow = $setContent['yytd_isshow'];

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
if ($yytd_isshow == 1) {
    $order_completed_data = C::t('#yytd_vip#yytd_vip')->fetch_ordercompleted_data($uid);
    $ocdCount = count($order_completed_data);
    for ($i = 0; $i < $ocdCount; $i++) {
        $order_completed_data[$i]['adddate'] = date('Y-m-d H:i:s', $order_completed_data[$i]['adddate']);
    }
}


if ($_GET['action'] == 'buytrue') {
    //判断当前用户是否处于登录状态
    if (!$_G['uid']) {
     //   showmessage('not_loggedin', NULL, array(), array('login' => 1));
        showmessage(lang('plugin/yytd_vip', 'login_status'), NULL, array(), array());
    }
    //判断当前站点 id是否设置正确
	if($parter_id==""){
		showmessage(lang('plugin/yytd_vip', 'eccontractinfo'), NULL, array(), array());
		return;
	}
	if($parter_sign==""){
		showmessage(lang('plugin/yytd_vip', 'eccontractinfo'), NULL, array(), array());
		return;
	}


    $buyIdKey = $_GET['buyId'];

    include template('common/header_ajax');
    echo '<form id="payform" name="payform" action="plugin.php?id=yytd_vip" method="post"><input type="hidden" value="writeData" name="action"><input type="hidden" value="'.$buyIdKey.'" name="IDKey"><input type="hidden" id="formhash" name="formhash" value="'.FORMHASH.'" ></form><script type="text/javascript" reload="1">document.forms[\'payform\'].submit();</script>';
    include template('common/footer_ajax');
}

if ($_POST['action'] == 'writeData') {
    if (!submitcheck('action')) {
        echo "args error";
        return;
    }

    $buyIdKey = $_POST['IDKey'];
    if (!isset($yytd_rule[$buyIdKey])) {
        echo $buyIdKey;
        exit('Access Denied');
    }



    $titleStr = '';
    if ($yytd_rule[$buyIdKey][3] == 0) {
        $titleStr = lang('plugin/yytd_vip', 'order_group_name') . $yytd_rule[$buyIdKey][0] . lang('plugin/yytd_vip', 'validityinfo');
    } else {
        $titleStr = lang('plugin/yytd_vip', 'order_group_name') . $yytd_rule[$buyIdKey][0] . $yytd_rule[$buyIdKey][3] . "_Day";
    }

   $pay_type = $_POST['pay_type'];
   $rand = rand(10000000000,99999999999);
    $orderid = md5($_G['timestamp'].'_'.$rand.'_'.$_G['uid']);
	
    $insertdata = array(
        'order_id' =>$orderid,
        'order_status' => 1,
        'uid' => $uid,
        'username' => $myname,
        'trade_no' => '',
        'group_id' => $yytd_rule[$buyIdKey][1],
        'group_name' => $yytd_rule[$buyIdKey][0],
        'extcreditstitle' => $yytd_rule[$buyIdKey][4],
        'extcredits' => $yytd_rule[$buyIdKey][5],
        'price' => $yytd_rule[$buyIdKey][2],
        'expire' => $yytd_rule[$buyIdKey][3],
        'adddate' => time(),
        'editdate' => 0,
        'ip' => $_G['clientip'],
        'bankname' => $pay_type,
    );
    C::t('#yytd_vip#yytd_vip')->insert_data($insertdata);


	$args = array();
	$post_time = time();
	$args['fee'] = sprintf("%.2f", $insertdata['price']);
	$args['notifyUrl'] =$_G['siteurl'].'plugin.php?id=yytd_vip:callback';
    $args['returnUrl'] =$_G['siteurl'].'plugin.php?id=yytd_vip:returnback';

    $number = 0;
    $zhongwen = '购买VIP';
    $zhongwen = diconv($zhongwen, 'UTF-8', CHARSET);
    $subject = $_G['username'].$zhongwen.'['.$yytd_rule[$buyIdKey][0].']';//标题


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
		$sign = md5($parter_id.$timestamp.$parter_sign);
		$optional = array(
				'number' => $number,
				'extcredit' => 0,
		);

        $subject = diconv($subject, CHARSET, 'UTF-8');
        $subject = urlencode($subject);

		$para = array(
			'sign' => $sign,
			'appid' => $parter_id,
			'timestamp' => $timestamp,
			'total_fee' => $fee*100,//单位分
			'bill_no' => $orderid,
			'title' => $subject,
			'optional' => json_encode($optional),
			'return_url' => urlencode($args['returnUrl']),
			'notify_url' => urlencode($args['notifyUrl']),
			'bill_timeout' => '3600',//单位为秒
		);
		
		$para_get = createLinkstring($para);
		
		dheader('Location: http://pay.szyuxitech.com/api?'.$para_get);

}

include template('yytd_vip:index');


function handleryytd_rule($arrayrule)
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
?>
