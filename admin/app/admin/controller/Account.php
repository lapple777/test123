<?php
namespace app\admin\controller;
use app\admin\model\AdminUser;
class Account extends Common{
    private $adminUser;
    public function __construct()
    {
        parent::__construct();
        $this->adminUser = new AdminUser();
    }

    public function account_info(){
        $where = [
            'username'=>session('adminUser')
        ];
        $res = $this->adminUser->where($where)->find();
        $data = [
            'adminUser'=>$res
        ];
        $this->assign($data);
        return $this->fetch('account-info');
    }
    public function account_case(){
        return $this->fetch('account-case');
    }
}