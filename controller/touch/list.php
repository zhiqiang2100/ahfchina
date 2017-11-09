<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：list.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年02月29日
*   Description   ：
*/
Class Controller_Touch_List extends Controller_Touch_Base {
    public $_tpl     = 'touch/list.php';

    public function run() {
        $this->_data['action']      = 'list';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
