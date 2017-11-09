<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：index.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月11日
*   Description   ：用户中心首页相关的ajax操作接口
*/
class Controller_Aj_Index {
    private $_data  = array(); 
    
    public function run() {
        $op     = Be_Data::param('op', 'set');
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
        case 'set':
            $appid      = (int)Be_Data::param('appid', 0);
            $result     = Model_Userset::setAppTop($uid, $appid);

            if ( $result ) {
                $ret = array(
                    'status'    => 1,
                    'message'   => 'success',
                );
            } else
                $ret = array(
                    'status'    => 0,
                    'message'   => '置顶失败',
                );
        break;
        case 'stock':
            $code   = Be_Data::param('code', '');
            $type   = Be_Data::param('type', 'stock');
            $lists  = Model_Stocks::refreshStock($code, $type);
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
