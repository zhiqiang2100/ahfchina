<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：userset.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月09日
*   Description   ：用户设置相关
*/
Class Model_Userset {
    const USER_SETS_KEY = 'user_sers';
    //初始化25个应用，如果后期应用多于25个的时候可以再行追加
    private static $defaultApps = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
    //当前最新的card
    private static $maxAppId = 6;
    /**
     * @param $uid int 用户id
     * @return $appid int 
     * @desc 获取用户对app的配置
     */
    public static function getUserSets($uid) {
        $cache_key = self::USER_SETS_KEY . $uid;
        $userSets  = Be_Mc::get('mc.default', $cache_key);
        if ( !$userSets || Model_Common::isRefresh() ) {
            $userSets  = Data_Userset::getUserSets($uid);
        }
        if ( !is_array($userSets) || count($userSets) == 0 ) {
            //先初始化用户的配置信息
            self::initUserSets($uid);
            $userSets = self::$defaultApps;
        }
        
        Be_Mc::set('mc.default',$cache_key, $userSets, 3600);
        return $userSets;
    }

    public static function getUserSetById($id) {
        return Data_Userset::getUserSetById($id);
    }

    /**
     * @param $uid int
     * @return bool true/false 
     * @desc 初始化用户配置
     */
    public static function initUserSets($uid) {
        $userSets = self::$defaultApps;
        $ret = Data_Userset::addUserSets($uid, $userSets);
        if ( $ret ) 
            self::setAppTop($uid, self::$maxAppId);
        return TRUE;
    }

    /**
     * @access public 
     * @param $uid int
     * @param $appid
     * @return bool true/false
     * @desc 置顶app
     */
    public static function setAppTop($uid, $appid) {
        $appid = (int)$appid;
        if ( !in_array($appid, self::$defaultApps) )
            $appid = 0;
        $newSets   = array();
        $cache_key = self::USER_SETS_KEY . $uid;
        $userSets  = self::getUserSets($uid);
        $newSets   = array_diff($userSets, array($appid));
        array_unshift($newSets, $appid);
        $ret = self::updateUserSets($uid, $newSets);
        if ( $ret )
            Be_Mc::del('mc.default', $cache_key);
        return $ret;
        
    }

    /**
     * @desc 保存用户设置
     */
    public static function updateUserSets($uid, $userSets) {
        return Data_Userset::updateUserSets($uid, $userSets);
    }
}
