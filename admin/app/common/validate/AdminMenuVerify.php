<?php
namespace app\common\validate;

use think\Validate;

class AdminMenuVerify extends Validate{
    protected $rule = [
        ['menuname','require','菜单名必填'],
        ['navurl','require','标识必填'],
    ];
    protected $scene = [
        'menuVerify'=>['menuname','navurl']
    ];
}