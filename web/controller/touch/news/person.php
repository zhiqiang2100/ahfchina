<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：person.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月14日
*   Description   ：
*/
Class Controller_Touch_News_Person extends Controller_Touch_Base {
    public $_tpl     = 'touch/news/person.php';

    public function run() {
        //$newsList   = Model_Article::getArticles(3, 1, 20, true);
        $lists     = Model_Article::getArticlesByST(4, 2, 1, 100, true);
        $this->_data['lists']      = $lists;
        $this->_data['title']       = 'AHF-人物新闻';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
