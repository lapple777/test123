<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/28
 * Time: 10:12
 */

namespace app\common\validate;
use think\Validate;
//划入资金验证
class FundAllotVerify extends Validate{
    protected $rule = [
        ['inmoney','require|token','划入的金额不能为空'],
        ['outmoney','require|token','转出金额不能为空']
    ];
    protected $scene = [
        'fundIn'=>['inmoney'],
        'fundOut'=>['outmoney']
    ];
}