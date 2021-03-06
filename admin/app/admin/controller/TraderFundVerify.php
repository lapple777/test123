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
    //交易者资金划入列表
    public function trader_fundIn(){
        $fields = [
            'transfer.add_time','transfer.success_time',
            'transfer.id','order_id','name','trader_user',
            'transfer_price','transfer_status','user_id'
        ];
        $res  = Db::name('transfer_log')
                ->alias('transfer')
                ->field($fields)
                ->join('user','transfer.user_id=user.id')
                ->where(['order_type'=>'1'])
                ->paginate(10);
        $data = [
            'trader_fundIn_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('trader-in-verify');
    }
  //交易者资金划出列表
    public function trader_fundOut(){
        $fields = [
            'transfer.add_time','transfer.success_time',
            'transfer.id','order_id','name','trader_user',
            'transfer_price','transfer_status','user_id'
        ];
        $res  = Db::name('transfer_log')
                ->alias('transfer')
                ->join('user','transfer.user_id=user.id')
                ->field($fields)
                ->where(['order_type'=>'2'])
                ->paginate(10);
        $data = [
            'trader_fundOut_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('trader-out-verify');
    }
    //划入审核通过
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
        $res = $this->transfer->field('transfer_status,transfer_price')->where($where)->find();
        if($res){
            if($res['transfer_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
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
        //============================交易账号划入成功发送邮件通知客户================
        $orderRes = $this->transfer->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '系统权利金转入交易账户申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $account = $input['trader_user'];
        $price = $res['transfer_price'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'申请权利金转入'.$account.'，金额＄'.$price.'（美元）已通过审核，，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        //================================================================
        $mail->send($title,$msg,1,$email,$name);


        $this->success('审核成功');
    }

    //划入审核不通过
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
        $res = $this->transfer->field('transfer_status,transfer_price')->where($where)->find();
        if($res){
            if($res['transfer_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
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

        //==============交易账号划入未通过审核发送邮件通知客户==================
        $orderRes = $this->transfer->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '系统权利金转入交易账户申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $account = $input['trader_user'];
        $price = $res['transfer_price'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'申请权利金转入'.$account.'，金额＄'.$price.'（美元）未通过审核，，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);
        //============================================================================
        $this->success('审核成功');
    }
    //划出审核通过
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
        $res = $this->transfer->field('transfer_status,transfer_price')->where($where)->find();
        if($res){
            if($res['transfer_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
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

        //===================交易账号划出审核通过发送邮件通知客户=================
        $orderRes = $this->transfer->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '系统权利金转出交易账户申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $account = $input['trader_user'];
        $price = $res['transfer_price'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'申请权利金转出'.$account.'，金额＄'.$price.'（美元）已通过审核，，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);
        //========================================================================

        $this->success('审核成功');
    }
    //划出审核不通过
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
        $res = $this->transfer->field('transfer_status,transfer_price')->where($where)->find();
        if($res){
            if($res['transfer_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
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
        //=============交易账号划出未通过审核发送邮件通知客户==============
        $orderRes = $this->transfer->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '系统权利金转出交易账户申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $account = $input['trader_user'];
        $price = $res['transfer_price'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'申请权利金转出'.$account.'，金额＄'.$price.'（美元）未通过审核，，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);
        //===================================================================

        $this->success('审核成功');
    }
}