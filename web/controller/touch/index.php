<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：index.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月03日
*   Description   ：首页
*/
Class Controller_Touch_Index extends Controller_Touch_Base {
    public $_tpl     = 'touch/index.php';

    public function run() {
        //获取首页轮播图
        $lunboList  = Model_Pic::getPicList(0);
        $this->_data['lunboList']   = $lunboList;
        $newsLunbo  = Model_Pic::getPicList(1);
        $this->_data['newsLunbo']   = $newsLunbo;
        //取最新的3条新闻
        $newsList   = Model_Article::getArticles(4, 1, 3, true);
        $this->_data['newsList']    = $newsList;
        //获得新闻轮播图
        $newsLunbo  = Model_Pic::getPicList(1);
        //获取项目列表
        $xmList     = Model_Article::getArticles(2, 1, 3, true);
        $this->_data['xmList']      = $xmList;
        //防治知识
        $fzList     = Model_Article::getArticles(5, 1, 3, true);
        //首页监测点列表
        $checkList  = Model_Check::getIndexCheck();
        $this->_data['checkList']      = $checkList;
        $this->_data['fzList']      = $fzList;
        $this->_data['action']      = 'index';
        $this->_data['title']       = 'AHF-CHINA首页';
        //$this->_tpl = 'touch/index_mobile.php';
        Be_View::display($this->_tpl,$this->_data); 
    }

}
