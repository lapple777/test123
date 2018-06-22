<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"F:\gitcrm\admin\public/../app/index\view\index\account.html";i:1529663760;s:46:"F:\gitcrm\admin\app\index\view\common\css.html";i:1529054880;s:49:"F:\gitcrm\admin\app\index\view\common\script.html";i:1529054880;s:49:"F:\gitcrm\admin\app\index\view\common\header.html";i:1529054880;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>账号信息</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="/static/index/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="/static/index/css/main.css" rel="stylesheet" type="text/css">

    <!--<script src="//cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>-->
<script type="text/javascript" src="/static/index/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/index/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/index/js/scrollspy.js"></script>

<!--[if lt IE 9]>
<script src="/static/index/js/html5shiv.min.js"></script>
<script src="/static/index/js/respond.min.js"></script>
<![endif]-->
    <style>
        .my_account_top{
            background:#868ec5;
        }
    </style>
</head>
<body>
<style>
    .nav_right li .a {
        background-color: #868ec5;
    }
    .navbar-default .navbar-nav>li>a:hover{ color:#fff; background-color:#868ec5;}

</style>
<div class="container-fluid nav_big_box">
    <div class="container">
        <nav class="navbar navbar-default nav_box" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand logo"><img src="/static/index/images/logo.png"></a>-->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right nav_right">
                        <li><a class="a1 a" id="index" href="<?php echo url('index/Index/index'); ?>">账户基本信息</a></li>
                        <li><a class="a2 " id="myorder" href="<?php echo url('index/Order/myOrder'); ?>">下单</a></li>
                        <li><a class="a3 " id="statement" href="<?php echo url('index/Statements/statement'); ?>">历史订单</a></li>
                        <?php if(session('username')){?>
                            <li><a class="a4" href="<?php echo url('index/Login/loginOut'); ?>">退出</a></li>
                        <?php }else{?>
                            <li><a class="a4" id="login" href="<?php echo url('index/Login/login'); ?>">登录 </a></li>
                        <?php }?>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>
<script>
    var url = location.href;
    var arr = url.split(".");
    var res = arr[arr.length-2].split('/')
    var id = res[res.length-1];
    if(id != 'admin'){
        $('.nav_right li a').removeClass('a')
        $('#'+id).addClass('a')
    }

</script>
	<div class="container-fluid my_account_box">
    	<div class="container">
        	<div class="row my_account">
              <div class="col-md-3"></div>

              <div class="col-md-6 account_box">
              		<div class="my_account_top">
                        <!--<img class="img-circle" src="/static/index/images/my_touxiang.png">-->
                        <h1>基本信息</h1>
                    </div>

                 <div class="my_account_bottom">
                    <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Account ID:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['tid']?></div>
                    </div>
                    <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Fullname:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['account']?></div>
                    </div>
                     <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Gender:</div>
                         <div class="col-md-9 col-xs-9 account_right">
                         <?php
                         $sex = $user['male'];
                            switch($sex){
                             case '1':
                            $maleTxt  = '男';
                             break;
                             case  '2':
                             $maleTxt = '女';
                             break;
                             }
                         ?>
                             <?=$maleTxt?>
                         </div>
                     </div>
                     <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Date of birth:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['birthday']?></div>
                     </div>
                     <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Address:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['address']?></div>
                     </div>
                     <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Email:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['email']?></div>
                     </div>
                     <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">IC:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['id_card']?></div>
                     </div>
                    <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Created:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=date('Y-m-d H:i:s',$user['add_time'])?></div>
                    </div>
                    <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Balance:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['wallet']?></div>
                    </div>
                     <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">AgentID:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['user_id']?></div>
                     </div>

                    <div class="row account">
                         <div class="col-md-3 col-xs-3 account_left">Account Status:</div>
                         <div class="col-md-9 col-xs-9 account_right"><?=$user['ta_status']?></div>
                    </div>
              </div>
              </div>
               <div class="col-md-3"></div>
            </div>
        </div>

    </div>
</body>
</html>
