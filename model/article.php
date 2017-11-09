<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：article.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月04日
*   Description   ：
*/
class Model_Article extends Model_Base {
    public static function addArticle($style = 1, $title = '', $content = '')
    {
        $ret = Data_Article::addArticle($style, $title, $content);
        return $ret;
    }

    /**
     * $format = true 过滤图片，并且将图片单独汇总出来
     */
    public static function getArticles($style, $page, $perPage, $format = false) {
        $ret = array();
        $articles = Data_Article::getArticles($style, $page, $perPage);
        $ret = self::formatArticles($articles, $format);
        
        return $ret;
    }

    public static function formatArticles($articles, $format = false) {
        $ret = array();
        if ( Be_Libs_Tool::be_array($articles) ) {
            foreach ( $articles as $key => &$value ) {
                $atime          = $value['utime'] ? $value['utime'] : $value['ctime'];
                $value['dtime'] = date("Y/m/d", $atime);
                $content = htmlspecialchars_decode($value['content']);
                if ( $format ) {
                    preg_match_all('/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i', $content, $matches);
                    if ( Be_Libs_Tool::be_array($matches[1]) ) 
                        $value['images'] = $matches[1];
                    $value['content']   = preg_replace('#<img.*?>#', '', $content);
                    $value['content']   = preg_replace('#</?p>|<br/>|<br />#', '', $value['content']);
                }
                $ret[] = $value;
            }
        }
        return $ret;
    }

    public static function formateSingleArticle($article) {
        if ( Be_Libs_Tool::be_array($article) ) {
                $atime          = $article['utime'] ? $article['utime'] : $article['ctime'];
                $article['dtime'] = date("Y/m/d", $atime);
                $article['content'] = htmlspecialchars_decode($article['content']);
        }
        return $article;
    }

    public static function getArticle($id) {
        $articles = Data_Article::getArticle($id);
        return $articles;
    }

    public static function getArticleByStyle($style) {
        $articles = self::formateSingleArticle(Data_Article::getArticleByStyle($style));
        return $articles;
    }
    
    public static function getArticlesByST($style, $type, $page =1 , $perPage = 20, $format = false) {
        $ret = array();
        $articles = Data_Article::getArticlesByST($style, $type, $page, $perPage);
        $ret = self::formatArticles($articles, $format);
        return $ret;
    }

    public static function updateArticle($id, $title, $content) {
        $ret = Data_Article::updateArticle($id, $title, $content);
        return $ret;
    }

    public static function getTotal($style) {
        $total = Data_Article::getTotal($style);
        return $total;
    }

    public static function updateArticleStatus($id, $status) {
        if ( !$id ) return false;
        $ret = Data_Article::updateArticleStatus($id, $status);
        return $ret;
    }
}
