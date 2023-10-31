<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

const XianLiaoMeURL = 'https://www.xianliao.me/';



function getCredentials() {

    global $_G;

    //Check cache first
    $website_id = isset($_G['cache']['plugin']['xianliaome']['xianliaome_wid']) ? $_G['cache']['plugin']['xianliaome']['xianliaome_wid'] : false;
    $sso_key = isset($_G['cache']['plugin']['xianliaome']['xianliaome_sso']) ? $_G['cache']['plugin']['xianliaome']['xianliaome_sso'] : false;


    //Get from DB
    if (!$website_id || !$sso_key) {
        $params = DB::query("SELECT * FROM " . DB::table('common_pluginvar') . " WHERE variable = 'xianliaome_wid' OR variable = 'xianliaome_sso'");

        if($params>0){
            while ($dbRecord = DB::fetch($params)){
                $dbRecords[]=$dbRecord;
            }
            unset($dbRecord);
        }

        foreach ($dbRecords as $param) {
            if ($param["variable"] == "xianliaome_wid") {
                $website_id = isset($param['value']) ? $param['value'] : false;
            }
            if ($param["variable"] == "xianliaome_sso") {
                $sso_key = isset($param['value']) ? $param['value'] : false;
            }
        }
    }


    return array($website_id, $sso_key);

}


function renderXLMEmbedCode($website_id, $sso_key) {

    global $_G;

    $xlm_wid=$website_id;
    $xlm_key=$sso_key;
    $xlm_url= XianLiaoMeURL;
    $xlm_uid=$_G['uid'];
    $xlm_name=$_G['member']['username'];

    $xlm_avatar=avatar($_G['uid'],'small');
    preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $xlm_avatar, $out);
    $xlm_avatar=isset($out[0][0]) ? $out[0][0] : str_replace("'"," ",$xlm_avatar);


    $xlm_time=time();
    $xlm_hash=hash('sha512',$xlm_wid.'_'.$_G['uid'].'_'.$xlm_time.'_'.$xlm_key);
    $xlm_gid=$_G['member']['groupid'].' '.str_replace("\t", " ",$_G['member']['extgroupids']);


    $userGroupList = explode(" ", $xlm_gid);
    $xlm_isAdmin = 0;
    if (in_array("1", $userGroupList)) {
        $xlm_isAdmin=hash('sha512',$xlm_wid.'_'.$_G['uid'].'_'.$xlm_time.'_'.$xlm_key.'_1');
    }


    $output = "<script>";
    $output = $output . "xlm_wid='" . $xlm_wid . "';";
    $output = $output . "xlm_url='" . $xlm_url . "';";
    $output = $output . "xlm_uid='" . $xlm_uid . "';";
    $output = $output . "xlm_name='" . $xlm_name . "';";
    $output = $output . "xlm_avatar='" . $xlm_avatar . "';";
    $output = $output . "xlm_gid='" . $xlm_gid . "';";
    $output = $output . "xlm_time='" . $xlm_time . "';";
    $output = $output . "xlm_hash='" . $xlm_hash . "';";
    $output = $output . "xlm_isAdmin='" . $xlm_isAdmin . "';";
    $output = $output . "</script>";
    $output = $output . "<script type='text/javascript' charset='UTF-8' src='" . $xlm_url . "embed.js'></script>";

    return $output;
}



//web
class plugin_xianliaome {

    public function global_footer(){

        list($website_id, $sso_key) = getCredentials();

        return renderXLMEmbedCode($website_id, $sso_key);
    }


}

//mobile
class mobileplugin_xianliaome {

    public function global_header_mobile(){

        list($website_id, $sso_key) = getCredentials();

        return renderXLMEmbedCode($website_id, $sso_key);
    }
}
