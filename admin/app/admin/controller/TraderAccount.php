<?php
namespace app\admin\controller;
use app\admin\model\User;
use app\common\validate\AdminTraderAccount;
use app\admin\model\LeaveMessage;
use app\admin\model\TraderUser;
//交易者账号管理
class TraderAccount extends Common{
    private $user;
    private $message;
    private $traderUser;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
        $this->message = new LeaveMessage();
        $this->traderUser = new TraderUser();
    }
    //交易者账号列表
    public function accounts_list(){
        $fields = [
            'username','name','bank_card','phone',
            'email','id_card','add_time','id',
            'user_status','wallet'
        ];

        $result = $this->user
            ->field($fields)
            ->where(['user_status'=>['neq',0]])
            ->paginate(10);

        $count = '';
        foreach($result as $key => $value){
            $where = [
                'from_userid'=>$value['id'],
                'status'=>0
            ];
            $count[$value['id']] = $this->message->field('id')->where($where)->count();

        }
//        print_r($count);
//        die;
//        echo '<pre>';
//        dump($result);die;
        $data = [
            'account_list'=>$result,
            'count_list'=>$count
        ];

        $this->assign($data);
        return $this->fetch('accounts-list');
    }

    //交易者账号申请列表
    public function account_sq_list(){
        if(request()->isPost()){
            $input = input();
            $type = $input['status'];
            $uid = $input['id'];
            switch($type){
                case 0:
                    $status = 3;
                    break;
                case 1:
                    $status = 1;
                    break;
            }
            $data = [
                'user_status'=>$status,
                'success_time'=>time()
            ];
            $where = [
                'id'=>$uid
            ];
            $res = $this->user->where($where)->update($data);
            if($res){
                switch($type){
                    case 0:
                        //交易者账号申请失败发送邮件通知客户
                        $fields = ['name','email','add_time'];
                        $res = $this->user->field($fields)->where(['id'=>$uid])->find();

                        $title = '会员管理账户开户申请';
                        $emailTime = date('Y-m-d H:i:s',$res['add_time']);
                        $name = $res['name'];
                        $email = $res['email'];
                        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                                    &nbsp; &nbsp; &nbsp; 欢迎使用莫里云对冲系统
                                    <br/>
                                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的申请会员管理账户审核未通过。请您登录会员中心查看详情。<br/>

                                    <br/><br/><br/><br/>
                                   此为系统邮件请勿回复';


                        break;
                    case 1:
                        //交易者账号申请成功发送邮件通知客户
                        $fields = ['name','email','add_time'];
                        $res = $this->user->field($fields)->where(['id'=>$uid])->find();
                        $title = '会员管理账户开户申请';
                        $emailTime = date('Y-m-d H:i:s',$res['add_time']);
                        $name = $res['name'];
                        $email = $res['email'];
                        $url = 'http://'.$_SERVER['SERVER_NAME'].url('trader/Login/index');
                        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                                    &nbsp; &nbsp; &nbsp; 欢迎使用莫里云对冲系统
                                    <br/>
                                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的申请会员管理账户已经开户成功。请登录网址：'.$url.' 查看详情。<br/>
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
            'id','username','name','bank_card',
            'phone','email','id_card','add_time', 'user_status'
        ];
        $where = [
            'user_status'=>0
        ];
        $whereor = [
            'user_status'=>3
        ];
        $result = $this->user->field($fields)->where($where)->whereOr($whereor)->paginate(10);

        $data = [
            'account_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('accounts-sq-list');
    }
    //交易者账号编辑
    public function account_edit(){
        if(request()->isPost()){
            $input = input();
            $validate = new AdminTraderAccount();
            $result = $validate->scene('edit')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            $where = [
                'id'=>$input['id']
            ];
            if($input['password'] == ''){
                $data = [
                    'username'=>trim($input['username']),
                    'name'=>trim($input['name']),
                    'phone'=>trim($input['phone']),
                    'email'=>trim($input['email']),
                    'id_card'=>trim($input['id_card']),
                    'bank_card'=>trim($input['bank_card']),
                    'user_status'=>trim($input['user_status']),
                    'wallet'=>trim($input['wallet']),
                ];
            }else{
                $data = [
                    'username'=>trim($input['username']),
                    'password'=>md5(trim($input['password'])),
                    'name'=>trim($input['name']),
                    'phone'=>trim($input['phone']),
                    'email'=>trim($input['email']),
                    'id_card'=>trim($input['id_card']),
                    'bank_card'=>trim($input['bank_card']),
                    'user_status'=>trim($input['user_status']),
                    'wallet'=>trim($input['wallet']),
                ];
            }
            $res = $this->user->where($where)->update($data);
            if($res){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }

        }
        $input = input();
        $id = $input['id'];
        $where = [
            'id'=>$id
        ];
        $fields = [
            'id','username','name','phone','email',
            'id_card','bank_card','wallet','user_status'
        ];
        $result = $this->user->field($fields)->where($where)->find();
        if(!$result){
            $this->error('账号异常');
        }
        $data = [
            'account'=>$result
        ];
        $this->assign($data);
        return $this->fetch('account-edit');
    }
    //留言管理
    public function account_message(){
        if(request()->isPost()){
            //留言回复
            $input = input();
            $id = $input['id'];//用户id
            $message = $input['message'];//回复内容
            $data = [
                'from_userid' => 0,
                'to_userid' => $id,
                'message' => $message,
                'add_time' => time(),
            ];
            $res = $this->message->insert($data);
            if($res){
                $this->success('回复成功');
            }else{
                $this->success('回复失败，请重试');
            }
        }
        $input = input();
        $id = $input['id'];
        $name = $input['username'];
        if(isset($input['type']) && $input['type'] == 'message'){

            $fields = ['id','message','from_userid','to_userid','add_time','status'];
            $ress = $this->message
                ->field($fields)
                ->where(['to_userid'=>$id])
                ->whereOr(['from_userid'=>$id])
                ->order('id desc')
                ->select();
//            $array = json_decode(json_encode($ress),true);
//            $new_array = $array['data'];

            $data =  array_reverse($ress);

            if($ress){
                $this->success($data);
            }


        }
        $data = [
            'status'=>1
        ];
        $where = [
            'from_userid'=>$id
        ];
        $this->message->where($where)->update($data);
        return $this->fetch('account-message');
    }
    //交易者账户删除
    public function account_del(){
        $input = input();
        $where = [
            'user_id'=>$input['id']
        ];
        $res = $this->traderUser->field('user_id')->where($where)->count();
        if($res){
            $this->error('该交易者账户下还有交易账号,无法删除');
        }
        $where = [
            'id'=>$input['id']
        ];
        $res = $this->user->field('wallet')->where($where)->find();
        if($res['wallet']>0){
            $this->error('该交易者账户还有余额,无法删除');
        }
        $res = $this->user->where($where)->delete();
        if ($res){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}