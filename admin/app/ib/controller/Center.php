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
            'name','id'
        ];
        $where = [
            'ib_id'=>session('IBId')
        ];
        $res = $this->user->field($fields)->where($where)->select();
        if (!$res){
            echo '数据集为空';
        }else{
            $fields = [
                'account','id'
            ];
            $IBCenter = [];
            foreach ($res as $value){
//              echo '<pre>';
//               dump($value->name);
              $result = $this->trading->field($fields)->where('user_id',$value->id)->select();
//              echo '<pre>';
//              print_r($result);
              $list = [
                  'parentList'=>[
                      'parentId'=>$value->id,
                      'parentName'=>$value->name,
                  ],
                  'children'=>$result
              ];
                $IBCenter []=$list;
            }
//            echo '<pre>';
//            dump($IBCenter);
        }
       $this->success($IBCenter);
     }
}
