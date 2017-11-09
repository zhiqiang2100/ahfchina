<?php
/**
*   Copyright (C) 2015 All rights reserved.
*
*   FileName      ：ozoz.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2015年07月08日
*   Description   ：1010
*/
class Model_Ozoz {
    //第一天可以领取1个刷新道具，0个炸弹
    private static $initTools   = array(2, 0);
    CONST USER_1010_TOOLS_KEY   = 'user_1010_tools_';

    /**
     * @param $uid int 当前用户id
     * @access public
     * @return array
     * @desc 获取当前用户赠送道具信息 
     */
    public static function getUserToolsInfo($uid) {
        $toolsInfo = $info = array();
        if ( (int)$uid <= 0 ) {
            return array(
                'tools'     => self::$initTools,
                'drawTools' => false,
            );
        }
        $cache_key = self::USER_1010_TOOLS_KEY . $uid;
        $info  = Be_Mc::get('mc.default', $cache_key);
        if ( $_GET['debug'] )
            var_dump($info);
        if ( !$info || Model_Common::isRefresh() ) {
            $info = Data_Ozoz::getUserToolsInfo($uid);
            //var_dump(unserialize($info['give_tools']));
            if ( !Be_Libs_Tool::be_array($info) ) {
                $toolsInfo['tools']     = self::$initTools;
                $toolsInfo['drawTools'] = false;
                return $toolsInfo;
            } 
        }
        Be_Mc::set('mc.default',$cache_key, $info, 86400);
        //是否领取过道具
        $toolsInfo['drawTools'] = self::isDrawTools($info);
        //是否重新开始
        if ( self::resetTools($info) )
            $toolsInfo['tools'] = self::$initTools;
        else
            $toolsInfo['tools'] = unserialize($info['give_tools']);
        return $toolsInfo;
    }

    /**
     * @desc 用户领取道具的行为
     */
    public static function drawTools($uid) {
        $toolsInfo = self::getUserToolsInfo($uid);
        //如果已经领取过了
        if ( $toolsInfo['drawTools'] )
            $ret = false;
        else {
            //调用道具领取接口
            $drawResult = Data_Ozoz::drawTools($uid, $toolsInfo['tools']);
            if ( $drawResult ) {
                $newTool[0] = $toolsInfo['tools'][0] + 2;
                if ( (int)$toolsInfo['tools'][0] == 12 ) {
                    $newTool[1] = 1;
                } else {
                    $newTool[1] = 0;
                }
                if ( (int)$toolsInfo['tools'][0] == 14 ) {
                    $newTool[0] = self::$initTools;
                }
                $toolsInfo['tools'] = $newTool;
                //更新数据库
                $ret = Data_Ozoz::updateNextDay($uid, $toolsInfo);
                //删除缓存数据
                $cache_key = self::USER_1010_TOOLS_KEY . $uid;
                Be_Mc::del('mc.default', $cache_key);
            }
        }
        return array(
            'result' => $ret,
            'tools'  => $newTool,
            );
    }

    /**
     * @desc 是否重新开始算时间
     */
    private static function resetTools($info) {
        if ( $info['logintime'] > 0 ) 
            return ( self::currentTime() - $info['logintime'] ) > 86400;
        else//说明没有记录
            return true;
    }

    /**
     * @desc 当前用户是否领取过道具
     */
    private static function isDrawTools($info) {
        $drawTools = false;
        if ( $info['logintime'] > 0 ) {
            $drawDay = date("Y-m-d", $info['logintime']);
            $expireTime = strtotime($drawDay . ' 23:59:59');
            if ( (self::currentTime() - $expireTime)  <= 0 )//未过期
                $drawTools = true;
        }
        return $drawTools;
    }

    /**
     * @desc 获取当前时间
     */
    private static function currentTime() {
        return time();
    }
}
