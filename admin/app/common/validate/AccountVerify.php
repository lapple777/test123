<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/21
 * Time: 18:50
 */


namespace app\common\validate;
use think\Validate;

class AccountVerify extends Validate{
    protected $regex = ['phone'=>'/1[3|5|6|7|8|9]\d{9}/'];
    protected $rule = [
        ['username','require','用户名必填'],
        ['name','require','姓名必填'],
        ['phone','require|regex:phone','手机号必填|手机号格式不正确'],
        ['email','require|email','邮箱必填|邮箱格式不正确'],
        ['bank_card','require','银行卡号必填'],
        ['id_card','require','身份证必填'],
        ['birthday','require','生日必填'],
        ['male','require','性别必填'],
        ['address','require','地址必填'],
        ['open_bank','require','开户行必填'],
    ];
    protected $scene = [
        'accountEdit'=>['username','name','phone','email','id_card','bank_card','open_bank'],
    ];

}