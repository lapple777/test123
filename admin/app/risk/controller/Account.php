<?php
namespace app\risk\controller;

class Account extends Common{
    public function account_info(){
        return $this->fetch('account-info');
    }
}