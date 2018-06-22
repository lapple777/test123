<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:78:"D:\PHP\PHPTutorial\WWW\test123\admin\public/../app/index\view\index\login.html";i:1528943849;s:67:"D:\PHP\PHPTutorial\WWW\test123\admin\app\index\view\common\css.html";i:1528943849;s:70:"D:\PHP\PHPTutorial\WWW\test123\admin\app\index\view\common\script.html";i:1528943849;s:70:"D:\PHP\PHPTutorial\WWW\test123\admin\app\index\view\common\header.html";i:1528943849;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录</title>
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
    <link rel="stylesheet" href="/static/index/css/validate_from_style.css">
	<style>
		#bg_color{
			position:absolute;
            width:100%;
            height:100%;
            background:#716d6dcc;
            z-index: 1;
		}
        .login {
            z-index: 999;
        }
        .login h1{
            color:black;
        }
        .user {
            background: #868ec5;
        }
        .login_main_bottom button {
            background: #868ec5;
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
<div id="bg_color"></div>
<div class="container-fluid login_box" >

	<div class="login">
		<form action="<?php echo url('Login/login'); ?>" method="post" class="loginform" >
	        <div class="login_main">
	        	<!--<div class="login_main_top">-->
	            	<!--<img class="img-circle" src="/static/index/images/touxiang.png">-->
	            <!--</div>-->
	            <div class="login_main_bottom">
					<div class="form-group"><h1>登录</h1></div>
	            	<div class="form-group ">
	                    <div class="input-group">
	                      <div class="input-group-addon user"><img src="/static/index/images/user.png"></div>
	                      <input class="form-control user_input" type="text" name="account" datatype="*" nullmsg="请输入交易账号！" placeholder="交易账号">
	                    </div>
	              </div>
	              <div class="form-group">
	                    <div class="input-group">
	                      <div class="input-group-addon user"><img src="/static/index/images/mima.png"></div>
	                      <input class="form-control user_input" type="password" name="password" datatype="*" nullmsg="请输入密码！" placeholder="密码">
	                    </div>
	              </div>
                  <button type="submit">提交</button>
	            </div>
	        </div>
		</form>
    </div>

</div>

</body>
<script src="/static/index/js/Validform.min.js"></script>
<script>
    $(function(){
        $(".loginform").Validform({
            ajaxPost:true,
            callback:function(data){
                if(data.code == 1){
                    $.Showmsg(data.msg)

                    setTimeout(function(){
                        $.Hidemsg(); //公用方法关闭信息提示框;显示方法是$.Showmsg("message goes here.");
                        location.href=data.url
                    },1000);

                }else{
                    $.Showmsg(data.msg)
                }

            }

        });
    })

</script>
</html>
