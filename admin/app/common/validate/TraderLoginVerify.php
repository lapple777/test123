<?php
namespace app\common\validate;

use think\Validate;

class TraderLoginVerify extends Validate{
    protected $regex = ['phone'=>'/1[3|5|6|7|8|9]\d{9}/'];
    protected $rule = [
        ['account','require','交易账号不能为空'],
        ['password','require','密码不能为空'],
    ];
    protected $scene = [
        'login'=>['account','password']
    ];
}