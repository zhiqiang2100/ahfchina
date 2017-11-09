<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：yuedu.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年07月30日
*   Description   ：悦读数据
*/
class Data_Yuedu {

    //定义第一页
    CONST FIRST_PAGE    = 1;
    //定义每页显示多少条
    CONST PER_PAGE      = 15;
    //阅读精彩推荐条数
    CONST YUEDU_REC_COUNT = 18;

    /**
     * @param null
     * @acess public
     * @return array()
     * @desc 获取悦读推荐数据
     */
    public static function getYueDuRec() {
        $lists  = array();

		$api_url    = sprintf(Be_Config::k('personal.api_yuedu_rec'), self::YUEDU_REC_COUNT);
        if ( empty($api_url) ) return $lists;

        $checkInfos = array(
            'con_timeout'   => 3,
            'read_timeout'  => 3,
        );
        $params = array();

        $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !$ret_data )
            $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( $ret_data['status'] != 1 )
            return $lists;
        else
            $lists = $ret_data['data'];

        return $lists;
    }

    /**
     * @param $uid int 用户uid
     * @param $page 当前页码
     * @param $size 每页多少个
     * @access public
     * return array()
     * @desc 获取我的悦读列表数据
     */
    public static function getMyLists($uid, $page = Data_Yuedu::FIRST_PAGE, $size = Data_Yuedu::PER_PAGE) {
        $lists  = array();

		$api_url    = sprintf(Be_Config::k('personal.api_yuedu_mylist'), Be_Libs_Safe_Des::encrypt($uid, Be_Config::k('personal.api_yuedu_key')), $page, $size);
        if ( empty($api_url) || (int)$uid <= 0 ) return $lists;

        $checkInfos = array(
            'con_timeout'   => 3,
            'read_timeout'  => 3,
        );

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
}
