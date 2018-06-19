<?php
namespace app\index\controller;
use app\index\model\TraderOrder;

class Statements extends Common{
    public function statement(){
        $traderOrder = new TraderOrder();
        $where = [
            'ta_id'=>session('userid'),
            'order_status'=>['neq',0]
        ];
        $fields = [
            'order_id','order_type','order_price','add_time',
            'stop_profit','stop_loss','lot_num','order_status',
            'order_close_time','profit','hand_price'
        ];
        $result = $traderOrder->field($fields)->order('order_close_time desc')->where($where)->paginate(15);
        $data = [
            'historyOrder'=>$result
        ];
        $this->assign($data);
        return $this->fetch('index/statement');
    }
}