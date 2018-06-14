<?php
namespace app\treasurer\controller;


class Finance extends Common{
    public function finance_info(){
        return $this->fetch('finance-info');
    }
}