<?php
namespace app\monitor\controller;
use think\worker\Server;

class ServerData extends Server
{
    protected $socket = 'tcp://0.0.0.0:9100';

    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data){
        echo "onMessage\n";
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

                        $params = $info['ticktime'].'|'.$info['bid'].'|'.$info['ask'];
                        var_dump($params);
                        $datas = [date('Y-m-d H:i:s',$info['ticktime']),$info['bid'],$info['ask']];
                        //推送数据到前端
                        $data = [
                            'content'=>$params,
                        ];

                        pushGet($data);
                        $pushDada = [
                            'type'=>'closeOrder',
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
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection) {
        echo "onConnect\n";
        var_dump($connection);
    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection){
        echo "onClose\n";
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg){
        echo "error $code $msg\n";
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
    //记录日志
    public function logs($msg){
        $filename = date('Ymd');
        file_put_contents('./logs/workerman_logs/'.$filename.'log.txt',$msg,FILE_APPEND);
    }
}
