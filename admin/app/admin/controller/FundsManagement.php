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
        $fields = [
            'out.id','order_id','name',
            'outmoney','out.add_time','id_card',
            'out.success_time','order_status',
            'out.user_id','user.user_status','rate','money'
        ];
        //客户出金记录
        $res = Db::name('outmoney_log')
            ->alias('out')
            ->field($fields)
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
        $fields = [
            'in.id','order_id','name',
            'inmoney','money','in.add_time',
            'in.success_time','order_status',
            'in.user_id','rate'
        ];
        $result = Db::name('inmoney_log')
            ->alias('in')
            ->field($fields)
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
        $res = $this->inmoney->field('order_status')->where($where)->find();
        if($res){
            if($res['order_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
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
        //客户入金通过发送邮件通知客户
        $fields = ['name','email'];
        $res = $this->user->field($fields)->where(['id'=>$input['user_id']])->find();

        $orderRes = $this->inmoney->field('add_time')->where($where)->find();

        $title = '系统权利金转入申请';
        $time = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$time.'提交权利金转出申请已通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);

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
        $res = $this->inmoney->field('order_status')->where($where)->find();
        if($res){
            if($res['order_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
        $result = $this->inmoney->where($where)->update($data);
        if($result){
            //客户入金失败发送邮件通知客户
            $orderRes = $this->inmoney->field('user_id,add_time')->where($where)->find();
            $fields = ['name','email'];
            $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();



            $title = '系统权利金转入申请';
            $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
            $name = $res['name'];
            $email = $res['email'];
            $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'提交权利金转出申请未通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
            $mail = new \app\api\controller\SendMail();
            $mail->send($title,$msg,1,$email,$name);

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
        $res = $this->outmoney->field('order_status')->where($where)->find();
        if($res){
            if($res['order_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
        $result = $this->outmoney->where($where)->update($data);
        if($result){
            //客户出金成功发送邮件通知客户
            $orderRes = $this->outmoney->field('user_id,add_time')->where($where)->find();
            $fields = ['name','email'];
            $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();



            $title = '系统权利金转出申请';
            $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
            $name = $res['name'];
            $email = $res['email'];
            $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'提交权利金转出申请已通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
            $mail = new \app\api\controller\SendMail();
            $mail->send($title,$msg,1,$email,$name);

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
       $res = $this->outmoney->field('order_status')->where($where)->find();
       if($res){
           if($res['order_status'] > 0){
               $this->error('订单已审核');
           }
       }else{
           $this->error('订单不存在');
       }
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
       //客户出金失败发送邮件通知客户
       $orderRes = $this->outmoney->field('user_id,add_time')->where($where)->find();
       $fields = ['name','email'];
       $res = $this->user->field($fields)->where(['id'=>$orderRes['user_id']])->find();



       $title = '系统权利金转出申请';
       $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
       $name = $res['name'];
       $email = $res['email'];
       $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'提交权利金转出申请未通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
       $mail = new \app\api\controller\SendMail();
       $mail->send($title,$msg,1,$email,$name);
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
        $res = $this->outmoney->field('order_status')->where($where)->find();
        if($res){
            if($res['order_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
        $result = $this->outmoney->where($where)->update($data);
        if($result){
            //ib出金成功发送邮件通知客户
            $orderRes = $this->outmoney->field('user_id,add_time')->where($where)->find();
            $fields = ['name','email'];
            $res = $this->ib->field($fields)->where(['id'=>$orderRes['user_id']])->find();



            $title = '系统权利金转出申请';
            $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
            $name = $res['name'];
            $email = $res['email'];
            $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'提交权利金转出申请已通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
            $mail = new \app\api\controller\SendMail();
            $mail->send($title,$msg,1,$email,$name);

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
        $res = $this->outmoney->field('order_status')->where($where)->find();
        if($res){
            if($res['order_status'] > 0){
                $this->error('订单已审核');
            }
        }else{
            $this->error('订单不存在');
        }
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
        //ib出金失败发送邮件通知客户
        $orderRes = $this->outmoney->field('user_id,add_time')->where($where)->find();
        $fields = ['name','email'];
        $res = $this->ib->field($fields)->where(['id'=>$orderRes['user_id']])->find();

        $title = '系统权利金转出申请';
        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
        $name = $res['name'];
        $email = $res['email'];
        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'提交权利金转出申请未通过，请您登录会员中心查看详情。<br/><br/><br/><br/><br/>
                   此为系统邮件请勿回复';
        $mail = new \app\api\controller\SendMail();
        $mail->send($title,$msg,1,$email,$name);
        $this->success('IB出金审核成功');
    }
}