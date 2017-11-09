<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：stocks.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月09日
*   Description   ：获取用户股票相关数据
*/
Class Data_Stocks {
    /**
     * @param $uid int
     * @return array()
     * @desc 获取股票相关信息
     */
    public static function getUserStocks($uid) {
        $lists  = array();
        if ( (int)$uid <= 0 ) return $lists;

		$api_url = sprintf(Be_Config::k('personal.api_stocks_info'), $uid);
        if ( empty($api_url) ) return $lists;

        $params = array();

        $checkInfos = array(
            'con_timeout'   => 5,
            'read_timeout'  => 5,
        );

        $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !$ret_data )
            $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( $ret_data['code'] != 1 )
            return $lists;
        else
            $lists = $ret_data['data'];

        return $lists;
    }

    /**
     * @code string 股票代码
     * @type string 股票类型
     * @return array()
     * @desc 刷新股票信息
     */
    public static function getStockInfo($code, $type) {
        $cinfo = array();

        $api_url = Be_Config::k('personal.api_stocks_info');
        if ( empty($api_url) ) return $cinfo;

        $params = array('code' => $code, 'op' => 'single', 'type' => $type);
        $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !$ret_data )
            $ret_data = json_decode(Be_Http::get($api_url, $params, $checkInfos), true);
        if ( !is_array($ret_data) || empty($ret_data) ) return false;
        if ( $ret_data['code'] != 1 )
            return $cinfo;
        else
            $cinfo = $ret_data['data'];

        return $cinfo;

    }
}
