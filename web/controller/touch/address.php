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
Class Controller_Touch_Address extends Controller_Touch_Base {
    public $_tpl     = 'touch/address.php';

    public function run() {
        $this->_data['action']      = 'address';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
