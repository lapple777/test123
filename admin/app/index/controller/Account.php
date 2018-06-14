<?php
//namespace app\index\controller;
//
//use app\index\model\User;
//
//class Account extends Common{
//    private $user;
//    public function __construct(){
//        parent::__construct();
//        $this->user = new User();
//    }
//
//    public function account(){
//        $where = [
//            'username'=>session('username')
//        ];
//        $result = $this->user->where($where)->find();
//
//        $data = [
//            'user'=>$result
//        ];
//
//        $this->assign($data);
//        return $this->fetch('index/account');
//    }
//}