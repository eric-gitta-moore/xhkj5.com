<?php
/**
 * Created by 讯幻网-www.xhkj5.com.
 * User: Administrator
 * Date: 2018-01-29
 * Time: 下午 09:38
 * File Name: get_qqmusic.php
 * Project Name: xhkj5com_control_school
 */

include_once './class/QQMusic.php';

echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>QQ音乐</title></head><body>';

echo <<<html
<form action="get_qqmusic.php" method="post">
keyword: <input type="text" name="keyword"><br>
page: <input type="text" name="page"><br>
num: <input type="text" name="num"><br>
<button type="submit">提交</button>
<button type="reset">重置</button><hr>
</form>
html;


if (!empty($_POST['keyword']))
{
    $keyword = $_POST['keyword'];
    $music = new QQMusic();
    $song_returned = $music->searchSongByName($keyword,empty($_POST['page'])?1:$_POST['page'],empty($_POST['num'])?30:$_POST['num']);
    $result = array();
    //print_r($song_returned);
    foreach ($song_returned['song']['list'] as $k => $v)
    {
        foreach ($v as $k1 => $v1)
        {
            switch ($k1)
            {
                case 'id':
                    $result[$k][$k1] = $v1;
    //                echo $k;
                    break;
                case 'mid':
                    $result[$k][$k1] = $v1;
                    $key = $music->searchVkeyBySongMid($v1);
                    $result[$k]['link'] = $music->searchSongPlayLinkByMidVkeyAndGuid($v1,$key['vkey'],$key['guid']);
                    $result[$k]['link2'] = $music->searchSongPlayLinkByMid($v1);
                    break;
                case 'name':
                    $result[$k][$k1] = $v1;
                    break;
            }
        }
    }
    echo '<table style="border-collapse: collapse;" cellspacing="3" cellpadding="5" border="1"><tr><td>ID</td><td>MID</td><td>歌名</td><td>播放链接1</td><td>播放链接2</td></tr>';
    foreach ($result as $value)
    {
        echo '<tr><td>'.$value['id'].'</td><td>'.$value['mid'].'</td><td>'.$value['name'].'</td><td><a target="_blank" href="'.$value['link'].'" >'.$value['link'].'<a/></td><td><a target="_blank" href="'.$value['link2'].'" >'.$value['link2'].'<a/></td></tr>';
    }
    echo '</table>';
}


echo '</body></html>';
