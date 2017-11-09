<?php
/**
*   Copyright (C) 2015 All rights reserved.
*
*   FileName      ：ozoz.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2015年07月20日
*   Description   ：
*/
Class Data_Ozoz {
    //数据库配置名称
    private static $_db_set     = 'db.user';
    //失败尝试次数
    private static $_try_times  = 2;
    //字符编码
    private static $_charset    = 'utf8';
    //是否强制跳过初始化
    private static $_forceInit  = false;
    //表前缀
    CONST PREFIX_TABLE_NAME     = 'user_1010_';


    /**
     * @desc 获取分表信息
     */
    private static function _getTableName($uid) {
        return self::PREFIX_TABLE_NAME . self::_userNumber($uid);
    }

    /**
     * @desc 用户在那个表中 
     */
    private static function _userNumber($uid) {
        return (int)substr($uid, -1);
    }

    /**
     * @desc 获取用户当前的道具信息
     */
    public static function getUserToolsInfo($uid) {
        $ret = array();
        if ( (int)$uid <= 0 ) return $ret;
        $sql = sprintf("SELECT * from %s where `uid` = %d", 
            self::_getTableName($uid), $uid);
        $ret = self::execute('get', $sql);
        if ( is_array($ret) && count($ret) > 0 )
            return $ret[0];
        else
            return array();
    }

    /**
     * @desc 更新当前用户的道具信息,下一次领取道具的信息
     */
    public static function updateNextDay($uid, $toolsInfo) {
        $ret = false;
        if ( (int)$uid <= 0 ) return $ret;
        $info = self::getUserToolsInfo($uid);
        if ( is_array($info) && count($info) > 0 ) {
            $sql = sprintf("update %s set `give_tools` = '%s', `logintime` = '%s' where `uid` = %d", 
                self::_getTableName($uid), serialize($toolsInfo['tools']), time(), $uid);
        } else {
            $sql = sprintf("insert into %s set `uid` = %d, `give_tools` = '%s', `logintime` = '%s', `createtime` = '%s'",
                self::_getTableName($uid), $uid, serialize($toolsInfo['tools']), time(), time());
        }
        $ret = self::execute('insert', $sql);
        if ( $ret == 0 ) 
            $ret = true;
        return $ret;
    }

    /**
     * @desc 领取道具接口
     */
    public static function drawTools($uid, $toolsInfo) {
        if ( (int)$uid <= 0 || count($toolsInfo) <= 0 ) return false;
        $nums = implode('|', $toolsInfo);
        $apiUrl = 'http://i.g.sina.cn/yc/1010/updateProps';
        $params = array(
            'uid'   => $uid,
            'nums'  => $nums,
            );
        $ret_data = json_decode(Be_Http::post($apiUrl, $params), true);
        if ( $ret_data['status'] == 0 )
            return true;
        else
            return false;
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
