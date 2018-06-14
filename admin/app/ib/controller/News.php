<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/11
 * Time: 14:39
 */

namespace app\ib\controller;

//新闻通知
class News extends Common{
    public function news_notice(){
        return $this->fetch('news-notice');
    }
}