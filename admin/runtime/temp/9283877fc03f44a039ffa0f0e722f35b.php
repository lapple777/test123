<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"F:\gitcrm\admin\public/../app/admin\view\transaction_accounts\accounts-list.html";i:1530171791;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 交易账号列表</title>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>交易账号</th>
                                        <th>所属客户</th>
                                        <th>账户余额</th>
                                        <th>注册时间</th>
                                        <th>审核时间</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($account_list as $account){ ?>
                                        <tr class="gradeX">
                                            <td><?=$account['account']?></td>
                                            <td><?=$account['name']?></td>
                                            <td class="center"><?=$account['wallet']?></td>
                                            <td class="center"><?=date('Y-m-d H:i:s',$account['add_time'])?></td>
                                            <td class="center"><?=$account['success_time']?date('Y-m-d H:i:s',$account['success_time']):''; ?></td>

                                            <td class="center">
                                                <?php
                                                $status = $account['ta_status'];
                                                switch($status){
                                                    case 1:
                                                        $statusText = '正常';
                                                        break;
                                                    case 2:
                                                        $statusText = '禁用';
                                                        break;
                                                }
                                                ?>
                                                <?=$statusText?>
                                            </td>

                                            <td class="center">
                                                <a href="javascript:void(0)" onclick="account_edit('编辑','<?php echo url('admin/TransactionAccounts/account_edit',['id'=>$account['id']]); ?>','','550')">编辑</a>
                                                <a href="javascript:void (0)" onclick="account_del(this,'<?php echo url('admin/TransactionAccounts/account_del',['id'=>$account['id']]); ?>')">删除</a>

                                            </td>
                                        </tr>
                                    <?php }?>


                                    </tbody>

                                </table>
                                <div class="text-right page_css">
                                    <?php echo $account_list->render(); ?>
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
    //编辑交易账户
    function account_edit(title,url,w,h){
        layer_show(title,url,w,h);
    }
    //删除交易账户
    function account_del(that,url) {
        layer.confirm('确认删除改交易账户吗?',function () {
            $.ajax({
                url:url,
                type:'GET',
                timeout:5000,
                success:function (data) {
                    if(data.code==0){
                        layer.msg(data.msg);
                        return false;
                    }else if(data.code==1){
                        $(that).parents('tr').remove();
                        layer.msg('已删除',{icon:1,time:1000})
                        return false;
                    }
                },
                error:function () {
                    layer.msg('网络错误,请稍后重试!')
                    return false;
                }
            })
        })
    }
</script>

</body>

</html>
