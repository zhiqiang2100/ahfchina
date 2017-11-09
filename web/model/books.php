<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：books.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月08日
*   Description   ：阅读相关接口
*/
class Model_Books {

    /**
     * @param $uid int
     * @return array()
     * @desc 获取用户书架上的书籍信息
     */
    public static function getUserBooks($uid) {
        $books = array(); 
        if ( (int)$uid <= 0 ) return $starInfo;
        $cache_key  = 'ubooks_info_' . $uid;
        $books = Be_Mc::get('mc.default', $cache_key);
        if ( !$books || Model_Common::isRefresh() ) {
            $books_info = Data_Books::getUserBooks($uid);
            if ( is_array($books_info) && count($books_info) > 0 ) {
                foreach ( $books_info as $key => $value ) {
                    $books[$key]['title']   = $value['title'];
                    $books[$key]['author']  = $value['author'];
                    $books[$key]['category']= $value['category'];
                    $books[$key]['status']  = $value['status'];
                    $books[$key]['counts']  = $value['read_count'];
                    $books[$key]['cover']   = $value['cover'];
                    $books[$key]['read_url']   = $value['read_url'];
                }
            }
            Be_Mc::set('mc.default',$cache_key, $books_info, 300);
        }
        if ( is_array($books) && count($books) > 0 ) {
            foreach ( $books as $key => &$value ) {
                $url        = $value['read_url'];
                $backurl    = Libs_Tool::getHostUrl();
                $content    = '给大家分享一部好书 书名:' . $value['title'] . ' 作者:' . $value['author'] . ' 分类:' . $value['category'] . ' 状态:' . $value['status'] . ' 千万不要错过哦';
                Be_Libs_Weibo::setTj('book');
                $shareurl   = Be_Libs_Weibo::buildShareUrl($content, $url, $value['cover'], $backurl, 0, $value['title']);
                $value['shareurl'] = $shareurl;
                //$shareCount = Be_Libs_Weibo::getShareCount($url);
            }
        }
        return $books;
    }
}
