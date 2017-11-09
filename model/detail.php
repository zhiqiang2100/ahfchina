<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：item.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年03月08日
*   Description   ：
*/
class Model_Detail {

    /**
     * @param $time string 添加时间 
     * @param $office string 地点 
     * @param $title string 主题 
     * @param $author string 分享人 
     * @param $des string 分享描述 
     * @return array()
     * @desc 获取用户书架上的书籍信息
     */
    public static function addItem($time, $office, $title, $author, $des) {
        $ret = Data_Detail::addItem($time, $office, $title, $author, $des);
        return $ret;
    }
}
