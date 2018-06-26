<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\PHP\PHPTutorial\WWW\test123\admin\public/../app/admin\view\rebate\rebate-list.html";i:1529999207;s:67:"D:\PHP\PHPTutorial\WWW\test123\admin\app\admin\view\common\css.html";i:1528943849;s:70:"D:\PHP\PHPTutorial\WWW\test123\admin\app\admin\view\common\script.html";i:1528943849;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 佣金列表</title>
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
                                        返佣列表
                                    </li>
                                </ul>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">

                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>序号</th>
                                        <th>订单号</th>
                                        <th>账号</th>
                                        <th>所属客户</th>
                                        <th>所属IB</th>
                                        <th>返佣金额</th>
                                        <th>返佣时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($rebate_list as $key => $value){?>
                                    <tr class="gradeX">
                                        <td><?php echo ++$key; ?></td>
                                        <td><?=$value['oid']?></td>
                                        <td><?=$value['account']?></td>
                                        <td><?=$value['uusername']?></td>
                                        <td><?=$value['iusername']?></td>
                                        <td><?=$value['rebate_price']?></td>
                                        <td><?=date('Y-m-d h:i:s',$value['add_time'])?></td>
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


</script>

</body>

</html>
