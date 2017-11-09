<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：city.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月30日
*   Description   ：
*/
class Model_City extends Model_Base {
    public static function addCity($name, $cname, $weight) {
        if ( empty($name) ) return false;
        $ret = Data_City::addCity($name, $cname, $weight);
        return $ret;
    }

    public static function getCitys($page, $perPage) {
        $articles = Data_City::getCitys($page, $perPage);
        return $articles;
    }

    public static function getIndexCity() {
        $citys = Data_City::getIndexCity();
        return $citys;
    }

    public static function getCity($id) {
        $articles = Data_City::getCity($id);
        return $articles;
    }

    public static function delCity($id) {
        $articles = Data_City::delCity($id);
        return $articles;
    }

    public static function updateCity($id, $name, $cname, $weight) {
        $articles = Data_City::updateCity($id, $name, $cname, $weight);
        return $articles;
    }

    public static function getTotal() {
        $total = Data_City::getTotal();
        return $total;
    }
}
