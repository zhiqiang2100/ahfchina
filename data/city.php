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
Class Data_City extends Data_Base {

    public static function addCity($name, $cname, $weight) {
        $sql = "insert into `city` set `name` = ?, `cname` = ?, `weight` = ?, `ctime` = ?";
        $res = self::dbInsert(self::$db, $sql, array($name, $cname, $weight, time()));
        return $res;
    }

    public static function getCitys($page = 1, $perPage = 20) {
        if ( !$style ) $style = 1;
        $offset = ( $page - 1) * $perPage;
        $sql = sprintf("select * from `city` order by id desc limit %d,%d", $offset, $perPage);
        $res = self::dbGet(self::$db, $sql);
        return $res;
    }

    public static function getIndexCity() {
        $sql = sprintf("select * from `city` order by `weight` desc, `ctime` desc limit 3");
        $res = self::dbGet(self::$db, $sql);
        return $res;
    }

    public static function getCity($id) {
        $sql = "select * from `city` where `id` = ?";
        $res = self::dbGet(self::$db, $sql, array($id));
        return $res[0];
    }

    public static function delCity($id) {
        $sql = "delete from `city` where `id` = ?";
        $res = self::dbInsert(self::$db, $sql, array($id));
        return $res[0];
    }

    public static function updateCity($id, $name, $cname, $weight) {
        $sql = "update `city` set `name` = ?, `cname` = ?, `weight` = ? where `id` = ?";
        $res = self::dbInsert(self::$db, $sql, array($name, $cname, $weight, $id));
        return $res;
    }

    public static function getTotal($style) {
        $sql = "select count(*) as num from `city`";
        $res = self::dbGet(self::$db, $sql, array());
        if ( Be_Libs_Tool::be_array($res) ) {
            return $res[0]['num'];
        } else 
            return 0;
    }

}
