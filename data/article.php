<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：article.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月04日
*   Description   ：
*/
class Data_Article extends Data_Base
{

    public static function addArticle($style = 1, $title, $content = '') {
        $sql = "insert into `article` set `style` = ?, `title` = ?, `content` = ?, `ctime` = ?";
        $res = self::dbInsert(self::$db, $sql, array($style, $title, $content, time()));
        return $res;
    }

    public static function getArticles($style, $page = 1, $perPage = 20) {
        if ( !$style ) $style = 1;
        $offset = ( $page - 1) * $perPage;
        $sql = sprintf("select * from `article` where `style` = %d and status = 0 order by id desc limit %d,%d", $style, $offset, $perPage);
        $res = self::dbGet(self::$db, $sql);
        return $res;
    }

    public static function getArticlesByST($style, $type, $page = 1, $perPage = 20) {
        if ( !$style ) $style = 1;
        $offset = ( $page - 1) * $perPage;
        $sql = sprintf("select * from `article` where `style` = %d and `type` = %d and status = 0 order by id desc limit %d,%d", $style, $type, $offset, $perPage);
        $res = self::dbGet(self::$db, $sql);
        return $res;
    }

    public static function getArticle($id) {
        $sql = "select * from `article` where `id` = ?";
        $res = self::dbGet(self::$db, $sql, array($id));
        return $res[0];
    }

    public static function getArticleByStyle($style) {
        $sql = sprintf("select * from `article` where `style` = %d order by id desc limit 1", $style);
        $res = self::dbGet(self::$db, $sql);
        return $res[0];
    }

    public static function updateArticle($id, $title, $content) {
        $sql = "update `article` set `title` = ?, `content` = ?, `utime` = ? where `id` = ?";
        $res = self::dbInsert(self::$db, $sql, array($title, $content, time(), $id));
        return $res;
    }

    public static function getTotal($style) {
        $sql = "select count(*) as num from `article` where `style` = ?";
        $res = self::dbGet(self::$db, $sql, array($style));
        if ( Be_Libs_Tool::be_array($res) ) {
            return $res[0]['num'];
        } else 
            return 0;
    }

    public static function updateArticleStatus($id, $status) {
        $sql = "update `article` set `status` = ?, `utime` = ? where `id` = ?";
        $res = self::dbInsert(self::$db, $sql, array($status, time(), $id));
        return $res;
    }

}
