<?php
namespace app\trader\controller;
use app\trader\model\TraderUser;
use app\trader\model\User;
class Trader extends Common{
    private $TraderUser;
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->TraderUser = new TraderUser();
        $this->user = new User();
    }

    //交易员列表
    public function trader_list(){
        $where = [
            'user_id'=>session('traderId')
        ];
        $result = $this->TraderUser->where($where)->select();
        $data = [
            'trader_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('trader-list');
    }
    //修改密码
    public function changePwd(){
        $input = input();
        //var_dump($input);die;
        $where = [
            'account'=>$input['account']
        ];
        $result = $this->TraderUser->where($where)->find();
        if(!$result){
            $this->error('账户不存在');
        }else{
            $data = [
                'password'=>md5(trim($input['password']))
            ];
            $result = $this->TraderUser->where($where)->update($data);
            if($result){
                $this->success('密码修改成功');
            }else{
                $this->error('密码修改失败');
            }
        }
    }
    //交易账户申请
    public function traderUserGet(){
        $account = self::getAccount();//获取账号
        $password = 12345678;//默认密码

        $data = [
            'account'=>$account,
            'password'=>md5(trim($password)),
            'user_id'=>session('traderId'),
            'add_time'=>time()
        ];
        $res = $this->TraderUser->insert($data);
        if($res){
            $userResult = $this->user->field('name')->where(['id'=>session('traderId')])->find();
            $title = '提示管理员审核';
            $msg = $userResult['name'].'提交交易账号申请，请及时审核。';
            $mail = new \app\api\controller\SendMail();
            $mail->send($title,$msg,0);

            $this->success('申请已提交成功');
        }else{
            $this->success('申请提交失败');
        }
    }
    //随机生成交易账号
    public function getAccount($length = 8){
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $account ='';
        for ( $i = 0; $i < $length; $i++ )
        {
            $account .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        $where = [
            'account'=>$account
        ];
        $result = $this->TraderUser->where($where)->find();
        if($result){
            $this->getAccount();
        }
        return $account;
    }
}