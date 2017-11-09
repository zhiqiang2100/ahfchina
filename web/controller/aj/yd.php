<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：yd.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年08月05日
*   Description   ：
*/
class Controller_Aj_Yd {
    private $_data  = array(); 
    private $_tpl   = 'touch/yd/listitem.php';
    
    public function run() {
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
        $page   = Be_Data::param('page', 1);
        $count  = Be_Data::param('count', Data_Yuedu::PER_PAGE);
        $lists  = Model_Yuedu::getMyLists($uid, $page, $count);
        if ( is_array($lists) )
            $myLists = $lists['list'];
        else
            $myLists = array();
        $this->_data['myLists'] = $myLists;
        $html = Be_View::render($this->_tpl,$this->_data);
        $isend = false;
        if ( count($myLists) < $count )
            $isend = true;
        $ret = array(
            'status'    => 1,
            'message'   => 'success',
            'html'      => $html,
            'isend'     => $isend,
        );

        Be_Libs_Ajax::displayJson($ret);
    }
}
