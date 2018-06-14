<?php
namespace app\common\validate;

use think\Validate;
class RegisterVerify extends Validate{
    protected $regex = ['phone'=>'/1[3|5|6|7|8|9]\d{9}/'];
    protected $rules = [
        ['username','require','用户名必填'],
        ['name','require','姓名必填'],
        ['phone','require|regex:phone','手机号必填|手机号格式不正确'],
        ['email','require|email','邮箱必填|邮箱格式不正确'],

        ['bank_card','require','银行卡号必填'],
        ['id_card','require','身份证必填'],
        ['password','require|min:8','密码必填|密码至少八位'],
    ];
    protected $scene = [
        'register'=>['username','name','phone','email','id_card','bank_card','password'],
    ];
}