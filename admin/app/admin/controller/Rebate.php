<?php
namespace app\admin\controller;
//返佣管理
class Rebate extends Common{
    //返佣列表
    public function rebate_list(){

        return $this->fetch('rebate-list');
    }
}