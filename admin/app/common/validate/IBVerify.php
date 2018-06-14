<?php
namespace app\common\validate;
use think\Validate;
class IBVerify extends Validate{
    //自定义验证
    protected $regex = [ 'phone' => '1[3|5|6|7|8|9]\d{9}'];
    //验证规则
    protected $rule = [
        ['username','require','用户名必须'],
        ['name','require','姓名必须'],
        ['phone','require|regex:phone','手机号必须|手机号格式不正确'],
        ['email','require|email','邮箱必须|邮箱格式不正确'],
        ['password','require','密码必须'],
        ['bank_card','require','银行卡号必须'],
        ['id_card','require','身份证号必须'],

    ];

    //验证场景
    protected $scene = [
        'add'   =>  ['username','name','phone','email','password','bank_card','id_card'],
        'edit'  =>  ['username','name','phone','email','bank_card','id_card']
    ];
}