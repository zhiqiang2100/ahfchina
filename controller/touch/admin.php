<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：admin.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年02月26日
*   Description   ：
*/
Class Controller_Touch_Admin {
    protected $_tpl     = 'touch/admin.php';

    public function run() {
        //获取参数
        self::getParam();
        $this->_data['hdInfo']    = $hdInfo;
        Be_View::display($this->_tpl,$this->_data); 
        
    }

        /**
     *  接收参数
     * @author 成凯丽  kaili2@staff.sina.com.cn
     * @return  
     * @since 2013-09-25
     */
    protected function getParam()
    {
        $this->type  = htmlspecialchars(Be_Data::param('type','',true));
    }

    /**
     * @access private
     * @return mixed
     * @desc 初始化用户信息
     */
    private function initUserInfo() {
        $uid = Model_Common::getUserId();
        $this->_data['userInfo']    = Be_Libs_Sns_Weibo_Tauth::getUserInfoByUid($uid);
        $this->_data['uid'] = $uid;
    }
    
}
