<?php
namespace app\trader\controller;
use app\trader\common\Common;
use app\trader\model\InMoneyLog;
use app\trader\model\OutMoneyLog;
use app\trader\model\User;
use Mockery\CountValidator\Exception;
use think\Db;
use app\trader\model\Config;
//资金管理
class Brm extends Common{
    private $inmoney;
    private $outmoney;
    private $user;
    private $config;
    public function __construct()
    {
        parent::__construct();
        $this->inmoney = new InMoneyLog();
        $this->outmoney = new OutMoneyLog();
        $this->user = new User();
        $this->config = new Config();
    }

    //客户入金列表
    public function inmoney_list(){
        $where = [
            'user_id'=>session('traderId'),
            'user_type'=>'1',
        ];
        $fields = [
            'id','order_id','inmoney','money',
            'add_time','success_time','order_status'
        ];
        $res = $this->inmoney->field($fields)->where($where)->select();
        $data = [
            'inmoney_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('inmoney-list');
    }
    //客户入金申请
    public function inmoney(){
        if(request()->isPost()){

            $input = input();
            if(empty($input['inmoney'])){
                $this->error('入金金额不能为空');
            }
            //账单号
            $orderId = Common::getOrderId('inmoney_log','order_id');
            //检查用户状态
            $where = [
                'id'=>session('traderId')
            ];
            $fields = ['name','phone'];
            $userRes = $this->user->field($fields)->where($where)->find();
            $res = Common::checkUserStatus('user',$where);
            if(!$res){
                $this->error('账户暂时不能入金');
            }
            //读取配置信息
            $configRes = $this->config->field('rate')->where(['id'=>1])->find();
            $money = $input['inmoney']*$configRes['rate'];//人民币
            $data = [
                'order_id'=>$orderId,
                'inmoney'=>$input['inmoney'],//美元
                'user_id'=>session('traderId'),
                'user_type'=>'1',
                'add_time'=>time(),
                'rate'=>$configRes['rate'],//汇率
                'money'=>$money,
            ];
            $result = $this->inmoney->insert($data);
            if($result){
                //向admin发送入金通知邮件
//                $title = '客户申请入金';
//                $msg = '【用户入金】用户ID为：'.session('traderId').' 姓名：'.$userRes['name'].'，入金：'.$money.'人民币，对应美元为：'.$input['inmoney'];
//                $mail = new \app\api\controller\SendMail();
//                $mail->send($title,$msg,0);

                $this->success('入金申请已提交');
            }else{
                $this->error('入金申请提交失败');
            }
        }
        $res = $this->config->field('rate')->where(['id'=>1])->find();
        $data = [
            'rate'=>$res['rate']
        ];
        $this->assign($data);
        return $this->fetch('inmoney');
    }
    //客户出金列表
    public function outmoney_list(){
        $where = [
            'user_id'=>session('traderId'),
            'user_type'=>'1',
        ];
        $fields = [
            'id','order_id','outmoney',
            'add_time','success_time','order_status'
        ];
        $res = $this->outmoney->field($fields)->where($where)->select();
        $data = [
            'outmoney_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('outmoney-list');
    }
    //客户出金申请
    public function outmoney(){
        if(request()->isPost()){
            $input = input();
            if(empty($input['outmoney'])){
                $this->error('入金金额不能为空');
            }
            //账单号
            $orderId = Common::getOrderId('outmoney_log','order_id');
            //检查用户状态
            $where = [
                'id'=>session('traderId')
            ];
            $res = Common::checkUserStatus('user',$where);
            if(!$res){
                $this->error('账户暂时不能入金');
            }
            //检查账户余额
            $fields = ['wallet','name'];
            $result = $this->user->field($fields)->where($where)->find();
            if($result){
                if($result['wallet'] < $input['outmoney']){
                    $this->error('账户余额不足');
                }
            }else{
                $this->error('账户不存在');
            }
            $data = [
                'order_id'=>$orderId,
                'outmoney'=>$input['outmoney'],
                'user_id'=>session('traderId'),
                'user_type'=>'1',
                'add_time'=>time(),
            ];
            Db::startTrans();
            try{
                $sql = 'UPDATE crm_user SET wallet = wallet-'.$input['outmoney'].',freeze_price = '.$input['outmoney'].' WHERE id = '.session('traderId');
                Db::query($sql);
                $this->outmoney->insert($data);
                Db::commit();
            }catch(\Exception $e){
                Db::rollback();
                $this->error('出金申请提交失败');
            }
            //向admin发送出金通知邮件
//            $msg = '【用户出金】用户ID为：'.session('traderId').' 姓名：'.$result['name'].'，出金金额为(美元)：'.$input['outmoney'];
//            $mail = new \app\api\controller\SendMail();
//            $mail->send($msg,0);

            $this->success('出金申请已提交');

        }
        $fields = ['wallet'];
        $res = $this->user->field($fields)->where(['id'=>session('traderId')])->find();
        $data = [
            'blance'=>$res['wallet']
        ];
        $this->assign($data);
        return $this->fetch('outmoney');
    }
}