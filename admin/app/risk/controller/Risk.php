<?php
namespace app\risk\controller;


class Risk extends Common{
    public function risk_info(){
        return $this->fetch('risk-info');
    }
}