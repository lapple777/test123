<?php
namespace app\admin\controller;
use app\admin\model\OutMoneyLog;
use app\admin\model\IB;
use app\admin\model\User;
use think\Db;

//出入金管理
class FundsManagement extends Common{
    private $outmoney;
    private $ib;
    private $user;
    public function __construct(){
        parent::__construct();
        $this->outmoney = new OutMoneyLog();
        $this->ib = new IB();
        $this->user = new User();
    }
    public function funds_list(){
        $fields = [
            'id','order_id','outmoney','add_time',
            'success_time','order_status','user_type','user_id'
        ];

        //IB出金记录
        $result = Db::name('outmoney_log')
            ->alias('out')
            ->join('ib','out.user_id=ib.id')
            ->where(['user_type'=>'2'])
            ->paginate(10);
        //客户出金记录
        $res = Db::name('outmoney_log')
            ->alias('out')
            ->join('user','out.user_id=user.id')
            ->where(['user_type'=>'1'])
            ->paginate(10);
//        echo '<pre>';
//        print_r($result);;die;
        $data = [
            'ib_outmoney_list'=>$result,
            'user_outmoney_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('funds-list');
    }
    //客户出金成功
    function userWithdraw_success(){
        $input = input();
        echo '<pre>';
        print_r($input);;die;
    }
    //客户出金失败
    function userWithdraw_fail(){

    }
    //IB出金成功
    function IBWithdraw_success(){

    }
    //IB出金失败
    function IBWithdraw_fail(){

    }
}