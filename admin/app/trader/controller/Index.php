<?php 
namespace app\trader\controller;
use think\Db;
use app\trader\model\User;
use app\trader\model\TradingAccount;
use app\trader\model\Order;
use app\trader\model\LeaveMessage;
use app\trader\model\Config;
class Index extends Common{
    private $order;
    private $trading;
    private $user;
    private $config;
    public function __construct(){
        parent::__construct();
        $this->user = new User();
        $this->order = new Order();
        $this->trading = new TradingAccount();
        $this->config = new Config();
    }
    public function index(){
        //查询未读消息数量
        $message = new LeaveMessage();
        $where = [
            'to_userid'=>session('traderId'),
            'status'=>0
        ];
        $count = $message->field('id')->where($where)->count();
        $data = [
            'count'=>$count
        ];
        $this->assign($data);
		return $this->fetch();
	}
	//账户基本信息 => 账户资金 账户盈利 成功次数 交易手数
	public function welcome(){
        $where = [
            'id'=>session('traderId')
        ];
        $fields = [
            'id','wallet','username','name','phone','email',
            'id_card','bank_card','add_time','open_bank',
            'address','birthday','male','id_card_zm','id_card_fm',
            'bank_card_zm','bank_card_fm','user_status'
        ];
        $resInfo = $this->user->field($fields)->where($where)->find();

        //账户资金
        $resWallet = $this->user->field('wallet')->where('id',session('traderId'))->find();
       //账户盈利
        $where = [
            'u.id'=>session('traderId')
        ];
        $resProfit = Db::name('user u')
            ->join('trading_account t','u.id=t.user_id')
            ->join('order o','o.ta_id = t.id')
            ->where($where)
            ->sum('profit');
        //交易手数
        $resLotNum = Db::name('user u')
            ->join('trading_account t','u.id=t.user_id')
            ->join('order o','o.ta_id = t.id')
            ->where($where)
            ->sum('lot_num');
        //成功次数
        $where = [
            'u.id'=>session('traderId'),
            'o.order_status'=>'1'
        ];
        $resSuccess = Db::name('user u')
            ->join('trading_account t','u.id=t.user_id')
            ->join('order o','o.ta_id = t.id')
            ->where($where)
            ->count();
        $configRes = $this->config->field('hand_price')->find();
        //获取当前客户下所有交易账号id（用来计算在场订单总手数）
        $AccountId = $this->trading
                    ->field('id')
                    ->where(['user_id'=>session('traderId')])
                    ->select();
        //获取当前客户所有交易账号账户余额
        $AccountWallet = $this->trading
                        ->where(['user_id'=>session('traderId')])
                        ->sum('wallet');

        $idStr = '';
        if($AccountId){
            foreach($AccountId as $ids){
                $idStr .= $ids['id'].',';
            }
        }
        $orderWhere = [
            'order_status'=>0,
            'ta_id'=>['in',substr($idStr,0,-1)]
        ];
        //获取在场订单总手数
        $onlineHand = $this->order->where($orderWhere)->sum('lot_num');
        //在场订单总金额
        $onlinePrice = $onlineHand * $configRes['hand_price'];
        //账户总资产
        $totalWallet = $resWallet['wallet']+$onlinePrice+$AccountWallet;
        $data = [
            'user_wallet'=>$resWallet,
            'profitTotal'=>$resProfit,
            'resSuccess' =>$resSuccess,
            'resLotNum' =>$resLotNum,
            'account'=>$resInfo,
            'onlinePrice'=>$onlinePrice,
            'AccountWallet'=>$AccountWallet,
            'totalWallet'=>$totalWallet
        ];
        $this->assign($data);
		return $this->fetch('index_v1');
	}
	public function getDate_List(){
        $fields = [
            'u.id uid','t.id tid','o.id oid','o.order_close_time','o.profit','order_status'
        ];
        $where = [
            'u.id'=>session('traderId'),
            'order_status'=>1
        ];
        $res = Db::name('user u')
            ->join('trading_account t','u.id=t.user_id')
            ->join('order o','o.ta_id = t.id')
            ->field($fields)
            ->where($where)
            ->select();
        $result = array();
        foreach ($res as $key =>$info) {
            $result[date('Y-m-d',$info['order_close_time'])][] = $info;
        }
        $dateList = array();
        $total = 0;
        $i=0;
        foreach ($result as $k=>$value){
            foreach ($value as $v){
                $total += $v['profit'];
            }

            $dateList[$i]['time']  = $k;
            $dateList[$i]['total']  = $total;
            $i ++;
            $total = 0;
        }
        $this->success($dateList);
    }
}