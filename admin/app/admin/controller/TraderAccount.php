<?php
namespace app\admin\controller;
use app\admin\model\User;
use app\common\validate\AdminTraderAccount;
//交易者账号管理
class TraderAccount extends Common{
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }
    //交易者账号列表
    public function accounts_list(){
        $fields = [
            'username','name','bank_card','phone',
            'email','id_card','add_time','id',
            'user_status'
        ];

        $result = $this->user->field($fields)->where('user_status = 1')->whereOr('user_status = 2')->paginate(100000);
        $data = [
            'account_list'=>$result
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

                        $title = '账户申请开户';
                        $emailTime = date('Y-m-d H:i:s',$res['add_time']);
                        $name = $res['name'];
                        $email = $res['email'];
                        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                                    &nbsp; &nbsp; &nbsp; 欢迎使用莫里云对冲系统
                                    <br/>
                                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的申请后台管理账户审核未通过。请您登录会员中心查看详情。<br/>

                                    <br/><br/><br/><br/>
                                   此为系统邮件请勿回复';


                        break;
                    case 1:
                        //交易者账号申请成功发送邮件通知客户
                        $fields = ['name','email','add_time'];
                        $res = $this->user->field($fields)->where(['id'=>$uid])->find();
                        $title = '账户申请开户';
                        $emailTime = date('Y-m-d H:i:s',$res['add_time']);
                        $name = $res['name'];
                        $email = $res['email'];
                        $url = 'http://'.$_SERVER['SERVER_NAME'].url('trader/Login/index');
                        $msg = '尊敬的'.$name.'，您好！<br/><br/>
                                    &nbsp; &nbsp; &nbsp; 欢迎使用莫里云对冲系统
                                    <br/>
                                    &nbsp; &nbsp; &nbsp; 您于'.$emailTime.'的申请后台管理账户已经开设成功。请登录网址：'.$url.' 查看详情。<br/>
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
}