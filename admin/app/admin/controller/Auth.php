<?php
namespace app\admin\controller;

//权限管理
class Auth extends Common{
    public function auth_list(){
        return $this->fetch('auth-list');
    }
}