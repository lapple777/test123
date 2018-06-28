<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"F:\gitcrm\admin\public/../app/admin\view\index\index.html";i:1529663760;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>后台管理页面</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    
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
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <i class="fa fa-area-chart"></i>
                                        <strong class="font-bold">后台管理</strong>
                                    </span>
                                </span>
                        </a>
                    </div>
                    <div class="logo-element">ADMIN
                    </div>
                </li>
                <!--<li class="hidden-folded padder m-t m-b-sm text-muted text-xs">-->
                <!--<span class="ng-scope">首页</span>-->
                <!--</li>-->
                <li class="line dk"></li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('/admin/Index/welcome'); ?>">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">主页</span>
                    </a>
                </li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('admin/Account/account_info'); ?>">
                        <i class="fa fa-user"></i>
                        <span class="nav-label">账户信息</span>
                    </a>
                </li>
                <!--<li class="line dk"></li>-->
                <li>
                    <a href="mailbox.html"><i class="fa fa-diamond"></i> <span class="nav-label">账户盈利 </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/Account/account_case'); ?>">账户情况</a>
                        </li>

                    </ul>

                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-users"></i> <span class="nav-label">IB管理 </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/IBManage/ib_list'); ?>">IB列表</a>
                        </li>

                    </ul>

                </li>
                 <li>
                    <a href="mailbox.html"><i class="fa fa-user-plus"></i> <span class="nav-label">交易者 </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/TraderAccount/accounts_list'); ?>">交易者账户</a>
                        </li>
                        <li><a class="J_menuItem" href="<?php echo url('admin/TransactionAccounts/accounts_list'); ?>">交易账户</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-user-plus"></i> <span class="nav-label">信息审核 </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/UserInfoAudit/traderInfo_audit'); ?>">交易信息审核</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-user-plus"></i> <span class="nav-label">账户申请列表 </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/TraderAccount/account_sq_list'); ?>">交易者账户申请列表</a>
                        </li>
                        <li><a class="J_menuItem" href="<?php echo url('admin/TransactionAccounts/account_sq_list'); ?>">交易账户申请列表</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-file-text"></i> <span class="nav-label">下单列表</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/Trade/online_order'); ?>">在场订单</a></li>
                        <li><a class="J_menuItem" href="<?php echo url('admin/Trade/history_order'); ?>">历史订单</a></li>

                    </ul>

                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-gg"></i> <span class="nav-label">返佣管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/Rebate/rebate_list'); ?>">返佣列表</a>
                        </li>

                    </ul>

                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-file-text"></i> <span class="nav-label">IB资金管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/FundsManagement/fundsIB_list'); ?>">IB出金</a>
                        </li>
                    </ul>

                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-file-text"></i> <span class="nav-label">客户资金管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/FundsManagement/funds_list'); ?>">客户出金</a>
                        </li>
                        <li><a class="J_menuItem" href="<?php echo url('admin/FundsManagement/deposit_list'); ?>">客户入金</a>
                        </li>
                    </ul>

                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-file-text"></i> <span class="nav-label">交易资金管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/TraderFundVerify/trader_fundIn'); ?>">资金划入审核</a>
                        </li>
                        <li><a class="J_menuItem" href="<?php echo url('admin/TraderFundVerify/trader_fundOut'); ?>">资金划出审核</a>
                        </li>
                    </ul>

                </li>
                <!--<li class="line dk"></li>-->

                <li>
                    <a href="#"><i class="fa fa-align-justify"></i> <span class="nav-label">权限控制</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo url('admin/Menu/menu_list'); ?>">菜单列表</a>
                        </li>
                        <li><a class="J_menuItem" href="<?php echo url('admin/Auth/auth_list'); ?>">权限列表</a>
                        </li>
                        <li><a class="J_menuItem" href="<?php echo url('admin/AuthGroup/auth_group_list'); ?>">用户组列表</a>
                        </li>
                        <li><a class="J_menuItem" href="<?php echo url('admin/Admin/admin_list'); ?>">管理员列表</a>
                        </li>
                    </ul>
                </li>


                <!--<li class="line dk"></li>-->

                <li>
                    <a href="#"><i class="fa fa-gear"></i> <span class="nav-label">全局配置</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="<?php echo url('admin/Config/config_info'); ?>">配置信息</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>

    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>

                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <!--<li class="dropdown">-->
                        <!--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">-->
                            <!--<i class="fa fa-envelope"></i> <span class="label label-warning">16</span>-->
                        <!--</a>-->
                        <!--<ul class="dropdown-menu dropdown-messages">-->
                            <!---->
                            <!--<li>-->
                                <!--<div class="dropdown-messages-box">-->
                                    <!--<a href="profile.html" class="pull-left">-->
                                        <!--<img alt="image" class="img-circle" src="img/a4.jpg">-->
                                    <!--</a>-->
                                    <!--<div class="media-body ">-->
                                        <!--<small class="pull-right text-navy">25小时前</small>-->
                                        <!--<strong>二愣子</strong> 呵呵-->
                                        <!--<br>-->
                                        <!--<small class="text-muted">昨天</small>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</li>-->
                            <!--<li class="divider"></li>-->
                            <!--<li>-->
                                <!--<div class="text-center link-block">-->
                                    <!--<a class="J_menuItem" href="mailbox.html">-->
                                        <!--<i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>-->
                                    <!--</a>-->
                                <!--</div>-->
                            <!--</li>-->
                        <!--</ul>-->
                    <!--</li>-->
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-user"></i><?=session('adminUser')?>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="<?php echo url('admin/Login/logout'); ?>">
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
            <iframe id="J_iframe" name="righe_con" width="100%" height="100%" src="/admin/Index/welcome" frameborder="0" data-id="index_v1.html" seamless></iframe>
        </div>
    </div>
    <!--右侧部分结束-->
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