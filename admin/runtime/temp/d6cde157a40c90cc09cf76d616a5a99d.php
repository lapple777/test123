<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"F:\gitcrm\admin\public/../app/admin\view\trade\history-order.html";i:1530169184;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>历史订单</title>
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
            </style>

        </head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">


    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab-1" aria-expanded="true">成功订单</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-2" aria-expanded="true">失败订单</a>
                            </li>

                        </ul>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>订单号</th>
                                    <th>订单类型</th>
                                    <th>交易账号</th>
                                    <th>手数</th>
                                    <th>订单价格</th>
                                    <th>止盈价格</th>
                                    <th>止损价格</th>
                                    <th>手续费</th>
                                    <th>做单时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($history_success as $value) {?>
                                <tr class="gradeX">
                                    <td><?=$value['order_id']?></td>
                                    <td>
                                        <?php
                                              $orderStatus = $value['order_type'];
                                              switch($orderStatus){

                                                  case '1':
                                                    $statusText = '做多';
                                                     break;
                                                  case '2':
                                                     $statusText = '做空';
                                                     break;
                                              }
                                              ?>
                                        <?=$statusText?>
                                    </td>
                                    <td><?=$value['account']?></td>
                                    <td><?=$value['lot_num']?></td>
                                    <td><?=$value['order_price']?></td>
                                    <td><?=$value['stop_profit']?></td>
                                    <td><?=$value['stop_loss']?></td>
                                    <td><?=$value['hand_price']?></td>
                                    <td><?=date('Y-m-d H:i:s',$value['oadd_time'])?></td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>订单号</th>
                                    <th>订单类型</th>
                                    <th>交易账号</th>
                                    <th>手数</th>
                                    <th>订单价格</th>
                                    <th>止盈价格</th>
                                    <th>止损价格</th>
                                    <th>手续费</th>
                                    <th>做单时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($history_fail as $value) {?>
                                <tr class="gradeX">
                                    <td><?=$value['oid']?></td>
                                    <td><?=$value['order_id']?></td>
                                    <td>
                                        <?php
                                              $orderStatus = $value['order_type'];
                                              switch($orderStatus){

                                                  case '1':
                                                    $statusText = '做多';
                                                     break;
                                                  case '2':
                                                     $statusText = '做空';
                                                     break;
                                              }
                                              ?>
                                        <?=$statusText?>
                                    </td>
                                    <td><?=$value['account']?></td>
                                    <td><?=$value['lot_num']?></td>
                                    <td><?=$value['order_price']?></td>
                                    <td><?=$value['stop_profit']?></td>
                                    <td><?=$value['stop_loss']?></td>
                                    <td><?=$value['hand_price']?></td>
                                    <td><?=date('Y-m-d H:i:s',$value['oadd_time'])?></td>
                                </tr>
                                <?php }?>
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
//            'paging':false
        });


    });

</script>

</body>

</html>
</title>
</head>
<body>
<
</body>
</html>