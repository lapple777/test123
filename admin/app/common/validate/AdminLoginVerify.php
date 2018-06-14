<?php
namespace app\common\validate;

use think\Validate;

class AdminLoginVerify extends Validate{
    protected $rule = [
        ['username','require','用户名不能为空'],
        ['password','require','密码不能为空'],
        ['code','require|captcha','验证码不能为空|验证码错误'],
    ];
    protected $scene = [
        'login'=>['username','password','code']
    ];
}