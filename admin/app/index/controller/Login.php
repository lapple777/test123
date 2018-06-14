<?php
namespace app\index\controller;

use think\Controller;

use app\index\model\TraderUser;
class Login extends Controller{
    //登陆
    public function login(){
        if(request()->isPost()){
            $input = input();
            //检测参数
            $this->checkParams($input);
        }
        return $this->fetch('index/login');
    }
    public function checkParams($data){
        $validate = new \app\common\validate\TraderLoginVerify();
        $result = $validate->scene('login')->check($data);
        if(!$result){
            $this->error($validate->getError());
        }else{
            $where = [
                'account'=>trim($data['account']),

            ];
            $fields = [
                'account','password',
                'ta_status','id'
            ];
            $user = new TraderUser();
            $res = $user->field($fields)->where($where)->find();
            if($res){
                if($res['ta_status'] == 0){
                    $this->error('账号正在审核中...');
                }else if($res['ta_status'] == 2){
                    $this->error('当前用户禁止登陆');
                }else if($res['password'] != md5(trim($data['password']))){
                    $this->error('密码错误');
                }else{
                    session('username',$res['account']);
                    session('userid',$res['id']);
                    $url = url('index/Index/index');
                    $this->success('登陆成功',$url);
                }
            }else{
                $this->error('账号不存在');
            }
        }
    }
    //退出
    public function loginOut(){
        session('username',null);
        $url = url('index/Login/login');
        $this->redirect($url);
    }
}