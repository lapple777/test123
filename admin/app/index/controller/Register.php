<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\IB;
use app\index\model\User;
use think\Validate;
use app\api\controller\Common;

class Register extends Controller{
    private $ib;
    private $user;
    private $ib_id;
    public function __construct()
    {
        parent::__construct();
        $this->ib = new IB();
        $this->user = new User();
    }

    public function index(){
        if(!input('orangeKey')){
            $this->error('无法注册，请联系管理员获取注册链接','index/Login/login');
        }
        //推荐码
        $orangeKey = input('orangeKey');
        //根据推荐码获取IB的id
        $where = [
            'orange_key'=>$orangeKey
        ];
        $result = $this->ib->field('id,ib_status')->where($where)->find();
        if(!$result){
            $this->error('注册码不存在');
        }else if($result['ib_status'] == 0){
            $this->error('当前IB状态异常');
        }
        return $this->fetch('index/register');

    }
    public function register(){
        //提交注册
        if(request()->isPost()){
            if(!input('orangeKey')){
                $this->error('无法注册，请联系管理员获取注册链接','index/Login/login');
            }
            //推荐码
            $orangeKey = input('orangeKey');
            //根据推荐码获取IB的id
            $where = [
                'orange_key'=>$orangeKey
            ];
            $result = $this->ib->field('id,ib_status')->where($where)->find();
            if($result){
                if($result['ib_status'] == 0){
                    $this->error('当前IB状态异常');
                }
                $this->ib_id = $result['id'];
            }else{
                $this->error('注册码不存在');
            }

            $input = input();

            $validate = new \app\common\validate\RegisterVerify();
            $result = $validate->scene('register')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            //验证身份证号
//            $res = Common::validation_filter_id_card($input['id_card']);
//            if(!$res){
//                $this->error('身份证号格式不正确');
//            }
            //验证银行卡号
            $ress = Common::check_bankCard($input['bank_card']);
            if(!$ress){
                $this->error('银行卡号格式不正确');
            }
            //检查用户名是否注册
            if($this->checkUser($input['username'])){
                $this->error('用户名已存在');
            }
            //检测手机号是否注册
            if($this->checkPhone($input['phone'])){
                $this->error('手机号已注册');
            }
            $data = [
                'username'=>trim($input['username']),
                'name'=>trim($input['name']),
                'phone'=>trim($input['phone']),
                'email'=>trim($input['email']),
                'id_card'=>trim($input['id_card']),
                'bank_card'=>trim($input['bank_card']),
                'address'=>trim($input['address']),
                'male'=>trim($input['male']),
                'birthday'=>trim($input['birthday']),
                'password'=>md5(trim($input['password'])),
                'ib_id'=>$this->ib_id,
                'add_time'=>time(),
            ];
            $result = $this->user->insertGetId($data);
            if($result){
                //向admin发送注册审核通知邮件
//                $msg = '【用户注册】用户ID为：'.$result.' 姓名为：'.$data['username'].'，请尽快审核！';
//                $mail = new \app\api\controller\SendMail();
//                $mail->send($msg,0);

                $url = url('trader/login/index');
                $this->success('注册成功，请等待审核通过',$url);
            }else{
                $this->error('注册失败');
            }
            return;
        }
    }
    //检查用户是否存在
    public function checkUser($username){
        $where = [
            'username'=>$username
        ];
        $res = $this->user->where($where)->find();
        if($res){
            return true;
        }else{
            return false;
        }
    }
    //检查手机号是否存在
    public function checkPhone($phone){
        $where = [
            'phone'=>$phone
        ];
        $res = $this->user->where($where)->find();
        if($res){
            return true;
        }else{
            return false;
        }
    }
}