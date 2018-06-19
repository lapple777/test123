<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/11
 * Time: 14:39
 */

namespace app\ib\controller;
use app\admin\model\IB;
use \app\ib\common\Common;
use app\ib\model\OutMoneyLog;
use think\Db;

//出金管理
class Withdraw extends Common {
    private $ib;
    private $outmoney;
    public function __construct()
    {
        parent::__construct();
        $this->ib = new IB();
        $this->outmoney = new OutMoneyLog();
    }
    public function withdraw_manage(){
        $fields = [
            'name','wallet','bank_card','id_card'
        ];
        $where = [
            'id'=>session('IBId')
        ];
        $result = $this->ib->field($fields)->where($where)->find();
        $fields = [
            'id','order_id','outmoney','order_status','add_time','success_time','order_status'
        ];
        $where = [
            'user_id'=>session('IBId'),
            'user_type'=>'2'
        ];
        $res = $this->outmoney->field($fields)->where($where)->select();
        $data = [
            'user_config'=>$result,
            'withdraw_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('withdraw-manage');
    }

    //IB申请出金
    public function ib_withdraw(){
        if(request()->isPost()){
            $input = input();
            if(empty($input['outmoney'])){
                $this->error('出金金额不能不空');
            }
            //订单号
            $orderId = Common::getIbOrderId('outmoney_log','order_id');
            //检查IB用户状态
            $where = [
                'id'=>session('IBId')
            ];
            $res = Common::checkIbStatus('ib',$where);
            if(!$res){
                $this->error('IB暂不能出金');
            }
            //检查用户余额
            $fields = ['wallet'];
            $result = $this->ib->field($fields)->where($where)->find();
            if($result){
                if($result['wallet']<$input['outmoney']){
                    $this->error('账户余额不足');
                }
            }else{
                $this->error('账户不存在');
            }

            $data = [
                'order_id'=>$orderId,
                'outmoney'=>$input['outmoney'],
                'user_id'=>session('IBId'),
                'user_type'=>'2',
                'add_time'=>time()
            ];
            Db::startTrans();
            try{
                $sql = 'UPDATE crm_ib SET wallet = wallet-'.$input['outmoney'].' WHERE id = '.session('IBId');
                Db::query($sql);
                $this->outmoney->insert($data);
                Db::commit();
            }catch(\Exception $e){
                Db::rollback();
                $this->error('出金申请提交失败');
            }
            session('IBWallet',$result['wallet']-$input['outmoney']);
            $this->success('出金申请已提交');
        }
        return $this->fetch('withdraw-manage');
    }

    //IB出金申请列表
    public function withdraw_list(){
        $fields = [
            'id','order_id','outmoney','order_status','add_time','success_time','order_status'
        ];
        $where = [
            'user_id'=>session('IBId'),
            'user_type'=>'2'
        ];
        $res = $this->outmoney->field($fields)->where($where)->select();
        $this->success($res);

    }
}