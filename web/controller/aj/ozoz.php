<?php
/**
*   Copyright (C) 2015 All rights reserved.
*
*   FileName      ：ozoz.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2015年07月21日
*   Description   ：1010
*/
class Controller_Aj_Ozoz {
    private $_data  = array(); 
    
    public function run() {
        $uid    = Model_Common::getUserId();
        if ( !Be_Libs_Safe_Csrf::checkAll(Be_Config::k('personal.csrf_code_key'), $uid) ) {
            $ret = array(
                'status'    => 0,
                'message'   => '异常操作',
            );
            Be_Libs_Ajax::displayJson($ret);
        }
        if ( (int)$uid <= 0 ) {
            $ret = array(
                'status'    => 0,
                'message'   => '用户未登录',
            );
            Be_Libs_Ajax::displayJson($ret);
        }
        $result = Model_Ozoz::drawTools($uid);

        if ( $result['result'] ) {
            $ret = array(
                'status'    => 1,
                'message'   => 'success',
                'data'      => '您明天可领取' . $result['tools'][0] . '个刷新，' . $result['tools'][1] . '个炸弹',
            );
        } else
            $ret = array(
                'status'    => 0,
                'message'   => '领取失败',
            );

        Be_Libs_Ajax::displayJson($ret);
    }
}
