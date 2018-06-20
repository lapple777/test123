<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"F:\gitcrm\admin\public/../app/ib\view\commission\commission-statistics.html";i:1529405664;s:43:"F:\gitcrm\admin\app\ib\view\common\css.html";i:1529054880;s:46:"F:\gitcrm\admin\app\ib\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>返佣记录</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    
<link rel="shortcut icon" href="favicon.ico">
<link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
<link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

<link href="/static/admin/css/animate.css" rel="stylesheet">
<link href="/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
<link href="/static/admin/css/plugins/jsTree/style.min.css" rel="stylesheet">
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
<div class="wrapper    wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab-1" aria-expanded="true">入金审核</a>
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
                                    <th>ID</th>
                                    <th>下单员</th>
                                    <th>返佣金额</th>
                                    <th>返佣时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($rebate_list as $value) {?>
                                <tr class="gradeX">
                                    <td><?=$value['id']?></td>
                                    <td><?=$value['account']?></td>
                                    <td><?=$value['rebate_price']?></td>
                                    <td><?=date('Y-m-d H:m:s',$value['add_time'])?></td>
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

    //入金成功
    function userDeposit_success(that,url) {
        layer.confirm('确认入金?',function () {
            $.ajax({
                url:url,
                type:'GET',
                timeout:5000,
                success:function (data) {
                    if(data.code==0){
                        layer.msg(data.msg);
                        return false;
                    }else if(data.code==1){
                        layer.msg(data.msg,{time:800},function () {
                            location.reload();
                        });
                        return false;
                    }
                },
                error:function () {
                    layer.msg('网络超时,请稍后再试');
                    return false;
                }
            })
        })
    }
    //入金失败
    function userDeposit_fail(that,url) {
        layer.confirm('确认入金?',function () {
            $.ajax({
                url:url,
                type:'GET',
                timeout:5000,
                success:function (data) {
                    if(data.code==0){
                        layer.msg(data.msg);
                        return false;
                    }else if(data.code==1){
                        layer.msg(data.msg,{time:800},function () {
                            location.reload();
                        });
                        return false;
                    }
                },
                error:function () {
                    layer.msg('网络超时,请稍后再试');
                    return false;
                }
            })
        })
    }
</script>

</body>
</html>