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
                'username','password','status','id'
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
                    session('adminUserId',$result['id']);
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
}