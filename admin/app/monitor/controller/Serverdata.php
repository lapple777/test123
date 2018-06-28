<?php
namespace app\monitor\controller;
use think\worker\Server;
use app\monitor\controller\Monitor;

class ServerData extends Server{
    private $ipurl = 'http://127.0.0.1:2121/';//本地
    //private $ipurl = 'http://210.209.85.65:2121/';//线上正式环境
    //private $ipurl = 'http://210.209.85.65:2167/';//线上测试环境

    protected $socket = 'tcp://0.0.0.0:9100';

    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data){
        //数据存入日志文件
        $this->logs($data,1);
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

                        $ask = $info['bid']+0.0002;
                        $params = $info['ticktime'].'|'.$info['bid'].'|'.$ask;
                        var_dump($params);
                        $datas = [date('Y-m-d H:i:s',$info['ticktime']),$info['bid'],$ask];
                        //================推送数据到前端============
                        $data = [
                            'content'=>$params,
                        ];
                        $this->pushGet($data);
                        //==========================================
                        $pushDada = [
                            'type'=>'closeOrder',
                            'ask'=>$ask,//买价
                            'bid'=>$info['bid'],//卖价
                        ];

                        //实时监控价格，进行平仓
                        $monitor = new Monitor();
                        $monitor->index($pushDada);
                        file_put_contents('./public/static/quotes/'.$filename.$value['Symbol'].'.txt',json_encode($datas).'|',FILE_APPEND);
                    }
                }
            }

        }
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection) {
        echo $connection->getRemoteIp()."\n";
        $msg = '【连接成功】'.date('Y-m-d H:i:s').' [IP]:'.$connection->getRemoteIp();
        $this->logs($msg);

    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection){
        //echo "onClose\n";
        $msg = '【连接断开】'.date('Y-m-d H:i:s').' [IP]:'.$connection->getRemoteIp();
        $this->logs($msg);
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg){
        //echo "error $code $msg\n";
        $msg = '【连接出错】'.date('Y-m-d H:i:s').' [IP]:'.$connection->getRemoteIp()."error: code=> $code,message=> $msg";
        $this->logs($msg);
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker) {

    }
    //检查数据是否分包
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
    //推送数据到前端
    public function pushGet($params = []){
//    print_r($params);
        //向前台推送数据
        $data = [
            'type' => 'publish',
            'content' => $params['content'],
            'to' => '',
        ];
        $url = $this->ipurl.'?type='.$data['type'].'&content='.$data['content'].'&to='.$data['to'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        $file_contents = curl_exec($ch);
        curl_close($ch);

        return $file_contents;

    }
    //记录日志
    public function logs($msg,$type = 0){
        if($type == 1){
            $filename = date('Ymd').'data';
        }else{
            $filename = date('Ymd');
        }

        file_put_contents('./logs/workerman_logs/'.$filename.'log.txt',$msg.PHP_EOL,FILE_APPEND);
    }
}
