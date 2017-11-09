<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：index.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年02月27日
*   Description   ：个人收藏控制器
*/
Class Controller_Touch_Favorite_Index extends Controller_Touch_Base {
    protected $_tpl         = 'touch/favorite/index.php';
    protected $_param       = array();
    private $_lists         = array(); 
    private $_cmnt_lists    = array(); 
    protected $_data        = array(); 
    
    public function run() {
        $this->getParam();
        $this->main();
        $this->setParam();
        Be_View::display($this->_tpl,$this->_data); 
    }


    /**
     * 获取uri中的参数
     */
    private function getParam() {
        //$type 1:文章 2:图片
        $this->_param['type'] = Be_Data::param('type', 1); 
    }

    /**
     * 收藏主函数
     */
    private function main() {

        //获取收藏和评论
        $this->_lists       = Model_Favorite::getFavoriteLists($this->_data['uid'], $this->_param['type']);

        //是否要显示更多
        if ( is_array($this->_lists) ) {
            if ( count($this->_lists['data']) < Data_Favorite::PER_PAGE_COUNT )
                $this->_data['isend']       = true;
            else {
                if ( $this->_lists['total'] == Data_Favorite::PER_PAGE_COUNT )
                    $this->_data['isend']   = true;
            }
        } else
            $this->_data['isend']       = true;

        //防攻击
        $genData = Be_Libs_Safe_Csrf::genData(Be_Config::k('personal.csrf_code_key'), $this->_data['uid']);
        $this->_data['csrfcode'] = $genData['csrfcode'];
        $this->_data['csrftime'] = $genData['csrftime'];
        if ( !$this->_data['isend'] ) 
            $this->_data['dataUrl'] = Model_Common::getHostUrl() . '/aj/favorite?op=lists&csrfcode='.$genData['csrfcode'].'&csrftime='.$genData['csrftime'];
    }

    /**
     * 给view层赋值
     */
    private function setParam() {
        $this->_data['type']        = $this->_param['type'];
        $this->_data['fav_lists']   = $this->_lists;
        $this->_data['action']      = 'fav';
    }
}
