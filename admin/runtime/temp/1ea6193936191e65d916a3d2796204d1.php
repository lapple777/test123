<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"D:\PHP\PHPTutorial\WWW\test123\admin\public/../app/trader\view\fund_allot\fund-allot.html";i:1528943849;s:68:"D:\PHP\PHPTutorial\WWW\test123\admin\app\trader\view\common\css.html";i:1528943849;s:71:"D:\PHP\PHPTutorial\WWW\test123\admin\app\trader\view\common\script.html";i:1528943849;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 资金分配</title>
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

        .content_box{
            width:80%;
            height:900px;
            margin:0 auto;
            border:1px solid #ccc;
        }
        .box_left{
            border-right:1px solid #ccc;
            height:100%;
            width:20%;
            float:left;
        }
        .box_right{
            width:60%;
            height:100%;
            float:left;
        }
        .box_title{
            margin: 30px 0 0 0;
            height:45px;
            line-height:40px;
        }
        .id_card{
            width: 250px;
            height: 150px;
            background:#ccc;
            display:inline-block;
            margin-right:10px;
            -webkit-border-radius:10px;
            -moz-border-radius:10px;
            border-radius:10px;
        }
        .card_box{
            width:660px;
            padding-left: 15px;
        }
    </style>

</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">


                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> 划入资金</a>
                            </li>
                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">划出资金</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <form class="form-horizontal m-t" method="post" id="inForm">
                                        <table class="table">
                                            <tr>
                                                <td class="text-right">划入金额</td>
                                                <td><input id="inmoney" name="inmoney" type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-primary" type="submit">提交</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <form class="form-horizontal m-t" method="post" id="outForm">
                                        <table class="table">
                                            <tr>
                                                <td class="text-right">划出金额</td>
                                                <td><input id="outmoney" name="outmoney" type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-primary" type="submit">提交</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
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

<!-- jQuery Validation plugin javascript-->
<script src="/static/admin/js/from_validate/jquery.validate.min.js"></script>
<script src="/static/admin/js/from_validate/messages_zh.min.js"></script>

<script src="/static/admin/js/from_validate/validate-methods.js"></script>




<script>

    $().ready(function() {
        //划入金额
        $("#inForm").validate({
            rules:{
                inmoney:{
                    required:true,
                }
            },
            onkeyup:false,
            focusCleanup:true,
            submitHandler: function(form)
            {
                $.ajax({
                    url:'<?php echo url('FundAllot/fund_in'); ?>',
                    type:'POST',
                    data:$(form).serialize(),
                    success:function(data){
                        console.log(data);
                        if(data.code == 1){
//                            var index = parent.layer.getFrameIndex(window.name);
//                            parent.layer.close(index);
                            layer.msg(data.msg,{time:800},function(){
                                parent.location.reload();
                            });
                            return false;
                        }else if(data.code == 0){
                            layer.msg(data.msg);
                            return false;
                        }
                    },
                    error:function(){
                        layer.msg('网络错误，请稍后再试');
                        return false;
                    }
                })

            }
        });
        //划出金额
        $("#outForm").validate({
            rules:{
                inmoney:{
                    required:true,
                }
            },
            onkeyup:false,
            focusCleanup:true,
            submitHandler: function(form)
            {
                $.ajax({
                    url:'<?php echo url('FundAllot/fund_out'); ?>',
                    type:'POST',
                    data:$(form).serialize(),
                    success:function(data){
                        console.log(data);
                        if(data.code == 1){
//                            var index = parent.layer.getFrameIndex(window.name);
//                            parent.layer.close(index);
                            layer.msg(data.msg,{time:800},function(){
                                parent.location.reload();
                            });
                            return false;
                        }else if(data.code == 0){
                            layer.msg(data.msg);
                            return false;
                        }
                    },
                    error:function(){
                        layer.msg('网络错误，请稍后再试');
                        return false;
                    }
                })

            }
        });

});


</script>

</body>

</html>
