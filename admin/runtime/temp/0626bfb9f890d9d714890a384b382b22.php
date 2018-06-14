<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\PHP\PHPTutorial\WWW\test123\admin\public/../app/admin\view\i_b_manage\ib-list.html";i:1528943849;s:67:"D:\PHP\PHPTutorial\WWW\test123\admin\app\admin\view\common\css.html";i:1528943849;s:70:"D:\PHP\PHPTutorial\WWW\test123\admin\app\admin\view\common\script.html";i:1528943849;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> IB管理</title>
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
                                        基本信息
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
                                        <a class="btn btn-primary" onclick="ib_add('添加IB','<?php echo url('admin/IBManage/ib_add'); ?>','','550')">添加IB</a>

                                    </li>


                                </ul>
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>用户名</th>
                                        <th>姓名</th>
                                        <th>手机号</th>
                                        <th>邮箱</th>
                                        <th>佣金</th>
                                        <th>身份证号</th>
                                        <th>银行卡号</th>
                                        <th>状态</th>
                                        <th>注册链接</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($ib_list as $ib){?>
                                    <tr class="gradeX">
                                        <td><?=$ib['username']?></td>
                                        <td><?=$ib['name']?></td>
                                        <td><?=$ib['phone']?></td>
                                        <td ><?=$ib['email']?></td>
                                        <td ><?=$ib['wallet']?></td>
                                        <td ><?=$ib['id_card']?></td>
                                        <td ><?=$ib['bank_card']?></td>
                                        <td ><?=$ib['ib_status'] == 1?'<span class="btn btn-success btn-xs">启用</span>':'<span class="btn btn-danger btn-xs">禁用</span>'?></td>
                                        <td ><?='http://'.$_SERVER['HTTP_HOST'].'/index/Register/index?orangeKey='.$ib['orange_key']?></td>
                                        <td class="center">
                                            <a href="javascript:void(0)" onclick="ib_edit('编辑IB账户','<?php echo url('admin/IBManage/ib_edit',['ib_id'=>$ib['id']]); ?>','','550')">编辑</a>
                                            <a href="javascript:void(0)" onclick="ib_del(this,'<?php echo url('admin/IBManage/ib_del',['ib_id'=>$ib['id']]); ?>')">删除</a>

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
    function ib_del(that,url){
        layer.confirm('确认删除？',function(){
            $.ajax({
                url:url,
                timeout:5000,
                type:'GET',
                success:function(data){
                    if(data.code == 0){
                        layer.msg(data.msg);
                        return false;
                    }else if(data.code == 1){
                        $(that).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                        return false;
                    }
                    console.log(data);
                },
                error:function(){
                    layer.msg('网络超时，请稍后再试');
                    return false;
                }


            })
        })
    }
    function ib_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    function ib_edit(title,url,w,h){
        layer_show(title,url,w,h);
    }
</script>

</body>

</html>
