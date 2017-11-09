<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：star.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：星运
*/
class Model_Star {
    private static $ast = array(
        "白羊座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/1241d602.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=1"
        ),
        "金牛座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/d80c44dc.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=2"
        ),
        "双子座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/2c15dc12.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=3"
        ),
        "巨蟹座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/daab63c8.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=4"
        ),
        "狮子座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/853c6d7b.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=5"
        ),
        "处女座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/f9b95d2e.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=6"
        ),
        "天秤座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/33269f8d.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=7"
        ),
        "天蝎座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/eef4bcfe.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=8"
        ),
        "射手座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/8f6cd554.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=9"
        ),
        "摩羯座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/b9b42d71.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=10"
        ),
        "水瓶座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/60707292.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=11"
        ),
        "双鱼座" => array (
            "img" => "http://u1.sinaimg.cn/upload/2011/1102/18/e9f0bc8c.jpg",
            "url" => "http://dp.sina.cn/dpool/astro/ts/?ast=12"
        )
    );

    /**
     * @param $uid int
     * @return array()
     * @desc 获取用户星运信息
     */
    public static function getUserStarInfo($uid) {
        $starInfo = array(); 
        if ( (int)$uid <= 0 ) return $starInfo;
        $cache_key  = 'ustar_info_' . $uid;
        #$starInfo = Be_Mc::get('mc.default', $cache_key);
        if ( !$starInfo || Model_Common::isRefresh() ) {
            $starInfo = Data_Star::getUserStarInfo($uid);
            $starInfo['img'] = self::$ast[$starInfo['name']]['img'];
            $starInfo['url'] = self::$ast[$starInfo['name']]['url'];
            Be_Mc::set('mc.default',$cache_key, $starInfo, 300);
        }
        if ( is_array($starInfo) && count($starInfo) > 0 ) {
            $url        = 'http://dp.sina.cn/dpool/astro/starent/xingyun.php';
            $backurl    = Libs_Tool::getHostUrl();
            $content    = Be_Libs_String::substr_cn($starInfo['name'] . ' 今日运势：' . $starInfo['ys'], 140);
            Be_Libs_Weibo::setTj('astro');
            $shareurl   = Be_Libs_Weibo::buildShareUrl($content, $url, $starInfo['img'], $backurl, 0);
            $starInfo['shareurl'] = $shareurl;
        }
        return $starInfo;
    }
}
