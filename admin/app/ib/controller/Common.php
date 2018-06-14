<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/7
 * Time: 15:17
 */

namespace app\ib\controller;
use think\Controller;

class Common extends Controller{
    public function __construct()
    {
        parent::__construct();
        if (!session('IBUser')){
            $this->redirect('ib/Login/index');
        }

    }
}