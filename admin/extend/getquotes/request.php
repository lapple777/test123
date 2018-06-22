<?php
use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;
require_once __DIR__ . '/workerman/Autoloader.php';

//本地
define('IP_URL','http://127.0.0.1:2121/');//推送地址
define('HOST_NAME','http://www.gitcrm.com');

//线上环境
//define('IP_URL','http://210.209.85.65:2121');
//define('HOST_NAME','http://www.morris-cloud.com');

function request($callback, $req_str="") {
    $worker = new Worker();
    $worker->onWorkerStart = function($worker) {
        // ssl需要访问443端口
        $con = new AsyncTcpConnection('tcp://13.70.6.140:9100');

        // 设置以ssl加密方式访问，使之成为wss
        // $con->transport = 'ssl';

        $con->onConnect = function($con) {
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
            //报价信息，需要存入数据库
            $filename = date('Ymd');

            $res = checkData($data);
            if($res){
                $data = trim($res);
                $json2 = substr($data,1, strlen($data)-5);

                $pars = ['EURUSD'];
                $datas = json_decode($json2,true);

                if(is_array($datas['Rsp_Info']['Quote'])){
                    foreach($datas['Rsp_Info']['Quote'] as $key=>$value){
                        if(in_array($value['Symbol'],$pars)){
                            $info = $datas['Rsp_Info']['Quote'][$key];
//                            $params = [
//                                date('Y/m/d H:i:s',$info['ticktime']),
////                                $info['ask'],//买价
//                                $info['bid'],//卖价
////                                $info['high'],//高价
////                                $info['low'],//低价
//                            ];
                            $params = $info['ticktime'].'|'.$info['bid'].'|'.$info['ask'];
                            var_dump($params);
                            $datas = [date('Y-m-d H:i:s',$info['ticktime']),$info['bid'],$info['ask']];
                            //推送数据到前端
                            $data = [
                                'content'=>$params,
                            ];

                            pushGet($data);
                            $pushDada = [
                                'ask'=>$info['ask'],//买价
                                'bid'=>$info['bid'],//卖价
                            ];
                            //实时监控价格，进行平仓
                            monitorGet($pushDada);
                            file_put_contents('../../public/static/quotes/'.$filename.$value['Symbol'].'.txt',json_encode($datas).'|',FILE_APPEND);
                        }
                    }
                }

            }

        };

        $con->connect();
    };

    Worker::runAll();
}

function checkData($data){
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
function pushGet($params = [])
{
//    print_r($params);
    //向前台推送数据
    $data = [
        'type' => 'publish',
        'content' => $params['content'],
        'to' => '',
    ];
    $url = IP_URL.'?type='.$data['type'].'&content='.$data['content'].'&to='.$data['to'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    $file_contents = curl_exec($ch);
    curl_close($ch);

    return $file_contents;

}
function monitorGet($params = [])
{
    //进行订单监控，实时进行平仓
    $data = [
        'ask'=>$params['ask'],//买价
        'bid'=>$params['bid'],//卖价
    ];
    $url = HOST_NAME.'/monitor/Monitor/index?type=closeOrder&ask='.$data['ask'].'&bid='.$data['bid'];


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    $file_contents = curl_exec($ch);
    curl_close($ch);
    return $file_contents;

}
function pushPost($params = [])
{
    $data = [
        'type' => 'publish',
        'content' => $params['content'],
        'to' => '',
    ];
    $url = IP_URL;
    $postUrl = $url;
    $curlPost = $data;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);//运行curl
    curl_close($ch);
    return $data;

}
request(function($data) {});