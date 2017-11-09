<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：check.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月14日
*   Description   ：
*/
Class Controller_Touch_Knowledge extends Controller_Touch_Base {
    public $_tpl     = 'touch/knowledge.php';

    public function run() {
        $lists     = Model_Article::getArticles(5, 1, 100, true);
        //项目列表
        $this->_data['lists']    = $lists;
        $this->_data['title']       = 'AHF-CHINA防治知识';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
