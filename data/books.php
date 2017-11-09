<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：books.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：
*/
Class Data_Books {
    /**
     * @param $uid int
     * @return array()
     * @desc 获取用户的书架上的书籍信息
     */
    public static function getUserBooks($uid = NULL) {
        $lists  = array();
        if ( !$uid ) return $lists;

		$api_url    = Be_Config::k('personal.api_books_info');
        if ( empty($api_url) ) return $lists;

        $params = array(
            'uid'   => $uid,
            'page'  => 1,
            'pagesize'  => 10,
        );
        $checkInfos = array(
            'con_timeout' => 4,
            'read_timeout' => 4,
        );

        $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !$ret_data )
            $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);

        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        else
            $lists = $ret_data['books'];

        return $lists;
    }
}
