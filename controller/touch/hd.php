<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：hd.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年05月20日
*   Description   ：活动页
*/
Class Controller_Touch_Hd {
    protected $_tpl     = 'touch/hd/index.php';
    protected $_listtpl     = 'touch/hd/cyclelist.php';
    private $_data      = array(); 
    private static $_apps = array();
    private $type      = '';

    public function run() {
        //获取参数
        self::getParam();
        Model_Common::needLogin('周三大奖从天而降活动');
        self::initUserInfo();
        $hdInfo = Model_Hd::getUinfo($this->_data['uid']);
        $this->_data['hdInfo']    = $hdInfo;
        if($this->type == 'cyclelist')
        {
            Be_View::display($this->_listtpl,$this->_data);
        }else if($this->type == 'modify')
        {
            $this->_data['type']= $this->type; 
            Be_View::display($this->_tpl,$this->_data);
        }else
        {
            //用户中奖信息
            $this->_data['user_prize'] = Model_Hd::getUserPrizeInfo( $this->_data['uid'], $hdInfo) ;
            Be_View::display($this->_tpl,$this->_data);  
        }
        
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
