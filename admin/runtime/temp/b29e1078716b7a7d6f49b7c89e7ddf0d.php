<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"F:\gitcrm\admin\public/../app/admin\view\menu\menu-list.html";i:1530524314;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>菜单管理</title>
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
                            <a data-toggle="tab" href="#tab-1" aria-expanded="true">
                                <ul class="sortable-list connectList agile-list ui-sortable">

                                    <li class="success-element">
                                        菜单列表
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
                                        <a class="btn btn-primary" onclick="add_menu('添加菜单','<?php echo url('admin/Menu/add_menu'); ?>','500','300')">添加菜单</a>


                                    </li>


                                </ul>
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>名称</th>
                                        <th>标识</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($menuList as $menu){?>
                                        <tr class="gradeX">
                                            <td><?=$menu['id']?></td>
                                            <td><?=$menu['_name']?></td>
                                            <td class="center"><?=$menu['navUrl']?></td>
                                            <td class="center">
                                                <a href="javascript:void(0)" class="btn btn-success btn-xs" onclick="edit_menu('添加子菜单','<?php echo url('admin/Menu/add_child_menu',['id'=>$menu['id']]); ?>','500','300')">添加子菜单</a>
                                                <a href="javascript:void(0)" class="btn btn-info btn-xs" onclick="edit_menu('编辑菜单','<?php echo url('admin/Menu/edit_menu',['id'=>$menu['id']]); ?>','500','300')">编辑</a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="del_menu('<?php echo url('admin/Menu/del_menu',['id'=>$menu['id']]); ?>','<?=$menu['name']?>')">删除</a>

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
            "ordering": false,
        });


    });

function add_menu(title,url,w,h){
    layer_show(title,url,w,h);
}
function edit_menu(title,url,w,h){
    layer_show(title,url,w,h);
}
    function del_menu(url,name){
        var index;
        layer.confirm('确定删除菜单 "<span class="text-danger">'+name+'</span>"',function(){
            $.ajax({
                type:'GET',
                url:url,
                beforeSend:function(){
                    index = layer.msg('正在删除...', {
                        icon: 16
                        ,shade: 0.5
                        ,time:false
                    });
                },
                success:function(data){
                    layer.close(index)
                    if(data.code == 1){
                        layer.msg(data.msg,function(){
                            location.reload();
                        });
                        return false;
                    }else if(data.code == 0){
                        layer.msg(data.msg);
                        return false;
                    }
                },
                error:function(){
                    layer.close(index)
                    layer.msg('网络错误，请稍后再试');
                    return false;
                }
            })
        })
    }
</script>

</body>

</html>
