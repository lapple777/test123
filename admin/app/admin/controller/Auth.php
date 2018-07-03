<?php
namespace app\admin\controller;
use app\admin\model\AdminAuthRule;
use think\Nx\Data;
//权限管理
class Auth extends Common{
    private $rule;
    public function __construct(){
        parent::__construct();
        $this->rule = new AdminAuthRule();
    }
    //权限列表
    public function auth_list(){
        $authList = $this->rule->select();
        $res=Data::tree($authList,'title','id','pid');

        $data = [
            'authList'=>$res
        ];
        $this->assign($data);
        return $this->fetch('auth-list');
    }
    //添加权限
    public function add_auth(){
        if(request()->isPost()){
            $input = input();
            $valiadte = new \app\common\validate\AdminAuthVerify();
            $result = $valiadte->scene('authVerify')->check($input);
            if(!$result){
                $this->error($valiadte->getError());
            }else{
                $name = $input['authname'];
                $url = $input['auth'];
                $res = $this->rule->where('title = "'.$name.'" or name = "'.$url.'"')->find();
                if($res){
                    $this->error('权限名或权限标识已存在');
                }
                $data = [
                    'title'=>$name,
                    'name'=>$url
                ];
                $res = $this->rule->insert($data);
                if($res){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }
        }
        return $this->fetch('auth-add');
    }
    //添加子权限
    public function add_child_auth(){
        if(request()->isPost()){
            $input = input();
            $valiadte = new \app\common\validate\AdminAuthVerify();
            $result = $valiadte->scene('authVerify')->check($input);
            if(!$result){
                $this->error($valiadte->getError());
            }else{
                $pid = $input['pid'];
                $name = $input['authname'];
                $url = $input['auth'];
                $res = $this->rule->where('title = "'.$name.'" or name = "'.$url.'"')->find();
                if($res){
                    $this->error('权限名或权限标识已存在');
                }
                $data = [
                    'pid'=>$pid,
                    'title'=>$name,
                    'name'=>$url
                ];
                $res = $this->rule->insert($data);
                if($res){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }
        }
        $input = input();
        $data = [
            'pid'=>$input['id']
        ];
        $this->assign($data);
        return $this->fetch('auth-child-add');
    }
    //编辑权限
    public function edit_auth(){
        if(request()->isPost()){
            $input = input();
            $validate = new \app\common\validate\AdminAuthVerify();
            $result = $validate->scene('authVerify')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }else{
                $id = $input['aid'];
                $name = $input['authname'];
                $url = $input['auth'];
                $res = $this->rule->where('(title = "'.$name.'" or name = "'.$url.'") and id != '.$id)->find();
                if($res){
                    $this->error('权限名或权限标识已存在');
                }
                $data = [
                    'title'=>$name,
                    'name'=>$url
                ];
                $result = $this->rule->where(['id'=>$id])->update($data);
                if($result){
                    $this->success('修改成功');
                }else{
                    $this->error('修改失败');
                }
            }

        }
        $input = input();
        $id = $input['id'];
        $res = $this->rule->where(['id'=>$id])->find();
        $data = [
            'auth'=>$res
        ];
        $this->assign($data);
        return $this->fetch('auth-edit');
    }
    //删除权限
    public function del_auth(){
        $input = input();
        $id = $input['id'];
        $result = $this->rule->where(['pid'=>$id])->find();
        if($result){
            $this->error('请先删除所有子权限，再删除此菜单');
        }else{
            $res = $this->rule->where(['id'=>$id])->delete();
            if($res){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }
    }
}