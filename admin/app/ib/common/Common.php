<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/13
 * Time: 10:09
 */
namespace app\ib\common;
use think\Controller;
use think\Db;

class Common extends Controller{
//IB生成唯一的订单号
 static public function getIbOrderId($table,$key){
     $orderId = date('YmdHis').rand(1000,9999);
     $where = [
         $key =>$orderId
     ];
     $result = Db::name($table)->where($where)->find();
     if ($result){
         self::getIbOrderId();
     }
     return $orderId;
 }
 //检查IB用户状态
    static public function checkIbStatus($table,$where){
        $result = Db::name($table)->where($where)->find();
        if($result){
            if($result['ib_status']!=1){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}