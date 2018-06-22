<?php
namespace app\trader\controller;

use app\trader\model\User;
use think\Validate;
class Account extends Common{
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
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
            'bank_card_zm','bank_card_fm'
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
            if($idCardFm){
                $infoIdFm  = $idCardFm->move(ROOT_PATH.'public'.DS.'uploads');
                if($infoIdFm){
//                    echo $infoIdFm->getSaveName();
                    $id_card_zm = $infoIdFm->getSaveName();
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
            if($idCardZm){
                $infoIdZm= $idCardZm->move(ROOT_PATH.'public'.DS.'uploads');
                if($infoIdZm){
//                    echo $infoIdZm->getSaveName();
                    $id_card_fm = $infoIdZm->getSaveName();
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
                'user_status' =>'4'
            ];
            if($idCardZm){
                $data['id_card_zm'] = $id_card_zm;
            }
            if($idCardFm){
                $data['id_card_fm']=$id_card_fm;
            }
            if($bankCardZm){
                $data['bank_card_zm']=$bank_card_zm;
            }
            if($bankCardFm){
                $data['bank_card_fm']=$bank_card_fm;
            }
            $where = [
                'id'=> $input['id']
            ];
            $result = $this->user->where($where)->update($data);
            if ($result){
                $this->success('提交成功,请等待审核');
            }else{
                $this->error('提交失败');
            }
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