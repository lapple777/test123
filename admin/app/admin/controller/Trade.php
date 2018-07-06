<?php
namespace app\admin\controller;

use think\Db;
use app\admin\model\Order;
//订单管理
class Trade extends Common{
    private $order;
    public function __construct(){
        parent::__construct();
        $this->order = new  Order();
    }
    //在场订单
    public function online_order(){
        $fields = [
            'o.id oid','order_id','order_type','order_price','o.add_time oadd_time','ta_id','stop_profit','stop_loss','lot_num',
            'order_status','order_close_time','profit','hand_price','account'
        ];
        $where = [
            'order_status'=>'0'
        ];
       $res = Db::name('order')
           ->alias('o')
           ->join('trading_account t','o.ta_id=t.id')
           ->field($fields)
           ->where($where)
           ->paginate(50);
//        $res = $this->order->field($fields)->where($where)->select();
        $data = [
            'online_order'=>$res
        ];
        $this->assign($data);
        return $this->fetch('online-order');
    }
    //历史订单
    public function history_order(){
        $fields = [
            'o.id oid','order_id','order_type','order_price','o.add_time oadd_time','ta_id','stop_profit','stop_loss','lot_num',
            'order_status','order_close_time','profit','hand_price','account'
        ];
        $where = [
            'order_status'=>'1'
        ];

        $res = Db::name('order')
            ->alias('o')
            ->join('trading_account t','o.ta_id=t.id')
            ->field($fields)
            ->where($where)
            ->select();
        $where = [
            'order_status'=>'2'
        ];
        $result = Db::name('order')
            ->alias('o')
            ->join('trading_account t','o.ta_id=t.id')
            ->field($fields)
            ->where($where)
            ->select();
        $data = [
            'history_success'=>$res,
            'history_fail'=>$result
        ];
        $this->assign($data);
        return $this->fetch('history-order');
    }
}