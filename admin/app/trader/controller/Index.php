<?php 
namespace app\trader\controller;
use think\Controller;
class Index extends Controller{
//	public function index(){
//		return $this->fetch('index2');
//	}
	public function index(){
		return $this->fetch();
	}
	public function welcome(){
		return $this->fetch('index_v1');
	}
}