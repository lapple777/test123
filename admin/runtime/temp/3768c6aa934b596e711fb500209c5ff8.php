<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"F:\gitcrm\admin\public/../app/admin\view\user_info_audit\traderInfo-edit.html";i:1529663760;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1529054880;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>交易账号审核</title>
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
        .tab-content img{
            width: 50%;
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
                                    交易账号信息审核
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
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>出生年月</th>
                                    <th>手机号</th>
                                    <th width="100px">邮箱</th>
                                    <th>身份证号</th>
                                    <th >身份证正面</th>
                                    <th>身份证反面</th>
                                    <th>银行卡号</th>
                                    <th>银行卡正面</th>
                                    <th>银行卡反面</th>
                                    <th>开户行</th>
                                    <th width="180px">地址</th>
                                    <th width="120px">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($traderInfo_list as $account){?>
                                <tr class="gradeX">
                                    <td><?=$account['id']?></td>
                                    <td><?=$account['username']?></td>
                                    <td><?=$account['name']?></td>
                                    <td>
                                        <?php
                                            $status = $account['male'];
                                            switch($status){
                                                case 1:
                                                    $statusText = '男';
                                                    break;
                                                case 2:
                                                    $statusText = '女';
                                                    break;
                                            }
                                            ?>
                                        <?=$statusText?>
                                    </td>
                                    <td><?=$account['birthday']?></td>
                                    <td class="center"><?=$account['phone']?></td>
                                    <td class="center"><?=$account['email']?></td>
                                    <td class="center"><?=$account['id_card']?></td>
                                    <td class="center"><img src="/uploads/<?=$account['id_card_zm']?>"></td>
                                    <td class="center"><img src="/uploads/<?=$account['id_card_fm']?>"></td>
                                    <td class="center"><?=$account['bank_card']?></td>
                                    <td class="center"><img src="/uploads/<?=$account['bank_card_zm']?>"></td>
                                    <td class="center"><img src="/uploads/<?=$account['bank_card_fm']?>"></td>
                                    <td class="center"><?=$account['open_bank']?></td>
                                    <td class="center"><?=$account['address']?></td>
                                    <td class="center">
                                        <a href="javascript:void(0)" onclick="checkUserStatus('<?=$account['id']?>',1)">通过</a>
                                        <a href="javascript:void(0)" onclick="checkUserStatus('<?=$account['id']?>',3)">不通过</a>

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
    function checkUserStatus(id,status){
        var index;
        $.ajax({
            type:'POST',
            url:'',

            data:{'id':id,'status':status},
            beforeSend:function(){
                index = layer.msg('正在处理...', {
                    icon: 16
                    ,shade: 0.5
                    ,time:false
                });

            },
            success:function(data){
                if(data.code == 1){
                    location.reload();
                }
                layer.close(index);
                layer.msg(data.msg)
            },
            error:function(){
                layer.msg('网络错误，请重试');
            }
        })
    }

</script>

</body>

</html>
