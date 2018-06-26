<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/11
 * Time: 14:37
 */

namespace app\ib\controller;

//联系我们
use app\ib\model\Admin;

class Contact extends Common{
    //获取admin信息->让IB进行联系
    private $admin;
    public function __construct(){
        parent::__construct();
        $this->admin = new Admin();
    }
    public function contact_us(){
//        $fields = [
//            'username','phone','email'
//        ];
//        $result = $this->admin->field($fields)->find();
//        $data = [
//            'admin_info'=>$result
//        ];
//        $this->assign($data);
        return $this->fetch('contact-us');
    }
}