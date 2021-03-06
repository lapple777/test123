<?php
namespace app\monitor\controller;

use think\Controller;
use think\cache\driver\Redis;
use think\Db;
//实时监控模块
class Monitor extends Controller{
    public function index(){
        $input = input();
        if($input['type'] == 'closeOrder'){
            $ask = $input['ask'];//买价
            $bid = $input['bid'];//卖价
        }
        //echo '<pre>';
        $redis = new Redis();
        $handler = $redis->handler();
        //做多订单
        $longOrderList = $handler->lRange('longOrderList',0,-1);
        if($longOrderList){
            //echo 111;
            foreach($longOrderList as $key=>$order){
                $lists = json_decode($order,true);
                if(is_array($lists)){

                    //做多止盈
                    if($bid >= $lists['stop_profit']){
                        if(!self::closeOrder($lists,1,$key)){
                            continue;
                        }
                    }else if($bid <= $lists['stop_loss']){
                        if(!self::closeOrder($lists,2,$key)){
                            continue;
                        }
                    }
                }

            }
        }

        //做空订单
        $shortOrderList = $handler->lRange('shortOrderList',0,-1);
        if($shortOrderList){
            //echo 222;
            foreach($shortOrderList as $key=>$order){
                $lists = json_decode($order,true);
                if(is_array($lists)){
                    //做空止盈
                    if($ask <= $lists['stop_profit']){
                        if(!self::closeOrder($lists,1,$key)){
                            continue;
                        }
                    }else if($ask >= $lists['stop_loss']){
                        if(!self::closeOrder($lists,2,$key)){
                            continue;
                        }
                    }

                }

            }
        }


    }
    //进行平仓，返佣操作
    public static  function closeOrder($data = [],$type,$index){

        //检查订单是否支付
        if(!self::checkOrderStatus($data['oid'])){
            return false;
        }

        /*
            [ib_id] => 3                ib的id
            [ta_id] => 1                交易账号的id
            [uid]=>3                    用户id

            [lot_num] => 10             手数
            [hang_price] => 1000        每手对应的美金
            [oid] => 42                 订单id
            [stop_profit] => 1.18682    止盈价
            [stop_loss] => 1.17662      止损价
            [order_type] => 1           订单类型
            [commission] => 5           每手手续费
            [award] => 50               每手奖励
        */
        //修改交易账号余额(止盈有奖励，止损只扣除手续费)，返佣修改ib账户余额，生成返佣记录
        $price = $data['lot_num'] * $data['hang_price'];//总美金
        $commission = $data['lot_num'] * $data['commission'];//手续费
        $order_data = [
            'order_status'=>$type,
            'order_close_time'=>time(),
            'hand_price'=> $commission
        ];

        switch($type){
            case 1:
                //止盈
                //账户余额
                $account_price = ($price + $data['lot_num'] * $data['award']) - $commission;
                $order_data['profit'] = $data['lot_num'] * $data['award']- $commission;

                break;
            case 2:
                //止损
                //账户余额
                $account_price = $price - $commission;
                $order_data['profit'] = 0;
                break;
        }


        $tarder_sql = 'UPDATE crm_trading_account SET wallet = wallet + '.$account_price.' WHERE id='.$data['ta_id'];
        $ib_sql = 'UPDATE crm_ib SET wallet = wallet + '.$commission.' WHERE id='.$data['ib_id'];
        Db::startTrans();
        try{
            //修改订单状态
            Db::name('order')->where(['id'=>$data['oid'],'order_status'=>0])->update($order_data);
            //修改交易账户余额
            Db::execute($tarder_sql);
            //修改ib账户余额
            Db::execute($ib_sql);

            //添加返佣记录
            $rebate_data = [
                'uid'=>$data['uid'],
                'ta_id'=>$data['ta_id'],
                'IB_id'=>$data['ib_id'],
                'rebate_price'=>$commission,
                'add_time'=>time(),
            ];
            Db::name('rebate')->insert($rebate_data);

            Db::commit();
        }catch(\Exception $e){
            Db::rollback();
            return false;
        }
        //平仓成功删除redis中的这条订单
        $redis = new Redis();
        $handler = $redis->handler();
        switch($data['order_type']){
            case 1:
                $handler->lRemove('longOrderList',json_encode($data),1);
                break;
            case 2:
                $handler->lRemove('shortOrderList',json_encode($data),1);
                break;
        }


    }
    public static function checkOrderStatus($id){
        $res = Db::name('order')->where(['id'=>$id,'order_status'=>0])->find();
        if($res){
            return true;
        }else{
            return false;
        }
    }
}