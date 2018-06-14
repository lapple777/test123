<?php
namespace app\admin\controller;

class Config extends Common{
    public function config_info(){
        return $this->fetch('config-info');
    }
}