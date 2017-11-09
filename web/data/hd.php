<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：hd.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年05月20日
*   Description   ：
*/
Class Data_Hd {
    private static $_charset    = 'utf-8';
    private static $_params     = array();
    private static $_time       = 0;
    private static $_hasKey     = 'vRaWCWh4un8t62aw';

    /**
     * @desc 获取用户的活动信息
     */
    public static function getUinfo($uid) {
        $lists  = array();

        $config_key = 'hd.api_hd_info';
		$api_url    = Be_Config::k($config_key);
        if ( empty($api_url) ) return $lists;

        self::$_params = array(
            'ie'        => self::$_charset,
            'oe'        => self::$_charset,
            'test_uid'  => $uid,
            //'from'      => 'wap',
            //'time'      => self::curTime(),
            //'m'         => md5($uid.self::$_time.self::$_hasKey),
        );
        $options = array(
            'con_timeout'   => 0,
            'read_timeout'  => 0,
        );

        $lists = self::_request($api_url, 'get', array(), $options);
        return $lists;
    }

    private static function curTime() {
        self::$_time = time();
        return self::$_time;
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
            $ret = $ret_data['result'];
        } else 
            return false;

        return $ret;

    }

    /**
     * @desc 获取用户的活动信息
     */
    public static function postAddress($uid,$name,$phone,$code,$address) {
        
        $api_url    = Be_Config::k('hd.api_hd_addrpost');
        self::$_params = array(
            'ie'        => self::$_charset,
            'oe'        => self::$_charset,
            'from'      => 'wap',
            'address'   => $address,
            'code'      => $code,
            'phone'     => $phone,
            'name'      => $name,
            'source'      => self::$_hasKey,         //（appkey）from=wap时该参数生效
//            'access_token'=> $name,   // from=wap时该参数生效
            'time'      => self::curTime(),
            'uid'       => $uid,
            'm'         => md5($uid.self::$_time.self::$_hasKey),
        );
        $ret_data = Be_Http::post( $api_url, self::$_params);
        $ret_data = json_decode($ret_data,true );
        
        if ( !is_array($ret_data) || empty($ret_data) ) {
            Be_Logs::put('error', 'post_address', $api_url."?" . http_build_query(self::$_params, '', '&'), $ret_data);
            return false;
        }
        if ( isset($ret_data['result']) && isset($ret_data['result']['status']) ) {
           Be_Logs::put('error', 'post_address', $api_url."?" . http_build_query(self::$_params, '', '&'), $ret_data);
           return $ret_data['result']['status']['code'] ;
        } else 
            return false;
    }
}
