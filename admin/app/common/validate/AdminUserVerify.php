<?php
namespace app\common\validate;
use think\Validate;

class AdminUserVerify extends Validate{
    protected $regex = [
        'phone'=>'/^1[3|5|6|7|8|9]\d{9}/',
    ];
    protected $rule = [
        ['username','require','用户名必填'],
        ['phone','require|regex:phone','手机号必填|手机号格式不正确'],
        ['email','require|email','邮箱必填|邮箱格式不正确'],
        ['password','require|min:8','密码必填|密码最少8位'],
    ];
    protected $scene = [
        'addAdmin'=>['username','phone','email','password'],
        'editAdmin'=>['username','phone','email'],
    ];
}