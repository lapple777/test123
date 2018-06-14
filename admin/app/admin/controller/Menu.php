<?php
namespace app\admin\controller;
//菜单管理
class Menu extends Common{
    public function menu_list(){
        return $this->fetch('menu-list');
    }
}