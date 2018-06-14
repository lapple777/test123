<?php
namespace app\risk\controller;

class TradeOrder extends Common{
    public function order_list(){
        return $this->fetch('order-list');
    }
}