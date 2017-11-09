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
class Data_Check extends Data_Base {

    public static function addCheck($name, $address, $city, $mobile) {
        $sql = "insert into `checks` set `name` = ?, `address` = ?, `city` = ?, `mobile` = ?, `ctime` = ?";
        $res = self::dbInsert(self::$db, $sql, array($name, $address, $city, $mobile, time()));
        return $res;
    }

    public static function getChecks() {
        $sql = sprintf("select * from `checks` order by id asc");
        $res = self::dbGet(self::$db, $sql);
        return $res;
    }

    public static function getChecksByCity($city) {
        $sql = sprintf("select * from `checks` where `city` = %d", $city);
        $res = self::dbGet(self::$db, $sql);
        return $res;
    }

    public static function getCheckByCity($city) {
        $sql = sprintf("select * from `checks` where `city` = %d order by id desc limit 1 ", $city);
        $res = self::dbGet(self::$db, $sql);
        return $res;
    }

    public static function getCheck($id) {
        $sql = "select * from `checks` where `id` = ?";
        $res = self::dbGet(self::$db, $sql, array($id));
        return $res[0];
    }

    public static function delCheck($id) {
        $sql = "delete from `checks` where `id` = ?";
        $res = self::dbInsert(self::$db, $sql, array($id));
        return $res[0];
    }

    public static function updateCheck($id, $name, $address, $city, $mobile) {
        $sql = "update `checks` set `name` = ?, `address` = ?, `city` = ?, `mobile` = ? where `id` = ?";
        $res = self::dbInsert(self::$db, $sql, array($name, $address, $city, $mobile, $id));
        return $res;
    }

    public static function getTotal() {
        $sql = "select count(*) as num from `checks`";
        $res = self::dbGet(self::$db, $sql, array());
        if ( Be_Libs_Tool::be_array($res) ) {
            return $res[0]['num'];
        } else 
            return 0;
    }

}
