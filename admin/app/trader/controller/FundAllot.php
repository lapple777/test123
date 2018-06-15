<?php
namespace app\trader\controller;
use app\trader\common\Common as commons;
use think\Db;
use app\trader\model\TraderLog;
use app\trader\model\User;
use app\trader\model\TradingAccount;

class FundAllot extends Common{
    private  $transfer;
    protected $user;
    protected $tradeAccount;
    public function __construct()
    {
        parent::__construct();
        $this->transfer = new TraderLog();
        $this->user = new User();
        $this->tradeAccount = new TradingAccount();
    }
    public function fundAllot(){
        $input = input();
        $data = [
            'fund_TranderId'=>$input['account']
        ];
        $this->assign($data);
        return $this->fetch('fund-allot');
    }
    //资金划入
    public function fund_in(){
        if(request()->isPost()){
            $input = input();
            if(empty($input['inmoney'])){
                $this->error('划入的金额不能为空');
            }
            //订单号
            $orderId = commons::getOrderId('transfer_log','order_id');
            //检查trader账户的状态
            $where = [
                'account'=>trim($input['account'])
            ];
            $res = commons::checkTraderStatus('trading_account',$where);
            if (!$res){
                $this->error('该交易账户暂不能划入金额');
            }
            //检查用户余额
            $fields = ['wallet'];
            $where = [
                'id'=>session('traderId')
            ];
            $result = $this->user->field($fields)->where($where)->find();
            if($result){
                if($result['wallet']<$input['inmoney']){
                    $this->error('账户余额不足');
                }
            }else{
                $this->error('账户不存在');
            }
            $data = [
                'order_id'=>$orderId,
                'transfer_price'=>$input['inmoney'],
                'user_id'=>session('traderId'),
                'trader_user'=>$input['account'],
                'order_type'=>'1',
                'add_time'=>time()
            ];
            Db::startTrans();
            try{
                $sql = 'UPDATE crm_user SET wallet = wallet-'.$input['inmoney'].' WHERE id = '.session('traderId');
                Db::query($sql);
                $this->transfer->insert($data);
                Db::commit();
            }catch(\Exception $e){
                Db::rollback();
                $this->error('划入资金提交失败');
            }
            $this->success('划入资金提交成功');
        }
    }
    //资金划出
    public function fund_out(){
        if(request()->isPost()){
            $input = input();
            if (empty($input['outmoney'])){
                $this->error('转出金额不能为空');
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
            $this->success('划出资金提交成功');
        }
    }
}