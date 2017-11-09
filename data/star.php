<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：star.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：
*/
Class Data_Star {
    /**
     * @param $uid int
     * @return array()
     * @desc 获取用户的星运信息
     */
    public static function getUserStarInfo($uid = NULL) {
        $lists  = array();
        if ( !$uid ) return $lists;

		$api_url    = Be_Config::k('personal.api_star_info');
        if ( empty($api_url) ) return $lists;

        $params = array(
            'uid'   => $uid,
        );
        $checkInfos = array(
            'con_timeout' => 2,
            'read_timeout' => 2,
        );

        $ret_data   = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        else
            $lists = $ret_data;

        return $lists;
    }
}
