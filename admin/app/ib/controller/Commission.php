<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/8
 * Time: 16:42
 */

namespace app\ib\controller;

//佣金统计
class Commission extends Common{
    public function commision_statistics(){
        return $this->fetch('commission-statistics');
    }
}