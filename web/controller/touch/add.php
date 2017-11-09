<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：add.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年03月07日
*   Description   ：
*/
Class Controller_Touch_Add extends Controller_Touch_Base {
    public $_tpl     = 'touch/add.php';

    public function run() {
        $this->_data['action']      = 'add';
        $time       = Be_Data::form('time', '');
        $office     = Be_Data::form('office', '');
        $title      = Be_Data::form('title', '');
        $author     = Be_Data::form('author', '');
        $des        = Be_Data::form('des', '');

        $result     = Model_Detail::addItem($time, $office, $title, $author, $des);
        if ( $result )
            header("Location::/list.php");

        Be_View::display($this->_tpl,$this->_data); 
    }

}
