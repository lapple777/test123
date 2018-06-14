<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\PHP\PHPTutorial\WWW\test123\admin\public/../app/admin\view\trade\online-order.html";i:1528943849;s:67:"D:\PHP\PHPTutorial\WWW\test123\admin\app\admin\view\common\css.html";i:1528943849;s:70:"D:\PHP\PHPTutorial\WWW\test123\admin\app\admin\view\common\script.html";i:1528943849;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 在场订单</title>
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
        .order_title span{
            display:inline-block;
            margin-right:15px;
            width:200px;
        }
        .icon_size{
            font-size:18px;
            width:25px;
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
                            <ul class="sortable-list connectList agile-list ui-sortable">

                                <li class="success-element">
                                    基本信息
                                </li>
                            </ul>
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">

                        <div class="panel-body">
                            <div class="order_title">
                                <i class="fa fa-server icon_size" ></i> <strong>在场订单列表</strong>
                            </div>
                            <div class="order_title">
                                <span><i class="fa fa-database" style="width:25px;height:20px;color:#98983ebd;font-size: 18px;"></i> 账户总资金：9999（美元）</span>
                                <span><i class="fa fa-cubes" style="width:25px;height:20px;color:red;font-size: 18px;"></i> 账户净值：9999（美元）</span>
                                <span><i class="fa fa-server" style="width:25px;height:20px;color:green;font-size: 18px;"></i> 账户盈利：9999（美元）</span>
                            </div>
                            <div class="order_title">
                                <span><i class="fa fa-globe" style="width:25px;height:20px;color:#2eb572bd;font-size: 18px;"></i> 总盈亏：9999（美元）</span>
                                <span><i class="fa fa-pie-chart" style="width:25px;height:20px;color:#606af7e0;font-size: 18px;"></i> 订单总数：9999（美元）</span>
                                <span><i class="fa fa-file-photo-o" style="width:25px;height:20px;color:#d27eb3;font-size: 18px;"></i> 总手数：9999（美元）</span>
                            </div>
                            <table class="table table-striped table-bordered table-hover dataTables-example">
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
                            <div class="order_title">
                                <i class="fa fa-server icon_size"></i> <strong>连续错N单列表</strong>
                            </div>
                            <table class="table table-striped table-bordered table-hover dataTables-example">
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

<!-- 全局js -->
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/static/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/static/admin/js/plugins/layer3.1/layer.js"></script>
<script src="/static/admin/js/demo/layer-demo.js"></script>
<!-- 自定义js -->
<script src="/static/admin/js/content.js?v=1.0.0"></script>
<script src="/static/admin/js/plugins/jeditable/jquery.jeditable.js"></script>

<!-- Data Tables -->
<script src="/static/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/static/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>


<script>
    $(document).ready(function () {
        $('.dataTables-example').dataTable({

        });





    });


</script>

</body>

</html>
