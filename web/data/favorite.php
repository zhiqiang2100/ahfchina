<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：favorite.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年02月27日
*   Description   ：个人中心，收藏数据交互脚本
*/
Class Data_Favorite {
    //收藏类型：新闻
    const FAVORITE_TYPE_ARTICLE = 1;
    //收藏类型：图片
    const FAVORITE_TYPE_PICTURE = 2;
    //视频
    const FAVORITE_TYPE_VIDEO   = 3;
    //博客
    const FAVORITE_TYPE_BLOG    = 4;
    //专栏
    const FAVORITE_TYPE_ZHUANLAN = 5;

    const FIRST_PAGE            = 1;
    const PER_PAGE_COUNT        = 15;
    private static $_hashArr    = array();
    private static $_params     = array();

    /**
     * @param $type int 用来标示是文章类型还是图片类型的收藏列表0:文章 1:图片
     * @param $page int 第几页
     * @param $count int 每页显示多少条
     * @return array()
     * @desc 获取收藏列表的数据层接口
     */
    public static function getFavoriteLists($uid = NULL, $type = self::FAVORITE_TYPE_ARTICLE, 
        $page = self::FIRST_PAGE, $count =self::PER_PAGE_COUNT) {

        $lists  = array();
        if ( (int)$uid <= 0 ) return $lists;

		$api_url    = Be_Config::k('personal.api_favorite_list');
        if ( empty($api_url) ) return $lists;

        self::$_params = array(
            'page'  => $page,
            'len'   => $count,
        );
        self::_tidyParams($uid);
        $checkInfos = array(
            'con_timeout' => 3,
            'read_timeout' => 3,
        );

        $lists = self::_request($api_url, 'get', $checkInfos);
        return $lists;
    }

    /**
     * @param $uid int 用户uid
     * @param $mid int 帖子id
     * @param $type int 收藏类型 1文章 2图片
     * @return bool true/false
     * @desc 添加收藏接口
     */
    public static function addFavorite($uid, $docid, $type = self::FAVORITE_TYPE_ARTICLE) {
        $ret = false;
        if ( (int)$uid <= 0 ) return $ret;

		$api_url    = Be_Config::k('personal.api_favorite_add');
        if ( empty($api_url) ) return $lists;

        self::$_params = array(
            'uid'       => $uid,
            'docid'     => $docid,
            'category'  => $type,
        );
        self::_tidyParams($uid);
        $checkInfos = self::_getCheckInfos();
        
        $ret = self::_request($api_url, 'post', $checkInfos);
        if ( is_array($ret) && isset($ret['data']) )
            return $ret['data']['id'];
        else
            return true;
    }

    /**
     * @param $uid int 用户uid
     * @param $fid int 收藏的id 
     * @param $type int 收藏类型 1文章 2图片
     * @return bool true/false
     * @desc 删除收藏的接口
     */
    public static function delFavorite($uid, $fid, $type = self::FAVORITE_TYPE_ARTICLE) {
        $ret = false;
        if ( (int)$uid <= 0 || !$fid ) return $ret;

		$api_url    = Be_Config::k('personal.api_favorite_del');
        if ( empty($api_url) ) return $lists;

        self::$_params = array(
            'id'  => $fid,
            'category'  => $type,
        );
        self::_tidyParams($uid);
        $checkInfos = self::_getCheckInfos();

        $ret = self::_request($api_url, 'post', $checkInfos);
        if ( is_array($ret) && isset($ret['data']) )
            return $ret['data'];
        else
            return false;
    }

    public static function isFavorite($uid, $id, $type = self::FAVORITE_TYPE_ARTICLE) {
        $ret = false;
        if ( (int)$uid <= 0 || !$id ) return $ret;

		$api_url    = Be_Config::k('personal.api_favorite_isfav');
        if ( empty($api_url) ) return $lists;

        self::$_params = array(
            'docid'  => $id,
            'category'  => $type,
        );
        self::_tidyParams($uid);
        $checkInfos = self::_getCheckInfos();

        $ret = self::_request($api_url, 'post', $checkInfos);
        if ( is_array($ret) && isset($ret['data']) )
            return $ret['data'];
        else
            return false;
    }

    /**
     * @param $uid int 用户uid
     * @return $suid string 加密后的字符串
     * @desc 和接口侧的加密算法
     */
    private static function encrypt($uid) {
        if ( (int)$uid <= 0 ) return ;
        $timeStamp = self::_curTime();
        $key = 'vRaWCWh4un8t62aw';
        $hash = md5($uid . $timeStamp . $key);
        self::$_hashArr['ctime']   = $timeStamp;
        self::$_hashArr['hash']    = $hash; 
    }

    /**
     * 获取当前时间戳
     */
    private static function _curTime() {
        return time();
    }

    /**
     * 发送请求前公共参数添加
     */
    private static function _tidyParams($uid) {
        self::encrypt($uid);
        self::$_params['uid']   = $uid;
        self::$_params['auth']  = 'wap';//用来教研来源是wap的
        self::$_params['source']= 2;//用来标示来源是wap的
        self::$_params['ctime'] = self::$_hashArr['ctime'];
        self::$_params['hash']  = self::$_hashArr['hash'];
    }

    /**
     * 设置http请求头中的参数
     */
    private static function _getCheckInfos() {
        $checkInfos = array(
            'refer' => 'http://sina.com.cn',
            //'refer' => $_SERVER['HTTP_REFERER'],
        );
        return $checkInfos;
    }

    /**
     * @access private
     * @param $url string 要发送的url地址
     * @param $method sting 请求方法get/post
     * @desc 发送http请求
     */
    private static function _request($url, $method = 'get', $checkInfos = array()) {
        $ret = array();
        $ret_data   = json_decode(Be_Http::$method($url, self::$_params, $checkInfos), true);
        if ( !$ret_data ) //加一次失败重试
            $ret_data   = json_decode(Be_Http::$method($url, self::$_params, $checkInfos), true);
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( isset($ret_data['result']) && isset($ret_data['result']['status']) ) {
            $ret['data'] = $ret_data['result']['data'];
            //列表汇总数据填充
            if ( $ret_data['result']['total'] )
                $ret['total']  = $ret_data['result']['total'];
            if ( $ret_data['result']['len'] )
                $ret['len']  = $ret_data['result']['len'];
            if ( $ret_data['result']['addtime'] )
                $ret['addtime']  = $ret_data['result']['addtime'];
        } else 
            return false;

        return $ret;

    }
}
