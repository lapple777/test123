<?php
namespace app\common\validate;
use think\Validate;

class AdminAuthVerify extends Validate{
    protected $rule = [
        ['authname','require','权限名必填'],
        ['auth','require','权限标识必填'],
    ];
    protected $scene = [
        'authVerify'=>['authname','auth']
    ];
}