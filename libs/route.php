<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：router.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年02月26日
*   Description   ：
*/
class Libs_route extends Be_Libs_Newmroute
{

    static $_class_name='';
        
    public static function getClassName(){
        if (self::$_class_name != '') return self::$_class_name;

        if (IS_CLI){
            if (!isset($GLOBALS['argv'][1])){
                throw new Be_Exception('cli mode arv 1 not set');//@todo add exception code
            }
            $pathInfo = str_replace('_', '/', $GLOBALS['argv'][1]);
            $dir_str = '';
        } else {
            $pathInfo = self::detect_pathInfo();
            $dir_str = 'Controller_';
            $pathInfo_tmp = ltrim($pathInfo, '/.');
        }
        $pathInfo = ltrim($pathInfo, '/.');
        $tmp = explode("/", $pathInfo);
        $tmp = array_map("ucfirst", $tmp);
        $controller_class = $dir_str. implode("_", $tmp);
        if (substr($controller_class, -1) == '_') $controller_class = $controller_class. 'Index';

        if (stripos($controller_class, APP_NAME)) {
            $controller_class = str_replace(ucfirst(APP_NAME) . "_", '', $controller_class);
        }
        return $controller_class;
    }
}
