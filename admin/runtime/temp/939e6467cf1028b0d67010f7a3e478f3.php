<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"D:\PHP\PHPTutorial\WWW\test123\admin\public/../app/ib\view\index\index.html";i:1529051775;s:64:"D:\PHP\PHPTutorial\WWW\test123\admin\app\ib\view\common\css.html";i:1528973180;s:67:"D:\PHP\PHPTutorial\WWW\test123\admin\app\ib\view\common\script.html";i:1527327149;}*/ ?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>IB-后台管理</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
<style>
    .header_box{
        color:white;
    }
</style>
    
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
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"> <i class="fa fa-times-circle"></i></div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs" style="font-size: 20px">
                                    <i class="fa fa-area-chart"></i>
                                    <strong class="font-bold">IB后台</strong>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="logo-element"> IB</div>
                </li>
                <li class="line dk"></li>
                <li class="header_box">
                    <p class="text-center">
                        <img src="/static/index/images/logo2.png" alt="" width="65" height="65"><br/><br/>
                       账户余额:$ <?=session('IBWallet')?><br/>
                    </p>

                </li>
                <li class="line dk"></li>
                <li>
                    <a class="J_menuItem" target="righe_con"  href="<?php echo url('/ib/Index/welcome'); ?>">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">主页</span>
                    </a>
                </li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('/ib/User/user_info'); ?>">
                        <i class="fa fa-user"></i>
                        <span class="nav-label">账户信息</span>
                    </a>
                </li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('/ib/Commission/commision_statistics'); ?>">
                        <i class="fa fa-bar-chart-o"></i>
                        <span class="nav-label">佣金统计</span>
                    </a>
                </li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('/ib/Withdraw/withdraw_manage'); ?>">
                        <i class="fa fa-gg-circle"></i>
                        <span class="nav-label">出金管理</span>
                    </a>
                </li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('/ib/Center/ib_center'); ?>">
                        <i class="fa fa-sitemap"></i>
                        <span class="nav-label">IB中心</span>
                    </a>
                </li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('/ib/Contact/contact_us'); ?>">
                        <i class="fa fa-phone-square"></i>
                        <span class="nav-label">联系我们</span>
                    </a>
                </li>
                <li>
                    <a class="J_menuItem" target="right_con" href="<?php echo url('/ib/News/news_notice'); ?>">
                        <i class="fa fa-bell"></i>
                        <span class="nav-label">新闻通知</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!--<左导航结束-->
    <!--右侧部分开始-->
    <!--右上方导航开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>

                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-user"></i><?=session('IBUser')?>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="<?php echo url('ib/Login/logout'); ?>">
                                    <div>
                                        退出登录
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe id="J_iframe" name="righe_con" width="100%" height="100%" src="/ib/Index/welcome" frameborder="0" data-id="index-v1.html" seamless></iframe>
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
<script src="/static/admin/js/hAdmin.js?v=4.1.0"></script>
<script type="text/javascript" src="/static/admin/js/index.js"></script>

<!-- 第三方插件 -->
<script src="/static/admin/js/plugins/pace/pace.min.js"></script>
</body>
 </html>