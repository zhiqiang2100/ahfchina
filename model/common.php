<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：common.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月13日
*   Description   ：公用model层
*/
Class Model_Common { 
    private static $userInfo = array();
    /**
     * @param $uid int 用户id
     * @return array('email' => 'xxx', 'msgnum' => 'xxx')
     * email:用户邮箱名称 msgnum:未读邮件数
     * @desc 获取用户未读邮件数
     */
    public static function unReadMailCounts($uid) {
        return Data_Common::unReadMailCounts($uid);
    }

    /**
     * @param null
     * @return array $userInfo eg:array(
     *  'sinauid'   => xxx,
     *  'sinanick'  => xxx,
     *  'sinausername' => xxx,
     * )
     * @desc 获取用户登录信息
     */
    public static function userInfo($detail = true) {
        if ( !is_array(self::$userInfo) || count(self::$userInfo) <= 0 ) {
            $uInfo = Be_Libs_Login::getLoginInfo();
            if(isset($uInfo['sinauid']) && !empty($uInfo['sinauid'])) {
                if ( $detail ) {
                    $cache_key      = 'user_info_'. $uInfo['sinauid'];
                    //$info = Be_Mc::get('mc.default',$cache_key);
                    if ( !$info ) 
                        $info = Be_Libs_Sns_Weibo_Tauth::getUserInfoByUid($uInfo['sinauid']);
                    if ( is_array($info) && count($info) > 0 ) {
                        $info['sinauid']        = $uInfo['sinauid'];
                        $info['sinausername']   = $uInfo['sinausername'];
                        self::$userInfo = $info;
                       // Be_Mc::set('mc.default',$cache_key, $info, 24 * 60 * 60);
                    }

                } else 
                    self::$userInfo = $uInfo;
            }
        }
        return self::$userInfo;
    }

    public static function getUserId() {
        $uid = 0;
        $userInfo = self::userInfo(); 
        if ( is_array($userInfo) && !empty($userInfo) )
            $uid = $userInfo['sinauid'];
        return $uid;
    }

    public static function getUserName() {
        $uname = '';
        $userInfo = self::userInfo(); 
        if ( is_array($userInfo) && !empty($userInfo) )
            $uname = $userInfo['screen_name'] ? $userInfo['screen_name'] : $userInfo['sinausername'];
        return $uname;
    }

    /**
     * @desc 获取用户头像
     *
     */
    public static function getUserAvatar() {
        $userInfo    = self::userInfo();
        if ( is_array($userInfo) && count($userInfo) > 0 ) {
            return $userInfo['profile_image_url'];
        } else 
            return Be_Config::k('job/global.default_face');
    }


    /**
     * @param $text 登录页面要显示的文字描述
     * @param $backurl 登录后要跳转到回的地址
     * @return string $url
     * @desc 获取用户登录url
     */
    public static function getLoginUrl($text = NULL, $backurl = NULL) {
        $text       = $text ? $text : '个人中心';
        $backurl    = $backurl ? $backurl : 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $loginUrl = Be_Libs_Login::loginUrl($text, $backurl);
        return html_entity_decode($loginUrl);
    }

    /**
     * @param $text 登录页面要显示的文字描述
     * @param $backurl 登录后要跳转到回的地址
     * @return string $url
     * @desc 换个账号登陆
     */
    public static function reLoginUrl($text = NULL, $backurl = NULL) {
        $text       = $text ? $text : '个人中心';
        $backurl    = $backurl ? $backurl : 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $loginUrl = Be_Libs_Login::reLoginUrl($text, $backurl);
        return html_entity_decode($loginUrl);
    }

    /**
     * @param $text 登出页面显示的文字描述
     * @param $backurl 登出之后跳回的地址
     * @return string $url
     * @desc 获取用户登出地址的url
     */
    public static function getLogoutUrl($text = NULL, $backurl = NULL) {
        $text       = $text ? $text : '个人中心';
        session_start();
        $reUrl      = $_SESSION['relocation'] ? $_SESSION['relocation'] : 'http://sina.cn/?vt=4';
        $backurl    = $backurl ? $backurl : $reUrl;
        $logoutUrl  = Be_Libs_Login::loginOutUrl($text, $backurl);
        return html_entity_decode($logoutUrl);
    }

    /**
     * @desc 检测用户是否登录，如果没有登录自动跳转到登陆页，支持定制登陆页的文字描述(text)，
     * 并支持定制登录后跳回的ulr，默认跳回当前页
     */
    public static function needLogin($text = NULL, $backurl = NULL ) {
        if ( !Be_Libs_Login::checkLogin() ) {
            $loginUrl = self::getLoginUrl($text, $backurl);
        	header("Cache-Control: no-cache, no-store");
			header("Pragma: no-cache");
			header('Location: '. $loginUrl);
        }
    }


    public static function getUserCounts($uid, $type = 1, $hasArr = array()) { 
        //$cache_key  = 'user_favorite_comment_count_' . $uid;
        //$userCounts = Be_Mc::get('mc.default',$cache_key);
        if ( !$userCounts ) {
            if ( isset($hasArr['total']) ) {
                $fav_count = $hasArr['total'];
            } else {
                $fav_lists  = Model_Favorite::getFavoriteLists($uid, $type);
                $fav_count  = $fav_lists['total'];
            }
            $cmnt_lists     = Model_Comment::getMyCommentLists($uid, 'my', $type);
            $cmnt_counts    = $cmnt_lists['usercount'];
            ///订阅列表
            $myLists = Model_Yuedu::getMyLists($uid);
            $userCounts = array(
                'fav_count' => $fav_count,//收藏数
                'l_reply'   => $cmnt_counts['l_reply'],//评论我的
                'l_count'   => $cmnt_counts['l_count'],//我评论的
                't_count'   => $cmnt_counts['l_reply'] + $cmnt_counts['l_count'],//评论总数
                'yd_count'  => $myLists['count'],//订阅的媒体数

            );
            //Be_Mc::set('mc.default',$cache_key, $userCounts, 180);
        }
        return $userCounts;
    }

    public static function isRefresh() {
        return Be_Data::param('refresh', '') || (!Be_Config::k('personal.cache_open'));
    }

    /**
     * @desc 获取业务的主域名地址
     */
    public static function getHostUrl() {
        return 'http://'.$_SERVER['HTTP_HOST'];
    }

    public static function encrpt($uid) {
        $key = '%&#(*^da&D@_*@#';
        return sha1($key . $uid);
    }
}
