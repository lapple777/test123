<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/8
 * Time: 16:42
 */

namespace app\ib\controller;
use app\ib\model\Rebate;
use app\ib\model\Ib;
use app\ib\model\User;
use think\Db;
//佣金统计
class Commission extends Common{
    private $rebate;
    private $ib;
    private $user;
    public function __construct(){
        parent::__construct();
        $this->rebate = new Rebate();
        $this->ib = new Ib();
        $this->user = new User();
    }
    public function commision_statistics(){
        $where = [
            'r.IB_id'=>session('IBId')
        ];
        $fields = [
            'r.id','user.name','r.add_time','r.rebate_price'
        ];
        $result = Db::name('rebate')
            ->alias('r')
            //->join('trading_account trading','r.uid=trading.id')
            ->join('user','r.uid=user.id')
            ->field($fields)
            ->where($where)
            ->paginate(10000);

        $data = [
            'rebate_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('commission-statistics');
    }
}