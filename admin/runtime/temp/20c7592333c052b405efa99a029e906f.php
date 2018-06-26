<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"F:\gitcrm\admin\public/../app/ib\view\contact\contact-us.html";i:1529054880;s:43:"F:\gitcrm\admin\app\ib\view\common\css.html";i:1529054880;s:46:"F:\gitcrm\admin\app\ib\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>联系我们</title>
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
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-sm-6">
        <p>联系人:<?=$admin_info['username']?></p>
        <p>联系方式:<?=$admin_info['email']?></p>
        <p>电话号码:<?=$admin_info['phone']?></p>
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
</body>
</html>