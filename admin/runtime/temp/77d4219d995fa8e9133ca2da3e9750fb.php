<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"F:\gitcrm\admin\public/../app/admin\view\account\account-info.html";i:1529389060;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 组织奖励</title>
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
                           <div class="content_box">
                                <div class="box_left text-center">
                                    <p class="box_title btn btn-w-m btn-primary btn-block">
                                        账号信息
                                    </p>

                                </div>
                                <div class="box_right">
                                    <div class="">
                                        <form class="form-horizontal m-t" id="signupForm">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">ID：</label>
                                                <div class="col-sm-8">
                                                    <input id="firstname"  class="form-control" type="text" value="<?=$adminUser['id']?>" readonly>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">用户名：</label>
                                                <div class="col-sm-8">
                                                    <input id="lastname"  class="form-control" type="text" value="<?=$adminUser['username']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">联系电话：</label>
                                                <div class="col-sm-8">
                                                    <input id="phone" class="form-control" type="text" value="<?=$adminUser['phone']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">邮件地址：</label>
                                                <div class="col-sm-8">
                                                    <input id="email" class="form-control" type="email" value="<?=$adminUser['email']?>" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">创建时间：</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control"  readonly value="<?=date('Y-m-d H:i:s',$adminUser['add_time'])?>">
                                                </div>
                                            </div>



                                        </form>
                                    </div>
                                </div>
                           </div>
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
<script src="/static/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="/static/admin/js/plugins/validate/messages_zh.min.js"></script>

<script src="/static/admin/js/demo/form-validate-demo.js"></script>

<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
<script>
    //外部js调用
    laydate({
        elem: '#create_time', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
        event: 'focus', //响应事件。如果没有传入event，则按照默认的click
        format: 'YYYY-MM-DD hh:mm:ss', //日期格式
        istime: true, //是否开启时间选择
//        isclear: true, //是否显示清空
//        istoday: true, //是否显示今天
//        issure: true, //是否显示确认
//        festival: true, //是否显示节日
//        min: '1900-01-01 00:00:00', //最小日期
//        max: '2099-12-31 23:59:59', //最大日期
//        start: '2014-6-15 23:00:00',    //开始日期
//        fixed: false, //是否固定在可视区域
//        zIndex: 99999999, //css z-index
//        choose: function(dates){ //选择好日期的回调
//
//        }
    });



</script>

</body>

</html>
