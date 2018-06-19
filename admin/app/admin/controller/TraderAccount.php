<?php
namespace app\admin\controller;
use app\admin\model\User;
use app\common\validate\AdminTraderAccount;
//交易者账号管理
class TraderAccount extends Common{
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }
    //交易者账号列表
    public function accounts_list(){
        $fields = [
            'username','name','bank_card','phone',
            'email','id_card','add_time','id',
            'user_status'
        ];

        $result = $this->user->field($fields)->where('user_status = 1')->whereOr('user_status = 2')->paginate(10);
        $data = [
            'account_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('accounts-list');
    }

    //交易者账号申请列表
    public function account_sq_list(){
        if(request()->isPost()){
            $input = input();
            $type = $input['status'];
            $uid = $input['id'];
            switch($type){
                case 0:
                    $status = 3;
                    break;
                case 1:
                    $status = 1;
                    break;
            }
            $data = [
                'user_status'=>$status,
                'success_time'=>time()
            ];
            $where = [
                'id'=>$uid
            ];
            $res = $this->user->where($where)->update($data);
            if($res){
                $this->success('处理成功');
            }else{
                $this->error('处理失败');
            }

        }
        $fields = [
            'id','username','name','bank_card',
            'phone','email','id_card','add_time', 'user_status'
        ];
        $where = [
            'user_status'=>0
        ];
        $whereor = [
            'user_status'=>3
        ];
        $result = $this->user->field($fields)->where($where)->whereOr($whereor)->paginate(10);

        $data = [
            'account_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('accounts-sq-list');
    }
    //交易者账号编辑
    public function account_edit(){
        if(request()->isPost()){
            $input = input();
            $validate = new AdminTraderAccount();
            $result = $validate->scene('edit')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            $where = [
                'id'=>$input['id']
            ];
            if($input['password'] == ''){
                $data = [
                    'username'=>trim($input['username']),
                    'name'=>trim($input['name']),
                    'phone'=>trim($input['phone']),
                    'email'=>trim($input['email']),
                    'id_card'=>trim($input['id_card']),
                    'bank_card'=>trim($input['bank_card']),
                    'user_status'=>trim($input['user_status']),
                    'wallet'=>trim($input['wallet']),
                ];
            }else{
                $data = [
                    'username'=>trim($input['username']),
                    'password'=>md5(trim($input['password'])),
                    'name'=>trim($input['name']),
                    'phone'=>trim($input['phone']),
                    'email'=>trim($input['email']),
                    'id_card'=>trim($input['id_card']),
                    'bank_card'=>trim($input['bank_card']),
                    'user_status'=>trim($input['user_status']),
                    'wallet'=>trim($input['wallet']),
                ];
            }
            $res = $this->user->where($where)->update($data);
            if($res){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }

        }
        $input = input();
        $id = $input['id'];
        $where = [
            'id'=>$id
        ];
        $fields = [
            'id','username','name','phone','email',
            'id_card','bank_card','wallet','user_status'
        ];
        $result = $this->user->field($fields)->where($where)->find();
        if(!$result){
            $this->error('账号异常');
        }
        $data = [
            'account'=>$result
        ];
        $this->assign($data);
        return $this->fetch('account-edit');
    }
}