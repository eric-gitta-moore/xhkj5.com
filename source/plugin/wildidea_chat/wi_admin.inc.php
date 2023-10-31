<?php
/**
 * Created by discuzX.
 * @author  wildidea<lirongtong@hotmail.com>
 * @link    http://www.wildidea.cn
 * @github  https://github.com/lirongtong
 * @date    2017-2-16 18:12
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) exit('Access Denied');
require 'global.php';
/* check exec() function */
if(!function_exists('exec')){
    cpmsg($PL_LANG['execSupportTip'], '', 'error');
}
/* check php command */
exec('php -v', $vRes, $vState);
if(intval($vState) != 0 && !$vRes){
    cpmsg($PL_LANG['globalCommandTip'], '', 'error');
}

/**
 * exec command
 * @param $host
 * @param $port
 * @param $isWin
 * @return bool
 * @link http://www.wildidea.cn
 * @author wildidea<lirongtong@hotmail.com>
 */
function start($host, $port, $isWin){
    $cmd = 'php '.__DIR__.'/server.php '.$host.' '.$port;
    if($isWin){
        pclose(popen('start /B '.$cmd, 'r'));
    }else{
        exec($cmd.' > /dev/null &');
    }
    $PL_G['listen_domain'] = $host;
    $PL_G['listen_port'] = $port;
    return true;
}

/**
 * close
 * @param array $pid
 * @param $isWin
 * @return array
 * @link http://www.wildidea.cn
 * @author wildidea<lirongtong@hotmail.com>
 */
function stop($pid, $isWin){
    $temp = [];
    foreach($pid as $k => $v){
        if($isWin){
            exec('taskkill /pid '.$v.' -t -f', $killRes, $killState);
        }else{
            exec('kill -s 9 '.$v, $killRes, $killState);
        }
        if(intval($killState) != 0){
            $temp[] = $v;
        }
    }
    return $temp;
}

/**
 * GET PID
 * @param $isWin
 * @return array
 * @link http://www.wildidea.cn
 * @author wildidea<lirongtong@hotmail.com>
 */
function getPid($isWin){
    $tempProcess = $processes = $pid = array();
    if($isWin){
        /* WIN - get process */
        exec('tasklist', $task, $listState);
        $word = 'php.exe';
    }else{
        exec('ps -ax|grep php', $task, $listState);
        $word = 'server.php';
    }
    if(intval($listState) == 0 && $task){
        /* match */
        foreach($task as $process){
            if(strpos($process, $word) !== false){
                $tempProcess[] = $process;
            }
        }
        /* handle process string */
        if($tempProcess){
            foreach($tempProcess as $key => $val){
                $processData = explode(' ', $val);
                foreach($processData as $k => $v){
                    $v = trim($v);
                    if(!empty($v)) $processes[$key][] = $v;
                }
            }
        }
        /* get pid */
        if($processes){
            foreach($processes as $p){
                if($isWin) $pid[] = $p[1];
                else $pid[] = $p[0];
            }
        }
    }
    return $pid;
}

global $_G;
$os = PHP_OS;
$isWin = strtoupper(substr($os, 0, 3)) == 'WIN' ? true : false;
$version = PHP_VERSION;
$pid = getPid($isWin);
$status = $pid ? '<span class="red">'.$PL_LANG['yes'].'</span>' : '<span class="red">'.$PL_LANG['no'].'</span>';
$pidStr = $pid ? implode(' / ', $pid) : $PL_LANG['none'];
$http = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$submitUrl = $http.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'&fh='.formhash();

if($_POST['doSubmit']){
	$formHash = $_GET['fh'] ? $_GET['fh'] : $_POST['fh'];
    if($formHash == formhash()){
    	$host = $_POST['host'] ? trim($_POST['host']) : $_SERVER['HTTP_HOST'];
	    $port = $_POST['port'] ? intval(trim($_POST['port'])) : 12345;
	    $operation = isset($_POST['operation']) ? intval($_POST['operation']) : false;
	    if($operation == 1){
	        /* open */
	        $stopRes = stop($pid, $isWin);
	        if($stopRes){
	            $stopStr = '';
	            foreach($stopRes as $k => $v){
	                if($stopStr != '') $stopStr .= '<br />';
	                $stopStr .= $PL_LANG['pStop1'].' '.$PL_LANG['lBracket'].' '.$v.' '.$PL_LANG['rBracket'].' '.$PL_LANG['pStop2'];
	            }
	            cpmsg($stopStr.$PL_LANG['wrap'].$PL_LANG['pStop3'].$PL_LANG['pStop4'], '', 'error');
	        }else{
	            start($host, $port, $isWin);
	            cpmsg($PL_LANG['wsOpen'], $_SERVER['HTTP_REFERER'], 'succeed');
	        }
	    }else if($operation == -1){
	        /* close */
	        if($pid){
	            $stopRes = stop($pid, $isWin);
	            if($stopRes){
	                $stopStr = '';
	                foreach($stopRes as $k => $v){
	                    if($stopStr != '') $stopStr .= '<br />';
	                    $stopStr .= $PL_LANG['pStop1'].' '.$PL_LANG['lBracket'].' '.$v.' '.$PL_LANG['rBracket'].' '.$PL_LANG['pStop2'];
	                }
	                cpmsg($stopStr.$PL_LANG['wrap'].$PL_LANG['pStop3'].$PL_LANG['pStop5'], '', 'error');
	            }else{
	                cpmsg($PL_LANG['wsClose'], $_SERVER['HTTP_REFERER'], 'succeed');
	            }
	        }else{
	            cpmsg($PL_LANG['wsNotRunning'], $_SERVER['HTTP_REFERER'], 'error');
	        }
	    }else{
	        cpmsg($PL_LANG['wsOptSelect'], $_SERVER['HTTP_REFERER'], 'error');
	    }
    }else{
        cpmsg($PL_LANG['overdue'], '', 'error');
    }
}

$html = <<<EOF
<style>.red{color: red;}</style>
<table class="tb tb2">
    <tbody>
        <tr>
            <th colspan="15" class="partition">{$PL_LANG['wsRunTip']}<span class="red">{$PL_LANG['lBracketCn']}{$PL_LANG['important']}{$PL_LANG['rBracketCn']}</span></th>
        </tr>
        <tr>
            <td class="tipsblock">
                <ul>
                    <li>{$PL_LANG['explain1']}</li>
                    <li>{$PL_LANG['explain2']}</li>
                    <li>{$PL_LANG['explain3']}</li>
                    <li>{$PL_LANG['explain4']}</li>
                    <li>{$PL_LANG['explain5']}</li>
                    <li>{$PL_LANG['explain6']}</li>
                    <li>{$PL_LANG['explain7']}</li>
                    <li><span class="red">{$PL_LANG['explain8']}</span></li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
<table class="tb tb2">
    <tbody>
        <tr>
            <th colspan="15" class="partition">{$PL_LANG['wsState']}</th>
        </tr>
        <tr>
            <td class="tipsblock">
                <ul>
                    <li>{$PL_LANG['running']} {$PL_LANG['colon']}{$status}</li>
                    <li>{$PL_LANG['env']} {$PL_LANG['colon']}{$os} / PHP v{$version}</li>
                    <li>{$PL_LANG['pid']} {$PL_LANG['colon']}{$pidStr}</li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
<form action="{$submitUrl}" method="post" id="chat-setting-form">
    <table class="tb tb2">
        <tbody>
            <tr><th colspan="15" class="partition">{$PL_LANG['wsSetting']}</th></tr>
            <tr><td class="td27">{$PL_LANG['wsPort']}{$PL_LANG['colon']}</td></tr>
            <tr>
                <td class="rowform">
                    <input type="text" class="txt" placeholder="12345" name="port" />
                </td>
            </tr>
            <tr><td class="td27">{$PL_LANG['wsAct']}{$PL_LANG['colon']}</td></tr>
            <tr class="noborder">
                <td class="rowform">
                    <ul>
                        <li class="checked">
                            <input type="radio" class="radio" name="operation" value="1" />&nbsp;{$PL_LANG['ou']}
                        </li>
                        <li>
                            <input type="radio" class="radio" name="operation" value="-1" />&nbsp;{$PL_LANG['close']}
                        </li>
                    </ul>
                </td>
                <td class="tips2">{$PL_LANG['wsSetTip']}</td>
            </tr>
            <tr>
                <td colspan="15">
                    <input type="submit" class="btn" value="{$PL_LANG['submit']}" />
                    <input type="hidden" value="1" name="doSubmit" />
                </td>
            </tr>
        </tbody>
    </table>
</form>
EOF;

echo $html;