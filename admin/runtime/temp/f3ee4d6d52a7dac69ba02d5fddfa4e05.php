<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"F:\gitcrm\admin\public/../app/admin\view\funds_management\fundsIB-list.html";i:1529054880;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1529054880;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>出入金管理</title>
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
                                <a data-toggle="tab" href="#tab-1" aria-expanded="true">IB出金审核</a>
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
                                    <th>账单号</th>
                                    <th>出金人</th>
                                    <th>出金账号</th>
                                    <th>出金金额</th>
                                    <th>出金人状态</th>
                                    <th>出金时间</th>
                                    <th>出金状态</th>
                                    <th>完成时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($ib_outmoney_list as $value) {?>
                                <tr class="gradeX">
                                    <td><?=$value['id']?></td>
                                    <td><?=$value['order_id']?></td>
                                    <td><?=$value['name']?></td>
                                    <td><?=$value['id_card']?></td>
                                    <td><?=$value['outmoney']?></td>
                                    <td>
                                        <?php
                                               $statusIb = $value['ib_status'];
                                               switch($statusIb){
                                                  case '0':
                                                     $statusTxt = '禁用';
                                                      break;
                                                   case '1':
                                                      $statusTxt = '启用';
                                                      break;
                                                }
                                                ?>
                                        <?=$statusTxt?>
                                    </td>

                                    <td><?=date('Y-m-d H:m:s',$value['add_time'])?></td>
                                    <td>
                                        <?php
                                              $orderStatus = $value['order_status'];
                                              switch($orderStatus){
                                                 case '0':
                                                    $statusText = '审核中';
                                                    break;
                                                  case '1':
                                                    $statusText = '审核成功';
                                                     break;
                                                  case '2':
                                                     $statusText = '审核失败';
                                                     break;
                                              }
                                              ?>
                                        <?=$statusText?>
                                    </td>
                                    <td>
                                        <?php
                                                if($value['success_time']==0){
                                                ?>
                                        <span></span>
                                        <?php }
                                               else {
                                               ?>
                                        <span> <?=date('Y-m-d H:m:s',$value['success_time'])?></span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php
                                                if($value['order_status']==0){
                                                ?>
                                        <a href="javascript:void(0)" onclick="IBWithdraw_success(this,'<?php echo url('admin/FundsManagement/IBWithdraw_success',['order_id'=>$value['order_id'],'ib_id'=>$value['user_id']]); ?>')">成功</a>
                                        <a href="javascript:void(0)" onclick="IBWithdraw_fail(this,'<?php echo url('admin/FundsManagement/IBWithdraw_fail',['order_id'=>$value['order_id'],'ib_id'=>$value['user_id'],'outmoney'=>$value['outmoney']]); ?>')">失败</a>
                                        <?php }
                                               else {
                                               ?>
                                        <span>已审核</span>
                                        <?php }?>

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

    //IB出金成功
    function IBWithdraw_success(that,url) {
        layer.confirm('确认出金?',function () {
            $.ajax({
                url:url,
                timeout:5000,
                type:'GET',
                success:function (data) {
                    console.log('客户出金')
                    console.log(data);
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
                    layer.msg('网络超时,请稍后再试!')
                    return false;
                }
            })
        })
    }
    //IB出金失败
    function IBWithdraw_fail(that,url) {
        layer.confirm('出金失败?',function () {
            $.ajax({
                url:url,
                timeout:5000,
                type:'GET',
                success:function (data) {
                    if(data.code==0){
                        layer.msg(data.msg)
                    }else if(data.code==1){
                        layer.msg(data.msg,{time:800},function () {
                            location.reload();
                        });
                    }
                },
                error:function () {
                    layer.msg('网络超时,请稍后再试!');
                }
            })
        })
    }
</script>

</body>

</html>
