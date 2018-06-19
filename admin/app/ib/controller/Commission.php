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
            'IB_id'=>session('IBId')
        ];
        $result = Db::name('rebate')
            ->alias('rebate')
            ->join('trading_account trading','rebate.uid=trading.id')
            ->where($where)
            ->paginate(10000);

        $data = [
            'rebate_list'=>$result
        ];
        $this->assign($data);
        return $this->fetch('commission-statistics');
    }
}