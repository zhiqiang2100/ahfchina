<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：detail.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月08日
*   Description   ：
*/
Class Controller_Touch_Detail extends Controller_Touch_Base {
    public $_tpl     = 'touch/detail.php';

    public function run() {
        $id = Be_Data::param('id', 0);
        //获取首页轮播图
        $detail  = Model_Article::getArticle($id);
        $this->_data['detail']  = $detail;
        $this->_data['title']   = $detail['title'];
        Be_View::display($this->_tpl,$this->_data); 
    }

}
