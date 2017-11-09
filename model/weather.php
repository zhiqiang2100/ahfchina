<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：weather.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：天气相关model层接口
*/
class Model_Weather {

    /**
     * @param $uid
     * @return array()
     * @desc 获取当前客户端用户所在城市的天气情况
     */
    public static function getLocationWeather($uid) {
        $weather = array();    
        $cache_key  = 'location_weather' . $uid;
        $weather = Be_Mc::get('mc.default',$cache_key);
        $city = $_COOKIE['w_dc'];
        if ( !$city )
            $city = $_COOKIE['current_city'];
        else
            $city = iconv('gbk', 'utf8', $city);

        $ip   = Be_Data::getClientIp();

        if ( !$weather || Model_Common::isRefresh() ) {
            $weatherL = Data_Weather::getLocationWeather($uid, $ip, $city);
            if ( is_array($weatherL) && is_array($weatherL['today']) && count($weatherL['today']) > 0 ) {
                //当前城市名称
                $weather['city'] = $weatherL['today']['day']['city'];
                //周几
                $weather['week'] = $weatherL['today']['week_chinese'];
                //天气更新时间
                $weather['uptime'] = date("m月d日 H:i", strtotime($weatherL['today']['day']['updatetime']));
                //天气标志图片
                $weather['icon'] = $weatherL['today']['icon'];
                //天气描述
                $weather['desc'] = $weatherL['today']['status_show_fomart'];
                //温度描述
                $weather['temp'] = str_replace('/', '-', $weatherL['today']['temperature_show_fomart']);
                //风力描述
                $weather['power']= $weatherL['today']['power_str_show_fomart'];
                //PM值
                $weather['pm25']= $weatherL['today']['pm25'];
                //空气污染程度
                $weather['pollution']= $weatherL['today']['pollution'];
                Be_Mc::set('mc.default',$cache_key, $weather, 600);
            }
        }
        if ( !$_COOKIE['w_dc'] ) {
            $city = iconv('utf8', 'gbk', $weather['city']);
            Be_Libs_Cookie::setCookie('w_dc', $city, 365 * 24 * 3600);
        }
        if ( is_array($weather) && count($weather) > 0 ) {
            $url        = 'http://weather1.sina.cn/';
            $backurl    = Be_Libs_Tool::getHostUrl();
            $content    = $weather['city'] . ' ' . date('m/d H:i') . ' 今日,' . $weather['desc'] . $weather['temp'] . ' ' . $weather['power']; 
            $shareurl   = Be_Libs_Weibo::buildShareUrl($content, $url, $weather['icon'], $backurl, 0);
            $weather['shareurl'] = $shareurl;
        }
        return $weather;
    }
}
