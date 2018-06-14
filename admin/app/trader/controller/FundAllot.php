<?php
namespace app\trader\controller;

class FundAllot extends Common{
    public function fundAllot(){
        return $this->fetch('fund-allot');
    }
    //资金划入
    public function fund_in(){
        if(request()->isPost()){
            $input = input();
            echo '资金划入';
            var_dump($input);die;
        }
    }
    //资金划出
    public function fund_out(){
        if(request()->isPost()){
            $input = input();
            echo '资金划出';
            var_dump($input);die;
        }
    }
}