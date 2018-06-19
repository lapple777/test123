<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/14
 * Time: 20:20
 */

namespace app\admin\controller;
use app\admin\model\TradingAccount;
use app\admin\model\User;
use app\trader\model\TraderLog;
use think\Db;
class TraderFundVerify extends Common{
    private $user;
    private $tradeAccount;
    private $transfer;
    public function __construct(){
        parent::__construct();
        $this->tradeAccount = new TradingAccount();
        $this->transfer = new TraderLog();
        $this->user = new User();
    }
    //交易者资金划入
    public function trader_fundIn(){
        $res  = Db::name('transfer_log')
            ->alias('transfer')
            ->join('user','transfer.user_id=user.id')
            ->where(['order_type'=>'1'])
            ->paginate(10000);
        $data = [
            'trader_fundIn_list'=>$res
        ];
//        echo "<pre>";
//        print_r($res);
        $this->assign($data);
        return $this->fetch('trader-in-verify');
    }
  //交易者资金划出
    public function trader_fundOut(){
        $res  = Db::name('transfer_log')
            ->alias('transfer')
            ->join('user','transfer.user_id=user.id')
            ->where(['order_type'=>'2'])
            ->paginate(10000);
        $data = [
            'trader_fundOut_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('trader-out-verify');
    }
    //划入成功
    public function fund_in_success(){
        $input = input();
        $data = [
            'success_time'=>time(),
            'transfer_status'=>'1'
        ];
        $where = [
            'order_id'=>$input['order_id'],
            'order_type'=>'1'
        ];
        Db::startTrans();
        try{
            $sql = 'UPDATE crm_trading_account SET wallet = wallet+'.$input['transfer_price'].' WHERE account = "'.$input['trader_user'].'"';
            Db::query($sql);
            $this->transfer->where($where)->update($data);
            Db::commit();
        }catch(\Exception $e){
            Db::rollback();
            $this->error('审核失败');
        }
        $this->success('审核成功');
    }

    //划入失败
    public function fund_in_fail(){
        $input = input();
        $data  = [
            'success_time'=>time(),
            'transfer_status'=>'2'
        ];
        $where = [
            'order_id'=>$input['order_id'],
            'order_type'=>'1'
        ];
        Db::startTrans();
        try{
            $sql = 'UPDATE crm_user SET wallet = wallet+'.$input['transfer_price'].' WHERE id='.$input['user_id'];
            Db::query($sql);
            $this->transfer->where($where)->update($data);
            Db::commit();
        }catch(\Exception $e){
            Db::rollback();
            $this->error('审核失败');
        }
        $this->success('审核成功');
    }
    //划出成功
    public function fund_out_success(){
        $input = input();
        $data = [
            'success_time'=>time(),
            'transfer_status'=>'1'
        ];
        $where = [
            'order_id'=>$input['order_id'],
            'order_type'=>'2'
        ];
        Db::startTrans();
        try{
            $sql = 'UPDATE crm_user SET wallet = wallet+'.$input['transfer_price'].' WHERE id = '.$input['user_id'];
            Db::query($sql);
            $this->transfer->where($where)->update($data);
            Db::commit();
        }catch(\Exception $e){
            Db::rollback();
            $this->error('审核失败');
        }
        $this->success('审核成功');
    }
    //划出失败
    public function fund_out_fail(){
        $input = input();
        $data = [
            'success_time'=>time(),
            'transfer_status'=>'2'
        ];
        $where = [
            'order_id'=>$input['order_id'],
            'order_type'=>'2'
        ];
        Db::startTrans();
        try{
            $sql = 'UPDATE crm_trading_account SET wallet = wallet+'.$input['transfer_price'].' WHERE account = "'.$input['trader_user'].'"';
            Db::query($sql);
            $this->transfer->where($where)->update($data);
            Db::commit();
        }catch(\Exception $e){
            Db::rollback();
            $this->error('审核失败');
        }
        $this->success('审核成功');
    }
}