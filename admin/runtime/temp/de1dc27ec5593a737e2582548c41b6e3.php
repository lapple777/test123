<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"F:\gitcrm\admin\public/../app/admin\view\rebate\rebate-list.html";i:1529054880;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1529054880;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
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
                                        奖励情况
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