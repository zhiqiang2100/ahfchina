<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：comment.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月14日
*   Description   ：评论相关ajax交互接口
*/
class Controller_Aj_Comment {
    protected $_tpl     = 'touch/comment/ajindex.php';
    private $_data  = array(); 
    
    public function run() {
        $op     = Be_Data::param('op', 'agree');
        $type   = Be_Data::param('type', 1);
        $uid    = Model_Common::getUserId();
        if ( !Be_Libs_Safe_Csrf::checkAll(Be_Config::k('personal.csrf_code_key'), $uid) ) {
            $ret = array(
                'code'    => 0,
                'msg'   => '异常操作',
            );
        }
        if ( (int)$uid <= 0 ) {
            $ret = array(
                'code'    => 0,
                'msg'   => '用户未登录',
            );
        }
        switch ( $op ) {
        case 'agree':
            $newsid     = Be_Data::form('newsid', '');
            $channel    = Be_Data::form('channel', '');
            $mid        = Be_Data::form('mid', '');
            $result     = Model_Comment::newsAgree($newsid, $mid, $channel);

            if ( $result ) {
                $ret = array(
                    'code'  => 1,
                    'msg'   => 'success',
                );
            } else
                $ret = array(
                    'code'  => 0,
                    'msg'   => '收藏取消失败',
                );
        break;
        case 'cmnt':
            $newsid     = Be_Data::form('newsid', '');
            $channel    = Be_Data::form('channel', '');
            $content    = Be_Libs_String::filterSpeChar(urldecode(Be_Data::form('cmntContent', '')));
            $from       = Be_Data::form('from', 'personal');
            $parent     = Be_Data::form('parent', '');
            $toWb       = Be_Data::form('woWb', '');
            $result     = Model_Comment::addComment($uid, $newsid, $channel, $content, $from, $parent);
            if ( $result ) {
                if ( $toWb ) {
                    $url        = 'http://weather1.sina.cn/';
                    $backurl    = Libs_Tool::getHostUrl();
                    $content    = $content;
                    $shareurl   = Be_Libs_Weibo::buildShareUrl($content, $url, '', $backurl, 0);
                }
                $ret = array(
                    'code'      => 0,
                    'msg'       => '您也发送成功！',
                );
            } else
                $ret = array(
                    'code'      => 1,
                    'msg'       => '发送失败！',
                );
            break;
        case 'lists':
            $page   = Be_Data::param('page', 1);
            $count  = Be_Data::param('count', Data_Comment::PER_PAGE_COUNT);
            //action动作类型
            $action = Be_Data::param('action', 'my');
            $this->_data['action']  = $action;
            $lists  = Model_Comment::getMyCommentLists($uid, $action, $type, $page, $count);
            if ( is_array($lists['cmntlist']) && !empty($lists['cmntlist']) ) {
                $this->_data['cmnt_lists']  = $lists;
                $html = Be_View::render($this->_tpl,$this->_data);
            } else  {
                $html = '';
            }
            $ret = array(
                'code'      => 1,
                'msg'       => 'success',
                'data'      => $html,
            );
        break;
        }

        Be_Libs_Ajax::displayJson($ret);
    }
    
}
