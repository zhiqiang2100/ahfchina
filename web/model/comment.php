<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：comment.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年03月10日
*   Description   ：评论列表
*/
class Model_Comment {
    /**
     * @param $type int 用来标示是文章类型还是图片类型的收藏列表0:文章 1:图片
     * @param $page int 第几页
     * @param $action string 动作类型
     * @param $count int 每页显示多少条
     * @return array()
     * @desc 获取我的评论列表
     */
    public static function getMyCommentLists($uid, $action = Data_Comment::COMMENT_ACTION_MY,
        $type = Data_Comment::COMMENT_TYPE_ARTICLE,$page = Data_Comment::FIRST_PAGE, 
        $count = Data_Comment::PER_PAGE_COUNT) {
            $ret = array();
            //$cache_key = 'user_cmnt_' . $uid . '_' . $action . '_' . $type . '_' . $page . '_' . $count;
            //$ret = Be_Mc::get('mc.default',$cache_key);
            if ( !$ret )  {
                $commentLists = Data_Comment::getMyCommentLists($uid, $action, $type, $page, $count);
                if ( is_array($commentLists) && !empty($commentLists) ) {
                    foreach ( $commentLists['cmntlist'] as $key => &$value ) {
                        //url互转
                        $weburl     = $commentLists['newsdict'][$value['newsid']]['url'];
                        $urlArr     = Be_Libs_Url::convertUrl($weburl);
                        $webtitle   = $commentLists['newsdict'][$value['newsid']]['title'];
                        $waptitle   = $urlArr['title'] ? $urlArr['title'] : $webtitle;
                        $title              = $waptitle? $waptitle : $value['title'];
                        if  ( strpos($weburl, '.com.cn' ) !== false )
                            $ret['cmntlist'][$key]['url']    = 'http://dp.sina.cn/dpool/cms/jump.php?url='. urlencode($weburl) . '&vt=4';
                        else if ( $urlArr['url'] == '' ) {
                            $ret['cmntlist'][$key]['url'] = $weburl;
                        }
                        $wapurl = $ret['cmntlist'][$key]['url']; 
                        $ret['cmntlist'][$key]['wtitle']  = $title;
                        //组装分享相关的数据
                        $ret['cmntlist'][$key]['content'] = Be_Libs_String::filterSpeChar($value['content']);
                        $url        = $wapurl ? $wapurl : Libs_Tool::getHostUrl() . '/comment/?op=' . $action;
                        $backurl    = Libs_Tool::getHostUrl() . '/comment/?op=' . $action;
                        $shareurl   = Be_Libs_Weibo::buildShareUrl($value['content'], $url, '', $backurl, 0, $title);
                        $ret['cmntlist'][$key]['shareurl'] = $shareurl;
                        //用户头像
                        $ret['cmntlist'][$key]['icon'] = Libs_Tool::getUserImage($value);
                        //用户昵称
                        $ret['cmntlist'][$key]['nick'] = Libs_Tool::getUserNick($value);
                        //评论时间格式化
                        $ret['cmntlist'][$key]['ctime']    = Libs_Tool::getTimeReduce($value['time']);
                        //赞数
                        $ret['cmntlist'][$key]['agree']    = $value['agree'];
                        $ret['cmntlist'][$key]['mid']      = $value['mid'];
                        $ret['cmntlist'][$key]['parent']   = $value['parent'];
                        $ret['cmntlist'][$key]['channel']  = $value['channel'];
                        $ret['cmntlist'][$key]['newsid']   = $value['newsid'];
                        $ret['cmntlist'][$key]['area']     = $value['area'];
                        $ret['cmntlist'][$key]['from']     = Libs_Tool::getPubFrom($value['config']);
                        if ( $ret['cmntlist'][$key]['from'] )
                            $ret['cmntlist'][$key]['area']  = $ret['cmntlist'][$key]['from'];
                    }
                    //处理评论的盖楼信息
                    foreach ( $commentLists['replydict'] as $k => &$v ) {
                        if ( is_array($v) && count($v) > 0 ) {
                            foreach ( $v as $kk => &$vv ) {
                                $ret['replydict'][$k][$kk]['content']   = Be_Libs_String::filterSpeChar($vv['content']);
                                //用户昵称
                                $ret['replydict'][$k][$kk]['nick']      = Libs_Tool::getUserNick($vv);
                                //评论时间格式化
                                $ret['replydict'][$k][$kk]['ctime']     = Libs_Tool::getTimeReduce($vv['time']);
                                //地区
                                $ret['replydict'][$k][$kk]['area']      = $vv['area'];
                                //来自uc或者qq浏览器
                                $ret['replydict'][$k][$kk]['from']      = Libs_Tool::getPubFrom($vv['config']);
                            }
                        }
                    }
                    $ret['usercount'] = $commentLists['usercount'];
                    //Be_Mc::set('mc.default',$cache_key, $ret, 300);
                }
            }
        return $ret;
    }

    /**
     * @param $newsid string 被赞帖子的id
     * @param $mid string 被赞帖子的mid
     * @param $channel string 被赞帖子的渠道来源
     * @return bool true/false
     * @desc 赞操作
     */
    public static function newsAgree($newsid, $mid, $channel) {
        return Data_Comment::newsAgree($newsid, $mid, $channel);
    }

    /**
     * @param $uid int 用户的uid
     * @param $mid string 被回复帖子的mid
     * @param $channel string 被回复帖子的渠道来源
     * @param $content string 回复内容
     * @param $from string 来源
     * @param $parent string 帖子父id
     * @return bool true/false
     * @desc 对帖子进行回复操作
     */
    public static function addComment($uid, $newsid, $channel, $content, $from, $parent) {
        if ( (int)$uid <= 0 ) return false;
        $ret = Data_Comment::addComment($uid, $newsid, $channel, $content, $from, $parent);
        if ( $ret ) {//清理缓存
            $cache_key1 = 'user_cmnt_' . $uid . '_my_1_1_20';
            $cache_key2 = 'user_cmnt_' . $uid . '_rmy_1_1_20';
            Be_Mc::del('mc.default', $cache_key1);
            Be_Mc::del('mc.default', $cache_key2);
        }
        return $ret;
    }

    public static function userCommentCounts($uid) {
        if ( (int)$uid <= 0 ) return array();
        return Data_Comment::userCommentCounts($uid);
    }
}
