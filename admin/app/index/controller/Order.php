<?php
namespace app\index\controller;
use app\index\model\Config;
use app\index\model\TraderUser;
use app\index\model\User;
use app\index\model\TraderOrder;
use app\trader\common\Common as Commons;
use think\Db;
use think\cache\driver\Redis;

class Order extends Common{
    //在场订单列表
    public function myOrder(){
        if(request()->isPost()){
            $traderOrder = new TraderOrder();
            $where = [
                'ta_id'=>session('userid'),
                'order_status'=>'0'
            ];
            $fields = [
                'order_id','order_type','order_price','add_time',
                'stop_profit','stop_loss','lot_num','order_status'
            ];
            $result = $traderOrder->field($fields)->order('add_time desc')->where($where)->select();
            if($result){
                $this->success($result);
            }else{
                $this->error('订单数据获取失败');
            }

        }

        return $this->fetch('index/order');
    }
    //下单
    public function placeOrder(){
        if(request()->isPost()){
            $input = input();
            if(!isset($input['lot'])){
                $this->error('请输入手数');
            }
            if($input['lot'] < 0.1){
                $this->error('最小手数为0.1手');
            }
            if(!isset($input['direction'])){
                $this->error('请选择做多或者做空');
            }

            $currentPrice = $input['current_price'];//下单价格
            if(!$currentPrice){
                $this->error('当前价格异常');
            }
            $currentPrice2 = $input['current_price2'];//下单价格
            $type = $input['direction'];//下单类型1为做多2为做空
            $config = new Config();
            //查询配置
            $fields = ['stop_profit','stop_loss','hand_price','commission','award'];
            $configRes = $config->field($fields)->where(['id'=>1])->find();
            if($configRes){
                $stopProfit = $configRes['stop_profit'];//止盈
                $stopLoss = $configRes['stop_loss'];//止损
                $handPrice = $configRes['hand_price'];//每手对应美元价格
            }else{
                $this->error('参数获取失败');
            }
            $traderUser = new TraderUser();
            $where = [
                'account'=>session('username')
            ];
            $fields = ['id','wallet','ta_status','user_id'];
            $traderRes = $traderUser->field($fields)->where($where)->find();
            $user = new User();
            $ibId = $user->field('ib_id')->where(['id'=>$traderRes['user_id']])->find();
            if($traderRes){
                if($traderRes['ta_status'] != 1){
                    $this->error('用户状态异常');
                }else{
                    $orderPrice = $input['lot'] * $handPrice;//下单价格
                    if($orderPrice > $traderRes['wallet']){
                        $this->error('账户余额不足');
                    }
                    switch($type){
                        case 1;
                            //做多
                            $orderPrice = $currentPrice2;
                            //止盈价
                            $orderStopProfit = $orderPrice + $stopProfit/100000;
                            //止损价
                            $orderStopLoss = $orderPrice - $stopLoss/100000;

                            break;
                        case 2:
                            //做空
                            $orderPrice = $currentPrice;
                            //止盈价
                            $orderStopProfit = $orderPrice - $stopProfit/100000;
                            //止损价
                            $orderStopLoss = $orderPrice + $stopLoss/100000;

                            break;
                    }
                    $taId = $traderRes['id'];//交易账号id
                    $orderId = Commons::getOrderId('order','order_id');//获取账单号
                    $traderOrder = new TraderOrder();
                    Db::startTrans();
                    try{

                        $data = [
                            'ta_id'=>$taId,//交易者账号id
                            'order_id'=>$orderId,//订单号
                            'order_price'=>$orderPrice,//下单价格
                            'stop_profit'=>$orderStopProfit,//止盈价
                            'stop_loss'=>$orderStopLoss,//止损价
                            'lot_num'=>$input['lot'],//下单手数
                            'order_type'=>$type,//下单类型
                            'add_time'=>time(),//添加时间
                            'hand_price'=>$input['lot']*$configRes['commission']
                        ];

                        $oid = $traderOrder->insertGetId($data);
                        $price = $input['lot']*$handPrice;//手续费
                        $sql = 'UPDATE crm_trading_account SET wallet=wallet-'.$price.' WHERE account="'.session('username').'"';

                        Db::execute($sql);

                        Db::commit();
                    }catch(\Exception $e){
                        Db::rollback();
                        $this->error('下单失败');
                    }
                    //将订单存入缓存,进行实施监控进行平仓
                    $redis = new Redis();
                    $handler = $redis->handler();
                    $data = [
                        'ib_id'=>$ibId['ib_id'],//ib用户id
                        'ta_id'=>$traderRes['id'],//交易账号id
                        'uid'=>$traderRes['user_id'],//客户id
                        'lot_num'=>$input['lot'],//下单手数
                        'hang_price'=>$handPrice,//每手对应的美金
                        'oid'=>$oid,//订单id
                        'stop_profit'=>$orderStopProfit,//止盈价
                        'stop_loss'=>$orderStopLoss,//止损价
                        'order_type'=>$type,//订单类型
                        'commission'=>$configRes['commission'],//做错每手手续费
                        'award'=>$configRes['award'],//做对每手奖励
                    ];
                    switch($type){
                        case 1:
                            //做多
                            $handler->rPush('longOrderList',json_encode($data));
                            break;
                        case 2:
                            //做空
                            $handler->rPush('shortOrderList',json_encode($data));
                            break;
                    }

                    $this->success('下单成功');

                }
            }else{
                $this->error('账户不存在');
            }

        }
    }
    public function getJsonData(){
        $input = input();
        $filename =  $filename = date('Ymd');
        $Symbol = $input['Symbol'];
        $data = file_get_contents('./static/quotes/'.$filename.$Symbol.'.txt');
        $newArray = [];
        $array = explode('|',$data);
        foreach($array as $key => $value){
            if($array[$key]){
                array_push($newArray,json_decode($array[$key]));
            }

        }
//        echo '<pre>';
//        print_r(json_encode($newArray));die;
        if($data){
            $this->success(json_encode($newArray));
        }else{
            $this->error('暂无数据');
        }


    }
}