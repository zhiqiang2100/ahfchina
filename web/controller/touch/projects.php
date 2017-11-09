<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：project.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月14日
*   Description   ：
*/
Class Controller_Touch_Projects extends Controller_Touch_Base {
    public $_tpl     = 'touch/projects.php';

    public function run() {
        $lists     = Model_Article::getArticles(2, 1, 100, true);
        //项目列表
        $this->_data['lists']    = $lists;
        $this->_data['title']       = 'AHF-CHINA项目列表';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
