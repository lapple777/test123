<?php
namespace app\ib\controller;

use think\Controller;
use think\Db;
//IB登录管理
class Login extends Controller{
    public function index(){
        if(request()->isPost()){
            $input = input();
            $validate  = new \app\common\validate\IBLoginVerify();
            $result = $validate->scene('login')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            $where = [
                'phone'=>$input['phone']
            ];
            $fields = [
                'phone','password','ib_status','username','wallet','id'
            ];
            $result = Db::name('ib')->field($fields)->where($where)->find();
            if(!$result){
                $this->error('手机号不存在');
            }else{
                if($result['ib_status']==0){
                    $this->error('用户禁止登陆');
                }else if(md5(trim($input['password']))!= $result['password']){
                    $this->error('密码错误');
                }else{
                    session('IBUser',$result['username']);
                    session('IBWallet',$result['wallet']);
                    session('IBId',$result['id']);
                    $this->success('登陆成功','/ib');
                }
            }
        }
        return $this->fetch('login');
    }

    //IB退出操作
    public function logout(){
        session('IBUser',null);
        $url = url('/ib/Login/index');
        $this->redirect($url);
    }
    //修改密码
    public function modify_pwd(){
        if(request()->isPost()) {
            $input = input();
            $where = [
                'id'=>session('IBId')
            ];
            $fields = [
                'password','id'
            ];
//            dump($input);
            $res = Db::name('ib')->field($fields)->where($where)->find();
            if(!$res){
                $this->error('用户不存在');
            }else{
                if(md5(trim($input['oldPwd']))!=$res['password']){
                    $this->error('密码错误');
                }else{
                    $data = [
                        'password'=>md5(trim($input['repeatPwd']))
                    ];
                    $res = Db::name('ib')->where($where)->update($data);
                    if(!$res){
                        $this->error('修改密码失败');
                    }else{
                        session('IBUser',null);
                        session('IBWallet',null);
                        session('IBId',null);
                        $url = url('ib/Login/index');
                        $this->success('修改密码成功',$url);
                    }
                }
            }
        }
        return $this->fetch('modify-pwd');
    }
}