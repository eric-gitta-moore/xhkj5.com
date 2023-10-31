<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-21 10:09
 */
ignore_user_abort(true);
error_reporting(E_ERROR);
@set_time_limit(0);
date_default_timezone_set('Asia/shanghai');

/**
 * Class WebSocket
 */
class WebSocket{

    const LISTEN_SOCKET_NUM = 9;
    /**
     * @var array
     */
    private $sockets = array();
    /**
     * @var resource
     */
    private $master;

    /**
     * WebSocket constructor.
     * @param $host
     * @param $port
     */
    public function __construct($host, $port){
        try{
            $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1);
            socket_bind($this->master, $host, $port);
            socket_listen($this->master, self::LISTEN_SOCKET_NUM);
        }catch(Exception $e){}
        $this->sockets[0] = array('resource' => $this->master);
        while(true){
            try{$this->doServer();}catch(Exception $e){}
        }
    }

    /**
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private function doServer(){
        $write = $except = NULL;
        $sockets = array_column($this->sockets, 'resource');
        $readNum = socket_select($sockets, $write, $except, NULL);
        if(false === $readNum) return ;
        foreach($sockets as $socket){
            if($socket == $this->master){
                $client = socket_accept($this->master);
                if(false === $client){
                    continue;
                }else{
                    self::connect($client);
                    continue;
                }
            }else{
                $bytes = @socket_recv($socket, $buffer, 2048, 0);
                if($bytes < 9){
                    $recvMsg = $this->disconnect($socket);
                }else{
                    if(!$this->sockets[(int)$socket]['handshake']){
                        self::handShake($socket, $buffer);
                        continue;
                    }else{
                        $recvMsg = self::parse($buffer);
                    }
                }
                array_unshift($recvMsg, 'receive_message');
                $msg = self::dealMessage($socket, $recvMsg);
                $this->broadcast($msg);
            }
        }
    }

    /**
     * connect
     * @param $socket
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public function connect($socket){
        if(function_exists('posix_getpid')) $pid = posix_getpid();
        else $pid = get_current_user();
        socket_getpeername($socket, $ip, $port);
        $socket_info = array(
            'resource' => $socket,
            'uname' => $pid,
            'handshake' => false,
            'ip' => $ip,
            'port' => $port
        );
        $this->sockets[(int)$socket] = $socket_info;
    }

    /**
     * close
     * @param $socket
     * @return array
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private function disconnect($socket){
        $recvMsg = array(
            'type' => 'logout',
            'content' => $this->sockets[(int)$socket]['uname']
        );
        unset($this->sockets[(int)$socket]);
        return $recvMsg;
    }

    /**
     * shake hand
     * @param $socket
     * @param $buffer
     * @return bool
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    public function handShake($socket, $buffer){
        $lineWithKey = substr($buffer, strpos($buffer, 'Sec-WebSocket-Key:')+18);
        $key = trim(substr($lineWithKey, 0, strpos($lineWithKey, "\r\n")));
        $upgradeKey = base64_encode(sha1($key.'258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        $upgradeMessage = 'HTTP/1.1 101 Switching Protocols'."\r\n";
        $upgradeMessage .= 'Upgrade: websocket'."\r\n";
        $upgradeMessage .= 'Sec-WebSocket-Version: 13'."\r\n";
        $upgradeMessage .= 'Connection: Upgrade'."\r\n";
        $upgradeMessage .= 'Sec-WebSocket-Accept:'.$upgradeKey."\r\n\r\n";
        socket_write($socket, $upgradeMessage, strlen($upgradeMessage));
        $this->sockets[(int)$socket]['handshake'] = true;
        $msg = array(
            'type' => 'handshake',
            'content' => 'done'
        );
        $msg = $this->build(json_encode($msg));
        socket_write($socket, $msg, strlen($msg));
        return true;
    }

    /**
     * parse
     * @param $buffer
     * @return mixed
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private function parse($buffer){
        $decoded = '';
        $len = ord($buffer[1]) & 127;
        if($len === 126){
            $masks = substr($buffer, 4, 4);
            $data = substr($buffer, 8);
        }else if($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data = substr($buffer, 14);
        }else{
            $masks = substr($buffer, 2, 4);
            $data = substr($buffer, 6);
        }
        for($index = 0; $index < strlen($data); $index++){
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }
        return json_decode($decoded, true);
    }

    /**
     * wrap
     * @param $msg
     * @return string
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private function build($msg){
        $frame = [];
        $frame[0] = '81';
        $len = strlen($msg);
        if($len < 126){
            $frame[1] = $len < 16 ? '0' . dechex($len) : dechex($len);
        }else if($len < 65025){
            $s = dechex($len);
            $frame[1] = '7e' . str_repeat('0', 4 - strlen($s)) . $s;
        }else{
            $s = dechex($len);
            $frame[1] = '7f' . str_repeat('0', 16 - strlen($s)) . $s;
        }
        $data = '';
        $l = strlen($msg);
        for($i = 0; $i < $l; $i++){
            $data .= dechex(ord($msg{$i}));
        }
        $frame[2] = $data;
        $data = implode('', $frame);
        return pack('H*', $data);
    }

    /**
     * wrap message
     * @param $socket
     * @param $recvMsg
     * @return string
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private function dealMessage($socket, $recvMsg){
        $msgType = $recvMsg['type'];
        $msgContent = $recvMsg['content'];
        $response = [];
        switch($msgType){
            case 'login':
                $this->sockets[(int)$socket]['uname'] = $msgContent;
                $userList = array_column($this->sockets, 'uname');
                $response['type'] = 'login';
                $response['content'] = $msgContent;
                $response['user_list'] = $userList;
                break;
            case 'logout':
                $userList = array_column($this->sockets, 'uname');
                $response['type'] = 'logout';
                $response['content'] = $msgContent;
                $response['user_list'] = $userList;
                break;
            case 'user':
                $uname = $this->sockets[(int)$socket]['uname'];
                $response['type'] = 'user';
                $response['uid'] = $recvMsg['uid'];
                $response['uname'] = $recvMsg['uname'];
                $response['avatar'] = trim($recvMsg['avatar']);
                $response['from'] = $uname;
                $response['content'] = $msgContent;
                break;
        }
        return $this->build(json_encode($response));
    }

    /**
     * broadcast
     * @param $data
     * @link http://www.wildidea.cn
     * @author wildidea<lirongtong@hotmail.com>
     */
    private function broadcast($data){
        foreach($this->sockets as $socket){
            if($socket['resource'] == $this->master){continue;}
            socket_write($socket['resource'], $data, strlen($data));
        }
    }
}
$host = $_SERVER['argv'][1] ? $_SERVER['argv'][1] : 'localhost';
$port = $_SERVER['argv'][2] ? $_SERVER['argv'][2] : '12345';
new WebSocket($host, $port);
