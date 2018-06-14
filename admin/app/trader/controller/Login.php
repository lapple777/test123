<?php 
namespace app\trader\controller;

use think\Controller;
use think\Db;
//登录管理
class Login extends Controller{
	public function index(){
		if(request()->isPost()){
			$input = input();
			$validate = new \app\common\validate\LoginVerify();
			$result = $validate->scene('login')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            $where = [
                'phone'=>$input['phone']
            ];
            $fields = [
                'phone','password','user_status','username','id'
            ];
            $result = Db::name('user')->field($fields)->where($where)->find();
            if(!$result){
                $this->error('用户不存在');
            }else{
                if($result['user_status'] == 0){
                    $this->error('用户正在审核中，暂时无法登陆');
                } else if($result['user_status'] == 2){
                    $this->error('用户禁止登陆');
                }else if(md5(trim($input['password'])) != $result['password']){
                    $this->error('密码错误');
                }else{
                    session('traderUser',$result['username']);
                    session('traderId',$result['id']);
                    $this->success('登陆成功','/trader');
                }
            }
		}
		return $this->fetch('login');
	}
    //退出登录
    public function logout(){
        session('traderUser',null);
        session('traderId',null);
        $url = url('trader/Login/index');
        $this->redirect($url);
    }
}