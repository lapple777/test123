<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/22
 * Time: 14:25
 */

namespace app\admin\controller;

use app\admin\model\User;
class UserInfoAudit extends Common{
    private  $user;
    public function __construct(){
        parent::__construct();
        $this->user  = new User();
    }

    //user账户信息列表
    public function traderInfo_audit(){
        if(request()->isPost()) {
            $input = input();

            $type = $input['status'];
            $uid = $input['id'];
            switch ($type) {
                case 1:
                    $status = 1;
                    break;
                case 3:
                    $status = 3;
                    break;
            }
            $data = [
                'user_status' =>$status
            ];
            $where = [
                'id'=>$uid
            ];
            $res = $this->user->where($where)->update($data);
            if($res){
                $this->success('审核成功');
            }else{
                $this->error('审核失败');
            }
        }
        $where  = [
            'user_status'=>'4'
        ];
        $fields = [
            'username','name','bank_card','phone','email','id',
            'id_card','add_time','id_card_zm','id_card_fm',
            'bank_card_zm','bank_card_fm','open_bank','address','male','birthday'
        ];
        $res = $this->user->field($fields)->where($where)->select();
        $data = [
            'traderInfo_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('traderInfo-edit');
    }
}