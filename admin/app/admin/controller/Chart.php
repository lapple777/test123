<?php
namespace app\admin\controller;

/**
 图表控制器
 */
class Chart extends Common{
    public function graph_echarts(){
        return $this->fetch();
    }
    public function graph_flot(){
        return $this->fetch();
    }
    public function graph_metrics(){
        return $this->fetch();
    }
    public function graph_morris(){
        return $this->fetch();
    }
    public function graph_peity(){
        return $this->fetch();
    }
    public function graph_rickshaw(){
        return $this->fetch();
    }
    public function graph_sparkline(){
        return $this->fetch();
    }
    public function graph_options(){
        return $this->fetch();
    }

}