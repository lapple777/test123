<?php
namespace app\admin\controller;

//权限组管理
class AuthGroup extends Common{
    public function auth_group_list(){
        return $this->fetch('auth-group-list');
    }
}