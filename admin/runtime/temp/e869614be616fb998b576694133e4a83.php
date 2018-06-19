<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"F:\gitcrm\admin\public/../app/trader\view\trader\trader-list.html";i:1529374371;s:47:"F:\gitcrm\admin\app\trader\view\common\css.html";i:1529054880;s:50:"F:\gitcrm\admin\app\trader\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 交易者账户列表</title>
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
                                    交易者账户
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
                                    <a class="btn btn-primary" onclick="traderuser_get()">交易账户申请</a>
                                </li>
                            </ul>
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>交易账号</th>
                                    <th>账户余额</th>
                                    <th>添加时间</th>
                                    <th>状态</th>
                                    <th width="250">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($trader_list as $trader){?>
                                    <tr class="gradeX">
                                        <td><?=$trader['id']?></td>
                                        <td><?=$trader['account']?></td>
                                        <td><?=$trader['wallet']?></td>
                                        <td class="center"><?=date('Y-m-d H:i:s',$trader['add_time'])?></td>
                                        <td class="center">
                                            <?php
                                            $status = $trader['ta_status'];
                                            if($status == 0){
                                                echo '正在审核中...';
                                            }else if($status == 1){
                                                 echo '正常';
                                            }else if($status == 2){
                                                 echo '禁用';
                                            }
                                            ?>
                                        </td>
                                        <td class="center">
                                            <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="changePwd('<?php echo url("Trader/changePwd",['account'=>$trader['account']]); ?>')">修改密码</a>
                                            <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="fundAllot('资金分配','<?php echo url("FundAllot/fundAllot",['account'=>$trader['account']]); ?>','500','300')">分配资金</a>

                                            <a href="javascript:void(0)" class="btn btn-xs btn-success" onclick="account_login('<?php echo url("FundAllot/login",['account'=>$trader['account']]); ?>')">登录此交易账号</a>
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
        //"aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[5]}// 制定列不参与排序
        ]

    });

});
//修改密码
function changePwd(url){
    layer.prompt({title: '请输入新密码', formType: 1}, function(pass, index){
        $.ajax({
            type:'POST',
            url:url,
            data:{password:pass},
            success:function(data){
                layer.msg(data.msg);
            },
            error:function(){
                layer.msg('网络错误，请稍后重试');
                return false;
            }
        })
        layer.close(index);
    });
}
//登录交易账号
function account_login(url){
    var index = '';
    $.ajax({
        type:'GET',
        url:url,
        beforeSend:function(){
            index = layer.msg('正在登录...',{time:false});
        },
        success:function(data){
            layer.close(index);
            layer.msg(data.msg);
            if(data.code == 1){
                loction.href = data.msg
            }
        },
        error:function(){
            layer.close(index);
            layer.msg('网络错误,请稍后重试...');
            return false;
        }
    })
}
    //交易账户申请
function traderuser_get(){
    var index = '';
    $.ajax({
        type:'GET',
        url:'<?php echo url("trader/Trader/traderUserGet"); ?>',
        data:'',
        beforeSend:function(){
            index = layer.msg('正在提交申请...',{time:false});

        },
        success:function(data){
            layer.close(index);
            layer.msg(data.msg);
            return false;

        },
        error:function(){
            layer.msg('网络错误,请稍后重试...');
            return false;
        }
    })
}
//资金分配
function fundAllot(title,url,w,h){
    layer_show(title,url,w,h);
}

</script>

</body>

</html>
