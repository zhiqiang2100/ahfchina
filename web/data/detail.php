<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：detail.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年03月08日
*   Description   ：
*/
Class Data_Detail {
    //数据库配置名称
    private static $_db_set     = 'db.ck';
    //失败尝试次数
    private static $_try_times  = 2;
    //字符编码
    private static $_charset    = 'utf8';
    //是否强制跳过初始化
    private static $_forceInit  = false;
    //表名
    private static $_tableName  = 'ck_detail';

    public static function addItem($time, $office, $title, $author, $des) {
        $sql = sprintf("insert into %s (`time`, `office`, `title`, `author`, `des`) values ('%s', '%s', '%s', '%s'', '%s')", self::$_tableName, $time, $office, $title, $author, $des);
        var_dump($sql);exit;
        $ret = self::execute('insert', $sql);
        return $ret;
    }

    public static function getUserSetById($uid) {
        $ret = array();
        if ( (int)$uid <= 0 ) return $ret;
        $sql = sprintf("SELECT `uid` from %s where `id` = %d", 
            self::getTableName($uid), $uid);
        $ret = self::execute('get', $sql);
        if ( is_array($ret) && count($ret) > 0 ) {
            return $ret[0]['uid'];
        } else {
            return 0;
        }
    }

    public static function getAllUsers() {
        $sql = "SELECT count(id) from user_sets";
        $ret = self::execute('get', $sql);
        var_dump($ret);
        if ( is_array($ret) && count($ret) > 0 )
            return $ret;
        else
            return array();
    }

    public static function getMaxUserId() {
        $sql = "SELECT id from user_sets order by id desc limit 1";
        $ret = self::execute('get', $sql);
        var_dump($ret);
        if ( is_array($ret) && count($ret) > 0 )
            return $ret;
        else
            return array();
    }

    /**
     * @param $uid int
     * @param $userSets array
     * @return bool false/true
     * @desc 增加用户的置顶设置
     */
    public static function addUserSets($uid, $userSets) {
        $ret = false;
        if ( (int)$uid <= 0 ) return false;
        $sql = sprintf("insert into %s set `uid` = %d, `sets` = '%s'", 
            self::getTableName($uid), $uid, serialize($userSets));
        $ret = self::execute('insert', $sql);
        if ( $ret == 0 ) 
            $ret = true;
        return $ret;
    }

    /**
     * @param $uid int
     * @param $userSets array 
     * @return bool false/true
     * @desc更新用户设置
     */
    public static function updateUserSets($uid, $userSets) {
        $ret = false;
        if ( (int)$uid <= 0 ) return $ret;
        $sql = sprintf("update %s set `sets` = '%s' where `uid` = %d", 
            self::getTableName($uid), serialize($userSets), $uid);
        $ret = self::execute('insert', $sql);
        if ( $ret == 0 ) 
            $ret = true;
        return $ret;
    }

    /**
     * @param int $uid
     * @return string $uid所在的表名
     * @desc 获取用户uid所在的表名
     */
    private function getTableName($uid) {
        if ( (int)$uid <= 0 ) return '';
        return 'user_sets';
    }

    /**
     * @param $opType string 操作类型
     * @param $sql string 要执行的query语句
     * @return mixed query执行结果
     * @desc 执行query语句
     */
    private function execute($opType, $sql) {
        if ( !$sql ) return false;
        $opType ? $opType : 'get';
        $ret = Be_Pdo::$opType(self::$_db_set, $sql, array(), $forceInit = self::$_forceInit,
            $con = array('trytime' => self::$_try_times, 'char' => self::$_charset));
        return $ret;
    }
}
