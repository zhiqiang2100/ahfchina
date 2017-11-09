<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：checks.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年06月04日
*   Description   ：
*/
Class Controller_Touch_Checks extends Controller_Touch_Base {
    public $_tpl     = 'touch/checks.php';

    public function run() {
        $checkList  = Model_Check::getChecks();
        $res = array();
        if ( Be_Libs_Tool::be_array($checkList) ) {
            foreach ( $checkList as $key => $value ) {
                $res[$value['city_name']][] = $value;
            }
        }
        $this->_data['checkList']      = $res;
        $this->_data['action']      = 'index';
        $this->_data['title']       = 'AHF-监测点';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
