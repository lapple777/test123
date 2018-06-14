<?php
namespace app\admin\controller;

//管理员管理
class Admin extends Common{
    public function admin_list(){
        return $this->fetch('admin-list');
    }
}