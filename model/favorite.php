<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：favorite.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年02月27日
*   Description   ：个人中心收藏
*/
class Model_Favorite {

    /**
     * @param $uid int 用户id
     * @param $type int 用来标示是文章类型还是图片类型的收藏列表0:文章 1:图片
     * @param $page int 第几页
     * @param $count int 每页显示多少条
     * @return array()
     * @desc 获取收藏列表
     */
    public static function getFavoriteLists($uid, $type = Data_Favorite::FAVORITE_TYPE_ARTICLE,
        $page = Data_Favorite::FIRST_PAGE, $count = Data_Favorite::PER_PAGE_COUNT) {
        
        $favoriteLists = Data_Favorite::getFavoriteLists($uid, $type, $page, $count);
        if ( is_array($favoriteLists['data']) && !empty($favoriteLists['data']) ) {
            foreach ( $favoriteLists['data'] as $key => &$value ) {
                $value['ctime']     = Libs_Tool::getTimeReduce($value['ctime'], false);
                $value['addtime']   = Libs_Tool::getTimeReduce($value['addtime'], false);
                $title = $value['short_title'] ? $value['short_title'] : $value['title'];
                //$value['url'] = 'http://dp.sina.cn/dpool/cms/jump.php?url='. urlencode($value['url']) . '&vt=4';
                $value['url'] = $value['url'];
                $value['title'] = $title;
                if ( $value['category'] == Data_Favorite::FAVORITE_TYPE_ARTICLE )
                    $cat = '[新闻]';
                else if ( $value['category'] == Data_Favorite::FAVORITE_TYPE_PICTURE )
                    $cat = '[图集]';
                else if ( $value['category'] == Data_Favorite::FAVORITE_TYPE_VIDEO )
                    $cat = '[视频]';
                else if ( $value['category'] == Data_Favorite::FAVORITE_TYPE_BLOG )
                    $cat = '[博客]';
                else if ( $value['category'] == Data_Favorite::FAVORITE_TYPE_ZHUANLAN )
                    $cat = '[专栏]';
                $value['cat']  = $cat;
                $genData = Be_Libs_Safe_Csrf::genData(Be_Config::k('personal.csrf_code_key'), Model_Common::getUserId());
                $value['delurl'] = Model_Common::getHostUrl() . '/aj/favorite?fid='.$value['id'] . '&csrfcode='.$genData['csrfcode'] . '&csrftime=' . $genData['csrftime'];
            }
        }
        return $favoriteLists;
    }

    /**
     * @param $uid int 用户id
     * @param $docid string 帖子地址
     * @param $type int 收藏类型 1文章 2图片
     * @return bool true/false
     * @desc 添加收藏
     */
    public static function addFavorite($uid, $docid, $type = Data_Favorite::FAVORITE_TYPE_ARTICLE) {
        return Data_Favorite::addFavorite($uid, $docid, $type);
    }

    /**
     * @param $uid int 用户id
     * @param $fid int 收藏id
     * @param $type int 收藏类型 1文章 2图片
     * @return bool true/false
     * @desc 删除收藏
     */
    public static function delFavorite($uid, $fid, $type = Data_Favorite::FAVORITE_TYPE_ARTICLE) {
        return Data_Favorite::delFavorite($uid, $fid, $type);
    }

    /**
     * @param $uid int 用户id
     * @param $fid int 收藏id
     * @param $type int 收藏类型 1文章 2图片
     * @return bool true/false
     * @desc 判断是否收藏过
     */
    public static function isFavorite($uid, $fid, $type = Data_Favorite::FAVORITE_TYPE_ARTICLE) {
        return Data_Favorite::isFavorite($uid, $fid, $type);
    }

    public static function checkAll($docid) {
        return true;
        $csrfcode   = Be_Data::form('csrfcode', 0);
        $csrftime   = Be_Data::form('csrftime', 0);
        $ckcode = md5('_sina_collect_Key_' . $csrftime .'_'. $docid);
        if ( ($ckcode == $csrfcode) && ((time() - $csrftime) < 10) )
            return true;
        else
            return false;
    }

}
