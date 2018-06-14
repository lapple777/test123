<?php
namespace app\admin\controller;

class Account extends Common{
    public function account_info(){
        return $this->fetch('account-info');
    }
    public function account_case(){
        return $this->fetch('account-case');
    }
}