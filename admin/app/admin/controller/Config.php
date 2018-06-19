<?php
namespace app\admin\controller;
use app\admin\model\Config as ConfigModel;
class Config extends Common{
    private $config;
    public function __construct()
    {
        parent::__construct();
        $this->config = new ConfigModel();
    }

    public function config_info(){
        if(request()->isPost()){
            $input = input();
            $type = $input['type'];
            switch($type){
                case 'changePrice':
                    if($input['stop_profit'] == '' || $input['stop_loss'] == ''){
                        $this->error('止盈价或止损价不能为空');
                    }
                    //修改止盈止损价
                    $data = [
                        'stop_profit'=>$input['stop_profit'],
                        'stop_loss'=>$input['stop_loss']
                    ];
                    break;
                case 'handPrice':
                    if($input['handPrice'] == ''){
                        $this->error('价格不能为空');
                    }
                    //修改每手对应的美元
                    $data = [
                        'hand_price'=>$input['handPrice']
                    ];
                    break;
                case 'commission':
                    if($input['commission'] == ''){
                        $this->error('手续费不能为空');
                    }
                    //手续费设置
                    $data = [
                        'commission'=>$input['commission']
                    ];
                    break;
                case 'award':
                    if($input['award'] == ''){
                        $this->error('奖励不能为空');
                    }
                    //奖励设置
                    $data = [
                        'award'=>$input['award']
                    ];
                    break;
                case 'rate':
                    if($input['rate'] == ''){
                        $this->error('汇率不能为空');
                    }
                    //汇率设置
                    $data = [
                        'rate'=>$input['rate']
                    ];
                    break;
            }
            $res = $this->config->where(['id'=>1])->update($data);
            if($res){
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }
        $fields = [
            'stop_profit','stop_loss','hand_price',
            'commission','award','rate'
        ];
        $res = $this->config->field($fields)->find();

        $data = [
            'config'=>$res
        ];
        $this->assign($data);
        return $this->fetch('config-info');
    }
    //止盈止损修改
    public function changePrice(){
        if(request()->isPost()){

        }
    }
}