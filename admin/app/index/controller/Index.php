<?php
namespace app\index\controller;
use app\index\model\TraderUser;
use app\index\model\User;
use think\Db;
class Index extends Common
{
    private $user;
    private $trader;
    public function __construct(){
        parent::__construct();
        $this->trader = new TraderUser();
        $this->user = new User();
    }

    public function index(){
        $fields = [
            'u.id uid','t.id tid','name','t.add_time','id_card','email','address','male','birthday','account','user_id','t.wallet','ta_status'
        ];
        $where = [
            'account'=>session('username')
        ];

        $result = Db::name('user')
            ->alias('u')
            ->join('trading_account t','u.id=t.user_id')
            ->field($fields)
            ->where($where)
            ->find();
// dump($result);die;
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
