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
    public function online_order(){
        $fields = [
            'id','order_id','order_type','order_price','add_time','ta_id','stop_profit','stop_loss','lot_num',
            'order_status','order_close_time','profit','hand_price'
        ];
        $where = [
            'order_status'=>'0'
        ];
        $res = $this->order->field($fields)->where($where)->select();
        $data = [
            'online_order'=>$res
        ];
//        echo '<pre>';
//        print_r($res);
        $this->assign($data);
        return $this->fetch('online-order');
    }

    public function history_order(){
        $fields = [
            'id','order_id','order_type','order_price','add_time','ta_id','stop_profit','stop_loss','lot_num',
            'order_status','order_close_time','profit','hand_price','order_close_time'
        ];
        $where = [
            'order_status'=>'1'
        ];
        $res = $this->order->field($fields)->where($where)->select();
        $where = [
            'order_status'=>'2'
        ];
        $result = $this->order->field($fields)->where($where)->select();
        $data = [
            'history_success'=>$res,
            'history_fail'=>$result
        ];
        $this->assign($data);
        return $this->fetch('history-order');
    }
}