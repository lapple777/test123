<?php 
namespace app\trader\controller;
use app\trader\model\LeaveMessage;
class Index extends Common{
	public function index(){
		//查询未读消息数量
        $message = new LeaveMessage();
        $where = [
            'to_userid'=>session('traderId'),
            'status'=>0
        ];
        $count = $message->field('id')->where($where)->count();
        $data = [
            'count'=>$count
        ];
        $this->assign($data);
		return $this->fetch();
	}
	public function welcome(){
		return $this->fetch('index_v1');
	}
}