<?php
namespace app\admin\controller;
use app\admin\model\TraderUser;
//交易账号管理
class TransactionAccounts extends Common{
    private $traderUser;
    public function __construct()
    {
        parent::__construct();
        $this->traderUser = new TraderUser();
    }

    //交易账号列表
    public function accounts_list(){
        $fields = [
            'tu.id','user_id','account','tu.wallet',
            'tu.add_time', 'ta_status','tu.success_time',
            'u.name'
        ];
        $where = [
            'ta_status'=>1
        ];
        $whereor = [
            'ta_status'=>2
        ];
        $result = $this->traderUser->alias('tu')->field($fields)->join('crm_user u','tu.user_id = u.id','left')->where($where)->whereOr($whereor)->paginate(10);

        $data = [
            'account_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('accounts-list');
    }

    //交易账号申请列表
    public function account_sq_list(){
        if(request()->isPost()){
            $input = input();
            $type = $input['status'];
            $tid = $input['id'];
            switch($type){
                case 0:
                    $status = 3;
                    break;
                case 1:
                    $status = 1;
                    break;
            }
            $data = [
                'ta_status'=>$status,
                'success_time'=>time()
            ];
            $where = [
                'id'=>$tid
            ];
            $res = $this->traderUser->where($where)->update($data);
            if($res){
                $this->success('处理成功');
            }else{
                $this->error('处理失败');
            }

        }
        $fields = [
            'tu.id','user_id','account'
            ,'tu.add_time', 'ta_status','tu.success_time',
            'u.name'
        ];
        $where = [
            'ta_status'=>0
        ];
        $whereor = [
            'ta_status'=>3
        ];
        $result = $this->traderUser->alias('tu')->field($fields)->join('crm_user u','tu.user_id = u.id','left')->where($where)->whereOr($whereor)->paginate(10);

        $data = [
            'account_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('accounts-sq-list');
    }
    //交易账号编辑
    public function account_edit(){
        if(request()->isPost()){
            $input = input();
            $where = [
                'id'=>$input['id']
            ];
            if($input['password'] == ''){
                $data = [
                    'ta_status'=>$input['user_status'],
                    'wallet'=>$input['wallet']
                ];
            }else{
                $data = [
                    'password'=>md5(trim($input['password'])),
                    'ta_status'=>$input['user_status'],
                    'wallet'=>$input['wallet']
                ];
            }
            $res = $this->traderUser->where($where)->update($data);
            if($res){
                $this->success('修改成功');
            }else{
                $this->success('修改失败');
            }
        }
        $input = input();
        $id = $input['id'];
        $where = [
            'id'=>$id
        ];
        $fields = [
            'id','account','wallet','ta_status'
        ];
        $result = $this->traderUser->field($fields)->where($where)->find();
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