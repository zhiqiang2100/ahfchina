<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：news.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月08日
*   Description   ：
*/
Class Controller_Touch_News extends Controller_Touch_Base {
    public $_tpl     = 'touch/news.php';

    public function run() {
        //$newsList   = Model_Article::getArticles(3, 1, 20, true);
        $newsList = $fzList = $ggList = array();
        $lists     = Model_Article::getArticles(4, 1, 20, true);
        if ( Be_Libs_Tool::be_array($lists) ) {
            foreach ( $lists as $key => $value ) {
                if ( $value['type'] == 1 )
                    $newsList[] = $value;
                if ( $value['type'] == 2 )
                    $fzList[] = $value;
                if ( $value['type'] == 3 )
                    $ggList[] = $value;
            }
        }
        //取最新的5条新闻
        $this->_data['newsList']    = $newsList;
        //人物新闻5条
        $this->_data['ggList']      = $ggList;
        //政策法规 5条
        $this->_data['fzList']      = $fzList;
        $this->_data['title']       = 'AHF-CHINA新闻列表';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
