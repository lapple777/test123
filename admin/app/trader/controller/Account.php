<?php
namespace app\trader\controller;

use app\trader\model\User;

class Account extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }

    //账户信息
    public function account_info(){
        $where = [
            'id'=>session('traderId')
        ];
        $fields = [
            'id','wallet','username','name','phone','email',
            'id_card','bank_card','add_time'
        ];
        $res = $this->user->field($fields)->where($where)->find();
        $data = [
            'account'=>$res
        ];
        $this->assign($data);
        return $this->fetch('account-info');
    }
    public function account_case(){
        return $this->fetch('account-case');
    }
}