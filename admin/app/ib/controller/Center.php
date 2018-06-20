<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/11
 * Time: 14:39
 */

namespace app\ib\controller;
use app\ib\model\User;
use app\ib\model\TradingAccount;
use think\Db;
//IB中心
class Center extends Common{
    private $user;
    private $trading;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
        $this->trading = new TradingAccount();
    }

    public function ib_center(){
         return $this->fetch('ib-center');
     }
     public function get_IbSubList(){
         $fields = [
            'u.name','u.id','t.account','t.id tid'
        ];
        $where = [
            'u.ib_id'=>session('IBId')
        ];

         $result = Db::name('user')
             ->alias('u')
             ->join('trading_account t','u.id=t.user_id')
             ->field($fields)
             ->where($where)
             ->paginate(10000);
//         $someKey = [];
//         $total = '';
//         foreach ($result as $item){
//             $someKey[] = $item['id'];
//             dump($total);
//         }

//         dump(array_flip($someKey));
//         dump($total);
//dump($result);
       $this->success($result);
     }
}
