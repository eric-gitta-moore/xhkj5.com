<?php
/**
 * Created by 讯幻网-www.xhkj5.com.
 * User: Administrator
 * Date: 2018-01-20
 * Time: 下午 11:19
 * File Name: test.php
 * Project Name: test
 */
use Workerman\Worker;
use Workerman\Lib\Timer;
require_once 'Workerman/Autoloader.php';

//声明全局变量，储存TCP连接信息
global $_G,$_G_R,$_G_success,$_G_bind/*,$DB*/;
$_G = $_G_R = $_G_success = $_G_bind = array();
//$_G_R是$_G的逆向数组，即键名与键值对调，$_G = array('id' => 'terminal');
//$_G_bind格式：array('clientId'=>'serverId');

//创建一个worker对象
$worker = new Worker('tcp://0.0.0.0:9420');

//worker开始启动
$worker->onWorkerStart = function ($worker) {
    /**
     * 对调$_G和$_G_R
     */
    function flipArr() {
        //对调数组
        global $_G,$_G_R;
        $_G_R = flip($_G);
    }


    /**
     * 对调数组键名和键值
     * @param $array 被对调的数组
     * @return array
     */
    function flip ($array) {
        $arr = array();
        //对调数组，不保留对调后数组的键名
        foreach ($array as $k => $v) {
            $arr[] = $k;
        }

        return $arr;
    }
};

//终端发来消息时，触发回调函数
$worker->onMessage = function($con,$data)use($worker) {
//    //记录日志
//    global $DB;
//    $DB->query('INSERT INTO `'.TB_NAME.'`(`general_param`) VALUES('.urlencode($data).')');

    //所有提交进来的数据全部为json格式，在此进行解码，返回数组
    $data = json_decode($data,true);

    //如果不是json数据则结束
    if (!$data) {
        $con->send(json_encode('Access Denied'));
        return;
    }

    global $_G,$_G_R,$_G_bind;//启用全局变量

    //验证访问密匙
    $rand = '';
    if ($data['key'] !== '123456') {
        $con->send(json_encode(array('return' => array('msg' => 'Access Denied'))));
        return;
    } else {
        global $_G_success;
        if (!in_array($con->id,$_G_success))
        {
            $con->send(json_encode(array('return' => array('msg' => 'Connect Success'))));
        }
        flipArr();//对调
    }

    print_r($data);
    if (isset($worker->connections[$con->id]) && !in_array($con->id,$_G))
    {
        $_G[$con->id] = $data['terminal'];//终端入栈
    }
    print_r($_G);

    //server发送操作请求
    if ($data['terminal'] == 'server' && !empty($data['method']))
    {
        switch ($data['method'])
        {
            case 'post_msg':
                //校验参数防止出错
                if (empty($data['param']['msg']) || !in_array(intval($data['param']['target']),$_G_R))
                {
                    $con->send(json_encode(array('return' => array('msg' => 'param error'))));
                    return;
                }
                $worker->connections[intval($data['param']['target'])]->send(json_encode(array('return' => array('msg' => $data['param']['msg']))));
                echo '1';
                break;

            case 'get_info':
                $con->send(json_encode(array('return' => array('msg' => $_G))));
                break;

            case 'bind':
                $_G_bind[$data['param']['bindClientId']] = $con->id;
                //$_G_bind格式：array('clientId'=>'serverId');
                $con->send(json_encode(array('return' => array('msg' => 'Bind Success'))));
                break;

//            case 'get_qq_music':
//                $music_param = $data['param']['qqMusic'];
//                $music = new qqMusic($music_param['music_played_song_name'],$music_param['page'],$music_param['returned'],$music_param['charset'],$music_param['music_play_pink_interface'],$music_param['music_search_link_interface']);
//                $returned = $music->exec();
//                $con->send(json_encode(array('return' => array('msg' => $returned))));

            default :
                $con->send(json_encode(array('return' => array('msg' => 'Method Error'))));
                break;
        }

    } elseif ($data['terminal'] == 'client' && !empty($data['method'])) {//客户端发消息到服务端
        switch ($data['method']) {
            case 'post_msg':
                /*
                 * 'param' => array('msg'=>'***');
                 */
                if (!empty($_G_bind[$con->id])) {
                    $con->send(json_encode(array('return' => array('msg' => 'Undefined'))));
                } else {
                    //由于所有终端发数据之前都进行了json_encode()操作，所以这里就不需要重复操作了
                    $worker->connections[$_G_bind[$con->id]]->send($data['param']['msg']);
                }

                break;


            default :
                $con->send(json_encode(array('return' => array('msg' => 'Method Error'))));
                break;
        }
    }


//    $con->timer_id = Timer::add(1,function ()use($con) {
//        $con->send(json_encode('hearting'));
//    });

};


//有终端连接时，触发回调函数
$worker->onConnect = function ($con) {
    $con->send(json_encode(array('return' => array('msg' => 'Please Return'))));
    global $_G_success;
    $_G_success[] = $con->id;

};


//有终端断开时，触发回调函数
$worker->onClose = function ($con) {
    global $_G,$_G_success;//启用全局变量

    unset($_G[$con->id]);//该终端出栈

    foreach ($_G_success as $k => $v)
    {
        if ($v == $con->id)
        {
            unset($_G_success[$k]);
            break;
        }
    }

    flipArr();//对调
};


//运行worker
$worker::runAll();








