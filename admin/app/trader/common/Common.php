<?php
namespace app\trader\common;
use think\Controller;
use think\Db;
class Common extends Controller{
    //生成唯一账单号
    static public function getOrderId($table,$key){
        $orderId = date('YmdHis').rand(1000,9999);
        $where = [
            $key=>$orderId
        ];
        $result = Db::name($table)->where($where)->find();
        if($result){
            self::getOrderId();
        }
        return $orderId;
    }
    //检查用户状态
    static public function checkUserStatus($table,$where){
        $result = Db::name($table)->where($where)->find();
        if($result){
            if($result['user_status'] != 1){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}
