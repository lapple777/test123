<?php
namespace app\trader\controller;

class Account extends Common{
    //账户信息
    public function account_info(){
        return $this->fetch('account-info');
    }
    public function account_case(){
        return $this->fetch('account-case');
    }
}