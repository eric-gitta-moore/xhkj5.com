<?php
if (!defined('IN_DISCUZ'))
{
    exit('Access Denied');
}

class plugin_laoyang_postyle
{

    function post_top_output()
    {
        global $_G, $message;
        $config = $_G['cache']['plugin']['laoyang_postyle'];
        if ($_GET['action'] == 'newthread')
        {
            for ($i = 1; $i <= 5; $i++)
            {
                $forum = unserialize($config['forum' . $i]);
                $forum = (array) $forum;
                if (in_array($_G['forum']['fid'], $forum))
                {
                    $message = $config['style'. $i];
                    break;
                }
            }
        }
    }

}

class plugin_laoyang_postyle_forum extends plugin_laoyang_postyle
{
    
}

?>