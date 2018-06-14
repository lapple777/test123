<?php
namespace app\index\controller;
use app\index\model\TraderUser;
class Index extends Common
{
    private $user;
    public function __construct(){
        parent::__construct();
        $this->user = new TraderUser();
    }

    public function index(){
        $where = [
            'account'=>session('username')
        ];
        $result = $this->user->where($where)->find();

        $data = [
            'user'=>$result
        ];

        $this->assign($data);
       return $this->fetch('index/account');
    }
    public function welcome(){
        return $this->fetch('chart/graph_echarts');
    }
}
