<?php
namespace app\index\controller;
use app\index\model\TraderUser;
use app\index\model\User;
use think\Db;
use app\index\model\TraderOrder;
use app\index\model\Config;
class Index extends Common
{
    private $user;
    private $trader;
    private $order;
    private $config;
    public function __construct(){
        parent::__construct();
        $this->trader = new TraderUser();
        $this->user = new User();
        $this->order = new TraderOrder();
        $this->config = new Config();
    }

    public function index(){
        $fields = [
            'u.id uid','t.id tid','username','name','t.add_time','id_card','email','address','male','birthday','account','user_id','t.wallet','ta_status'
        ];
        $where = [
            'account'=>session('username')
        ];
        $result = Db::name('user')
            ->alias('u')
            ->join('trading_account t','u.id=t.user_id','right')
            ->field($fields)
            ->where($where)
            ->find();
        $orderWhere = [
            'ta_id'=>$result['tid'],
            'order_status'=>0
        ];
        $total_hand = $this->order->where($orderWhere)->sum('lot_num');
        $configRes = $this->config->field('hand_price')->find();
        $price = $total_hand * $configRes['hand_price'];
 //dump($result);die;
        $data = [
            'user'=>$result,
            'onlinePrice'=>$price
        ];

        $this->assign($data);
       return $this->fetch('index/account');
    }
    public function welcome(){
        return $this->fetch('chart/graph_echarts');
    }
}
