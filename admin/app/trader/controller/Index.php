<?php 
namespace app\trader\controller;

class Index extends Common{
	public function index(){
		return $this->fetch();
	}
	public function welcome(){
		return $this->fetch('index_v1');
	}
}