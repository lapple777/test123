<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/7
 * Time: 17:17
 */

namespace app\ib\controller;


class Index extends Common{
    public function index(){
        return $this->fetch();
    }
    public  function welcome(){
        return $this->fetch('index-v1');
    }
}