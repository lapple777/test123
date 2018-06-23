<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"F:\gitcrm\admin\public/../app/index\view\index\order.html";i:1529387801;s:49:"F:\gitcrm\admin\app\index\view\common\script.html";i:1529054880;s:46:"F:\gitcrm\admin\app\index\view\common\css.html";i:1529054880;s:49:"F:\gitcrm\admin\app\index\view\common\header.html";i:1529054880;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>下单</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <!--<script src="//cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>-->
<script type="text/javascript" src="/static/index/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/index/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/index/js/scrollspy.js"></script>

<!--[if lt IE 9]>
<script src="/static/index/js/html5shiv.min.js"></script>
<script src="/static/index/js/respond.min.js"></script>
<![endif]-->
    <script src="/static/index/layer3.11/layer.js"></script>
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="/static/index/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="/static/index/css/main.css" rel="stylesheet" type="text/css">

    <style>
        .chart_box{
            height:400px;
        }
        .btn_res{
            height:30px;
        }
        .btn_sub{
            margin-top:20px;
            margin-right:30px;
        }
        .current_price{
            height:30px;
            line-height:30px;
        }
        .order_right button {
             padding: 0px 12px;

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
	<div class="container-fluid my_account_box main_box">
    <div class="main_body">
    	<div class="container my_account my_order">
			<div class="chart_box">
                <div id="container" style="height: 100%"></div>
			</div>
        	<div class="my_order_box">
            	<h1>下单</h1>
				<span></span>
				<form action="" id="orderFrom" method="post">
	                <div class="row order_box">
		                <div class="col-md-2 order_left">
		                    <p>下单品种:</p>
		                    <p>当前价格:</p>
		                    <p>下单手数:</p>
		                    <p>下单类型:</p>

		                </div>
		                <div class="col-md-3 order_right">
		                     <p>EURUSD</p>
		                    <p class="current_price"></p>
                            <input type="hidden" name="current_price" id="current_price" value="">
                            <input type="hidden" name="current_price2" id="current_price2" value="">
		                    <p class="order_radio">
		                      <div class="form-group  order_radio">
								  <input type="number" name="lot" step="0.1" min="0.1" value="10" />
		                       </div>
		                    </p>
		                    <p>
			                    <label class="radio-inline" style="line-height:20px;">
		                            <input type="radio" name="direction" id="inlineRadio1" value="1"> 做多
		                    	</label>
			                    <label class="radio-inline" style="line-height:20px;">
			                    	<input type="radio" name="direction" id="inlineRadio2" value="2"> 做空
		                    	</label>
		                    </p>
		                    <p>
                                <span class="btn btn-danger btn-sm btn_sub" onclick="subFrom()">提交</span>
                                <button class="btn btn-primary btn-sm btn_res" type="reset">重置</button>
                            </p>
		                </div>
	             	</div>
				</form>
            </div>

		<!--3-->
            <div class="my_order_box">
            	<h1>在场订单<span></span></h1>
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
                         <th>订单状态</th>
                      </tr>
                   </thead>
                   <tbody id="data">

                   </tbody>
                </table>
            	</div>
        	</div>
        </div>
     </div>
    </div>

</body>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
<script src='https://cdn.bootcss.com/socket.io/2.0.3/socket.io.js'></script>

<script src="/static/index/js/orderjs.js"></script>

<script>
getKData('<?=session("username")?>');


</script>

</html>
