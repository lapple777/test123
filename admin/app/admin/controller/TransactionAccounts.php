<?php
namespace app\admin\controller;
use app\admin\model\TraderUser;
use app\admin\model\User;
use app\admin\model\Order;
//交易账号管理
class TransactionAccounts extends Common{
    private $traderUser;
    private $user;
    private $order;
    public function __construct()
    {
        parent::__construct();
        $this->traderUser = new TraderUser();
        $this->user = new User();
        $this->order = new Order();
    }

    //交易账号列表
    public function accounts_list(){

        $fields = [
            'tu.id','user_id','account','tu.wallet',
            'tu.add_time', 'ta_status','tu.success_time',
            'u.name'
        ];
        $where = [
            'ta_status'=>1
        ];
        $whereor = [
            'ta_status'=>2
        ];
        $result = $this->traderUser
                    ->alias('tu')
                    ->field($fields)
                    ->join('crm_user u','tu.user_id = u.id','left')
                    ->where($where)
                    ->whereOr($whereor)
                    ->paginate(10);

        $data = [
            'account_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('accounts-list');
    }

    //交易账号申请列表
    public function account_sq_list(){
        if(request()->isPost()){
            $input = input();
            $type = $input['status'];
            $tid = $input['id'];
            switch($type){
                case 0:
                    $status = 3;
                    break;
                case 1:
                    $status = 1;
                    break;
            }
            $data = [
                'ta_status'=>$status,
                'success_time'=>time()
            ];
            $where = [
                'id'=>$tid
            ];
            $res = $this->traderUser->where($where)->update($data);
            $fields = [
                'id','user_id','add_time','account'
            ];

            $orderRes = $this->traderUser
                        ->field($fields)
                        ->where(['id'=>$tid])
                        ->find();

            $fields = ['name','email'];

            $userres = $this->user
                        ->field($fields)
                        ->where(['id'=>$orderRes['user_id']])
                        ->find();
            if($res){
                switch($type){
                    case 0:
                        //=======交易账号申请审核已通过发送邮件通知客户============
                        $title = '交易账户开户申请';
                        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
                        $name = $userres['name'];
                        $email = $userres['email'];
                        $account = $orderRes['account'];
                        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                                    &nbsp; &nbsp; &nbsp; 欢迎使用莫里云对冲系统
                                    <br/>
                                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的申请交易账号审核未通过。账号：'.$account.'，请您登录会员中心查看详情。<br/>

                                    <br/><br/><br/><br/>
                                   此为系统邮件请勿回复';


                        break;
                    case 1:
                        //=======交易账号申请审核未通过发送邮件通知客户============
                        $title = '交易账户开户申请';
                        $emailTime = date('Y-m-d H:i:s',$orderRes['add_time']);
                        $name = $userres['name'];
                        $email = $userres['email'];
                        $account = $orderRes['account'];
                        $url = 'http://'.$_SERVER['SERVER_NAME'].url('index/Login/login');
                        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                                    &nbsp; &nbsp; &nbsp; 欢迎使用莫里云对冲系统
                                    <br/>
                                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的申请交易账号已经开设成功。账号：'.$account.'，请登录网址：'.$url.' 查看详情。<br/>
                                     &nbsp; &nbsp; &nbsp 我们提供的所有服务仅基于执行交易指令和系统服务。信息不包含个人金融或投资意见或其他推荐或我们交易价位的纪录，交易仅属于个人行为，请结合自身特定投资目的、财政状况进行投资。
                                    <br/><br/><br/><br/>
                                   此为系统邮件请勿回复';
                        break;
                }
                $mail = new \app\api\controller\SendMail();
                $mail->send($title,$msg,1,$email,$name);

                $this->success('处理成功');
            }else{
                $this->error('处理失败');
            }

        }
        $fields = [
            'tu.id','user_id','account'
            ,'tu.add_time', 'ta_status','tu.success_time',
            'u.name'
        ];
        $where = [
            'ta_status'=>0
        ];
        $whereor = [
            'ta_status'=>3
        ];
        $result = $this->traderUser
                    ->alias('tu')
                    ->field($fields)
                    ->join('crm_user u','tu.user_id = u.id','left')
                    ->where($where)
                    ->whereOr($whereor)
                    ->paginate(10);

        $data = [
            'account_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('accounts-sq-list');
    }
    //交易账号编辑
    public function account_edit(){
        if(request()->isPost()){
            $input = input();
            $where = [
                'id'=>$input['id']
            ];
            if($input['password'] == ''){
                $data = [
                    'ta_status'=>$input['user_status'],
                    'wallet'=>$input['wallet']
                ];
            }else{
                $data = [
                    'password'=>md5(trim($input['password'])),
                    'ta_status'=>$input['user_status'],
                    'wallet'=>$input['wallet']
                ];
            }
            $res = $this->traderUser->where($where)->update($data);
            if($res){
                $this->success('修改成功');
            }else{
                $this->success('修改失败');
            }
        }
        $input = input();
        $id = $input['id'];
        $where = [
            'id'=>$id
        ];
        $fields = [
            'id','account','wallet','ta_status'
        ];
        $result = $this->traderUser
                    ->field($fields)
                    ->where($where)
                    ->find();
        if(!$result){
            $this->error('账号异常');
        }
        $data = [
            'account'=>$result
        ];
        $this->assign($data);
        return $this->fetch('account-edit');
    }
    //删除交易账户
    public function account_del(){
        $input = input();
        $where = [
            'order_status'=>'0',
            'ta_id'=>$input['id']
        ];
        $res = $this->order->field('ta_id')->where($where)->count();
        if($res){
            $this->error('该交易账户下还有未平仓订单,无法删除');
        }
        $where = [
            'id'=>$input['id']
        ];
        $res = $this->traderUser->field('wallet')->where($where)->find();
        if($res['wallet']>0){
            $this->error('该交易账户还有余额,无法删除');
        }
        $res = $this->traderUser->where($where)->delete();
        if ($res){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}