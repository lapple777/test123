<?php
namespace app\index\controller;
use think\Controller;
class Pushapi extends Controller
{
    public function __construct(){
        parent::__construct();
    }
    public function pushData($data = ''){
        $string = '13123123 123123 123123';

        $push = new Push();
        $res = $push->setUser()->setContent($string)->push();


    }
}