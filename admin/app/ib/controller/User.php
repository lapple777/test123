<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/11
 * Time: 15:31
 */

namespace app\ib\controller;

//账户信息
use app\admin\model\IB;

class User extends Common {
    private $ib;
    public function __construct()
    {
        parent::__construct();
        $this->ib = new IB();
    }
    //获取当前IB的用户信息
    public function user_info(){
        $fields  = [
            'phone','name','wallet','bank_card','id_card','email','username','password','orange_key'
        ];
        $where = [
            'id'=>session('IBId')
        ];
        $result = $this->ib->field($fields)->where($where)->find();
        $data = [
            'user_info'=>$result
        ];

        $this->assign($data);
        return $this->fetch('user-info');
    }
    //编辑IB基本信息
    public function ib_edit(){
        if(request()->isPost()){
            $input = input();
            $validate = new \app\common\validate\IBVerify();
            $result = $validate->scene('edit')->check($input);
            if (!$result){
                $this->error($validate->getError());
            }else{
                //检查用户名是否注册
                $where = [
                    'username'=>$input['username'],
                    'id'=>['neq',session('IBId')]
                ];
                $res = $this->ib->where($where)->find();
                if($res){
                    $this->error('用户名已存在');
                }
                //检查手机号是否注册
                $where = [
                    'phone'=>$input['phone'],
                    'id'=>['neq',session('IBId')],
                ];
                $res = $this->ib->where($where)->find();
                if($res){
                    $this->error('手机号已存在');
                }
                $data = [
                    'username'=>$input['username'],
                    'name'=>$input['name'],
                    'phone'=>$input['phone'],
                    'email'=>$input['email'],
                    'id_card'=>$input['id_card'],
                    'bank_card'=>$input['bank_card'],
                ];
                $result = $this->ib->where(['id'=>session('IBId')])->update($data);
                if($result){
                    session('IBUser',$input['username']);
                    $this->success('修改成功');
                }else{
                    $this->error('修改失败');
                }
            }
        }
    }
}