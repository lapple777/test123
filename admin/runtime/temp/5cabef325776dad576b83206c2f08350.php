<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"F:\gitcrm\admin\public/../app/trader\view\index\index.html";i:1530171791;s:47:"F:\gitcrm\admin\app\trader\view\common\css.html";i:1530169408;s:50:"F:\gitcrm\admin\app\trader\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>客户管理页面</title>

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
        margin-top:-65px;
    }
</style>
    <style>
        body.fixed-sidebar .navbar-static-side, body.canvas-menu .navbar-static-side {
            width: 270px;
        }
        #page-wrapper {
            margin: 0 0 0 270px;
        }
        .header_box{
            color:white;
            margin-top:60px;
        }
        .header_box table{
            margin:0 auto;
        }
        .text_inde{
            text-indent: 1em;
        }
        .padd_top{
            padding-top:10px;
        }
        .workday{
            font-size: 15px;
            color: #869fb1
        }
    </style>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side nav_left" role="navigation">
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
                                        <strong class="font-bold">客户管理</strong>
                                    </span>
                                </span>
                        </a>
                    </div>
                    <div class="logo-element">
                        TRADER
                    </div>
                </li>
                <li class="header_box">
                    <p class="text-center">
                        <img src="/static/index/images/my_touxiang.png" alt="" width="65" height="65"><br/><br/>
                        <?=session('traderUser')?>
                    </p>
                </li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('trader/Index/welcome'); ?>">
                        <i class="fa  fa-user"></i>
                        <span class="nav-label">账户信息</span>
                    </a>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-diamond"></i> <span class="nav-label">交易账户管理 </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo url('Trader/trader_list'); ?>" >交易账户列表</a>
                        </li>
                    </ul>

                </li>
                <li>

                    <a class="" target="_blank" href="<?php echo url('index/Login/login'); ?>">
                        <i class="fa fa-object-ungroup"></i>
                        <span class="nav-label">交易账号登录</span>
                    </a>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-diamond"></i> <span class="nav-label">资金分配记录 </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo url('FundRecord/fund_in_record'); ?>">划入记录</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo url('FundRecord/fund_out_record'); ?>">划出记录</a>
                        </li>

                    </ul>

                </li>
                <li>
                    <a href="mailbox.html"><i class="fa  fa-credit-card"></i> <span class="nav-label">出入金管理 </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo url('Brm/inmoney_list'); ?>">入金</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo url('Brm/outmoney_list'); ?>">出金</a>
                        </li>

                    </ul>

                </li>
                <li>
                    <a class="J_menuItem" target="righe_con" href="<?php echo url('trader/LeaveMessage/leave_message'); ?>" onclick="change_num()">
                        <i class="fa  fa-commenting"></i>
                        <span class="nav-label">留言</span>
                        <?php if($count > 0){ ?>
                            <span class="badge badge-danger"><?=$count?></span>
                        <?php }?>
                    </a>
                </li>
                <li class="line dk"></li>
                <li class="line dk"></li>
                <li class="line dk"></li>
                <li class="line dk"></li>
                <li class="line dk"></li>
                <li class="line dk"></li>
                <li>
                  <p class="workday">  工作时间：<br/>
                      <label style="width: 28px;"></label>       周一至周五<br>
                      <label style="width: 28px;"></label>      上午 09：00-12：00<br/>
                      <label style="width: 28px;"></label>       下午 14：00-17：00<br/>
                      <label style="width: 28px;"></label>        法定节假日除外
                  </p>
                </li>
            </ul>
        </div>

    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-user"></i><?=session('traderUser')?>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a onclick="modifyPwd('修改密码','<?php echo url('trader/Login/modify_pwd'); ?>','400','350')">
                                    <div>
                                        修改密码
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('trader/Login/logout'); ?>">
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
            <iframe id="J_iframe" name="righe_con" width="100%" height="100%" src="/trader/Index/welcome" frameborder="0" data-id="index_v1.html" seamless></iframe>
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
<script>
    function change_num(){
        $('.badge-danger').hide();
    }
    function modifyPwd(title,url,w,h) {
        layer_show(title,url,w,h);
    }
</script>
</body>
<script>
</script>
</html>
