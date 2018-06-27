<?php
namespace app\common\validate;
use think\Validate;
//后台-》交易者-》交易者账户
class AdminTraderAccount extends Validate{
    protected $regex = ['phone'=>'/1[3|5|6|7|8|9]\d{9}/'];
    protected $rule = [
        ['username','require','用户名必填'],
        ['name','require','姓名必填'],
        ['phone','require|regex:phone','手机号必填|手机号格式不正确'],
        ['email','require|email','邮箱必填|邮箱格式不正确'],
        ['id_card','require','身份证号必填'],
        ['bank_card','require','银行卡号必填'],
    ];
    protected $scene = [
        'edit'=>['username','name','phone','email','id_card','bank_card']
    ];
}