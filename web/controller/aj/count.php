<?php
/**
 *   Copyright (C) 2015 All rights reserved.
 *
 *   FileName      ：count.php
 *   Author        ：zhiqiang18
 *   Email         ：zhiqiang18@staff.sina.com.cn
 *   Date          ：2015年03月17日
 *   Description   ：获取导航数字
 */
class Controller_Aj_Count {
    private $_data  = array(); 

    public function run() {
        $uid    = Model_Common::getUserId();
        /**
        if ( !Be_Libs_Safe_Csrf::checkAll(Be_Config::k('personal.csrf_code_key'), $uid) ) {
            $ret = array(
                'status'    => 0,
                'message'   => '异常操作',
            );
        }
         */
        if ( (int)$uid <= 0 ) {
            $ret = array(
                'status'    => 0,
                'message'   => '用户未登录',
            );
        }
        //获取导航各种数
        $userCounts  = Model_Common::getUserCounts($uid);
        $ret = array(
            'status'    => 1,
            'message'   => 'success',
            'data'      => $userCounts,
        );

        Be_Libs_Ajax::displayJson($ret);
    }
}
