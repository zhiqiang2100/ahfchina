<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：comment.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月10日
*   Description   ：评论相关的底层数据脚本
*/
Class Data_Comment {
    //收藏类型：文章
    const COMMENT_TYPE_ARTICLE  = 0;
    //收藏类型：图片
    const COMMENT_TYPE_PICTURE  = 1;
    //我的评论列表
    const COMMENT_ACTION_MY     = 'my';
    //评论我的列表
    const COMMENT_ACTION_RMY    = 'rmy';

    const FIRST_PAGE            = 1;
    const PER_PAGE_COUNT        = 20;
    private static $_charset    = 'utf-8';
    private static $_params     = array();

    /**
     * @param $uid int 用户的uid
     * @param $action string 用来表示动作类型，是评论我的还是我评论的
     * @param $type int 用来标示是文章类型还是图片类型的收藏列表0:文章 1:图片
     * @param $page int 第几页
     * @param $count int 每页显示多少条
     * @return array()
     * @desc 获取我的评论列表的数据层接口
     */
    public static function getMyCommentLists($uid = NULL, $action = self::COMMENT_ACTION_MY, 
        $type = self::COMMENT_TYPE_ARTICLE, $page = self::FIRST_PAGE, $count =self::PER_PAGE_COUNT) {
        $lists  = array();
        if ( (int)$uid <= 0 ) return $lists;

        $config_key = 'personal.api_' . $action . '_comments';
		$api_url    = Be_Config::k($config_key);
        if ( empty($api_url) ) return $lists;

        self::$_params = array(
            'uid'       => $uid,
            'page'      => $page,
            'page_size' => $count,
            'ie'        => self::$_charset,
            'oe'        => self::$_charset,
        );
        $options = array(
            'con_timeout'   => 10,
            'read_timeout'  => 10,
        );

        $lists = self::_request($api_url, 'get', $checkInfos, $options);
        return $lists;
    }

    /**
     * @param $newsid string 被赞帖子的id
     * @param $mid string 被赞帖子的mid
     * @param $channel string 被赞帖子的渠道来源
     * @return bool true/false
     * @desc 赞操作
     */
    public static function newsAgree($newsid, $mid, $channel) {
        $lists  = array();
		$api_url    = Be_Config::k('personal.api_comment_agree');
        self::$_params = array(
            'newsid'    => $newsid,
            'mid'       => $mid,
            'channel'   => $channel,
        );

        $ret_data   = json_decode(Be_Http::get($api_url, self::$_params), true);
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( isset($ret_data['result']) && isset($ret_data['result']['status']) ) {
            if ( $ret_data['result']['status']['code'] != 0 )
                return false;
            else
                return true;
        }

        return false;
    }

    /**
     * @param $uid int 用户的uid
     * @param $mid string 被回复帖子的mid
     * @param $channel string 被回复帖子的渠道来源
     * @param $content string 回复内容
     * @param $from string 来源
     * @param $parent string 帖子父id
     * @return bool true/false
     * @desc 对帖子进行回复操作
     */
    public static function addComment($uid, $newsid, $channel, $content, $from, $parent) {
        $lists  = array();
		$api_url= Be_Config::k('personal.api_comment_send');
        $uinfo  = Model_Common::userInfo($uid);
        self::$_params = array(
            'uid'       => $uid,
            'newsid'    => $newsid,
            'channel'   => $channel,
            'content'   => $content,
            'from'      => $from,
            'parent'    => $parent,
            'ip'        => Be_data::getClientIp(),
            'user'      => $uinfo['sinausername'], 
        );

        $ret_data   = json_decode(Be_Http::get($api_url, self::$_params), true);
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( isset($ret_data['result']) && isset($ret_data['result']['status']) ) {
            if ( $ret_data['result']['status']['code'] != 0 )
                return false;
            else
                return true;
        }

        return false;
    }

    public static function userCommentCounts($uid) {
        $lists  = array();
		$api_url= Be_Config::k('personal.api_comment_count');
        self::$_params = array(
            'uid'       => $uid,
            'ie'        => self::$_charset,
            'oe'        => self::$_charset,
        );

        $options = array(
            'con_timeout'   => 0,
            'read_timeout'  => 0,
        );


        $ret_data   = json_decode(Be_Http::get($api_url, self::$_params, $checkInfos, $options), true);
        if ( !is_array($ret_data) || empty($ret_data) ) return array();
        if ( isset($ret_data['result']) && isset($ret_data['result']['status']) ) {
            if ( $ret_data['result']['status']['code'] != 0 )
                return $lists;
            else 
                $lists = $ret_data['result']['data']['comment_count'];
        }

        return $lists;
    }

    /**
     * @access private
     * @param $url string 要发送的url地址
     * @param $method sting 请求方法get/post
     * @desc 发送http请求
     */
    private static function _request($url, $method = 'get', $checkInfos = array(), $options = array()) {
        $ret = array();
        $ret_data   = json_decode(Be_Http::$method($url, self::$_params, $checkInfos, $options), true);
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( isset($ret_data['result']) && isset($ret_data['result']['status']) ) {
            if ( $ret_data['result']['status']['code'] != 0 )
                return false;
            $ret['cmntlist']    = $ret_data['result']['cmntlist'];//评论列表信息
            $ret['usercount']   = $ret_data['result']['usercount'];//统计信息
            $ret['newsdict']    = $ret_data['result']['newsdict'];//跟帖所属的留言板信息
            $ret['replydict']   = $ret_data['result']['replydict'];//盖楼信息
        } else 
            return false;

        return $ret;

    }
}
