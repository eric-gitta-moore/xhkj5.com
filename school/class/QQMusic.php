<?php
/**
 * Created by 讯幻网-www.xhkj5.com.
 * User: Administrator
 * Date: 2018-01-31
 * Time: 下午 05:13
 * File Name: QQMusic.php
 * Project Name: Music
 */

/**
 * Class QQMusic
 */
class QQMusic
{
    /**
     * 版本号
     */
    const VERSION = '1.0.0';

    /**
     * 接口
     */
    private $QQInterface = array(
        //通过歌名模糊搜索歌曲
        //{page},{keyword},{number}
        'search_song_by_name' => 'https://c.y.qq.com/soso/fcgi-bin/client_search_cp?ct=24&qqmusic_ver=1298&new_json=1&remoteplace=txt.yqq.song&searchid=70961303682974686&t=0&aggr=1&cr=1&catZhida=1&lossless=0&flag_qc=0&p={page}&n={number}&w={keyword}&g_tk=5381&jsonpCallback=MusicJsonCallback9046142339937813&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过专辑MID搜索专辑
        //{album_mid}
        'search_album_by_mid' => 'https://c.y.qq.com/v8/fcg-bin/fcg_v8_album_info_cp.fcg?albummid={album_mid}&g_tk=5381&jsonpCallback=albuminfoCallback&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过歌手MID搜索歌手唱的歌
        //{singer_mid},{begin},{number}
        'search_song_by_singer_mid' => 'https://c.y.qq.com/v8/fcg-bin/fcg_v8_singer_track_cp.fcg?g_tk=5381&jsonpCallback=MusicJsonCallbacksinger_track&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0&singermid={singer_mid}&order=listen&begin={begin}&num={number}&songstatus=1',

        //通过歌手mid，搜索相似歌手
        //{singer_mid},{begin},{number}
        'search_similar_by_singer_mid' => 'https://c.y.qq.com/v8/fcg-bin/fcg_v8_simsinger.fcg?utf8=1&singer_mid={singer_mid}&start={begin}&num={number}&g_tk=5381&jsonpCallback=SingerSimCallback&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过歌手mid，搜索粉丝发布的mv
        //{singer_mid},{begin},{number}
        'search_fan_mv_by_singer_mid' => 'https://c.y.qq.com/mv/fcgi-bin/fcg_singer_mv.fcg?cid=205360581&g_tk=5381&jsonpCallback=singerfanmvlistJsonCallback&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0&singermid={singer_mid}&order=time&begin={begin}&num={number}&cmd=1',

        //通过歌手mid，搜索mv
        //{singer_mid},{begin},{number}
        'search_mv_by_singer_mid' => 'https://c.y.qq.com/mv/fcgi-bin/fcg_singer_mv.fcg?cid=205360581&singermid={singer_mid}&order=listen&begin={begin}&num={number}&g_tk=5381&jsonpCallback=singermvlistJsonCallback&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过歌手mid，搜索专辑
        //{singer_mid},{begin},{number}
        'search_album_by_singer_mid' => 'https://c.y.qq.com/v8/fcg-bin/fcg_v8_singer_album.fcg?format=jsonp&platform=yqq&singermid={singer_mid}&order=time&begin={begin}&num={number}&g_tk=5381&jsonpCallback=singeralbumlistJsonCallback&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过歌曲MID和guid获取guid相对应的vkey
        //{song_mid},{guid}
        'search_vkey_by_song_mid' => 'https://c.y.qq.com/base/fcgi-bin/fcg_music_express_mobile3.fcg?g_tk=5381&jsonpCallback=MusicJsonCallback42234033647827407&loginUin=0&hostUin=0&format=json&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0&cid=205361747&callback=MusicJsonCallback42234033647827407&uin=0&songmid={song_mid}&filename=C400{song_mid}.m4a&guid={guid}',

        //通过专辑MID获取专辑图片链接
        //{album_mid}
        'search_picture_by_album_mid' => 'https://y.gtimg.cn/music/photo_new/T002R300x300M0000{album_mid}.jpg?max_age=2592000',

        //通过歌手MID，搜索歌手照片(大)链接
        //{singer_mid}
        'search_singer_big_picture_by_mid' => 'https://y.gtimg.cn/music/photo_new/T001R300x300M000{singer_mid}.jpg?max_age=2592000',

        //通过歌手MID，搜索歌手照片(大)链接
        //{singer_mid}
        'search_singer_small_picture_by_mid' => 'https://y.gtimg.cn/music/photo_new/T001R150x150M0000{singer_mid}.jpg?max_age=2592000',

        //通过歌手MID搜索歌手人生信息
        //{singer_mid},{r}
        'search_singer_info_by_mid' => 'https://c.y.qq.com/splcloud/fcgi-bin/fcg_get_singer_desc.fcg?singermid={singer_mid}&utf8=1&outCharset=utf-8&format=xml&r={r}',

        //通过song_mid,vkey和guid获取歌曲播放链接
        //{song_mid},{vkey},{guid}
        //说明：此播放链接带有生命周期，过一定时间会失效
        'search_song_play_link_by_mid_vkey_and_guid' => 'http://dl.stream.qqmusic.qq.com/C400{song_mid}.m4a?vkey={vkey}&guid={guid}&uin=0&fromtag=66',

        //通过song_mid获取歌曲播放链接
        //{song_mid}
        //说明：此播放链接永久有效
        'search_song_play_link_by_mid' => 'http://thirdparty.gtimg.com/C100{song_mid}.m4a?fromtag=38',

        //通过song_mid获取歌词
        //{song_mid},{pcachetime}
        //说明：{pcachetime} = strval(当前时间截) + strval(rand(100,999))
        'search_song_lyrics_by_mid' => 'https://c.y.qq.com/lyric/fcgi-bin/fcg_query_lyric_new.fcg?nobase64=1&callback=MusicJsonCallback_lrc&pcachetime={pcachetime}&songmid={song_mid}&g_tk=5381&jsonpCallback=MusicJsonCallback_lrc&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过top_id获取排行榜评论
        //{top_id},{page},{return_number}
        //说明：{return_number}<=30
        'search_top_comment_list_by_top_id' => 'https://c.y.qq.com/base/fcgi-bin/fcg_global_comment_h5.fcg?g_tk=5381&jsonpCallback=jsoncallback36991106764183&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf8&notice=0&platform=yqq&needNewCode=0&cid=205360772&reqtype=2&biztype=4&topid={top_id}&cmd=8&needmusiccrit=0&pagenum={page}&pagesize={return_number}&lasthotcommentid=&callback=jsoncallback36991106764183&domain=qq.com&ct=24&cv=101010',

        //通过top_id获取排行榜评论数量
        //{top_id}
        'search_top_comment_list_number_by_top_id' => 'https://c.y.qq.com/base/fcgi-bin/fcg_global_comment_h5.fcg?g_tk=5381&jsonpCallback=jsoncallback23444204903277033&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf8&notice=0&platform=yqq&needNewCode=0&cid=205360772&reqtype=1&biztype=4&topid=4&cmd=4&needmusiccrit=0&pagenum=0&pagesize=0&lasthotcommentid=&callback=jsoncallback23444204903277033&domain=qq.com',
        
        //获取所有的排行榜
        'search_all_top_list' => 'https://c.y.qq.com/v8/fcg-bin/fcg_v8_toplist_opt.fcg?page=index&format=html&tpl=macv4&v8debug=1&jsonCallback=jsonCallback',

        //通过top_id获取排行榜歌曲
        //{date},{top_id},{begin},{number}
        'search_top_song_list_by_top_id' => 'https://c.y.qq.com/v8/fcg-bin/fcg_v8_toplist_cp.fcg?tpl=3&page=detail&date={date}&topid={top_id}&type=top&song_begin={begin}&song_num={number}&g_tk=5381&jsonpCallback=MusicJsonCallbacktoplist&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //各种总类信息
        'get_categories' => 'https://c.y.qq.com/splcloud/fcgi-bin/fcg_get_diss_tag_conf.fcg?g_tk=5381&jsonpCallback=getPlaylistTags&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过tag搜索歌单
        //{category_id},{sort_id},{16rand},{begin},{number}
        //说明end需要减1，例如从第一个开始取30个出来，begin=0,number=30-1
        'search_play_list_by_tag' => 'https://c.y.qq.com/splcloud/fcgi-bin/fcg_get_diss_by_tag.fcg?picmid=1&rnd=0.{16rand}&g_tk=5381&jsonpCallback=getPlaylist&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0&categoryId={category_id}&sortId={sort_id}&sin={begin}&ein={number}',

        //通过歌单tid搜索相似歌单
        //{play_list_tid},{max_return_number},{time()+3rand}
        'search_play_list_similar_by_tid' => 'https://c.y.qq.com/musichall/fcgi-bin/fcg_similar_recomm.fcg?recomtype=2&dissid={play_list_tid}&maxnum={max_return_number}&_={tiem()+3rand}&g_tk=5381&jsonpCallback=GetCdlistCallback&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过歌单tid获取最新评论
        //{play_list_tid},{page},{number}
        'search_play_list_comment_by_tid' => 'https://c.y.qq.com/base/fcgi-bin/fcg_global_comment_h5.fcg?g_tk=5381&jsonpCallback=jsoncallback823342661806272&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf8&notice=0&platform=yqq&needNewCode=0&cid=205360772&reqtype=2&biztype=3&topid={play_list_tid}&cmd=8&needmusiccrit=0&pagenum={page}&pagesize={number}&lasthotcommentid=&callback=jsoncallback823342661806272&domain=qq.com&ct=24&cv=101010',

        //通过歌单tid获取信息
        //{play_list_tid}
        'search_play_list_info_by_tid' => 'https://c.y.qq.com/qzone/fcg-bin/fcg_ucc_getcdinfo_byids_cp.fcg?type=1&json=1&utf8=1&onlysong=0&disstid={play_list_tid}&format=jsonp&g_tk=5381&jsonpCallback=playlistinfoCallback&loginUin=0&hostUin=0&format=jsonp&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0',

        //通过歌单tid获取信息的访问referer
        //{play_list_tid}
        'search_play_list_info_by_tid_referer' => 'https://y.qq.com/n/yqq/playsquare/{play_list_tid}.html'

    );

    /**
     * 各种总类信息
     * 在初始化类的时候获取
     * @var array
     */
    protected static $categories = array();

    /**
     * curl设置
     * @var array
     */
    protected static $curl_opt = array(
        CURLOPT_SSL_VERIFYPEER => 0,//禁止校验https安全证书
        CURLOPT_RETURNTRANSFER => 1,//返回字符串
//        CURLOPT_COOKIESESSION => 1,//开启cookie
//        CURLOPT_COOKIEJAR => ''//设置访问后cookie的储存位置
    );

    /**
     * curl资源句柄
     * @var
     */
    private $ch;

    /**
     * xml转换为数组
     * @param $xml
     * @return mixed
     */
    public static function xmlToArray($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }

    /**
     * 驼峰转下划线
     * @param $str
     * @return null|string|string[]
     */
    public static function humpToLine($str){
        $str = preg_replace_callback('/([A-Z]{1})/',function($matches){
            return '_'.strtolower($matches[0]);
        },$str);
        return $str;
    }

    /**
     * QQMusic构造函数
     * 初始化curl资源句柄
     */
    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt_array($this->ch,static::$curl_opt);
        error_reporting(0);//屏蔽所有错误提示
    }

    /**
     * 提取最外层圆括号内的字符串
     * @param $param
     * @return bool|string
     */
    public static function pickUpFromParentheses($param)
    {
        $before = strpos($param,'(') + 1;
        $after = strrpos($param,')');
        return substr($param,$before,$after - $before);
    }

    /**
     * 提取链接或者地址的文件名或者后缀名
     * @param $param
     * @return array
     */
    public static function getSuffix($param)
    {
        if (strpos($param,'http://') === 0 || strpos($param,'https://') === 0)
        {
            //如果是带参数的链接就进一步处理
            if (strpos($param,'?') !== false)
            {
                $w = strpos($param,'?');
                $param = substr($param,0,$w);
            }

            $file_name = substr($param,strrpos($param,'/') + 1);
//        echo $file_name;
            $suffix = substr($file_name,strrpos($file_name,'.') + 1);

            return array(
                'file_name' => $file_name,
                'suffix' => $suffix
            );

        } elseif (strpos($param,'http://') === false && strpos($param,'https://') === false)
        {
            //判断是用“/”还是用“\”
            if (strpos($param,'\\') !== false)
            {
//            echo strrpos($param,'\\');
                $file_name = substr($param,strrpos($param,'\\') + 1);
                $suffix = substr($file_name,strrpos($file_name,'.') + 1);
                return array(
                    'file_name' => $file_name,
                    'suffix' => $suffix
                );

            } elseif (strpos($param,'/') !== false)
            {
                $file_name = substr($param,strrpos($param,'/') + 1);
                $suffix = substr($file_name,strrpos($file_name,'.') + 1);
                return array(
                    'file_name' => $file_name,
                    'suffix' => $suffix
                );
            }
        }
    }

    /**
     * QQMusic析构函数
     */
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        curl_close($this->ch);
    }

    /**
     * 通过歌名模糊搜索歌曲
     * @param $keyword 编码为UTF-8
     * @param int $page
     * @return array
     */
    public function searchSongByName($keyword,$page = 1,$num = 20)
    {
        $number = $num;
        if (empty($keyword) || !is_int($page) || !is_int($number))return 'param error';

        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{page}','{keyword}','{number}'),array(strval($page),$keyword,strval($number)),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        foreach ($result['data']['song'] as $key => $value)
        {
            switch ($key)
            {
                case 'curpage'://当前页面
                    $return['song']['current_page'] = $value;
                    break;
                case 'curnum'://总页数
                    $return['song']['total_page'] = $value;
                    break;
                case 'totalnum'://总数量
                    $return['song']['total_number'] = $value;
                    break;
            }
        }
        $return['song']['list'] = $this->arrangeSong($result['data']['song']['list']);
        return $return;

    }

    /**
     * 通过专辑MID搜索专辑
     * @param $album_mid
     * @return array
     */
    public function searchAlbumByMid($album_mid)
    {
        if (!is_string($album_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace('{album_mid}',$album_mid,$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
//        print_r($result); echo '<hr />';
        $return = array();
        //有些歌曲可能会出现“因版权限制 暂无法查看该专辑下歌曲”，因而没有'list'数组
        foreach ($result['data'] as $key => $value)
        {
            switch ($key)
            {
                case 'aDate':
                    $return['album']['time_public'] = $value;
                    break;
                case 'company':
                    $return['album']['company_name'] = $value;
                    break;
                case 'desc':
                    $return['album']['description'] = $value;
                    break;
                case 'genre':
                    $return['album'][$key] = $value;
                    break;
                case 'id':
                    $return['album'][$key] = $value;
                    break;
                case 'lan':
                    $return['album']['language'] = $value;
                    break;
                case 'list':
                    $return['album'][$key] = $this->arrangeSong($value);
//                    foreach ($value as $k => $v)
//                    {
//                        foreach ($v as $k_ => $v_)
//                        {
//                            switch ($k_)
//                            {
//                                case 'albumdesc':
//                                    $return['album'][$key][$k]['album_description'] = $v_;
//                                    break;
//                                case 'albumid':
//                                    $return['album'][$key][$k]['album_id'] = $v_;
//                                    break;
//                                case 'albummid':
//                                    $return['album'][$key][$k]['album_mid'] = $v_;
//                                    break;
//                                case 'albumname':
//                                    $return['album'][$key][$k]['album_name'] = $v_;
//                                    break;
//                                case 'interval':
//                                    $return['album'][$key][$k][$k_] = $v_;
//                                    break;
//                                case 'singer':
//                                    $return['album'][$key][$k][$k_] = $v_;
//                                    break;
//                                case 'songid':
//                                    $return['album'][$key][$k]['song_id'] = $v_;
//                                    break;
//                                case 'songmid':
//                                    $return['album'][$key][$k]['song_mid'] = $v_;
//                                    break;
//                                case 'songname':
//                                    $return['album'][$key][$k]['song_name'] = $v_;
//                                    break;
//                                case 'strMediaMid':
//                                    $return['album'][$key][$k]['media_mid'] = $v_;
//                                    break;
//                            }
//                        }
//                    }
                    break;
                case 'mid':
                    $return['album'][$key] = $value;
                    break;
                case 'name':
                    $return['album'][$key] = $value;
                    break;
                case 'singerid':
                    $return['album']['singer']['id'] = $value;
                    break;
                case 'singermblog':
                    $return['album']['singer']['blog'] = $value;
                    break;
                case 'singermid':
                    $return['album']['singer']['mid'] = $value;
                    break;
                case 'singername':
                    $return['album']['singer']['name'] = $value;
                    break;
                case 'total_song_num':
                    $return['album'][$key] = $value;
                    break;
            }
        }
        return $return;
    }

    /**
     * 通过歌手MID搜索歌手唱的歌
     * @param $singer_mid
     * @return array
     */
    public function searchSongBySingerMid($singer_mid)
    {
        if (!is_string($singer_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace('{singer_mid}',$singer_mid,$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);

        $return = array();
        foreach ($result['data'] as $key => $value)
        {
            if (!is_array($value))
            {
                $return[$key] = $value;
            } else {

                foreach ($value as $k => $v)
                {
                    foreach ($v as $k_ => $v_)
                    {
                        switch ($k_)
                        {
                            case 'Fupload_time':
                                $return[$key][$k]['upload_time'] = $v_;
                                break;

                            case 'musicData':
                                $return[$key] = $this->arrangeSong($value);
//                                foreach ($v_ as $k__ => $v__)
//                                {
//                                    switch ($k__)
//                                    {
//                                        case 'albumdesc':
//                                            $return['list'][$k]['album_description'] = $v_;
//                                            break;
//                                        case 'albumid':
//                                            $return['list'][$k]['album_id'] = $v_;
//                                            break;
//                                        case 'albummid':
//                                            $return['list'][$k]['album_mid'] = $v_;
//                                            break;
//                                        case 'albumname':
//                                            $return['list'][$k]['album_name'] = $v_;
//                                            break;
//                                        case 'interval':
//                                            $return['list'][$k][$k__] = $v_;
//                                            break;
//                                        case 'singer':
//                                            $return['list'][$k][$k__] = $v_;
//                                            break;
//                                        case 'songid':
//                                            $return['list'][$k]['song_id'] = $v_;
//                                            break;
//                                        case 'songmid':
//                                            $return['list'][$k]['song_mid'] = $v_;
//                                            break;
//                                        case 'songname':
//                                            $return['list'][$k]['song_name'] = $v_;
//                                            break;
//                                        case 'strMediaMid':
//                                            $return['list'][$k]['media_mid'] = $v_;
//                                            break;
//                                    }
//                                }
                                break;
                        }
                    }
                }
            }
        }
        return $return;
    }

    /**
     * 通过歌手mid，搜索相似歌手
     * @param $singer_mid
     * @param $begin
     * @param $num
     * @return array
     */
    public function searchSimilarBySingerMid($singer_mid,$begin = 0,$num = 30)
    {
        if (!is_string($singer_mid) || !is_int($begin) || !is_int($num))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{singer_mid}','{begin}','{number}'),array($singer_mid,strval($begin),strval($num)),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);

        $return = array();
        $return['singers'] = $result['singers']['items'];
        return $return;
    }

    /**
     * 通过歌手mid，搜索粉丝发布的mv
     * @param $singer_mid
     * @param $begin
     * @param $num
     * @return array
     */
    public function searchFanMvBySingerMid($singer_mid,$begin = 0,$num = 30)
    {
        if (!is_string($singer_mid) || !is_int($begin) || !is_int($num))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{singer_mid}','{begin}','{number}'),array($singer_mid,strval($begin),strval($num)),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);

        $return = array();
        $return['total'] = $result['data']['total'];
        $return['list'] = $result['data']['list'];
        //去除多余数据
        for ($i = 0;$i < count($return['list']);$i++)
        {
            unset($return['list'][$i]['index']);
            unset($return['list'][$i]['vid']);
            unset($return['list'][$i]['encrypt_uin']);
            unset($return['list'][$i]['score']);
            unset($return['list'][$i]['upload_uin']);
        }
        return $return;
    }

    /**
     * 通过歌手mid，搜索mv
     * @param $singer_mid
     * @param $begin
     * @param $num
     * @return array
     */
    public function searchMvBySingerMid($singer_mid,$begin = 0,$num = 30)
    {
        if (!is_string($singer_mid) || !is_int($begin) || !is_int($num))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{singer_mid}','{begin}','{number}'),array($singer_mid,strval($begin),strval($num)),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);

        $return = array();
        $return['total'] = $result['data']['total'];
        $return['list'] = $result['data']['list'];
        //去除多余数据
        for ($i = 0;$i < count($return['list']);$i++)
        {
            unset($return['list'][$i]['index']);
            unset($return['list'][$i]['vid']);
            unset($return['list'][$i]['encrypt_uin']);
            unset($return['list'][$i]['score']);
            unset($return['list'][$i]['upload_uin']);
        }
        return $return;
    }

    /**
     * 通过歌手mid，搜索专辑
     * @param $singer_mid
     * @param $begin
     * @param $num
     * @return array
     */
    public function searchAlbumBySingerMid($singer_mid,$begin = 0,$num = 30)
    {
        if (!is_string($singer_mid) || !is_int($begin) || !is_int($num))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{singer_mid}','{begin}','{number}'),array($singer_mid,strval($begin),strval($num)),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);

        $return = array();
        foreach ($result as $key => $value)
        {
            switch ($key)
            {
                case 'list':
                    foreach ($value as $k => $v)
                    {
                        foreach ($v as $k_ => $v_)
                        {
                            switch ($k_)
                            {
                                case 'albumID':
                                    $return[$key][$k]['album_id'] = $v_;
                                    break;
                                case 'albumMID':
                                    $return[$key][$k]['album_mid'] = $v_;
                                    break;
                                case 'albumName':
                                    $return[$key][$k]['album_name'] = $v_;
                                    break;
                                case 'albumtype':
                                    $return[$key][$k]['album_type'] = $v_;
                                    break;
                                case 'company':
                                    $return[$key][$k][$k_] = $v_;
                                    break;
                                case 'desc':
                                    $return[$key][$k]['description'] = $v_;
                                    break;
                                case 'lan':
                                    $return[$key][$k]['language'] = $v_;
                                    break;
                                case 'latest_song':
                                    foreach ($v_ as $k__ => $v__)
                                    {
                                        switch ($k__)
                                        {
                                            case 'songid':
                                                $return[$key][$k][$k_]['song_id'] = $v__;
                                                break;

                                            default:
                                                $return[$key][$k][$k_][$k__] = $v__;
                                                break;
                                        }
                                    }
                                    break;
                                case 'listen_count':
                                    $return[$key][$k][$k_] = $v_;
                                    break;
                                case 'pubTime':
                                    $return[$key][$k]['public_time'] = $v_;
                                    break;
                                case 'singerID':
                                    $return[$key][$k]['singer_id'] = $v_;
                                    break;
                                case 'singerMID':
                                    $return[$key][$k]['singer_mid'] = $v_;
                                    break;
                                case 'singerName':
                                    $return[$key][$k]['singer_ame'] = $v_;
                                    break;
                                case 'singers':
                                    $return[$key][$k][$k_] = $v_;
                                    break;
                            }
                        }
                    }
                    break;

                default:
                    $return[$key] = $value;
                    break;
            }
        }
        return $return;
    }

    /**
     * 通过专辑MID获取专辑图片链接
     * @param $album_mid
     * @return mixed
     */
    public function searchPictureByAlbumMid($album_mid)
    {
        if (!is_string($album_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace('{album_mid}',$album_mid,$url_interface);
        return $url;
    }

    /**
     * 通过歌手MID，搜索歌手照片(大)链接
     * @param $singer_mid
     * @return mixed
     */
    public function searchSingerBigPictureByMid($singer_mid)
    {
        if (!is_string($singer_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace('{singer_mid}',$singer_mid,$url_interface);
        return $url;
    }

    /**
     * 通过歌手MID，搜索歌手照片(小)链接
     * @param $singer_mid
     * @return mixed
     */
    public function searchSingerSmallPictureByMid($singer_mid)
    {
        if (!is_string($singer_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace('{singer_mid}',$singer_mid,$url_interface);
        return $url;
    }

    /**
     * 通过歌手MID搜索歌手人生信息
     * @param $singer_mid
     * @return mixed
     */
    public function searchSingerInfoByMid($singer_mid)
    {
        if (!is_string($singer_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{singer_mid}','{r}'),array($singer_mid,time()),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_REFERER,'https://c.y.qq.com/xhr_proxy_utf8.html');
        //获取结果后不能关闭，否则后续无法操作
        $result = static::xmlToArray(curl_exec($this->ch));

        return $result['data']['info'];

    }

    /**
     * 通过歌曲MID获取歌曲的vkey
     * @param $song_mid
     * @return mixed
     */
    public function searchVkeyBySongMid($song_mid)
    {
        if (!is_string($song_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{song_mid}','{guid}'),array($song_mid,$guid = time()),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //这里稍微有点不同
        curl_setopt($this->ch,CURLOPT_REFERER,'https://y.qq.com/portal/player.html');
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);

        return array(
            'vkey' => $result['data']['items']['0']['vkey'],
            'guid' => strval($guid)
        );
    }

    /**
     * 通过song_mid,vkey和guid获取歌曲播放链接
     * @param $song_mid
     * @param $vkey
     * @param $guid
     * @return mixed
     */
    public function searchSongPlayLinkByMidVkeyAndGuid($song_mid,$vkey,$guid)
    {
        if (!is_string($song_mid) || !is_string($vkey) || !is_string($guid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{song_mid}','{guid}','{vkey}'),array($song_mid,$guid,$vkey),$url_interface);
        return $url;
    }

    /**
     * 通过song_mid获取歌词
     * @param $song_mid
     * @return array
     */
    public function searchSongLyricsByMid($song_mid)
    {
        if (!is_string($song_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{song_mid}','{pcachetime}'),array($song_mid,strval(time()) + strval(rand(100,999))),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_REFERER,'https://y.qq.com/portal/player.html');
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);

        return array(
            'lyrics' => $result['lyric'],
            'trans' => $result['trans'],
        );

    }

    /**
     * 歌词转数组
     * 只针对QQ音乐
     * @param $lyrics
     * @return array
     */
    public static function lyricsToArray($lyrics)
    {
        //双引号的\n才是换行符
        $explode = explode("\n",$lyrics);
        $regex = '/\[(\d{2}):(\S+)\](.+)/';
        $regex1 = '/\[([a-z]+):(\S+)\]/';
        $result = array();
//        print_r($explode);
        //批量提取并转换
        foreach ($explode as $value)
        {
            preg_match($regex,$value,$matches);
            preg_match($regex1,$value,$matches1);
//            print_r($matches);
            $result[strval(floatval($matches[1])*60 + floatval($matches[2]))] = $matches[3];
            switch ($matches1[1])
            {
                case 'ti':
                    $result['more']['title'] = $matches1[2];
                    break;
                case 'ar':
                    $result['more']['artist'] = $matches1[2];
                    break;
                case 'al':
                    $result['more']['album'] = $matches1[2];
                    break;
                case 'by':
                    $result['more'][$matches1[1]] = $matches1[2];
                    break;
                case 'offset':
                    $result['more'][$matches1[1]] = $matches1[2];
                    break;
            }
            //检查有没有少数据，为了规范代码
            if (!isset($result['more']['title']))$result['more']['title'] = '';
            if (!isset($result['more']['artist']))$result['more']['artist'] = '';
            if (!isset($result['more']['album']))$result['more']['album'] = '';
            if (!isset($result['more']['by']))$result['more']['by'] = '';
            if (!isset($result['more']['offset']))$result['more']['offset'] = '0';

            //这里不知道怎么多了个['0']
            unset($result['0']);
        }
        return $result;
    }

    /**
     * 通过top_id获取排行榜评论
     * @param $top_id
     * @param int $page
     * @param int $return_number
     * @return array|string
     */
    public function searchTopCommentListByTopId($top_id,$page = 1,$return_number = 30)
    {
        if (!is_string($top_id) || !is_int($page))return 'param error';
        if ($return_number > 30 || $return_number <= 0)return '$return_number error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{page}','{top_id}','{return_number}'),array(strval($page),$top_id,strval($return_number)),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        $return['top_id'] = $result['topid'];
        $return['topic_name'] = $result['topic_name'];
        $return['comment']['total'] = $result['comment']['comment_total'];
        $return['comment']['list'] = $this->arrangeComment($result['comment']['commentlist']);
//        foreach ($result['comment']['commentlist'] as $key => $value)
//        {
//            foreach ($value as $k => $v)
//            {
//                switch ($k)
//                {
//                    case 'avatarurl':
//                        $return['comment']['list'][$key]['avatar_url'] = $v;
//                        break;
//                    case 'commentid':
//                        $return['comment']['list'][$key]['comment_id'] = $v;
//                        break;
//                    case 'is_hot':
//                        $return['comment']['list'][$key][$k] = $v;
//                        break;
//                    case 'middlecommentcontent':
//                        foreach ($v as $k_ => $v_)
//                        {
//                            foreach ($v_ as $k__ => $v__)
//                            {
//                                switch ($k__)
//                                {
//                                    case 'replyed_identity_pic':
//                                        $return['comment']['list'][$key]['middle_comment_content'][$k_]['replyed']['identity_picture'] = $v__;
//                                        break;
//                                    case 'replyeduin':
//                                        $return['comment']['list'][$key]['middle_comment_content'][$k_]['replyed']['uin'] = $v__;
//                                        break;
//                                    case 'replyednick':
//                                        $return['comment']['list'][$key]['middle_comment_content'][$k_]['replyed']['name'] = $v__;
//                                        break;
//                                    case 'reply_identity_pic':
//                                        $return['comment']['list'][$key]['middle_comment_content'][$k_]['reply']['identity_picture'] = $v__;
//                                        break;
//                                    case 'replyuin':
//                                        $return['comment']['list'][$key]['middle_comment_content'][$k_]['reply']['uin'] = $v__;
//                                        break;
//                                    case 'replynick':
//                                        $return['comment']['list'][$key]['middle_comment_content'][$k_]['reply']['name'] = $v__;
//                                        break;
//                                    case 'subcommentcontent':
//                                        $return['comment']['list'][$key]['middle_comment_content'][$k_]['content'] = $v__;
//                                        break;
//                                    case 'subcommentid':
//                                        $return['comment']['list'][$key]['middle_comment_content'][$k_]['id'] = $v__;
//                                        break;
//                                }
//                            }
//                        }
//                        break;
//                    case 'nick':
//                        $return['comment']['list'][$key][$k] = $v;
//                        break;
//                    case 'rootcommentcontent':
//                        $return['comment']['list'][$key]['root']['comment_content'] = $v;
//                        break;
//                    case 'rootcommentid':
//                        $return['comment']['list'][$key]['root']['comment_id'] = $v;
//                        break;
//                    case 'rootcommentnick':
//                        $return['comment']['list'][$key]['root']['comment_nick'] = $v;
//                        break;
//                    case 'rootcommentuin':
//                        $return['comment']['list'][$key]['root']['comment_uin'] = $v;
//                        break;
//                    case 'time':
//                        $return['comment']['list'][$key][$k] = $v;
//                        break;
//                    case 'uin':
//                        $return['comment']['list'][$key][$k] = $v;
//                        break;
//                    case 'vipicon':
//                        $return['comment']['list'][$key]['vip_icon'] = $v;
//                        break;
//                }
//            }
//        }
        return $return;
    }

    /**
     * 通过top_id获取排行榜评论数量
     * @param $top_id
     * @return array
     */
    public function searchTopCommentListNumberByTopId($top_id)
    {
        if (!is_string($top_id))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{top_id}'),array($top_id),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        return array(
            'comment_total' => $result['commenttotal'],
            'top_id' => $result['topid']
        );
    }

    /**
     * 获取所有的排行榜
     * @return array
     */
    public function searchAllTopList()
    {
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = $url_interface;
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        foreach ($result as $key => $value)
        {
            foreach ($value as $k => $v)
            {
                switch ($k)
                {
                    case 'GroupID':
                        $return['group_id'] = $v;
                        break;
                    case 'GroupName':
                        $return['group_name'] = $v;
                        break;
                    case 'List':
                        foreach ($v as $k_ => $v_)
                        {
                            foreach ($v_ as $k__ => $v__)
                            {
                                switch ($k__)
                                {
                                    case 'ListName':
                                        $return['list'][$k_]['list_name'] = $v__;
                                        break;
                                    case 'listennum':
                                        $return['list'][$k_]['listen_num'] = $v__;
                                        break;
                                    case 'showtime':
                                        $return['list'][$k_]['show_time'] = $v__;
                                        break;
                                    case 'songlist':
                                        foreach ($v__ as $k1 => $v1)
                                        {
                                            foreach ($v1 as $k2 => $v2)
                                            {
                                                switch ($k2)
                                                {
                                                    case 'singerid':
                                                        $return['list'][$k_]['song_list'][$k1]['singer_id'] = $v2;
                                                        break;
                                                    case 'singername':
                                                        $return['list'][$k_]['song_list'][$k1]['singer_name'] = $v2;
                                                        break;
                                                    case 'songid':
                                                        $return['list'][$k_]['song_list'][$k1]['song_id'] = $v2;
                                                        break;
                                                    case 'songname':
                                                        $return['list'][$k_]['song_list'][$k1]['song_name'] = $v2;
                                                        break;
                                                }
                                            }
                                        }
                                        break;
                                    case 'topID':
                                        $return['list'][$k_]['top_id'] = $v__;
                                        break;
                                    case 'update_key':
                                        $return['list'][$k_][$k__] = $v__;
                                        break;
                                    default:
                                        if (static::getSuffix($v__)['suffix'] == 'png' || static::getSuffix($v__)['suffix'] == 'jpg')
                                        {
                                            $return['list'][$k_]['picture'][] = $v__;
                                        }
                                        break;
                                }

                            }
                        }
                        break;
                }
            }
        }
        return $return;
    }

    /**
     * 通过top_id获取排行榜歌曲
     * @param $top_id
     * @param $date
     * @param $begin
     * @param $number
     * @return array
     */
    public function searchTopSongListByTopId($top_id,$date,$begin = 0,$number = 30)
    {
        if (!is_string($top_id) || !is_string($date) || !is_int($begin) || !is_int($number))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{top_id}','{date}','{begin}','{number}'),array($top_id,$date,$begin,$number),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        foreach ($result as $key => $value)
        {
            switch ($key)
            {
                case 'comment_num':
                    $return['comment_number'] = $value;
                    break;
                case 'date':
                    $return[$key] = $value;
                    break;
                case 'songlist':
                    foreach ($value as $k1 => $v1)
                    {
                        foreach ($v1 as $k2 => $v2)
                        {
                            switch ($k2)
                            {
                                case 'cur_count':
                                    $return['song_list'][$k1]['current_count'] = $v2;
                                    break;
                                case 'old_count':
                                    $return['song_list'][$k1][$k2] = $v2;
                                    break;
                                case 'in_count':
                                    $return['song_list'][$k1][$k2] = $v2;
                                    break;
                                case 'data':
                                    $return['song_list'][$k1][$k2] = $this->arrangeSong($v2);
                                    break;
                            }
                        }
                    }
                    break;
                case 'total_song_num':
                    $return['total_song_number'] = $value;
                    break;
                case 'update_time':
                    $return[$key] = $value;
                    break;
            }
        }
        return $return;
    }

    /**
     * 整理歌曲列表
     * 去除多余数据并按照此类的命名规范返回
     * @param $list
     * @return array
     */
    protected function arrangeSong($list)
    {
        $return = array();
//        var_dump(is_array($list['0']['album']));
        //终于发现一点规律了。。。。。
        //QQ音乐歌曲的list部分有两种情况，一种是类似数组分类的(这个要详细一点)，还有一种是直接列在根下的
        //如果只传了一首歌的信息则又分类处理
        if (is_array($list['0']['album']))
        {
//            echo '1';
            foreach ($list as $num => $song_one) {
                foreach ($song_one as $key => $value)
                {
                    switch ($key)
                    {
                        case 'album':
                            $return[$num][$key] = $value;
                            unset($list[$num][$key]['title_hilight']);
                            unset($list[$num][$key]['title']);
                            //在这里获取语言和流派
//                            $album = $this->searchAlbumByMid($value['mid']);
//                            $return[$num]['language'] = $album['album']['language'];
//                            $return[$num]['genre'] = $album['album']['genre'];

                            break;
                        case 'desc':
                            $return[$num]['description'] = $value;
                            break;
                        case 'mid':
                            $return[$num][$key] = $value;
                            break;
                        case 'id':
                            $return[$num][$key] = $value;
                            break;
                        case 'interval':
                            $return[$num][$key] = $value;
                            break;
                        case 'lyric':
                            $return[$num]['lyric_name'] = $value;
                            break;
                        case 'mv':
                            $return[$num][$key] = $value;
                            break;
                        case 'name':
                            $return[$num][$key] = $value;
                            break;
                        case 'singer':
                            foreach ($value as $k => $v)
                            {
                                foreach ($v as $k_ => $v_)
                                {
                                    switch ($k_)
                                    {
                                        case 'id':
                                            $return[$num][$key][$k][$k_] = $v_;
                                            break;
                                        case 'mid':
                                            $return[$num][$key][$k][$k_] = $v_;
                                            break;
                                        case 'name':
                                            $return[$num][$key][$k][$k_] = $v_;
                                            break;
                                    }
                                }
                            }
                            break;
                        case 'subtitle':
                            $return[$num][$key] = $value;
                            break;
                        case 'time_public':
                            $return[$num][$key] = $value;
                            break;
                    }
                }
            }

        } elseif(!is_array($list['0']['album'])) {
//            echo '2';
            foreach ($list as $k => $v_)
            {
                foreach ($v_ as $k__ => $v__)
                {
                    switch ($k__)
                    {
                        case 'albumdesc':
                            $return['list'][$k]['album_description'] = $v_;
                            break;
                        case 'albumid':
                            $return['list'][$k]['album_id'] = $v_;
                            break;
                        case 'albummid':
                            $return['list'][$k]['album_mid'] = $v_;
                            break;
                        case 'albumname':
                            $return['list'][$k]['album_name'] = $v_;
                            break;
                        case 'interval':
                            $return['list'][$k][$k__] = $v_;
                            break;
                        case 'singer':
                            $return['list'][$k][$k__] = $v_;
                            break;
                        case 'songid':
                            $return['list'][$k]['song_id'] = $v_;
                            break;
                        case 'songmid':
                            $return['list'][$k]['song_mid'] = $v_;
                            break;
                        case 'songname':
                            $return['list'][$k]['song_name'] = $v_;
                            break;
                        case 'strMediaMid':
                            $return['list'][$k]['media_mid'] = $v_;
                            break;
                    }
                }
            }

        } elseif (!empty($list['0']))
        {
            if (is_array($list['album']))
            {
                foreach ($list as $key => $value)
                {
                    switch ($key)
                    {
                        case 'album':
                            $return[$key] = $value;
                            unset($list[$key]['title_hilight']);
                            unset($list[$key]['title']);
                            //在这里获取语言和流派
//                            $album = $this->searchAlbumByMid($value['mid']);
//                            $return['language'] = $album['album']['language'];
//                            $return['genre'] = $album['album']['genre'];

                            break;
                        case 'desc':
                            $return['description'] = $value;
                            break;
                        case 'mid':
                            $return[$key] = $value;
                            break;
                        case 'id':
                            $return[$key] = $value;
                            break;
                        case 'interval':
                            $return[$key] = $value;
                            break;
                        case 'lyric':
                            $return['lyric_name'] = $value;
                            break;
                        case 'mv':
                            $return[$key] = $value;
                            break;
                        case 'name':
                            $return[$key] = $value;
                            break;
                        case 'singer':
                            foreach ($value as $k => $v)
                            {
                                foreach ($v as $k_ => $v_)
                                {
                                    switch ($k_)
                                    {
                                        case 'id':
                                            $return[$key][$k][$k_] = $v_;
                                            break;
                                        case 'mid':
                                            $return[$key][$k][$k_] = $v_;
                                            break;
                                        case 'name':
                                            $return[$key][$k][$k_] = $v_;
                                            break;
                                    }
                                }
                            }
                            break;
                        case 'subtitle':
                            $return[$key] = $value;
                            break;
                        case 'time_public':
                            $return[$key] = $value;
                            break;
                    }
                }

            } else {
                foreach ($list as $k__ => $v_)
                {
                    switch ($k__)
                    {
                        case 'albumdesc':
                            $return['list']['album_description'] = $v_;
                            break;
                        case 'albumid':
                            $return['list']['album_id'] = $v_;
                            break;
                        case 'albummid':
                            $return['list']['album_mid'] = $v_;
                            break;
                        case 'albumname':
                            $return['list']['album_name'] = $v_;
                            break;
                        case 'interval':
                            $return['list'][$k__] = $v_;
                            break;
                        case 'singer':
                            $return['list'][$k__] = $v_;
                            break;
                        case 'songid':
                            $return['list']['song_id'] = $v_;
                            break;
                        case 'songmid':
                            $return['list']['song_mid'] = $v_;
                            break;
                        case 'songname':
                            $return['list']['song_name'] = $v_;
                            break;
                        case 'strMediaMid':
                            $return['list']['media_mid'] = $v_;
                            break;
                    }
                }
            }

        }
        return $return;
    }

    /**
     * 获取各种总类信息
     * @return array
     */
    public function getCategories()
    {
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = $url_interface;
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        foreach ($result['data']['categories'] as $key => $value)
        {
            if ($result['data']['categories'][$key]['usable'] == '0')
            {
                continue;//如果QQ音乐没有启用该配置则这里也舍去
            }
            elseif ($result['data']['categories'][$key]['usable'] == '1')
            {

                $add['name'] = $result['data']['categories'][$key]['categoryGroupName'];
                foreach ($result['data']['categories'][$key]['items'] as $items => $v)
                {
                    if ($v['usable'] == '1')
                    {
                        $add['items'][$items][$v['categoryId']] = $v['categoryName'];
                    }
                }
                $return[] = $add;
            }
        }
        return $return;
    }

    /**
     * 通过tag搜索歌单
     * @param $category_id
     * @param $sort_id
     * @param int $begin
     * @param int $number
     * @return array
     */
    public function searchPlayListByTag($category_id,$sort_id,$begin = 0,$number = 30)
    {
        if (!is_string($category_id) || !is_string($sort_id) || !is_int($begin) || !is_int($number))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{category_id}','{sort_id}','{begin}','{number}'),array($category_id,$sort_id,strval($begin),strval($number-1)),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        $return['total'] = $result['data']['sum'];
        foreach ($result['data']['list'] as $key => $value)
        {
            foreach ($value as $k1 => $v1)
            {
                switch ($k1)
                {
                    case 'commit_time':
                        $return['list'][$key][$k1] = $v1;
                        break;
                    case 'createtime':
                        $return['list'][$key]['create_time'] = $v1;
                        break;
                    case 'creator':
                        $return['list'][$key][$k1]['avatar_url'] = $v1['avatarUrl'];
                        $return['list'][$key][$k1]['name'] = $v1['name'];
                        $return['list'][$key][$k1]['qq'] = $v1['qq'];
                        break;
                    case 'dissid':
                        $return['list'][$key]['id'] = $v1;
                        break;
                    case 'dissname':
                        $return['list'][$key]['name'] = $v1;
                        break;
                    case 'imgurl':
                        $return['list'][$key]['image_url'] = $v1;
                        break;
                    case 'listennum':
                        $return['list'][$key]['listen_num'] = $v1;
                        break;
                }
            }
        }
        return $return;
    }

    /**
     * 通过歌单tid搜索相似歌单
     * @param $play_list_tid
     * @param int $max_return_number
     * @return array
     */
    public function searchPlayListSimilarByTid($play_list_tid,$max_return_number = 6)
    {
        if (!is_string($play_list_tid) || !is_int($max_return_number))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{play_list_tid}','{max_return_number}','{time()+3rand}'),array($play_list_tid,strval($max_return_number),strval(time())+strval(rand(100,999))),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        foreach ($result['data']['items'] as $k1 => $v1)
        {
            foreach ($v1 as $k2 => $v2)
            {
                switch ($k2)
                {
                    case 'createtime':
                        $return['list'][$k1]['create_time'] = $v2;
                        break;
                    case 'creator':
                        $return['list'][$k1]['creator']['qq'] = $v2['qq'];
                        $return['list'][$k1]['creator']['avatar_url'] = $v2['avatarUrl'];
                        $return['list'][$k1]['creator']['name'] = $v2['name'];
                        break;
                    case 'dissid':
                        $return['list'][$k1]['id'] = $v2;
                        break;
                    case 'dissname':
                        $return['list'][$k1]['name'] = $v2;
                        break;
                    case 'imgurl':
                        $return['list'][$k1]['image_url'] = $v2;
                        break;
                    case 'introduction':
                        $return['list'][$k1]['introduction'] = $v2;
                        break;
                    case 'listennum':
                        $return['list'][$k1]['listen_number'] = $v2;
                        break;
                    case 'pic_mid':
                        $return['list'][$k1]['picture_mid'] = $v2;
                        break;
                    case 'album_pic_mid':
                        $return['list'][$k1]['album_picture_mid'] = $v2;
                        break;
                }
            }
        }
        return $return;
    }

    /**
     * 通过歌单tid获取最新评论
     * @param $play_list_tid
     * @param int $page
     * @param int $number
     * @return array
     */
    public function searchPlayListCommentByTid($play_list_tid,$page = 1,$number = 30)
    {
        if (!is_string($play_list_tid) || !is_int($page) || !is_int($number))return 'param error';
        if ($number > 30)return 'param error';
        //初始化参数
        $page--;
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{play_list_tid}','{page}','{number}'),array($play_list_tid,strval($page),strval($number)),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        $return['total'] = $result['comment']['commenttotal'];
        $return['list'] = $this->arrangeComment($result['comment']['commentlist']);
        return $return;
    }

    /**
     * 整理评论
     * @param $comment
     * @return array
     */
    public function arrangeComment($comment)
    {
        $return = array();
        if (is_array($comment))
        {

        } else
        {
            foreach ($comment as $key => $value)
            {
                foreach ($value as $k => $v)
                {
                    switch ($k)
                    {
                        case 'avatarurl':
                            $return[$key]['avatar_url'] = $v;
                            break;
                        case 'commentid':
                            $return[$key]['comment_id'] = $v;
                            break;
                        case 'is_hot':
                            $return[$key][$k] = $v;
                            break;
                        case 'middlecommentcontent':
                            if (is_array($v))
                            {
                                foreach ($v as $k_ => $v_)
                                {
                                    foreach ($v_ as $k__ => $v__)
                                    {
                                        switch ($k__)
                                        {
                                            case 'replyed_identity_pic':
                                                $return[$key]['middle_comment_content'][$k_]['replyed']['identity_picture'] = $v__;
                                                break;
                                            case 'replyeduin':
                                                $return[$key]['middle_comment_content'][$k_]['replyed']['uin'] = $v__;
                                                break;
                                            case 'replyednick':
                                                $return[$key]['middle_comment_content'][$k_]['replyed']['name'] = $v__;
                                                break;
                                            case 'reply_identity_pic':
                                                $return[$key]['middle_comment_content'][$k_]['reply']['identity_picture'] = $v__;
                                                break;
                                            case 'replyuin':
                                                $return[$key]['middle_comment_content'][$k_]['reply']['uin'] = $v__;
                                                break;
                                            case 'replynick':
                                                $return[$key]['middle_comment_content'][$k_]['reply']['name'] = $v__;
                                                break;
                                            case 'subcommentcontent':
                                                $return[$key]['middle_comment_content'][$k_]['content'] = $v__;
                                                break;
                                            case 'subcommentid':
                                                $return[$key]['middle_comment_content'][$k_]['id'] = $v__;
                                                break;
                                        }
                                    }
                                }
                            } else
                            {
                                $return[$key]['middle_comment_content'] = null;
                            }
                            break;
                        case 'nick':
                            $return[$key][$k] = $v;
                            break;
                        case 'rootcommentcontent':
                            $return[$key]['root']['comment_content'] = $v;
                            break;
                        case 'rootcommentid':
                            $return[$key]['root']['comment_id'] = $v;
                            break;
                        case 'rootcommentnick':
                            $return[$key]['root']['comment_nick'] = $v;
                            break;
                        case 'rootcommentuin':
                            $return[$key]['root']['comment_uin'] = $v;
                            break;
                        case 'time':
                            $return[$key][$k] = $v;
                            break;
                        case 'uin':
                            $return[$key][$k] = $v;
                            break;
                        case 'vipicon':
                            $return[$key]['vip_icon'] = $v;
                            break;
                    }
                }
            }
        }
        return $return;
    }

    /**
     * 通过歌单tid获取信息
     * @param $play_list_tid
     * @return array
     */
    public function searchPlayListInfoByTid($play_list_tid)
    {
        if (!is_string($play_list_tid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        //设置链接
        $url = str_replace(array('{play_list_tid}'),array($play_list_tid),$url_interface);
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_REFERER,str_replace(array('{play_list_tid}'),array($play_list_tid),$this->QQInterface[static::humpToLine(__FUNCTION__).'_referer']));
        //获取结果后不能关闭，否则后续无法操作
        $result = json_decode(static::pickUpFromParentheses(curl_exec($this->ch)),1);
        //整理数据
        $return = array();
        foreach ($result['cdlist']['0'] as $k => $v)
        {
            switch ($k)
            {
                case 'disstid':
                    $return['id'] = $v;
                    break;
                case 'dissname':
                    $return['name'] = $v;
                    break;
                case 'logo':
                    $return['logo'] = $v;
                    break;
                case 'pic_mid':
                    $return['picture_mid'] = $v;
                    break;
                case 'album_pic_mid':
                    $return['album_picture_mid'] = $v;
                    break;
                case 'pic_dpi':
                    $return['picture_dpi'] = $v;
                    break;
                case 'desc':
                    $return['description'] = $v;
                    break;
                case 'ctime':
                    $return['create_time'] = $v;
                    break;
                case 'headurl':
                    $return['head_url'] = $v;
                    break;
                case 'nickname':
                    $return['creator_name'] = $v;
                    break;
                case 'tags':
                    $return['tags'] = $v;
                    break;
                case 'total_song_num':
                    $return['total_song_number'] = $v;
                    break;
                case 'songlist':
                    $return['song_list'] = $this->arrangeSong($v);
                    break;
                case 'visitnum'://播放量
                    $return['visit_number'] = $v;
                    break;
            }
        }
        return $return;
    }

    /**
     * 通过song_mid获取歌曲播放链接
     * @param $song_mid
     * @return mixed|string
     */
    public function searchSongPlayLinkByMid($song_mid)
    {
        if (!is_string($song_mid))return 'param error';
        //自动载入接口
        $url_interface = $this->QQInterface[static::humpToLine(__FUNCTION__)];
        return str_replace('{song_mid}',$song_mid,$url_interface);
    }
}
