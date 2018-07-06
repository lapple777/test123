<?php
namespace app\admin\controller;
use app\admin\model\AdminUser;
//管理员管理
class Admin extends Common{
    private $adminuser;
    public function __construct(){
        parent::__construct();
        $this->adminuser = new AdminUser();
    }
    //管理员列表
    public function admin_list(){
        $fields = ['id','username','status','phone','email','add_time'];
        $res = $this->adminuser->field($fields)->paginate(10);
        $data = [
            'userList'=>$res
        ];
        $this->assign($data);
        return $this->fetch('admin-list');
    }
    //添加管理员
    public function admin_add(){
        if(request()->isPost()){
            $input = input();
            $username = trim($input['username']);
            $phone = trim($input['phone']);
            $email = trim($input['email']);
            $password = md5(trim($input['password']));
            $validate = new \app\common\validate\AdminUserVerify();
            $result = $validate->scene('addAdmin')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }else{
                $res = $this->adminuser->where(['username'=>$username])->find();
                if($res){
                    $this->error('用户名已存在');
                }
                $data = [
                    'username'=>$username,
                    'phone'=>$phone,
                    'email'=>$email,
                    'password'=>$password,
                    'add_time'=>time(),
                ];
               $res = $this->adminuser->insert($data);
                if($res){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }
        }
        return $this->fetch('admin-add');
    }
    //编辑管理员
    public function admin_edit(){
        if(request()->isPost()){
            $input = input();
            $id = trim($input['id']);
            $username = trim($input['username']);
            $phone = trim($input['phone']);
            $email = trim($input['email']);
            $password = trim($input['password']);
            $validate = new \app\common\validate\AdminUserVerify();
            $result = $validate->scene('editAdmin')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }else{
                $data = [
                    'username'=>$username,
                    'phone'=>$phone,
                    'email'=>$email,
                ];
                if($password != ''){
                    if(strlen($password) < 8){
                        $this->error('密码长度至少8位');
                    }
                    $pwd = md5($password);
                    $data['password'] = $pwd;
                }
                $res = $this->adminuser->where(['id'=>$id])->update($data);
                if($res){
                    $this->success('修改成功');
                }else{
                    $this->error('修改失败');
                }
            }

        }
        $input = input();
        $id = $input['id'];
        $fields = [
            'username','phone','email','id'
        ];
        $res = $this->adminuser->field($fields)->where(['id'=>$id])->find();
        $data = [
            'adminUser'=>$res
        ];
        $this->assign($data);
        return $this->fetch('admin-edit');
    }
    //删除管理员
    public function admin_del(){
        $input = input();
        $id = $input['id'];
        if($id == 1){
            $this->error('此管理员禁止删除');
        }
        $res = $this->adminuser->where(['id'=>$id])->delete();
        if($res){
            $this->success('删除成功');

        }else{
            $this->error('删除失败');
        }
    }
}