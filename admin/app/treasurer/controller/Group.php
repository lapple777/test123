<?php
namespace app\treasurer\controller;


class Group extends Common{
    public function award(){
        return $this->fetch('award-list');
    }
}