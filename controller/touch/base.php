<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：base.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年08月05日
*   Description   ：
*/
Class Controller_Touch_Base {
    protected $_tpl     = '';
    protected $_data    = array(); 
    //当前用户uid
    protected $_uid     = '';
    //当前用户是否是访客
    //登录提示文案
    protected $LogText  = '';
    //是否获取用户详情信息
    private $_detail    = false;
    

    public function __construct() {
        session_start();
        if ( $_SERVER['HTTP_REFERER'] && 
            strpos($_SERVER['HTTP_REFERER'], Model_Common::getHostUrl()) === false ) { 
            $_SESSION['relocation'] = $_SERVER['HTTP_REFERER'];
        }
    }

    /**
     * @desc 用户是否真实登录
     */
    protected function realLogin() {
        return Model_Common::getUserId() > 0;
    }

}
