<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/11
 * Time: 10:24
 */

namespace app\common\validate;
use think\Validate;

class IBLoginVerify extends Validate{
    //自定义验证
    protected $regex = ['phone'=>'/1[3|5|6|7|8|9]\d{9}/'];
    protected $rule = [
        ['phone','require|regex:phone','手机号必填|手机号格式不正确'],
        ['password','require','密码必填'],
        ['code','require|captcha','验证码不能为空|验证码错误'],
    ];
    protected $scene = [
        'login'=>['phone','password','code']
    ];
}
