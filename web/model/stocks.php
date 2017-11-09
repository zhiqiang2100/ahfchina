<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：stocks.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：财经相关信息
*/
class Model_Stocks {

    /**
     * @param $uid int 
     * @return array()
     * @desc 获取用户个股信息
     */
    public static function getUserStocks($uid) {
        $stocks = array(); 
        if ( (int)$uid <= 0 ) return $stocks;
        $stocks = Data_Stocks::getUserStocks($uid);
        if ( is_array($stocks) && count($stocks) > 0 ) {
            $codesArr = array();
            foreach ( $stocks as $key => &$value ) {
                if ( in_array($value['code'], $codesArr) ) {
                    unset($stocks[$key]);
                } else {
                    $value      = self::tidyStockItem($value);
                    $url        = $value['url'];
                    $backurl    = Libs_Tool::getHostUrl();
                    $content    = "我正在使用手机新浪网股票查询功能查看股票实时行情,{$value['name']}({$value['code']}) 当前价:{$value['zuixin']} 涨跌额:{$value['zhangdiee']} 涨跌幅:{$value['zhangdiefu']}.很实用的工具哦,推荐给大家";
                    Be_Libs_Weibo::setTj('finance');
                    $shareurl   = Be_Libs_Weibo::buildShareUrl($content, $url, '', $backurl, 0);
                    $value['shareurl'] = $shareurl;
                    //$value['updatetime'] = self::formatTime($value['updatetime']);
                    array_push($codesArr, $value['code']);
                }
            }
        }
        return $stocks;
    }

    /**
     * @code string 股票代码
     * @type string 股票类型
     * @return array()
     * @desc 刷新股票信息
     */
    public static function refreshStock($code, $type) {
        $cinfo = array();
        if ( !$code ) return $cinfo;
        $cinfo = Data_Stocks::getStockInfo($code, $type);
        if ( is_array($cinfo) )
            return self::tidyStockItem($cinfo[0]);
        else
            return array();
    }

    /**
     * @access private
     * @param $stockInfo array
     * @return $stocksInfo array
     * @desc 格式化单条股票信息
     */
    private static function tidyStockItem($stockInfo) {
        if ( !is_array($stockInfo) || empty($stockInfo) ) 
            return $stockInfo;

        //sh和基金是红涨绿跌，其他则相反
        $type = $stockInfo['type'];
        $zhangdiee  = $stockInfo['zhangdiee'];
        $zhangdiefu = $stockInfo['zhangdiefu'];
        if ( $type == 'sh' || $type == 'stock' ) {
            if ( $zhangdiee > 0 ) {
                $cssName = 'red';
                $flag    = '+';
            } else {
                $cssName = 'green';
                $flag    = '';
            }
        } else {
            if ( $zhangdiee > 0 ) {
                $cssName = 'green';
                $flag    = '+';
            } else {
                $cssName = 'red';
                $flag    = '';
            }
        }
        if ( $zhangdiee == 0 || $stockInfo['stop'] != 0 ) {
            $cssName = 'black';
            $flag      = '';
        }
        $stockInfo['zhangdiee']  = $flag . $zhangdiee;
        $stockInfo['zhangdiefu'] = $flag . $zhangdiefu;
        $stockInfo['color']      = $cssName;
        $stockInfo['updatetime'] = self::formatTime($stockInfo['updatetime']);
        return $stockInfo;
    }

    private static function formatTime($time) {
        return date("m月d日 H:i", strtotime($time));
    }
}
