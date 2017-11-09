<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：rule.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月14日
*   Description   ：
*/
Class Controller_Touch_News_Rule extends Controller_Touch_Base {
    public $_tpl     = 'touch/news/rule.php';

    public function run() {
        $lists     = Model_Article::getArticlesByST(4, 3, 1, 100, true);
        $this->_data['lists']      = $lists;
        $this->_data['title']       = 'AHF-政策法规';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
