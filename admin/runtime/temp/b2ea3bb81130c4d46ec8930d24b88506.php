<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"F:\gitcrm\admin\public/../app/trader\view\brm\inmoney-list.html";i:1529462094;s:47:"F:\gitcrm\admin\app\trader\view\common\css.html";i:1529054880;s:50:"F:\gitcrm\admin\app\trader\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 入金列表</title>
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
                                    入金列表
                                </li>
                            </ul>
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <ul class="todo-list m-t small-list ui-sortable">
                                <li>
                                    <a class="btn btn-primary" onclick="inmoney('入金申请','<?php echo url('Brm/inmoney'); ?>','400','300')">入金</a>
                                </li>
                            </ul>
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>账单号</th>
                                    <th>入金金额(美元)</th>
                                    <th>人民币</th>
                                    <th>入金时间</th>
                                    <th>状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($inmoney_list as $value){?>
                                    <tr>
                                        <td><?=$value['id']?></td>
                                        <td><?=$value['order_id']?></td>
                                        <td><?=$value['inmoney']?></td>
                                        <td><?=$value['money']?></td>
                                        <td><?=date('Y-m-d H:i:s',$value['add_time'])?></td>
                                        <td>
                                            <?php
                                            $status = $value['order_status'];
                                            switch($status){
                                                case '0':
                                                    $statusText = '审核中...';
                                                    break;
                                                case '1':
                                                    $statusText = '入金成功';
                                                    break;
                                                case '2':
                                                    $statusText = '审核未通过';
                                                    break;
                                            }
                                            ?>
                                            <?=$statusText?>
                                        </td>
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

    });
});
    function inmoney(title,url,w,h){
        layer_show(title,url,w,h);

    }

</script>

</body>

</html>
