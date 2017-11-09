<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：history.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年02月29日
*   Description   ：
*/
Class Controller_Touch_History extends Controller_Touch_Base {
    public $_tpl     = 'touch/history.php';

    public function run() {
        $toolsInfo = Model_Ozoz::getUserToolsInfo($this->_data['uid']);
        if ( $_GET['debug'] )
            var_dump($toolsInfo);
        $this->_data['toolsInfo']    = $toolsInfo;
        $this->_data['action']      = 'index';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
