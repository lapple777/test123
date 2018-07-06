<?php
namespace app\trader\controller;

use app\trader\model\User;
use app\trader\model\UserInfoChange;
use think\Validate;
use think\Db;

class Account extends Common{
    private $user;
    private $userInfoChange;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
        $this->userInfoChange = new UserInfoChange();
    }

    //账户信息
    public function account_info(){
        $where = [
            'id'=>session('traderId')
        ];
        $fields = [
            'id','wallet','username','name','phone','email',
            'id_card','bank_card','add_time','open_bank',
            'address','birthday','male','id_card_zm','id_card_fm',
            'bank_card_zm','bank_card_fm','user_status'
        ];
        $res = $this->user->field($fields)->where($where)->find();
        $data = [
            'account'=>$res
        ];
        $this->assign($data);
        return $this->fetch('account-info');
    }
    public function account_case(){
        return $this->fetch('account-case');
    }

    public function edit_account(){
        if(request()->isPost()){
            $input = input();
            $validate = new \app\common\validate\AccountVerify();
            $result = $validate->scene('accountEdit')->check($input);
            if(!$result){
                $this->error($validate->getError());
            }
            $fields = [
                'username','name','phone',
                'email','id_card','bank_card',
                'address','birthday','male',
                'open_bank','id_card_zm',
                'id_card_fm','bank_card_zm',
                'bank_card_fm','user_status'
            ];
            $res = $this->user->field($fields)->where(['id'=>$input['id']])->find();
            if($res['user_status'] == 4){
                $this->error('信息修改正在审核中,请不要重复提交');
            }
            $params = [
                'username'      => $res['username'],
                'name'          => $res['name'],
                'phone'         => $res['phone'],
                'email'         => $res['email'],
                'id_card'       => $res['id_card'],
                'bank_card'     => $res['bank_card'],
                'address'       => $res['address'],
                'birthday'      => $res['birthday'],
                'male'          => $res['male'],
                'open_bank'     => $res['open_bank'],
                'id_card_zm'    => $res['id_card_zm'],
                'id_card_fm'    => $res['id_card_fm'],
                'bank_card_zm'  => $res['bank_card_zm'],
                'bank_card_fm'  => $res['bank_card_fm'],
            ];
            $ll = json_encode($params);

            $md5 = md5($ll);
            //检查用户名是否注册
            if($this->checkUser($input['username'],$input['id'])){
                $this->error('用户名已存在');
            }
            //检测手机号是否注册
            if($this->checkPhone($input['phone'],$input['id'])){
                $this->error('手机号已注册');
            }
            //获取表单上传文件
            $idCardZm = request()->file('IdCardZm');
            $idCardFm = request()->file('IdCardFm');
            $bankCardZm = request()->file('bankCardZm');
            $bankCardFm = request()->file('bankCardFm');
            $id_card_zm = '';
            $id_card_fm = '';
            $bank_card_zm = '';
            $bank_card_fm = '';
            if($idCardZm){
                $infoIdZm= $idCardZm->move(ROOT_PATH.'public'.DS.'uploads');
                if($infoIdZm){
//                    echo $infoIdZm->getSaveName();
                    $id_card_zm = $infoIdZm->getSaveName();
                }else{
//                    echo $infoIdZm->getError();
                    $this->error('上传银身份证正面失败');
                }
            }else{
                if($input['idFm']){

                }else{
                    $this->error('请上传身份证正面面');
                }

            }
            if($idCardFm){
                $infoIdFm  = $idCardFm->move(ROOT_PATH.'public'.DS.'uploads');
                if($infoIdFm){
//                    echo $infoIdFm->getSaveName();
                    $id_card_fm = $infoIdFm->getSaveName();
                }else{
//                    echo $idCardFm->getError();
                    $this->error('上传身份证反面失败');
                }
            }else{
                if($input['idZm']){

                }else{
                    $this->error('请上传身份证反面');
                }

            }

            if($bankCardZm){
                $infoBarkZm = $bankCardZm->move(ROOT_PATH.'public'.DS.'uploads');
                if($infoBarkZm){
//                    echo $infoBarkZm->getSaveName();
                    $bank_card_zm = $infoBarkZm->getSaveName();
                }else{
//                  echo $infoBarkZm->getError();
                    $this->error('上传银行卡正面失败');
                }
            }else{
                if($input['barkZm']){

                }else{
                    $this->error('请上传银行卡正面');
                }

            }
            if($bankCardFm){
                $infoBarkFm = $bankCardFm->move(ROOT_PATH.'public'.DS.'uploads');
                if($infoBarkFm){
//                    echo $infoBarkFm->getSaveName();
                    $bank_card_fm = $infoBarkFm->getSaveName();
                }else{
                    echo $infoBarkFm->getError();
                    $this->error('上传银行卡反面失败');
                }
            }else{
                if($input['barkFm']){

                }else{
                    $this->error('请上传银行卡反面');
                }

            }
            $data = [
                'username'=>trim($input['username']),
                'name'=>trim($input['name']),
                'phone'=>trim($input['phone']),
                'email'=>trim($input['email']),
                'id_card'=>trim($input['id_card']),
                'bank_card'=>trim($input['bank_card']),
                'address'=>trim($input['address']),
                'birthday'=>trim($input['birthday']),
                'male'=>trim($input['male']),
                'open_bank'=>trim($input['open_bank']),
                'add_time'=>time(),
                'user_id'=>$input['id']
            ];
            //身份证正面
            if($idCardZm){
                $data['id_card_zm'] = str_replace("\\","/",$id_card_zm);
            }else{
                $data['id_card_zm'] = str_replace("\\","/",$input['idZm']);
            }
            //身份证反面
            if($idCardFm){
                $data['id_card_fm'] = str_replace("\\","/",$id_card_fm);
            }else{
                $data['id_card_fm'] = str_replace("\\","/",$input['idFm']);
            }
            //银行卡正面
            if($bankCardZm){
                $data['bank_card_zm'] = str_replace("\\","/",$bank_card_zm);
            }else{
                $data['bank_card_zm'] = str_replace("\\","/",$input['barkZm']);
            }
            //银行卡反面
            if($bankCardFm){
                $data['bank_card_fm'] = str_replace("\\","/",$bank_card_fm);
            }else{
                $data['bank_card_fm'] = str_replace("\\","/",$input['barkFm']);
            }

            //判断用户信息是否存在修改


            $info = [
                'username'=>trim($input['username']),
                'name'=>trim($input['name']),
                'phone'=>trim($input['phone']),
                'email'=>trim($input['email']),
                'id_card'=>trim($input['id_card']),
                'bank_card'=>trim($input['bank_card']),
                'address'=>trim($input['address']),
                'birthday'=>trim($input['birthday']),
                'male'=>trim($input['male']),
                'open_bank'=>trim($input['open_bank']),
                'id_card_zm'=>$data['id_card_zm'],
                'id_card_fm'=>$data['id_card_fm'],
                'bank_card_zm'=>$data['bank_card_zm'],
                'bank_card_fm'=>$data['bank_card_fm'],

            ];
            if($md5 == md5(json_encode($info))){
                $this->error('信息未修改请不要提交');
            }
            Db::startTrans();
            try{
                $this->userInfoChange->insert($data);
                $params = [
                    'user_status'=>4
                ];
                $this->user->where(['id'=>$input['id']])->update($params);
                Db::commit();
            }catch(\Exception $e){
                Db::rollback();
                $this->error('提交失败');
            }
            $this->success('提交成功,请等待审核');

        }
    }
    //检查用户是否存在
    public function checkUser($username,$id){
        $where = [
            'username'=>$username
        ];
        $res = $this->user->where('id','not in',$id)->where($where)->find();
        if($res){
            return true;
        }else{
            return false;
        }
    }
    //检查手机号是否存在
    public function checkPhone($phone,$id){
        $where = [
            'phone'=>$phone
        ];
        $res = $this->user->where('id','not in',$id)->where($where)->find();
        if($res){
            return true;
        }else{
            return false;
        }
    }
}