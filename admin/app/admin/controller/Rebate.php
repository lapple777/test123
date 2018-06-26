<?php
namespace app\admin\controller;
//返佣管理
use think\Db;
class Rebate extends Common{
    //返佣列表
    public function rebate_list(){

        $fields = [
            'r.IB_id','r.rebate_price','r.ta_id','r.oid','r.uid','r.add_time',
            't.account','t.id tid',
            'u.name','u.username uusername',
            'i.id iid','i.username iusername','i.ib_status','i.wallet',
        ];
        $res = Db::name('rebate')
            ->alias('r')
            ->join('trading_account t','r.ta_id=t.id')
            ->join('user u','t.user_id=u.id')
            ->join('ib i','u.ib_id=i.id')
            ->field($fields)
            ->select();
//        echo '<pre>';
//        print_r($res);die;
        $data = [
            'rebate_list'=>$res
        ];
        $this->assign($data);
        return $this->fetch('rebate-list');
    }

}