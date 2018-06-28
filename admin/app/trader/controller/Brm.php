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
            $validate  = new \app\common\validate\BrmVerify();
            $result = $validate->scene('inmoney')->check($input);
            if(!$result){
                $this->error($validate->getError());
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
            $money =round( $input['inmoney']*$configRes['rate'],2);//人民币
            $time = time();
            $data = [
                'order_id'=>$orderId,
                'inmoney'=>$input['inmoney'],//美元
                'user_id'=>session('traderId'),
                'user_type'=>'1',
                'add_time'=>$time,
                'rate'=>$configRes['rate'],//汇率
                'money'=>$money,
            ];
            $result = $this->inmoney->insert($data);
            if($result){
                $userResult = $this->user->field('name,email')->where(['id'=>session('traderId')])->find();
                $mail = new \app\api\controller\SendMail();

                //向客户发送邮件入金通知
                $title = '账户权利金转入申请';
                $email = $userResult['email'];
                $emailTime = date('Y-m-d H:i:s',$time);
                $name = $userResult['name'];
                $msg = '尊敬的'.$userResult['name'].'，您好！<br/><br/>
                    您于'.$emailTime.'提交入金申请，入金金额为'.$input['inmoney'].'（美金），人民币'.$money.'元，请及时将资金汇入银行卡账号：4402006909100024969。成都莫里斯网络科技有限公司；开户行：中国工商银行股份有限公司成都万年场支行。<br/><br/><br/><br/>


                    此为系统邮件请勿回复';
                $mail->send($title,$msg,1,$email,$name);
                //向管理员发送邮件提示尽快审核
                $title = '提示管理员审核';
                $msg = $userResult['name'].'提交提交权利金转入申请，请及时审核。';

                $mail->send($title,$msg,0);

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
            'add_time','success_time','order_status','money'
        ];

        $res = $this->outmoney->field($fields)->where($where)->select();
        $data = [
            'outmoney_list'=>$res,
        ];
        $this->assign($data);
        return $this->fetch('outmoney-list');
    }
    //客户出金申请
    public function outmoney(){
        if(request()->isPost()){
            $input = input();
            $validate  = new \app\common\validate\BrmVerify();
            $result  = $validate->scene('outmoney')->check($input);
            if(!$result){
                $this->error($validate->getError());
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
            //读取配置信息
            $configRes = $this->config->field('out_rate')->where(['id'=>1])->find();
            $money = round($input['outmoney']*$configRes['out_rate'],2);//人民币
            $data = [
                'order_id'=>$orderId,
                'outmoney'=>$input['outmoney'],
                'user_id'=>session('traderId'),
                'rate'=>$configRes['out_rate'],
                'money'=>$money,
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
            $title = '提示管理员审核';
            $msg = $result['name'].'提交提交权利金转出申请，请及时审核。';
            $mail = new \app\api\controller\SendMail();
            $mail->send($title,$msg,0);

            $this->success('出金申请已提交');

        }
        $fields = ['wallet'];
        $res = $this->user->field($fields)->where(['id'=>session('traderId')])->find();
        //读取配置信息
        $configRes = $this->config->field('out_rate')->where(['id'=>1])->find();
        $data = [
            'blance'=>$res['wallet'],
            'out_rate'=>$configRes['out_rate']
        ];

        $this->assign($data);
        return $this->fetch('outmoney');
    }
}