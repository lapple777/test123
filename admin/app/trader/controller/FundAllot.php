<?php
namespace app\trader\controller;
use app\trader\common\Common as commons;
use think\Db;
use app\trader\model\TraderLog;
use app\trader\model\User;
use app\trader\model\TradingAccount;

class FundAllot extends Common
{
    private $transfer;
    protected $user;
    protected $tradeAccount;

    public function __construct()
    {
        parent::__construct();
        $this->transfer = new TraderLog();
        $this->user = new User();
        $this->tradeAccount = new TradingAccount();
    }

    public function fundAllot()
    {
        $input = input();
        $data = [
            'fund_TranderId' => $input['account']
        ];
        $this->assign($data);
        return $this->fetch('fund-allot');
    }

    //资金划入
    public function fund_in()
    {
        if (request()->isPost()) {
            $input = input();
            $validate = new \app\common\validate\FundAllotVerify();
            $result = $validate->scene('fundIn')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            //订单号
            $orderId = commons::getOrderId('transfer_log', 'order_id');
            //检查trader账户的状态
            $where = [
                'account' => trim($input['account'])
            ];
            $res = commons::checkTraderStatus('trading_account', $where);
            if (!$res) {
                $this->error('该交易账户暂不能划入金额');
            }
            //检查用户状态
            $where = [
                'id'=>session('traderId')
            ];
            $res = commons::checkUserStatus('user',$where);
            if(!$res){
                $this->error('该账户状态异常');
            }
            //检查用户余额
            $fields = ['wallet','name'];
            $where = [
                'id' => session('traderId')
            ];
            $result = $this->user->field($fields)->where($where)->find();
            if ($result) {
                if ($result['wallet'] < $input['inmoney']) {
                    $this->error('账户余额不足');
                }
            } else {
                $this->error('账户不存在');
            }
            $data = [
                'order_id' => $orderId,
                'transfer_price' => $input['inmoney'],
                'user_id' => session('traderId'),
                'trader_user' => $input['account'],
                'order_type' => '1',
                'add_time' => time()
            ];
            Db::startTrans();
            try {
                $sql = 'UPDATE crm_user SET wallet = wallet-' . $input['inmoney'] . ' WHERE id = ' . session('traderId');
                Db::query($sql);
                $this->transfer->insert($data);
                Db::commit();
            } catch (\Exception $e) {
                Db::rollback();
                $this->error('划入资金提交失败');
            }
            $title = '提示管理员审核';
            $msg = $result['name'].'提交交易账号权利金划入申请，请及时审核。';
            $mail = new \app\api\controller\SendMail();
            $mail->send($title,$msg,0);
            $this->success('划入资金提交成功');
        }
    }

    //资金划出
    public function fund_out(){
        if(request()->isPost()){
            $input = input();
            $validate = new \app\common\validate\FundAllotVerify();
            $result = $validate->scene('fundOut')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            //订单号
            $orderId = commons::getOrderId('transfer_log','order_id');
            //检查trader账户状态
            $where = [
                'account'=>trim($input['account'])
            ];
            $res = commons::checkTraderStatus('trading_account',$where);
            if (!$res){
                $this->error('该交易账户暂不能划出金额');
            }

            //检查用户状态
            $where = [
                'id'=>session('traderId')
            ];
            $res = commons::checkUserStatus('user',$where);
            if(!$res){
                $this->error('该账户状态异常');
            }
            $field = ['wallet'];
            $where = [
                'account'=>trim($input['account'])
            ];
            $result = $this->tradeAccount->field($field)->where($where)->find();
            if($result){
                if($result['wallet']<$input['outmoney']){
                    $this->error('账户余额不足');
                }
            }else{
                $this->error('无该交易账户');
            }
            $data = [
                'order_id'=>$orderId,
                'transfer_price'=>$input['outmoney'],
                'user_id'=>session('traderId'),
                'trader_user'=>$input['account'],
                'order_type'=>'2',
                'add_time'=>time()
            ];
            Db::startTrans();
            try{
                $sql = 'UPDATE crm_trading_account SET wallet = wallet-'.$input['outmoney'].' WHERE account = "'.trim($input['account']).'"';
                Db::query($sql);
                $this->transfer->insert($data);
                Db::commit();
            }catch(\Exception $e){
                Db::rollback();
                $this->error('划出资金提交失败');
            }
            $userResult = $this->user->field('name')->where(['id'=>session('traderId')])->find();
            $title = '提示管理员审核';
            $msg = $userResult['name'].'提交交易账号权利金划出申请，请及时审核。';
            $mail = new \app\api\controller\SendMail();
            $mail->send($title,$msg,0);

            $this->success('划出资金提交成功');
        }
    }
    //一键登录交易账号
//    public function login(){
//        $input = input();
//        $accountId = $input['accountId'];
//        $fields = [
//            'id','ta_status','account'
//        ];
//        $res = $this->tradeAccount->field($fields)->where(['id'=>$accountId])->find();
//        if($res){
//            if($res['ta_status'] == 0){
//                $this->error('账号正在审核中...');
//            }else if($res['ta_status'] == 2){
//                $this->error('当前用户禁止登陆');
//            }else {
//                session('username', $res['account']);
//                session('userid', $res['id']);
//                $url = url('index/Index/index');
//                $this->success('登陆成功', $url);
//            }
//        }else{
//            $this->error('账号不存在');
//        }
//    }
}