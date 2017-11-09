<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：hd.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年05月20日
*   Description   ：
*/
class Model_Hd {

    /**
     * @desc 获取当前用户的活动信息
     */
    public static function getUinfo($uid) {
        return Data_Hd::getUinfo($uid);
    }

    /**
     * @desc 获取当前用户的活动信息
     */
    public static function postAddress($uid,$name,$phone,$code,$address) {
        return Data_Hd::postAddress($uid, $name,$phone,$code,$address );
    }

    /**
     * @desc 获取当前用户中奖信息
     */
    public static function getUserPrizeInfo( $uid , $hdInfo = '' ) {
    	if(empty($hdInfo)){
    		$hdInfo =  self::getUinfo($uid);
    	}
        $all_user_prizes = $hdInfo['all_user_prizes'];
        $user_prize = array();
        if( !empty($all_user_prizes) && is_array($all_user_prizes) ){
            foreach ($all_user_prizes as $key => $users) {
                if( isset( $users[$uid] ) && !empty($users[$uid]) ){
                    $user_prize = $users[$uid];
                    break;
                }
                continue;
            }
        }
        return $user_prize ;
    }

}
