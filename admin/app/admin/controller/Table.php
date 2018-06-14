<?php
/**
 * Created by PhpStorm.
 * User: Udea_PHP2
 * Date: 2018/3/30
 * Time: 18:02
 */

namespace app\admin\controller;


class Table extends Common
{
    public function table_basic(){
        return $this->fetch();
    }
    public function table_bootstrap(){
        return $this->fetch();
    }
    public function table_data_tables(){
        return $this->fetch();
    }
    public function table_foo_table(){
        return $this->fetch();
    }
    public function table_jqgrid(){
        return $this->fetch();
    }
}