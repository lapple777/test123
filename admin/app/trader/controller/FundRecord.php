<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/15
 * Time: 16:45
 */

namespace app\trader\controller;

use app\trader\model\TraderLog;
class FundRecord extends Common {
    protected $transfer;
    public function __construct()
    {
        parent::__construct();
        $this->transfer = new TraderLog();
    }

    //资金划入记录
    public function fund_in_record(){
        $fields = [
            'order_id','transfer_price',
            'trader_user','transfer_status',
            'add_time','success_time',
            'id','user_id'
        ];
        $where = [
            'user_id'=>session('traderId'),
            'order_type'=>'1'
        ];
        $res = $this->transfer->field($fields)->where($where)->paginate(10);
        $data = [
            'fundIn_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('fund-in-list');
    }
    //资金划出记录
    public function fund_out_record(){
        $fields = [
            'order_id','transfer_price',
            'trader_user','transfer_status',
            'add_time','success_time',
            'id','user_id'
        ];
        $where = [
            'user_id'=>session('traderId'),
            'order_type'=>'2'
        ];
        $res = $this->transfer->field($fields)->where($where)->paginate(10);
        $data = [
            'fundOut_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('fund-out-list');
    }

}