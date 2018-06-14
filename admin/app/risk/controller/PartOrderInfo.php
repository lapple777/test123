<?php
namespace app\risk\controller;

class PartOrderInfo extends Common{
    public function part_order_info(){
        return $this->fetch('part-order-info');
    }
}