<?php
error_reporting(0);
define('IN_CRONLITE', true);
define('VERSION', '1001');
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
define('SYS_KEY', 'quanquan');
define('CC_Defender', 1); //防CC攻击开关(1为session模式)

date_default_timezone_set("PRC");
$date = date("Y-m-d H:i:s");
session_start();
if(CC_Defender!=0){
	include_once SYSTEM_ROOT.'function/security.php';
}
include_once(SYSTEM_ROOT."function/function.php");
$url=addslashes($_GET['url']);

//下面配置接口============================
$apijk = array(
'0' => 'http://wwwhe53.177kdy.cn/4.php?pass=1&url=|总通用vip接口',
'1' => 'http://api.suduniu.com/sudu/?url=|通用vip接口1',
'2' => 'http://www.65yw.com/chaojikan.php?url=|通用vip接口2',
'3' => 'http://000o.cc/jx/ty.php?url=|通用vip接口3',
//'31' => 'http://api.nepian.com/ckparse/?url=|通用vip接口18',//不稳定
//'4' => 'http://yyygwz.com/index.php?url=|通用vip接口4',//坏
//'5' => 'http://api.cloudparse.com/?url=|全网通用接口5',//坏
//'6' => 'https://api.47ks.com/webcloud/?v=|通用vip接口6',//坏
//'7' => 'http://www.ou522.cn/t2/1.php?url=|通用vip接口7',//坏
//'8' => 'http://jx.xuanpianwang.com/parse?url=|通用vip接口8',//坏
'9' => 'http://www.wmxz.wang/video.php?url=|通用vip接口9',
//'10' => 'http://www.vipjiexi.com/yun.php?url=|通用vip接口10',//坏
//'11' => 'http://j.oxxxxx.cn/jx/?url=|通用接口11',//坏
//'12' => 'http://v.72du.com/api/?url=|通用接口12',//不稳定
//'13' => 'http://www.97zxkan.com/jiexi/97zxkanapi.php?url=|通用接口13',//坏
//'14' => 'http://aikan-tv.com/tong.php?url=|通用接口14',//坏
'16' => 'http://www.yydy8.com/Common/?url=|通用vip接口15（清晰度一般）',
'24' => 'http://47.89.49.245/video.php?url=|通用接口16',
'25' => 'http://p2.api.47ks.com/webcloud/?url=|通用接口17',
'17' => 'https://apiv.ga/magnet/|磁力解析',
'18' => 'http://www.yydy8.com/Common/?url=|芒果TV手机接口',
'19' => 'http://v.rpsofts.com/v.php?url=|优酷超清接口',
'20' => 'http://mt2t.com/yun?url=|搜狐视频接口',
'21' => 'http://jx.xuanpianwang.com/parse?url=|乐视解析',
'22' => 'http://www.wmxz.wang/video.php?url=|腾讯vip接口（腾讯超清)',
'23' => 'http://jx.71ki.com/index.php?url=|优酷、乐视、搜狐、爱奇艺',
'24' => 'http://player.gakui.top/?url=|通用vip接口④（清晰度渣）',
'25' => 'http://qtzr.net/s/?qt=|万能接口1',
'26' => 'http://www.82190555.com/video.php?url=|万能接口2',
'27' => 'http://www.chepeijian.cn/jiexi/vip.php?url=|万能接口3',
'28' => 'http://moon.z66.pw/qiyi.php?url=|爱奇艺超清接口1',
'29' => 'http://yun.zihu.tv/play.html?url=|爱奇艺超清接口2',
'30' => '|更多接口待添加...',
);

@list($jk, $apiname)  = explode('|', $apijk[intval($_GET['jk'])]);
?>