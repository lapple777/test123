<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/14
 * Time: 13:43
 */
namespace app\admin\common;
use think\Controller;
use think\Db;
class Common extends Controller {
    //检查IB的状态
    static public function checkIBStatus($table,$where){
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
    //检查客户的状态
    static public function checkUserStatus($table,$where){
        $result = Db::name($table)->where($where)->find();
        if($result){
            if($result['user_status']!=1){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}