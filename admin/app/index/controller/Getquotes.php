<?php
namespace app\index\controller;
use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;
use think\Controller;


class Getquotes extends Controller{
    public function index(){
        $filename = date('Ymd');
        $per = 'EURUSD';
        $data = file_get_contents('./static/quotes/'.$filename.$per.'.txt');
        echo '<pre>';
        $arr = '['.$data.']';
        print_r($arr);
//        $arr = explode($data,'QUIT');
//        print_r($arr);
    }

}
