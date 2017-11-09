<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：pic.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月03日
*   Description   ：
*/
class Data_Pic extends Data_Base {

    public static function updatePic($filePath, $pos, $type = 0) {
        $sql = sprintf("select * from `picture` where `pos` = %d and `type` = %d", $pos, $type);
        $res = self::dbGet(self::$db, $sql);
        if  ( Be_Libs_Tool::be_array($res) && Be_Libs_Tool::be_array($res[0]) ) {
            $id = $res[0]['id'];
            $sql = sprintf("update `picture` set `url` = '%s', `pos` = %d, `type` = %d, `ctime` = %d where `id` = %d", $filePath, $pos, $type, time(), $id);
        } else {
            $sql = sprintf("insert into `picture` set `url` = '%s', `pos` = %d, `type` = %d, `ctime` = %d", $filePath, $pos, $type, time());
        }
        $res = self::dbInsert(self::$db, $sql, array());
        return $res;
    }

    public static function getPicList($type) {
        $sql = sprintf("select * from `picture` where `type` = %d order by pos asc", $type);
        $res = self::dbGet(self::$db, $sql);
        return $res;
    }

    public static function delPic($id) {
        $sql = sprintf("delete from `picture` where `id` = %d", $id);
        $res = self::dbInsert(self::$db, $sql, array());
        return $res;
    }

}
