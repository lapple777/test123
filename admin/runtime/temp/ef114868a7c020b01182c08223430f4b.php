<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"F:\gitcrm\admin\public/../app/admin\view\trader_fund_verify\trader-out-verify.html";i:1530168219;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>资金划出审核</title>
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
                                <a data-toggle="tab" href="#tab-1" aria-expanded="true">划出审核</a>
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
                                    <th>账单号</th>
                                    <th>划出账号</th>
                                    <th>划入账户</th>
                                    <th>划入账户名</th>
                                    <th>划出金额</th>
                                    <th>划出时间</th>
                                    <th>划出状态</th>
                                    <th>完成时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($trader_fundOut_list as $value) {?>
                                <tr class="gradeX">
                                    <td><?=$value['order_id']?></td>
                                    <td><?=$value['trader_user']?></td>
                                    <td><?=$value['user_id']?></td>
                                    <td><?=$value['name']?></td>
                                    <td><?=$value['transfer_price']?></td>
                                    <td><?=date('Y-m-d H:i:s',$value['add_time'])?></td>
                                    <td>
                                        <?php
                                               $statusIb = $value['transfer_status'];
                                               switch($statusIb){
                                                  case '0':
                                                     $statusTxt = '审核中';
                                                      break;
                                                   case '1':
                                                      $statusTxt = '划出成功';
                                                      break;
                                                   case '2':
                                                      $statusTxt = '划出失败';
                                                      break;
                                                }
                                                ?>
                                        <?=$statusTxt?>
                                    </td>


                                    <td>
                                        <?php
                                                if($value['success_time']==0){
                                                ?>
                                        <span></span>
                                        <?php }
                                               else {
                                               ?>
                                        <span> <?=date('Y-m-d H:i:s',$value['success_time'])?></span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php
                                                if($value['transfer_status']==0){
                                                ?>
                                        <a href="javascript:void(0)" onclick="fund_out_success(this,'<?php echo url('admin/TraderFundVerify/fund_out_success',['order_id'=>$value['order_id'],'user_id'=>$value['user_id'],'transfer_price'=>$value['transfer_price']]); ?>')">成功</a>
                                        <a href="javascript:void(0)" onclick="fund_out_fail(this,'<?php echo url('admin/TraderFundVerify/fund_out_fail',['order_id'=>$value['order_id'],'trader_user'=>$value['trader_user'],'transfer_price'=>$value['transfer_price']]); ?>')">失败</a>
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
                            <div class="text-right page_css">
                                <?php echo $trader_fundOut_list->render(); ?>
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
<script src="/static/admin/js/plugins/jeditable/jquery.jeditable.js"></script>

<!-- Data Tables -->
<script src="/static/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/static/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>


<script>
    $(document).ready(function () {
        $('.dataTables-example').dataTable({
            "paging":false
        });


    });

    //划出成功
    function fund_out_success(that,url) {
        layer.confirm('确认划出?',function () {
            var index  = '';
            index = layer.load();
            $.ajax({
                url:url,
                timeout:5000,
                type:'GET',
                success:function (data) {
                    layer.close(index);
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
                    layer.close(index);
                    layer.msg('网络超时,请稍后再试!')
                    return false;
                }
            })
        })
    }
    //划出失败
    function fund_out_fail(that,url) {
        layer.confirm('划出失败?',function () {
            var index  = '';
            index = layer.load();
            $.ajax({
                url:url,
                timeout:5000,
                type:'GET',
                success:function (data) {
                    layer.close(index);
                    if(data.code==0){
                        layer.msg(data.msg)
                        return false;
                    }else if(data.code==1){
                        layer.msg(data.msg,{time:800},function () {
                            location.reload();
                        });
                        return false;
                    }
                },
                error:function () {
                    layer.close(index);
                    layer.msg('网络超时,请稍后再试!');
                    return false;
                }
            })
        })
    }

</script>

</body>

</html>