<?php
namespace app\admin\controller;
use app\admin\model\AdminAuthGroup;
use app\admin\model\AdminAuthGroupAccess;
use app\admin\model\AdminAuthRule;
use app\admin\model\AdminUser;
use think\Db;
use think\Nx\Data;
//用户组管理
class AuthGroup extends Common{
    private $group;
    private $groupaccess;
    private $adminUser;
    private $rule;
    public function __construct(){
        parent::__construct();
        $this->group = new AdminAuthGroup();
        $this->groupaccess = new AdminAuthGroupAccess();
        $this->adminUser = new AdminUser();
        $this->rule = new AdminAuthRule();
    }

    //用户组列表
    public function auth_group_list(){
        $fields = [
            'id','title'
        ];
        $res = $this->group->field($fields)->paginate(10);
        $data = [
            'group_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('auth-group-list');
    }
    //添加用户组
    public function add_group(){
        if(request()->isPost()){
            $input = input();
            if($input['groupname'] == ''){
                $this->error('请填写组名');
            }
            $Groupdata = [
                'title'=>$input['groupname']
            ];
            $res = $this->group->where($Groupdata)->find();
            if($res){
                $this->error('组名已存在');
            }else{
                if(isset($input['userid'])){
                    Db::startTrans();
                    try{

                        $group_id = $this->group->insertGetId($Groupdata);
                        $data = [];
                        foreach($input['userid'] as $id){
                            $data [] = [
                                'uid'=>$id,
                                'group_id'=>$group_id
                            ];
                        }
                        $this->groupaccess->insertAll($data);
                        Db::commit();
                    }catch(\Exception $e){
                        Db::rollback();
                        $this->error('添加失败');
                    }
                    $this->success('添加成功');
                }else{
                    $res = $this->group->insert($Groupdata);
                    if($res){
                        $this->success('添加成功');
                    }else{
                        $this->error('添加失败');
                    }
                }
            }

        }
        $fields = ['id','username'];
        $res = $this->adminUser->field($fields)->select();
        $data = [
            'userList'=>$res
        ];
        $this->assign($data);
        return $this->fetch('group-add');
    }
    //编辑用户组
    public function edit_group(){
        if(request()->isPost()){
            $input = input();
            $group_id = $input['id'];
            $title = $input['groupname'];
            if($title == ''){
                $this->error('请填写组名');
            }
            $groupWhere = [
                'title'=>$title,
                'id'=>['neq',$group_id]
            ];
            $updateWhere = [
                'id'=>$group_id
            ];
            $res = $this->group->where($groupWhere)->find();
            if($res){
                $this->error('用户组已存在');
            }else{
                if(isset($input['userid'])){
                    Db::startTrans();
                    try{
                        //删除组关系表所有数据
                        $this->groupaccess->where(['group_id'=>$group_id])->delete();
                        $data = [
                            'title'=>$title
                        ];
                        $this->group->where($updateWhere)->update($data);
                        $data = [];
                        foreach($input['userid'] as $id){
                            $data [] = [
                                'uid'=>$id,
                                'group_id'=>$group_id
                            ];
                        }
                        $this->groupaccess->insertAll($data);
                        Db::commit();
                    }catch(\Exception $e){
                        Db::rollback();
                        $this->error('修改失败');
                    }
                    $this->success('修改成功');
                }else{
                    Db::startTrans();
                    try{
                        //删除组关系表所有数据
                        $this->groupaccess->where(['group_id'=>$group_id])->delete();
                        $data = [
                            'title'=>$title
                        ];
                        $this->group->where($updateWhere)->update($data);
                        Db::commit();
                    }catch(\Exception $e){
                        Db::rollback();
                        $this->error('修改失败');
                    }
                    $this->success('修改成功');
                }
            }
        }
        $input = input();
        $id = $input['id'];
        //获取组名
        $groupRes = $this->group
                    ->alias('g')
                    ->field('title,aga.uid')
                    ->join('crm_auth_group_access aga','g.id = aga.group_id','left')
                    ->where(['g.id'=>$id])
                    ->select();
        $ids = [];
        foreach($groupRes as $group){
            $ids[] = $group['uid'];
        }
        $fields = ['id','username'];
        $res = $this->adminUser->field($fields)->select();
        $data = [
            'userList'=>$res,
            'group'=>$groupRes[0]['title'],
            'ids'=>$ids
        ];
        $this->assign($data);
        return $this->fetch('group-edit');
    }
    //删除用户组
    public function del_group(){
        $input = input();
        $group_id = $input['id'];
        $res = $this->groupaccess->where(['group_id'=>$group_id])->find();
        if($res){
            $this->error('当前用户组下存在用户禁止删除');
        }else{
            $res = $this->group->where(['id'=>$group_id])->delete();
            if($res){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }
    }
    //分配权限
    public function group_allot_auth(){
        if(request()->isPost()){
            $input = input();
            $id = $input['id'];
            $where = [
                'id'=>$id
            ];
            if(isset($input['rule_ids'])){
                $rules = $input['rule_ids'];
                $data['rules'] = implode(',',$rules);
            }else{
                $data['rules'] = '';
            }
            $res = $this->group->where($where)->update($data);
            if($res){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }

        }
        $input = input();
        $id = $input['id'];
        $groupAuthRes = $this->group->where(['id'=>$id])->find();
        if($groupAuthRes['rules']){
            $groupAuth = explode(',',$groupAuthRes['rules']);
        }else{
            $groupAuth = [];
        }
        // 获取规则数据
        $authList = $this->rule->select();
        $authList = Data::channelLevel($authList,0,'&nbsp;','id');

        $data = [
            'groupAuth'=>$groupAuth,
            'authList'=>$authList,
            'id'=>$id
        ];
        $this->assign($data);
        return $this->fetch('group-allot-auth');
    }
}