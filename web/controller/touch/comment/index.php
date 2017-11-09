<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：index.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月10日
*   Description   ：评论中心入口，我的评论列表
*/
Class Controller_Touch_Comment_Index extends Controller_Touch_Base{
    protected $_tpl     = 'touch/comment/index.php';
    private $_param     = array();
    private $_lists     = array(); 
    private $_fav_lists = array(); 
    protected $_data    = array(); 
    
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
        $this->_param['type']   = Be_Data::param('type', 1); 
        //action动作类型
        $this->_param['action'] = Be_Data::param('action', 'my');
    }

    /**
     * 收藏主函数
     */
    private function main() {
        //$this->_data['uid'] = '5436613282';
        //$this->_data['uid'] = '2570336921';

        //评论
        $this->_lists   = Model_Comment::getMyCommentLists($this->_data['uid'], $this->_param['action'], $this->_param['type']);
        //计算是否要加载更多
        if ( is_array($this->_lists['cmntlist']) && !empty($this->_lists['cmntlist']) ) 
            $this->_data['isend']       = false;
        else
            $this->_data['isend']       = true;

        $cmnt_counts    = $this->_lists['usercount'];
        $userCounts = array(
            'l_reply'   => $cmnt_counts['l_reply'],//评论我的
            'l_count'   => $cmnt_counts['l_count'],//我评论的
            't_count'   => $cmnt_counts['l_reply'] + $cmnt_counts['l_count'],//评论总数

        );
        $this->_data['userCounts']  = $userCounts;
        //防攻击
        $genData = Be_Libs_Safe_Csrf::genData(Be_Config::k('personal.csrf_code_key'), $this->_data['uid']);
        $this->_data['csrfcode']    = $genData['csrfcode'];
        $this->_data['ctime']       = $genData['csrftime'];
        if ( !$this->_data['isend'] ) 
            $this->_data['dataUrl'] = Model_Common::getHostUrl() . '/aj/comment?op=lists&action='.$this->_param['action'].'&csrfcode='.$genData['csrfcode'].'&csrftime='.$genData['csrftime'];
        $this->_data['genData']     = $genData;
    }

    /**
     * 给view层赋值
     */
    private function setParam() {
        $this->_data['type']        = $this->_param['type'];
        $this->_data['cmnt_lists']  = $this->_lists;
        $this->_data['action']      = $this->_param['action'];
    }
}
