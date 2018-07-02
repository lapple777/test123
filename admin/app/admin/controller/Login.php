<?php 
namespace app\admin\controller;

use think\Controller;
use think\Db;
//登录管理
class Login extends Controller{
	public function index(){
		if(request()->isPost()){
			$input = input();
			$validate = new \app\common\validate\AdminLoginVerify();
			$result = $validate->scene('login')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            $where = [
                'username'=>$input['username']
            ];
            $fields = [
                'username','password','status'
            ];
            $result = Db::name('admin')->field($fields)->where($where)->find();
            if(!$result){
                $this->error('用户不存在');
            }else{
                if($result['status'] == 0){
                    $this->error('用户禁止登陆');
                }else if(md5(trim($input['password'])) != $result['password']){
                    $this->error('密码错误');
                }else{
                    session('adminUser',$input['username']);
                    $this->success('登陆成功','/admin');
                }
            }
		}
		return $this->fetch('login');
	}
    //退出登录
    public function logout(){
        session('adminUser',null);
        $url = url('/admin/Login/index');
        $this->redirect($url);
    }
    //修改密码
    public function modify_pwd(){
        if(request()->isPost()){
            $input = input();
            if(empty($input['oldPwd'])){
                $this->error('请输入密码');
            }
            $where = [
                'username'=>session('adminUser')
            ];

            $res = Db::name('admin')->field('password')->where($where)->find();
            if($res['password']!=md5(trim($input['oldPwd']))){
                $this->error('密码错误');
            }else{
                $data = [
                    'password'=>md5(trim($input['password']))
                ];
                $res = Db::name('admin')->where($where)->update($data);
                if(!$res){
                    $this->error('修改密码失败');
                }else{
                    session('adminUser',null);
                    $url = url('admin/Login/index');
                    $this->success('修改密码成功',$url);
                }
            }
        }
        return $this->fetch('modify-pwd');
    }
}