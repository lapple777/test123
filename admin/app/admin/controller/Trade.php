<?php
namespace app\admin\controller;

//订单管理
class Trade extends Common{
    public function online_order(){
        return $this->fetch('online-order');
    }
}