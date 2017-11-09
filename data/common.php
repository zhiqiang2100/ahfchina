<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：Common.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月13日
*   Description   ：公共类
*/
Class Data_Common {
    /**
     * @param $uid int 用户名
     * @return array
     * @desc 获取用户未读邮件书
     */
    public static function unReadMailCounts($uid) {
        $lists  = array();
        if ( (int)$uid <= 0 ) return $lists;

		$api_url    = Be_Config::k('common.api_mail_unread');
        if ( empty($api_url) ) return $lists;
        //获取加密字符串
        $encrypt = Libs_Encrypt::mencrypt($uid);

        $params = array(
            'entry' => $encrypt['entry'],
            'ts'    => $encrypt['ts'],
            's'     => $encrypt['s'],
            'uid'   => $uid,
        );

        $ret_data   = json_decode(Be_Http::get($api_url, $params), true);
        if ( !$ret_data ) {
            $ret_data   = json_decode(Be_Http::get($api_url, $params), true);
        }
        if ( is_array($ret_data) )
            if ( $ret_data['r'] == 0 ) {
                $lists = $ret_data['d'];
            } else 
                return false;
        else
            return false;

        return $lists;
    }
}
