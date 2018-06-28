<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"F:\gitcrm\admin\public/../app/admin\view\account\account-case.html";i:1529054880;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 账户情况</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    
<link rel="shortcut icon" href="favicon.ico">
<link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

<link href="/static/admin/css/animate.css" rel="stylesheet">
<link href="/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
<style>
    .dataTables_paginate{
        text-align:right;
    }
    .dataTables_filter{
        text-align:right;
    }
    .page_css{
        margin-top: -65px;
    }
</style>
    <style>
        .dataTables_paginate{
            text-align:right;
        }
        .dataTables_filter{
            text-align:right;
        }
        .order_title{
            line-height:45px;
        }
        #tab-1 .order_title span{
            display:inline-block;
            border:1px solid #ccc;
            border-radius:50px;
            margin-right:50px;
            width:200px;
            padding:10px 0 10px 20px;
        }
        #tab-1 .order_title span i{
            font-size:20px;

        }
        .icon_size{
            font-size:18px;
            width:25px;
        }
        .icon_border{
            border:2px solid #ccc;
            width:50px;
            height:50px;
            border-radius:50%;
            line-height:50px;
            margin:0 30px 0 0;

        }
        #tab-1 span:nth-child(1) .icon_border{
            border-color:#26c126;
        }
        #tab-1 span:nth-child(1) h1{
            color:#26c126;
        }
        #tab-1 span:nth-child(2) .icon_border{
            border-color:#4c4cd6;
        }
        #tab-1 span:nth-child(2) h1{
            color:#4c4cd6;
        }
        #tab-1 span:nth-child(3) .icon_border{
            border-color:#cece51;
        }
        #tab-1 span:nth-child(3) h1{
            color:#cece51;
        }
        #tab-2 .order_title{
            margin: 0 0 20px 0;
        }
        .mony_box{
            line-height: 15px;
        }
        .mony_box h1{
            margin:0;
        }
        .data_list p{
           background:#f4f4f5;
            margin-bottom:15px;
            line-height:35px;
        }
        .data_list p span{
            display:inline-block;
            width:12%;
            font-size:16px;
        }
        .zhu_right{
            width:60%;
        }
        .order_etail{
            width:40%;
        }
        .order_etail .row{
            margin:60px 0 0 30px;
        }
    </style>

</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1" aria-expanded="true">
                            账户基本情况
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-2" aria-expanded="true">
                            账户历史
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="order_title">
                                <span>
                                    <p class="pull-left icon_border text-center">
                                        <i class="fa fa-database"></i>
                                    </p>
                                    <div class="pull-left mony_box">
                                         <h1 >999</h1>
                                        账户资金
                                    </div>

                                </span>
                                <span>
                                     <p class="pull-left icon_border text-center">
                                         <i class="fa fa-cubes"></i>
                                     </p>
                                    <div class="pull-left mony_box">
                                        <h1 >999</h1>
                                        账户净值
                                    </div>
                                </span>
                                <span>
                                     <p class="pull-left icon_border text-center">
                                         <i class="fa fa-server"></i>
                                     </p>
                                    <div class="pull-left mony_box">
                                        <h1 >999</h1>
                                        账户盈亏
                                    </div>
                                </span>

                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span><i class="fa fa-server icon_size" ></i> <strong>数据总览</strong></span> &nbsp; &nbsp;
                                    <span><i class="fa fa-cubes" style="width:25px;height:20px;color:darkorange;font-size: 18px;"></i> 账户总手数：666</span>

                                </div>
                                <div class="panel-body data_list">

                                    <p class="text-center">
                                        <span>总手数</span>
                                        <span class="text-danger">（666）</span>
                                        <span>成功数</span>
                                        <span class="text-danger">（88）</span>
                                        <span>盈亏率</span>
                                        <span class="text-danger">（25%）</span>
                                        <span>最大回撤率</span>
                                        <span class="text-danger">（20%）</span>
                                    </p>
                                    <p class="text-center">
                                        <span>最大手数</span>
                                        <span class="text-danger">（666）</span>
                                        <span>失败数</span>
                                        <span class="text-danger">（88）</span>
                                        <span>最大浮亏</span>
                                        <span class="text-danger">（25%）</span>
                                        <span>成功率</span>
                                        <span class="text-danger">（20%）</span>
                                    </p>

                                </div>

                            </div>
                            <div class="panel panel-default">

                                <div class="panel-body">
                                    <div id="container" style="height: 350px"></div>
                                </div>

                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span><i class="fa fa-server icon_size" ></i> <strong>连续做对单量和做错单量</strong></span> &nbsp; &nbsp;
                                </div>
                                <div class="panel-body">
                                    <div class="pull-left order_etail">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading text-center">
                                                        <i class="fa fa-check" style="color:red;font-size:18px;    width: 30px;"></i>连续做对订单
                                                    </div>
                                                    <div class="panel-body text-center">
                                                        <p>第一单</p>
                                                        <p>第二单</p>
                                                        <p>第三单</p>
                                                        <p>第四单</p>
                                                        <p>第五单</p>
                                                        <p>...</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading text-center">
                                                        <i class="fa fa-close" style="color:red;font-size:18px;    width: 30px;"></i>连续做错订单
                                                    </div>
                                                    <div class="panel-body text-center">
                                                        <p>第一单</p>
                                                        <p>第二单</p>
                                                        <p>第三单</p>
                                                        <p>第四单</p>
                                                        <p>第五单</p>
                                                        <p>...</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="pull-right zhu_right">
                                        <div id="zhu" style="height: 350px"></div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="order_title">
                                <span><i class="fa fa-server icon_size" ></i> <strong>账户数据</strong></span> &nbsp; &nbsp; &nbsp; &nbsp;
                                <span><i class="fa fa-cubes" style="width:25px;height:20px;color:red;font-size: 18px;"></i> 总盈亏：9999（美元）</span>
                            </div>
                            <table class="table table-striped table-bordered table-hover account_history">
                                <thead>
                                <tr>
                                    <th>工号</th>
                                    <th>姓名</th>
                                    <th>本月奖励</th>
                                    <th>累计奖励</th>
                                    <th>本月奖励数</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="gradeX">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                </tr>
                                <tr class="gradeC">
                                    <td>Trident</td>
                                    <td>Internet Explorer 5.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                                    <td class="center">C</td>
                                </tr>
                                <tr class="gradeA">
                                    <td>Trident</td>
                                    <td>Internet Explorer 5.5
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                                    <td class="center">A</td>
                                </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>


                </div>


            </div>
        </div>

    </div>

</div>
</div>
<!-- 全局js -->
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/static/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/static/admin/js/plugins/layer3.1/layer.js"></script>
<script src="/static/admin/js/demo/layer-demo.js"></script>
<!-- 自定义js -->
<script src="/static/admin/js/content.js?v=1.0.0"></script>


<!-- Data Tables -->
<script src="/static/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/static/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!--Echats-->
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/simplex.js"></script>


<script>
    $(document).ready(function () {
        $('.dataTables-example').dataTable({

        });

    });
    $(document).ready(function () {
        $('.account_history').dataTable({

        });

    });

//折线图
    var dom = document.getElementById("container");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: [820, 932, 901, 934, 1290, 1330, 1320],
            itemStyle : { normal: {label : {show: true}}},
            type: 'line',
            areaStyle: {}
        }]
    };

    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }

    //柱状图
    var zhu = document.getElementById("zhu");
    var zhuChart = echarts.init(zhu);
    var appa = {};
    options = null;
    appa.title = '坐标轴刻度与标签对齐';

    options = {
        color: ['#3398DB'],
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'直接访问',
                type:'bar',
                barWidth: '60%',
                data:[10, 52, 200, 334, 390, 330, 220]
            }
        ]
    };

    if (options && typeof options === "object") {
        zhuChart.setOption(options, true);
    }
</script>

</body>

</html>
