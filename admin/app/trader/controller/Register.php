<?php 
namespace app\trader\controller;

use think\Controller;
//注册管理
class Register extends Controller{
	public function index(){
		return $this->fetch('login/register');
	}
}