<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：encrypt.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月11日
*   Description   ：加密算法
*/
Class Libs_Encrypt {

    //和徐焱侧接口key，收藏相关接口
    const HASH_KEY_VALUE = 'vRaWCWh4un8t62aw';
    //和邮箱侧接口key
    const MAIL_KEY_VALUE = 'b6843c61ee2c66bf53e9f03a9760fc5d93';

    /** 
     * @access public
     * @param $uid int 用户uid
     * @return $suid string 加密后的字符串
     * @desc 和收藏接口侧的加密算法
     */
    public static function encrypt($uid) {
        if ( (int)$uid <= 0 ) return ;
        $timeStamp = self::_curTime();
        $hash = md5($uid . $timeStamp . self::HASH_KEY_VALUE);
        $hashArr['ctime']   = $timeStamp;
        $hashArr['hash']    = $hash; 
        return $hashArr;
    }   

    /**
     * @access private
     * @desc 获取当前时间戳
     */
    private static function _curTime() {
        return time();
    }

    /**
     * @access public
     * @param $uid int 用户id
     * @param $ctime int 解码的时间戳
     * @param hash string hash key value
     * @desc 和收藏接口侧解码的方法
     */
    public static function dencrypt($uid, $ctime, $hash) {
        $timeStamp = self::_curTime();
        if ( abs($timeStamp - $ctime) > 30 )
            return false;
        if ( md5($uid . $ctime . self::HASH_KEY_VALUE) == $hash )
            return true;
        else
            return false;
    }

    /**
     * @access public 
     * @param $uid int 用户uid
     * @return array
     * @desc 和邮箱侧接口协议
     */
    public static function mencrypt($uid) {
        $ctime = self::_curTime();
        $s = hash_hmac('sha1', '/1/checknewmsg' . $uid . $ctime, self::MAIL_KEY_VALUE); 
        return array(
            'entry' => 'sinamobile',
            's'     => $s,
            'ts'    => $ctime,
        );
    }
}
