<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：yuedu.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年07月30日
*   Description   ：悦读接入model层 
*/
class Model_Yuedu {
    /**
     * @param null
     * @access public
     * @return array
     * @desc获取个人中心首页悦读推荐的card数据
     */
    public static function getYueDuRec($uid) {
        $ydLists = array();
        //$cache_key  = 'yuedu_rec_my';
        //$ydLists = Be_Mc::get('mc.default', $cache_key);
        if ( !is_array($ydLists) || count($ydLists) <= 0 || Model_Common::isRefresh() ) {
            $ydLists = Data_Yuedu::getYueDuRec();
            if ( is_array($ydLists) && count($ydLists) > 0 ) {
                foreach ( $ydLists as $key => $value ) {//过滤标题为空的数据
                    if ( $value['title'] == '' )
                        unset($ydLists[$key]);
                }
                if ( ($ct = count($ydLists)) < Data_Yuedu::YUEDU_REC_COUNT ) {
                    $c = floor($ct/3);
                    $ydLists = array_slice($ydLists, 0, $c*3);
                }
                //Be_Mc::set('mc.default',$cache_key, $ydLists, 1800);
            }
        }
        return $ydLists;
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
        $ydLists = array();
        $cache_key = 'yuedu_my_lists_' . $uid . '_' . $page . '_' . $size;
        $ydLists = Be_Mc::get('mc.default', $cache_key);
        if ( !is_array($ydLists) || count($ydLists) <= 0 || Model_Common::isRefresh() ) {
            $ydLists = Data_Yuedu::getMyLists($uid, $page, $size);
            if ( is_array($ydLists) && count($ydLists) > 0 ) {
                Be_Mc::set('mc.default',$cache_key, $ydLists, 1800);
            }
        }
        return $ydLists;
    }
}
