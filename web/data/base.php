<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：base.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月03日
*   Description   ：
*/
class Data_Base
{
    public static $db = "db.ahfchina";
    /**
     * 获取接口数据
     */
    protected function httpGet($url, $params=array(), $method='GET', $option=array(), $trytime=3)
    {
        $header      = isset($option['header']) ? $option['header'] : array();
        $return_type = isset($option['return_type']) ? $option['return_type'] : 0;

        $fun = strtoupper($method) === 'POST' ? 'post' : 'get';
        for ($i = 0; $i < $trytime; $i++) {
            $res = Be_Http::$fun($url, $params, array(), array(
                'con_timeout'  => 5,
                'read_timeout' => 5, 
                'header'       => $header,
                'returnType'   => $return_type,
            ));
            if ($res === false) {
                continue;
            } else {
                return $res;
            }
        }
        return false;
    }

    /**
     * 插入
     */
    public function dbInsert($alias, $sql, $data=array())
    {
        return Be_Pdo::insert($alias, $sql, $data, FALSE, array('trytime' => 2));
    }

    /**
     * 更新
     */
    public function dbUpdate($alias, $sql, $data=array())
    {
        return Be_Pdo::update($alias, $sql, $data, FALSE, array('trytime' => 2));
    }

    /**
     * 查找
     */
    public function dbGet($alias, $sql, $data=array())
    {
        return Be_Pdo::get($alias, $sql, $data, FALSE, array('trytime' => 2));
    }

    /**
     * 删除
     */
    public function dbDelete($alias, $sql, $data=array())
    {
        return Be_Pdo::delete($alias, $sql, $data, FALSE, array('trytime' => 2));
    }
}
