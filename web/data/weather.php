<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：wether.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：
*/
Class Data_Weather {
    private static $_params = array();
    /**
     * @param $uid string 当前用户id
     * @return array()
     * @desc 获取当前客户端所在城市的天气情况
     */
    public static function getLocationWeather($uid = NULL, $ip = NULL, $city = NULL) {
        $lists  = array();

		$api_url    = Be_Config::k('personal.api_location_weather');
        if ( empty($api_url) ) return $lists;

        /**
        $opts = array(
            'http'=>array(
                'method'=>'GET',
                'timeout'=>10,
            )
        );
        $context = stream_context_create($opts);
        $ret_data   = json_decode(file_get_contents($api_url . '?ip=' . $ip, false, $context), true);
        */
        $params = array(
            'uid'   => $uid,
            'ip'    => $ip,
            'city'  => $city,
        );
        $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !$ret_data )
            $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( $ret_data['code'] != 0 )
            return $lists;
        else
            $lists = $ret_data['data'];
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( $ret_data['code'] != 0 )
            return $lists;
        else
            $lists = $ret_data['data'];

        return $lists;
    }
}
