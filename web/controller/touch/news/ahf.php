<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：ahf.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月14日
*   Description   ：
*/
Class Controller_Touch_News_Ahf extends Controller_Touch_Base {
    public $_tpl     = 'touch/news/ahf.php';

    public function run() {
        //$newsList   = Model_Article::getArticles(3, 1, 20, true);
        $lists     = Model_Article::getArticlesByST(4, 1, 1, 100, true);
        $this->_data['lists']      = $lists;
        $this->_data['title']       = 'AHF-新闻';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
