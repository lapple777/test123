<?php
namespace app\admin\controller;
use app\admin\model\OutMoneyLog;
use app\admin\model\InMoneyLog;
use app\admin\common\Common;
use app\admin\model\IB;
use app\admin\model\User;
use think\Db;

//出入金管理
class FundsManagement extends Common{
    private $outmoney;
    private $ib;
    private $user;
    private $inmoney;
    public function __construct(){
        parent::__construct();
        $this->outmoney = new OutMoneyLog();
        $this->inmoney = new InMoneyLog();
        $this->ib = new IB();
        $this->user = new User();
    }
    //客户出金列表
    public function funds_list(){
        //客户出金记录
        $res = Db::name('outmoney_log')
            ->alias('out')
            ->join('user','out.user_id=user.id')
            ->where(['user_type'=>'1'])
            ->paginate(10000);
        $data = [
            'user_outmoney_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('funds-list');
    }
    //IB出金记录
    public function fundsIB_list(){
        //IB出金记录
        $result = Db::name('outmoney_log')
            ->alias('out')
            ->join('ib','out.user_id=ib.id')
            ->where(['user_type'=>'2'])
            ->paginate(10000);
        $data = [
            'ib_outmoney_list'=>$result,

        ];
        $this->assign($data);
        return $this->fetch('fundsIB-list');
    }
    //入金列表
    public function deposit_list(){
        $result = Db::name('inmoney_log')
            ->alias('in')
            ->join('user','in.user_id=user.id')
            ->where(['user_type'=>'1'])
            ->paginate(10000);
        $data = [
            'deposit_list'=>$result
        ];
//        echo '<pre>';
//        print_r($result);
        $this->assign($data);
        return $this->fetch('deposit-list');
    }
    //客户入金成功
    public function userDeposit_success(){
        $input = input();
        $data = [
            'order_status'=>'1',
            'success_time'=>time()
        ];
        $where = [
            'order_id'=>$input['order_id'],
            'user_type'=>'1'
        ];
        Db::startTrans();
        try{
            $sql = 'UPDATE crm_user SET wallet = wallet+'.$input['inmoney'].' WHERE id = '.$input['user_id'];
            Db::query($sql);
            $this->inmoney->where($where)->update($data);
            Db::commit();
        }catch(\Exception $e){
            Db::rollback();
            $this->error('客户入金审核失败');
        }
        $this->success('客户入金审核成功');
    }
    //客户入金失败
    public function userDeposit_fail(){
        $input = input();
        $order_id = $input['order_id'];
        $where = [
            'order_id'=>$order_id,
            'user_type'=>'1'
        ];
        $data = [
            'order_status'=>'2',
            'success_time'=>time()
        ];

        $result = $this->inmoney->where($where)->update($data);
        if($result){
            $this->success('客户入金审核成功!');
        }else{
            $this->error('客户入金审核失败!');
        }
    }
    //客户出金成功
    public function userWithdraw_success(){
        $input = input();
        $order_id = $input['order_id'];
        $where = [
            'order_id'=>$order_id,
            'user_type'=>'1'
        ];
        $data = [
            'order_status'=>'1',
            'success_time'=>time()
        ];

        $result = $this->outmoney->where($where)->update($data);
        if($result){
            $this->success('客户出金审核成功!');
        }else{
            $this->error('客户出金审核失败!');
        }

    }
    //客户出金失败
   public function userWithdraw_fail(){
       $input = input();
       $data = [
           'order_status'=>'2',
           'success_time'=>time()
       ];
       $where = [
           'order_id'=>$input['order_id'],
            'user_type'=>'1'
       ];
       Db::startTrans();
       try{
           $sql = 'UPDATE crm_user SET wallet = wallet+'.$input['outmoney'].' WHERE id = '.$input['user_id'];
           Db::query($sql);
           $this->outmoney->where($where)->update($data);
           Db::commit();
       }catch(\Exception $e){
           Db::rollback();
           $this->error('客户出金审核失败');
       }
       $this->success('客户出金审核成功');

    }
    //IB出金成功
    public function IBWithdraw_success(){
        $input = input();
        $order_id = $input['order_id'];
        $where = [
            'order_id'=>$order_id,
            'user_type'=>'2'
        ];
        $data = [
            'order_status'=>'1',
            'success_time'=>time()
        ];

        $result = $this->outmoney->where($where)->update($data);
        if($result){
            $this->success('IB出金审核成功!');
        }else{
            $this->error('IB出金审核失败!');
        }


    }
    //IB出金失败
    public function IBWithdraw_fail(){
        $input = input();
        $data = [
            'order_status'=>'2',
            'success_time'=>time()
        ];
        $where = [
            'order_id'=>$input['order_id'],
            'user_type'=>'2'
        ];
        Db::startTrans();
        try{
            $sql = 'UPDATE crm_ib SET wallet = wallet+'.$input['outmoney'].' WHERE id = '.$input['ib_id'];
            Db::query($sql);
            $this->outmoney->where($where)->update($data);
            Db::commit();
        }catch(\Exception $e){
            Db::rollback();
            $this->error('IB出金审核失败');
        }
        $this->success('IB出金审核成功');
    }
}