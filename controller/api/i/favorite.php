<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：favorite.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月12日
*   Description   ：收藏内网api接口
*/
Class Controller_Api_I_Favorite {
    private $_param  = array();
    private $_lists  = array(); 
    private $_data   = array(); 
    
    public function run() {
        $this->getParam();
        $ret = $this->main();
        self::outPut($ret);
    }


    /**
     * 获取uri中的参数
     */
    private function getParam() {
        //$type 1:文章 2:图片
        $this->_param['type']   = (int)Be_Data::param('type', 1); 
        //收藏动作 string 'add'：添加 'isFav'：是否收藏
        $this->_param['op']     = Be_Data::param('op', 'add');
        //文章或者图片的id
        $this->_param['docid']  = htmlspecialchars(Be_Data::param('docid', ''));
        $this->_param['uid']    = ( (int)Be_Data::param('uid', 0)  > 0 ) ? (int)Be_Data::param('uid', 0) : Model_Common::getUserId();
        $this->_param['backurl']= htmlspecialchars(Be_Data::param('backurl', ''));
        $this->_param['callback'] = htmlspecialchars(Be_Data::param('jsoncallback', 'jsonp_func'));
        if ( !Model_Favorite::checkAll($this->_param['docid']) ) {
            $ret = array(
                'code'  => 0,
                'msg'   => '参数有误',
            );
            self::outPut($ret);
        }
        if ( !$this->_param['docid'] || !self::checkOp() ) {
            $ret = array(
                'code'  => 0,
                'msg'   => '参数错误',
            );
            self::outPut($ret);
        }
        $this->_param['docid'] = 'http://doc.sina.cn/?id=' . $this->_param['docid'];
    }

    /**
     * 收藏主函数
     */
    private function main() {
        switch ( $this->_param['op'] ) {
        case 'add':
            if ( !$this->_param['uid'] ) {
                $loginUrl = Be_Libs_Login::loginUrl('进入详情页收藏', $this->_param['backurl'], true);
                $loginUrl = html_entity_decode($loginUrl);
                $ret = array(
                    'code'  => 2,
                    'msg'   => '未登录',
                    'data'  => $loginUrl,
                );
                self::outPut($ret);
            }
            $result = Model_Favorite::addFavorite($this->_param['uid'], $this->_param['docid'], $this->_param['type']);
            if ( $result ) {
                $ret = array(
                    'code'  => 1,
                    'msg'   => 'succss',
                    'data'  => $result,
                );
            } else {
                $ret = array(
                    'code'  => 0,
                    'msg'   => 'failed',
                    'data'  => '',
                );
            }
            break;
        case 'isFav':
            if ( !$this->_param['uid'] ) {
                $ret = array(
                    'code'  => 1,
                    'msg'   => 'succss',
                    'data'  => false,
                );
            }
            $result = Model_Favorite::isFavorite($this->_param['uid'], $this->_param['docid'], $this->_param['type']);
            $ret = array(
                'code'  => 1,
                'msg'   => 'succss',
                'data'  => $result,
            );
            break;
        }
        return $ret;
    }
    
    private function outPut($ret) {
        echo $this->_param['callback'] . '(' .json_encode($ret) . ')';
        exit;
    }

    private function checkOp() {
        return in_array($this->_param['op'], array('add', 'isFav'));
    }

}
