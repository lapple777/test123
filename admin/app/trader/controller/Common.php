<?php 
namespace app\trader\controller;
use think\Controller;
class Common extends Controller{
	public function __construct(){
		parent::__construct();
		if(!session('traderUser')){
			$this->redirect('trader/Login/index');
		}
	}
}
