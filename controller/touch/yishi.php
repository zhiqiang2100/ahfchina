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
Class Controller_Touch_Yishi extends Controller_Touch_Base {
    public $_tpl     = 'touch/yishi.php';

    public function run() {
        $this->_data['action']      = 'yishi';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
