<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：favorite.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月06日
*   Description   ：收藏相关异步交互后端接口
*/
class Controller_Aj_Favorite {
    private $_data  = array(); 
    
    public function run() {
        $op     = Be_Data::param('op', 'del');
        $type   = Be_Data::param('type', 1);
        $uid    = Model_Common::getUserId();
        if ( !Be_Libs_Safe_Csrf::checkAll(Be_Config::k('personal.csrf_code_key'), $uid) ) {
            $ret = array(
                'status'    => 0,
                'message'   => '异常操作',
            );
        }
        if ( (int)$uid <= 0 ) {
            $ret = array(
                'status'    => 0,
                'message'   => '用户未登录',
            );
        }
        switch ( $op ) {
        case 'del':
            $fid    = Be_Data::param('fid', 0);
            $result = Model_Favorite::delFavorite($uid, $fid, $type);

            if ( $result ) {
                $ret = array(
                    'status'    => 1,
                    'message'   => 'success',
                );
            } else
                $ret = array(
                    'status'    => 0,
                    'message'   => '收藏取消失败',
                );
        break;
        case 'lists':
            $page   = Be_Data::param('page', 1);
            $count  = Be_Data::param('count', Data_Favorite::PER_PAGE_COUNT);
            $lists  = Model_Favorite::getFavoriteLists($uid, $type, $page, $count);
            if ( ($page * $count) >= $lists['total'] )
                $lists['isend'] = true;
            $ret = array(
                'status'    => 1,
                'message'   => 'success',
                'data'      => $lists,
            );
        break;
        }

        Be_Libs_Ajax::displayJson($ret);
    }
}
