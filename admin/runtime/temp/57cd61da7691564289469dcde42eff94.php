<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:61:"F:\gitcrm\admin\public/../app/index\view\index\statement.html";i:1529996501;s:46:"F:\gitcrm\admin\app\index\view\common\css.html";i:1529054880;s:49:"F:\gitcrm\admin\app\index\view\common\script.html";i:1529054880;s:49:"F:\gitcrm\admin\app\index\view\common\header.html";i:1529054880;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>历史订单</title>
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
	<div class="container-fluid my_account_box main_box">
    <div class="main_body">
    	<div class="container  my_account my_order">
            <div class="my_order_box pending_orders">
            	<h1>历史订单</h1>
                <div class="table-responsive leibiao">
                  <table class="table">
                   <thead>

					  <tr>
						  <th>订单号</th>
						  <th>订单类型</th>
						  <th>下单价格</th>
						  <th>止盈价</th>
						  <th>止损价</th>
						  <th>手数</th>
						  <th>下单时间</th>
						  <th>平仓时间</th>
						  <th>盈利</th>
						  <th>手续费</th>
						  <th>订单状态</th>
					  </tr>

                   </thead>
                   <tbody>
				   <?php if(!empty($historyOrder)){
				        foreach($historyOrder as $order){?>
                       <tr>
                           <td><?=$order['order_id']?></td>
                           <td> <?=$order['order_type'] == 1?'<span class="text-danger">做多</span>':'<span class="text-success">做空</span>'?></td>
                           <td><?=$order['order_price']?></td>
                           <td><?=$order['stop_profit']?></td>
                           <td><?=$order['stop_loss']?></td>
                           <td><?=$order['lot_num']?></td>
                           <td><?=date('Y-m-d H:i:s',$order['add_time'])?></td>
                           <td><?=date('Y-m-d H:i:s',$order['order_close_time'])?></td>
                           <?php  $status = $order['order_status'];?>
                           <td><?php echo '<span class="text-danger">'.$order['profit'].'</span>';?></td>
                           <td><?='-'.$order['hand_price']?></td>
                           <td>
                               <?php
                                    switch($status){
                                        case 1:
                                            echo '<span class="text-danger">成功</span>';
                                            break;
                                        case 2:
                                            echo '<span class="text-success">失败</span>';
                                            break;
                                    }
                               ?>
                           </td>
                       </tr>

                   <?php }?>
                   <tr>
                       <td colspan="10">
                           <?php echo $historyOrder->render(); ?>
                       </td>
                   </tr>
                   <?php }else{?>
                   <tr>
                       <td colspan="9" class="text-center">没有数据</td>
                   </tr>
                   <?php }?>
				   </tbody>
                </table>
                </div>
        </div>
        </div>
    </div>
    </div>
</body>
</html>
