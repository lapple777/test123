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
use app\ib\model\Config;
use think\Db;

//出金管理
class Withdraw extends Common {
    private $ib;
    private $outmoney;
    private $config;
    public function __construct()
    {
        parent::__construct();
        $this->ib = new IB();
        $this->outmoney = new OutMoneyLog();
        $this->config = new Config();
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
            'id','order_id','outmoney','order_status','add_time','success_time','order_status','money'
        ];
        $where = [
            'user_id'=>session('IBId'),
            'user_type'=>'2'
        ];
        $res = $this->outmoney->field($fields)->where($where)->select();
        //读取配置信息
        $configRes = $this->config->field('out_rate')->where(['id'=>1])->find();
        $data = [
            'user_config'=>$result,
            'withdraw_list'=>$res,
            'out_rate'=>$configRes['out_rate']
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
            $validate  = new \app\common\validate\IBWithdrawVerify();
            $result = $validate->scene('outmoney')->check($input);
            if(!$result){
                $this->error($validate->getError());
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
            $fields = ['wallet','name','email'];
            $result = $this->ib->field($fields)->where($where)->find();
            if($result){
                if($result['wallet']<$input['outmoney']){
                    $this->error('账户余额不足');
                }
            }else{
                $this->error('账户不存在');
            }
            //读取配置信息
            $configRes = $this->config->field('out_rate')->where(['id'=>1])->find();
            $time = time();
            $money = round($input['outmoney']*$configRes['out_rate'],2);

            $data = [
                'order_id'=>$orderId,
                'outmoney'=>$input['outmoney'],
                'user_id'=>session('IBId'),
                'user_type'=>'2',
                'rate'=>$configRes['out_rate'],
                'money'=>$money,
                'add_time'=>$time
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
            //==============给管理员发送出金申请=============
            $title = '提示管理员审核';
            $msg = $result['name'].'提交权利金转出申请，请及时审核。';
            $mail = new \app\api\controller\SendMail();
            $mail->send($title,$msg,1);
            //==============给管理员发送出金申请=============
            //==================给ib发送邮件===============
            $title = '系统权利金转出申请';
            $name = $result['name'];
            $email = $result['email'];
            $emailTime  = date('Y-m-d H:i:s',$time);
            $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'提交权利金转出申请，转出金额＄'.$input['outmoney'].'美元，兑换人民币¥'.$money.'元，汇率：'.$configRes['out_rate'].'，我们将第一时间为您审核。在通过审核后，我们将在1-2个工作日内，将资金转入到您本人银行卡账户上！<br/><br/><br/><br/><br/>

    此为系统邮件请勿回复！';
            $mail->send($title,$msg,1,$email,$name);

            //===================================================
            $this->success('出金申请已提交');
        }
        return $this->fetch('withdraw-manage');
    }

    //IB出金申请列表
    public function withdraw_list(){
        $fields = [
            'id','order_id','outmoney','order_status','add_time','success_time','order_status','money'
        ];
        $where = [
            'user_id'=>session('IBId'),
            'user_type'=>'2'
        ];
        $res = $this->outmoney->field($fields)->where($where)->select();
        $this->success($res);

    }
}