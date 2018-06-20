<?php
/**
 * Created by PhpStorm.
 * User: Udea-Manager
 * Date: 2018/6/20
 * Time: 16:53
 */

namespace app\trader\controller;


class LeaveMessage extends Common{
    public function leave_message(){
        return $this->fetch('leave-message');
    }
}