<?php
namespace app\admin\controller;

//下单员管理
class PartOrderUser extends Common{
    public function part_order_list(){
        return $this->fetch('part-order-list');
    }
}