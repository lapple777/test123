<?php
namespace app\admin\controller;
use think\Validate;
use app\admin\model\IB;
use app\admin\model\User;
use app\api\controller\Common;
//IB管理
class IBManage extends Common{
    private $ib;
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->ib = new IB();
        $this->user = new User();
    }

    //IB列表
    public function ib_list(){
        $fields = [
            'id','username','name',
            'phone','email','wallet',
            'orange_key','add_time',
            'ib_status','id_card','bank_card'
        ];
        $result = $this->ib->field($fields)->select();
        $data = [
            'ib_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('ib-list');
    }
    //添加IB
    public function ib_add(){
        if(request()->isPost()){
            $input = input();
            $validate = new \app\common\validate\IBVerify();
            $result = $validate->scene('add')->check($input);
            if(true !== $result){
                $this->error($validate->getError());
            }else{
                $where = [
                    'username'=>trim($input['username'])
                ];
                $res = $this->ib->where($where)->find();
                if($res){
                    $this->error('IB已存在');
                }
                $where = [
                    'phone'=>trim($input['phone'])
                ];
                $res = $this->ib->where($where)->find();
                if($res){
                    $this->error('手机号已注册');
                }
                //推荐码
                $orange_key = Common::getSort();
                $data = [
                    'username'=>trim($input['username']),
                    'name'=>trim($input['name']),
                    'phone'=>trim($input['phone']),
                    'email'=>trim($input['email']),
                    'wallet'=>trim($input['wallet']),
                    'password'=>md5(trim($input['password'])),
                    'add_time'=>time(),
                    'orange_key'=>$orange_key,
                    'id_card'=>trim($input['id_card']),
                    'bank_card'=>trim($input['bank_card']),
                    'ib_status'=>'1'
                ];
                $result = $this->ib->insert($data);
                if($result){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }
            return;
        }
        return $this->fetch('ib-add');
    }
    //编辑IB
    public function ib_edit(){
        if(request()->isPost()){
            $input = input();
            $validate = new \app\common\validate\IBVerify();
            $result = $validate->scene('edit')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }else{
                //检查用户名是否注册
                $where = [
                    'username'=>$input['username'],
                    'id'=>['neq',$input['ib_id']]
                ];
                $res = $this->ib->where($where)->find();
                if($res){
                    $this->error('用户名已存在');
                }
                //检查手机号是否注册
                $where = [
                    'phone'=>$input['phone'],
                    'id'=>['neq',$input['ib_id']]
                ];
                $res = $this->ib->where($where)->find();
                if($res){
                    $this->error('手机号已存在');
                }

                if($input['password'] == ''){
                    $data = [
                        'username'=>$input['username'],
                        'name'=>$input['name'],
                        'phone'=>$input['phone'],
                        'email'=>$input['email'],
                        'id_card'=>$input['id_card'],
                        'bank_card'=>$input['bank_card'],
                        'wallet'=>$input['wallet'],
                        'ib_status'=>$input['ib_status'],
                    ];
                }else{
                    $data = [
                        'username'=>$input['username'],
                        'name'=>$input['name'],
                        'phone'=>$input['phone'],
                        'email'=>$input['email'],
                        'id_card'=>$input['id_card'],
                        'bank_card'=>$input['bank_card'],
                        'wallet'=>$input['wallet'],
                        'ib_status'=>$input['ib_status'],
                        'password'=>md5(trim($input['password']))
                    ];
                }
                $result = $this->ib->where(['id'=>$input['ib_id']])->update($data);
                if($result){
                    $this->success('修改成功');
                }else{
                    $this->error('修改失败');
                }
            }
        }
        $input = input();
        $where = [
            'id'=>$input['ib_id']
        ];
        $fields = [
            'id','username','name','phone',
            'email','wallet','ib_status','id_card','bank_card'
        ];
        $result = $this->ib->field($fields)->where($where)->find();
        $data = [
            'ib'=>$result
        ];
        $this->assign($data);
        return $this->fetch('ib-edit');
    }
    //删除IB
    public function ib_del(){
        $input = input();
        $ib_id = $input['ib_id'];
        $where = [
            'ib_id'=>$ib_id
        ];
        $result = $this->user->field('id')->where($where)->count();
        if($result){
            $this->error('当前Ib下有客户,无法删除');
        }
        $where = [
            'id'=>$ib_id
        ];
        $result = $this->ib->field('wallet')->where($where)->find();
        if($result['wallet']>0){
            $this->error('该IB还有账户余额,无法删除');
        }
        $result = $this->ib->where($where)->delete();
        if($result){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }

    }

}