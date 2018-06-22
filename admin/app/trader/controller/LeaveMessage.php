<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/20
 * Time: 16:53
 */

namespace app\trader\controller;
use app\trader\model\LeaveMessage as messageTable;
//留言管理
class LeaveMessage extends Common{
    private $message;
    public function __construct()
    {
        parent::__construct();
        $this->message = new messageTable();
    }

    public function leave_message(){
        if(request()->isPost()){

            $input = input();

            if($input['message'] == ''){
                $this->error('请填写留言');
            }
            $fromId = session('traderId');
            $touserId = '0';//0为管理员
            $data = [
                'message'=>trim($input['message']),
                'from_userid'=>$fromId,
                'to_userid'=>$touserId,
                'add_time'=>time()
            ];
            $res = $this->message->insert($data);
            if($res){
                $this->success('留言成功');
            }else{
                $this->error('留言失败');
            }
        }
        $input = input();
        $id = session('traderId');
        if(isset($input['type']) && $input['type'] == 'message'){

                $fields = ['id','message','from_userid','to_userid','add_time','status'];
                $ress = $this->message->field($fields)
                    ->where(['from_userid'=>$id])
                    ->whereOr(['to_userid'=>$id])
                    ->order('id desc')
                    ->select();

                $data =  array_reverse($ress);
                if($ress){
                    $this->success($data);
                }


        }
        $data = [
            'status'=>1
        ];
        $where = [
            'to_userid'=>$id
        ];
        $this->message->where($where)->update($data);
        return $this->fetch('leave-message');
    }

}