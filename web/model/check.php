<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：check.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年06月12日
*   Description   ：
*/
class Model_Check extends Model_Base {
    public static function addCheck($name, $address, $city, $mobile) {
        if ( empty($name) ) return false;
        $ret = Data_Check::addCheck($name, $address, $city, $mobile);
        return $ret;
    }

    public static function getChecks() {
        $articles = Data_Check::getChecks();
        if ( is_array($articles) && !empty($articles) )  {
            foreach ( $articles as $k => &$v ) {
                $c = Data_City::getCity($v['city']);
                if ( is_array($c) ) {
                    $v['city_name'] = $c['name'];
                }
            }
        }
        return $articles;
    }

    public static function getIndexCheck() {
        $checks = array();
        $city = Model_City::getIndexCity();
        if ( is_array($city) && count($city) > 0 ) {
            foreach ( $city as $key => $val ) {
                $item = array();
                $check = self::getCheckByCity($val['id']);
                $item['city'] = $val['name'];
                $item['address'] = $check[0]['address'];
                $item['mobile'] = $check[0]['mobile'];
                $checks[] = $item;
            }
        }
        return $checks;
    }

    public static function getCheckByCity($city) {
        $check = Data_Check::getCheckByCity($city);
        return $check;
    }

    public static function getChecksByCity($city) {
        $articles = Data_Check::getChecksByCity($city);
        return $articles;
    }

    public static function getCheck($id) {
        $articles = Data_Check::getCheck($id);
        return $articles;
    }

    public static function delCheck($id) {
        $articles = Data_Check::delCheck($id);
        return $articles;
    }

    public static function updateCheck($id, $name, $address, $city, $mobile) {
        $articles = Data_Check::updateCheck($id, $name, $address, $city, $mobile);
        return $articles;
    }

    public static function getTotal() {
        $total = Data_Check::getTotal();
        return $total;
    }
}
