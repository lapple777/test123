<?php
namespace app\admin\controller;

//出入金管理
class FundsManagement extends Common{
    public function funds_list(){
        return $this->fetch('funds-list');
    }
}