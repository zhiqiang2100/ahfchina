<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：introduce.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月14日
*   Description   ：
*/
Class Controller_Touch_Introduce extends Controller_Touch_Base {
    public $_tpl     = 'touch/introduce.php';

    public function run() {
        //获取首页轮播图
        $detail  = Model_Article::getArticleByStyle(1);
        $this->_data['detail']  = $detail;
        $this->_data['title']   = 'AHF-介绍';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
