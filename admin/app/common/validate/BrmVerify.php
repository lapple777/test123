<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/28
 * Time: 10:40
 */

namespace app\common\validate;

use think\Validate;
class BrmVerify extends Validate{
    protected $rule  = [
        ['outmoney','require|token','出金金额不能为空'],
        ['inmoney','require|token','入金金额不能为空']
    ];
    protected $scene = [
        'outmoney'=>['outmoney'],
        'inmoney'=>['inmoney']
    ];
}