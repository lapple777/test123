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
        $res = $this->transfer->field('transfer_status')->where($where)->find();
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
        //交易账号划入成功发送邮件通知客户
        $orderRes = $this->transfer->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '账户权利金转入申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的权利金转入申请已通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);


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
        $res = $this->transfer->field('transfer_status')->where($where)->find();
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

        //交易账号划入失败发送邮件通知客户
        $orderRes = $this->transfer->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '账户权利金转入申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的权利金转入申请未通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);

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
        $res = $this->transfer->field('transfer_status')->where($where)->find();
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

        //交易账号划出成功发送邮件通知客户
        $orderRes = $this->transfer->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '账户权利金转出申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的账户权利金转出申请已通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);


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
        $res = $this->transfer->field('transfer_status')->where($where)->find();
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
        //交易账号划出失败发送邮件通知客户
        $orderRes = $this->transfer->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '账户权利金转出申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的账户权利金转出申请未通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);


        $this->success('审核成功');
    }
}