<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：index.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年08月05日
*   Description   ：
*/
Class Controller_Touch_Yd_Index extends Controller_Touch_Base {
    protected $_tpl     = 'touch/yd/index.php';
    public  $_data      = array(); 
    
    public function run() {
        $myLists = Model_Yuedu::getMyLists($this->_data['uid']);
        if ( is_array($myLists) ) {
            $this->_data['myLists'] = $myLists['list'];
            //媒体订阅数 
            $this->_data['dyCount'] = $myLists['count'];
            if ( count($this->_data['myLists']) < Data_Yuedu::PER_PAGE )
                $this->_data['isend'] = true;
        }
        Be_View::display($this->_tpl,$this->_data);
    }
}
