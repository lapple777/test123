<?php
namespace app\monitor\controller;
use Workerman\Worker;
use Workerman\Lib\Timer;
use Workerman\Connection\AsyncTcpConnection;
use app\monitor\controller\Monitor;

class Getquotes{
    //推送地址
    const IP_URL = 'http://127.0.0.1:2121/';
    public function index(){
        $worker = new Worker();
        $worker->onWorkerStart = function($worker) {
            $con = new AsyncTcpConnection('tcp://13.70.6.140:9100');

            // 设置以ssl加密方式访问，使之成为wss
            // $con->transport = 'ssl';

            $con->onConnect = function($con) {
                //--------------logs----------------------------------
                $error = "【建立连接】时间：".date('Y-m-d H:i:s').PHP_EOL;
                $this->logs($error);
                //--------------logs----------------------------------

                $Request_Serial= time().rand(100,999);
                $params = [
                    'CstData'=>[
                        'CstId'=>'CstId',
                        'CstPwd'=>'RXXpXOq9l+ZfNg+H4AM8ZLJDr8d8//CquPwe7dvv5e45tatllMJjC6O5Jj7jcwAu4FXsc6ufyhSgwx2OL31o1YVY4yPvpDhekhXS3G/TGR3wy0nOCLuEAaIwjF8GNBui1HVVTNIGoO1sAyqM0i85YYP1ukJLZRr8wjTed6CLJ58='
                    ],
                    'MT4Server'=>[
                        'Addr' => '13.70.6.140',
                        'Port' => 443,
                        'ManagerUser' => 1,
                        'ManagerPassword' => 'manager',
                    ],
                    'Request_Serial' => $Request_Serial,
                    'Request_Time' => time(),
                    'Request_Version' => '1.0.1'
                ];

                $params['Request_Data']= [
                        "Cmd" => "Market_Request",
                        "ReceiveServer" => "",
                        "ReceiveDatetype" => 0
                    ];
                $data = "W".json_encode($params)."QUIT\n";

                $con->send($data);

            };

            $con->onMessage = function($con, $data) {
                //原始数据=================
                file_put_contents('./public/static/quotes/rizhi_data.txt',json_encode($data).PHP_EOL,FILE_APPEND);
                //报价信息，需要存入数据库
                $filename = date('Ymd');
                $res = $this->checkData($data);
                if($res){
                    $data = trim($res);
                    $json2 = substr($data,1, strlen($data)-5);

                    $pars = ['EURUSD'];
                    $datas = json_decode($json2,true);

                    if(isset($datas['Rsp_Info']['Quote']) && is_array($datas['Rsp_Info']['Quote'])){
                        foreach($datas['Rsp_Info']['Quote'] as $key=>$value){
                            if(in_array($value['Symbol'],$pars)){
                                $info = $datas['Rsp_Info']['Quote'][$key];
                                var_dump(json_encode($info));
    //                            $params = [
    //                                date('Y/m/d H:i:s',$info['ticktime']),
    ////                                $info['ask'],//买价
    //                                $info['bid'],//卖价
    ////                                $info['high'],//高价
    ////                                $info['low'],//低价
    //                            ];
                                $params = $info['ticktime'].'|'.$info['bid'].'|'.$info['ask'];
                                //var_dump($params);
                                $datas = [date('Y-m-d H:i:s',$info['ticktime']),$info['bid'],$info['ask']];
                                //推送数据到前端
                                $data = [
                                    'content'=>$params,
                                ];

                                $this->pushGet($data);
                                $pushDada = [
                                    'type'=>'closeOrder',
                                    'ask'=>$info['ask'],//买价
                                    'bid'=>$info['bid'],//卖价
                                ];

                                //实时监控价格，进行平仓
                                $Monitor =  new Monitor();
                                $Monitor->index($pushDada);
                                //指定品种的数据
                                file_put_contents('./public/static/quotes/'.$filename.$value['Symbol'].'.txt',json_encode($datas).'|',FILE_APPEND);
                            }
                        }
                    }

                }

            };
            //断开重连
            $con->onClose=function($con) {
                //--------------logs----------------------------------
                $error = "【连接断开】时间：".date('Y-m-d H:i:s').PHP_EOL;
                $this->logs($error);
                //--------------logs----------------------------------
                //重新连接
                $this->index();

            };
            //连接出错
            $con->onError = function($con, $code, $msg)
            {
                //--------------logs----------------------------------
                $error = "【连接出错】Error code:$code msg:$msg".PHP_EOL;
                $this->logs($error);
                //--------------logs----------------------------------
                //连接出错重新建立连接
                $this->index();
            };

        $con->connect();
    };

    Worker::runAll();
    }

    public function checkData($data){
        $json = trim(substr(trim($data), strlen(trim($data))-4));
    //检查数据结尾
        if($json == 'QUIT'){
            if(isset($_SESSION['pretreatment'])){
                $params = trim($_SESSION['pretreatment']).trim($data);
                $_SESSION['pretreatment'] = '';
                return $params;

            }
            return $data;
        }else{
            $_SESSION['pretreatment']=$data;
            return false;
        }
    }

    public function pushGet($params = []){
    //    print_r($params);
        //向前台推送数据
        $data = [
            'type' => 'publish',
            'content' => $params['content'],
            'to' => '',
        ];
        $url = self::IP_URL.'?type='.$data['type'].'&content='.$data['content'].'&to='.$data['to'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        $file_contents = curl_exec($ch);
        curl_close($ch);

        return $file_contents;

    }
    public function logs($msg){
        $filename = date('Ymd');
        file_put_contents('./logs/workerman_logs/'.$filename.'log.txt',$msg,FILE_APPEND);
    }
}
