<?php
namespace app\admin\controller;

use app\admin\model\User;
use app\admin\model\UserInfoChange;
use think\Db;
class UserInfoAudit extends Common{
    private  $user;
    private $userInfoChange;
    public function __construct(){
        parent::__construct();
        $this->user  = new User();
        $this->userInfoChange = new UserInfoChange();
    }

    //user账户信息列表
    public function traderInfo_audit(){
        if(request()->isPost()) {
            $input = input();
            $type = $input['status'];
            $id = $input['id'];
            $where = [
                'id'=>$id
            ];
            $fields = [
                'id','status','user_id','username',
                'name','bank_card','phone','email',
                'id_card','id_card_zm','id_card_fm',
                'bank_card_zm','bank_card_fm','open_bank',
                'address','male','birthday',
            ];
            $res = $this->userInfoChange->field($fields)->where($where)->find();
            if($res){
                if($res['status'] != 0){
                    $this->error('信息已审核');
                }
                switch ($type) {
                    case 1:
                        $status = 1;
                        $user_status = 1;
                        $datas = [
                            'username'      => $res['username'],
                            'name'          => $res['name'],
                            'bank_card'     => $res['bank_card'],
                            'phone'         => $res['phone'],
                            'email'         => $res['email'],
                            'id_card'       => $res['id_card'],
                            'id_card_zm'    => $res['id_card_zm'],
                            'id_card_fm'    => $res['id_card_fm'],
                            'bank_card_zm'  => $res['bank_card_zm'],
                            'bank_card_fm'  => $res['bank_card_fm'],
                            'open_bank'     => $res['open_bank'],
                            'address'       => $res['address'],
                            'male'          => $res['male'],
                            'birthday'      => $res['birthday'],
                        ];
                        break;
                    case 5:
                        $status = 2; //信息审核不通过
                        $user_status = 5;
                        break;
                }
                $data = [
                    'status' =>$status
                ];
                $datas['user_status'] = $user_status;
                Db::startTrans();
                try{
                    $this->userInfoChange->where($where)->update($data);
                    $this->user->where(['id'=>$res['user_id']])->update($datas);
                    Db::commit();
                }catch(\Exception $e){
                    Db::rollback();
                    $this->error('审核失败');
                }
                $this->success('审核成功');
            }else{
                $this->error('审核信息出错');
            }


        }

        $fields = [
            'username','name','bank_card','phone','email','id',
            'id_card','add_time','id_card_zm','id_card_fm',
            'bank_card_zm','bank_card_fm','open_bank','address','male','birthday','status'
        ];
        $res = $this->userInfoChange->field($fields)->paginate(10);
//        echo '<pre>';
//        dump($res);die;
        $data = [
            'traderInfo_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('traderInfo-edit');
    }
}