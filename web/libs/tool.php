<?php
/*
 * @fileName: tool.php
 * @author  : 陈瀚禧
 * @mail    : hanxi@sina.staff.com.cn
 * @date    : 2013-08-26
 * @description:
 * 自选股业务层
 */
class Libs_Tool {

    public static function isWap() {
        return UA == 'wap' || $_GET['debug'] == 1;
    }
    /**
     * @param $time mixed 要格式化的时间，时间戳或者timeStamp
     * @param $timeStamp 传递的时间的类型，时间戳还是timeStamp default timeStamp
     * @param $format 格式化后的方式,1:收藏列表使用 2评论列表使用
     * @param desc 格式化时间
     * @return string 格式化好的时间
     */
    public static function formatTime($time, $timeStamp = true, $format = 1) {
        if ( $timeStamp )
            $time = strtotime($time);
        $now = time();
        $char = $now - $time;
        if ( $char < 60 )
            return $char . '秒前';
        else if ( $char < 3600 )
            return ceil($char/60) . '分钟前';
        else if ( $char < (24 * 60 * 60) )
            return date('今天H:i', $time);
        else 
            return date('Y月m日d H:i', $time);
    }

    /**
     * 格式化时间，评论列表使用
     */
    public static function getTimeReduce($timestamp, $t = true){
        if ( $t )
            $timestamp = strtotime($timestamp);
        $now        = time();
        $minutes = 60;
        $hour = 3600;
        $day = 3600*24;
        $month = $day*31;
        $year = $day*365;

        $time_reduce = $now - $timestamp;
        if($time_reduce < 1){
            $time_reduce = 1;
        }

        if($time_reduce > 0){
            $suffix = '前';
        }else{
            $suffix = '后';
        }
        if($time_reduce > $year){
            $result = floor($time_reduce/$year).'年';
        }elseif($time_reduce > $month){
            $result = floor($time_reduce/$month).'个月';
        }elseif($time_reduce > $day){
            $result = floor($time_reduce/$day).'天';
        }elseif($time_reduce > $hour){
            $result = floor($time_reduce/$hour).'小时';
        }elseif($time_reduce > $minutes){
            $result = floor($time_reduce/$minutes).'分钟';
        }else{
            $result = $time_reduce.'秒';
        }
        return $result.$suffix;
    }

    /**
     * 获取评论列表中的用户昵称
     */
    public static function getUserNick($cmnt) {
        $nick = '';
        if ( $cmnt['config'] ) {
            $config = $cmnt['config'];
            preg_match('/wb_screen_name\=([^&].+)/', $config, $matches);
            if ( is_array($matches) && $matches[1] ) {
                $unames = $matches[1];
                $nick   = substr($unames, 0, strpos($unames, '&'));
            } else {
                $nick = $cmnt['nick'];
            }
        } else 
            $nick = $cmnt['nick'];

        if ( $nick == '' ) 
            $nick = '手机用户';
        $nick = $nick;
        return $nick;
    }

    /**
     * 获取评论中用户的头像
     */
    public static function getUserImage($cmnt) {
        $profile_image_url = '';
        if ( $cmnt['config'] ) {
            $config = $cmnt['config'];
            preg_match('/wb_profile_img\=([^&].+)/', $config, $matches);
            if ( is_array($matches) && $matches[1] ) {
                $profile_image_url = urldecode($matches[1]);
            } else {
                $uinfo = Be_Libs_Sns_Weibo_Tauth::getUserInfoByUid($cmnt['uid']);
                $profile_image_url = $uinfo['profile_image_url'];
            }
        } else {
            $uinfo = Be_Libs_Sns_Weibo_Tauth::getUserInfoByUid($cmnt['uid']);
            $profile_image_url = $uinfo['profile_image_url'];
        }

        return $profile_image_url;
    }

    /**
     * @desc 获取业务的主域名地址
     */
    public static function getHostUrl() {
        $hostUrl = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : Be_Config::k('common.host_url');
        return 'http://'.$hostUrl;
    }

    /*
     * 功 能：调试
     * 参 数：$echo,$type(echo print_r var_dump)
     * 返 回：
     */
    public static function debug($echo,$type,$exit=false) {
        if($_GET['debug'] == 'dodebug')
        {
            switch($type)
            {
            case 'echo':
                echo $echo;
                break;
            case 'print_r':
                print_r($echo);
                break;
            case 'var_dump':
                var_dump($echo);
                break;
            }
            if($exit)
            {
                exit;
            }
        }
    }

    /*
     * 页面跳转
     */
    public static function redirect($vt, $msg, $redirectURL, $time=5, $backLink='') {
        switch ($vt) {
        case 1:
            $url = 'simple/redirect.php';
            break;
        case 3:
            $url = '3g/redirect.php';
            break;
        default:
            $url = 'touch/redirect.php';
            break;
        }
        $param['vt'] = $vt;
        $param['msg'] = $msg;
        $param['refresh'] = $time . ';URL=' . $redirectURL;
        $param['redirectUrl'] = $redirectURL;
        $param['backLink'] = $backLink;
        $view = new Be_View();
        $view->display($url, $param);
        exit;
    }
    
    /**
     * 生产刷新代码
     */
    public static function createRefresh() {

        $refresh_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $pathInfo = parse_url($refresh_url);
        $timer = Be_Data::param('timer')?Be_Data::param('timer'):0;
        parse_str($pathInfo['query'],$params);
        $params['timer'] = $timer;
        $query = http_build_query($params);
        $url  = $pathInfo['scheme'].'://'.$pathInfo['host'].$pathInfo['path'].'?'.$query;
        $refresh_html = $timer . ';URL=' . $url;
        if($timer>0){
            return $refresh_html;
        }else{
            return '';
        }
    }

    /**
     * 判断用户是否是访客用户
     */
    public static function isVisitor($ustatus = NULL) {
        return false;
    }

    public function treateUrl($url) {
        return substr($url, 0, -1) . '4';
    }

    public static function getPubFrom($config) {
        $str = '';
        if ( strpos($config, 'from=ucweb') )
            $str = '来自<a href="http://sina.cn/redirect.php?pid=760" style="color:#5494EA">UC浏览器</a>';
        if ( strpos($config, 'from=qqweb') )
            $str = '来自<a href="http://sina.cn/redirect.php?pid=761" style="color:#5494EA">QQ浏览器</a>';
        return $str;
    }
}

