<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：photo.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：图集相关接口
*/
Class Data_Photo {
    /**
     * @param null
     * @return array()
     * @desc 获取图集焦点图
     */
    public static function getPhotoFocus() {
        $lists  = array();

		$api_url    = Be_Config::k('personal.api_photo_focus');
        if ( empty($api_url) ) return $lists;

        /**
        $opts = array(
            'http'=>array(
                'method'=>'GET',
                'timeout'=>10,
            )
        );
        $context = stream_context_create($opts);
        $ret_data   = json_decode(file_get_contents($api_url, false, $context), true);
         */
        $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !$ret_data )
            $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( $ret_data['code'] != 0 )
            return $lists;
        else
            $lists = $ret_data['data'];

        return $lists;
    }

    /**
     * @param null
     * @return array()
     * @desc 获取高清图首页各频道第一张图
     */
    public static function getPhotoRec() {
        $lists  = array();

		$api_url    = Be_Config::k('personal.api_photo_rec');
        if ( empty($api_url) ) return $lists;

        $checkInfos = array(
            'con_timeout'   => 10,
            'read_timeout'  => 10,
        );

        $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !$ret_data )
            $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        
        $lists = $ret_data;

        return $lists;
    }
}
