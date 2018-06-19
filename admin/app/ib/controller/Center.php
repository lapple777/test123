<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/11
 * Time: 14:39
 */

namespace app\ib\controller;

//IB中心
class Center extends Common{
     public function ib_center(){

         return $this->fetch('ib-center');
     }
}
