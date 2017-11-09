<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：photo.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：高清图相关的接口
*/
class Model_Photo {

    /**
     * @param null
     * @return array()
     * @desc 获取高清图焦点图集
     * @desc 高清图改版之后这个方法不再使用2014-07-24
     */
    public static function getPhotoFocus() {
        $focus = array(); 
        $cache_key  = 'photo_focus';
        $foucs = Be_Mc::get('mc.default', $cache_key);
        if ( !$focus || Model_Common::isRefresh() ) {
            $focus = Data_Photo::getPhotoFocus();
            Be_Mc::set('mc.default',$cache_key, $focus, 600);
        }
        if ( is_array($focus) && count($focus) > 0 ) {
            foreach ( $focus as $key => &$value ) {
                $value['url'] = str_replace('WEB_ROOT/album', 'http://dp.sina.cn/dpool/hdpic/view.php', $value['url']);
                $url        = $value['url'];
                $backurl    = Libs_Tool::getHostUrl();
                $content    = $value['title'];
                $shareurl   = Be_Libs_Weibo::buildShareUrl($content, $url, $value['pic'], $backurl, 0);
                $value['shareurl'] = $shareurl;
            }
        }
        return $focus;
    }

    /**
     * @param null
     * @return array()
     * @desc 获取高清图首页每个频道的第一张图
     */
    public static function getPhotoRec() {
        $focus = array(); 
        $cache_key  = 'photo_rec_my';
        $rec = Be_Mc::get('mc.default', $cache_key);
        if ( !is_array($rec) || count($rec) <= 0 || Model_Common::isRefresh() ) {
            $rec = Data_Photo::getPhotoRec();
            Be_Mc::set('mc.default',$cache_key, $rec, 600);
        }
        if ( is_array($rec) && count($rec) ) {
            foreach ( $rec as $key => $value ) {
                $item = array();
                $item['title']  = $value[0]['short_name'];
                $item['url']    = Libs_Tool::treateUrl($value[0]['wap_url']);
                $item['pic']    = $value[0]['img_url'];
                //处理r3服务器的图片，自动截取合适比例，防止前端展示变形
                if ( strpos($item['pic'], '3.sinaimg.cn')) {
                    //http://r3.sinaimg.cn/10260/2014/0729/a9/b/96487603/250x10000x100x0x0x1.jpg
                    $item['pic'] = substr($item['pic'], 0, strrpos($item['pic'], '/')) . '/250x160x300x0x0x2'. substr($item['pic'], strrpos($item['pic'], '.')); 
                }
                $item['img_name']    = $value[0]['img_name'];
                $url        = $item['url'];
                $backurl    = Libs_Tool::getHostUrl();
                $content    = $item['title'];
                $shareurl   = Be_Libs_Weibo::buildShareUrl($content, $url, $item['pic'], $backurl, 0);
                $item['shareurl'] = $shareurl;
                $focus[] = $item;
            }
        }
        return $focus;
    }
}
