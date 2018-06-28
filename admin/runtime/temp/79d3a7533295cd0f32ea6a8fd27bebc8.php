<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"F:\gitcrm\admin\public/../app/trader\view\login\login.html";i:1529663760;s:50:"F:\gitcrm\admin\app\trader\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>客户登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.css" rel="stylesheet">
    <link href="/static/admin/css/style.css" rel="stylesheet">
    <link href="/static/admin/css/login.css" rel="stylesheet">
    <link href="/static/admin/css/chaimilogin.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>
    <style>

        .code{
            width: 55%;
            display: inline-block !important;
        }
        body.signin {
            background: url(/static/trader/images/bg2.jpg) no-repeat center fixed;
            background-size: cover;
        }
        .no-margins{
            /*color:black;*/
        }
        .chaimisettle img{
            width: 127px;
            height: 40px;
            margin-top: -6px;
        }
        .mosh{
            color: red;
            font-size: 21px;
            padding: 4px 7px 8px 17px;
            margin-left: 50px;
            margin-bottom: 7px;
        }
    </style>

</head>
<body class="chaimisettle">
<div>
    <div class="logo">
        <a class="logo_href" href="">
            <span class="mosh">MOS-H系统</span>
            <!--<img src="<?php echo url('/static/trader/images/bg2.jpg'); ?>"  alt="logo" class="logo-default" style="width: 182px;">-->
        </a>
        <div class="settleTitle">
            欢迎登录
        </div>
    </div>
</div>

<div class="loginBg">
    <div class="logintab">
        <div class="loginTop">
            账户登录
        </div>

        <form class="loginBody" id="login_form" method="post" action="" >
            <div class="form-group">
                <input type="text" class="form-control uname" name="phone" value="" placeholder="手机号" />
            </div>
            <div class="form-group">
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="密码" name="password" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control pword m-b code" name="code" placeholder="验证码" /><img src="<?php echo captcha_src(); ?>" onclick="changeCode(this)" alt="" >
            </div>
        </form>
        <div class="loginFoot" style="position: relative;">
            <span class="loginTips"></span>
            <span class="loginBtn login_btn">登&nbsp;&nbsp;&nbsp;&nbsp;录</span>
        </div>


        <div class="loginToSettled">
            <!--<i class="fa fa-arrow-circle-right"></i><span ng-click="toSettled()">去注册</span>-->
        </div>
    </div>
</div>

<div class="copyright"> 2018 © morris-cloud.com 版权所有  </div>
</body>
<!-- 全局js -->
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/static/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/static/admin/js/plugins/layer3.1/layer.js"></script>
<script src="/static/admin/js/demo/layer-demo.js"></script>
<script>
    function changeCode(that){
        $(that).attr('src','<?php echo captcha_src(); ?>'+'?'+Math.random());
    }
    $('.login_btn').click(function(){
        var phone = $('input[name="phone"]').val();
        var password = $('input[name="password"]').val();
        var code = $('input[name="code"]').val();
        if(phone == ''){
            layer.msg('手机号不能为空');
            $('input[name="phone"]').focus();
            return false;
        }
        if(password == ''){
            layer.msg('密码不能为空');
            $('input[name="password"]').focus();
            return false;
        }
        if(code == ''){
            layer.msg('验证码不能为空');
            $('input[name="code"]').focus();
            return false;
        }
        $.ajax({
            url:'<?php echo url("trader/Login/index"); ?>',
            type:'POST',
            timeout:5000,
            data:$('#login_form').serialize(),
            success:function(data){
                if(data.code == 0){
                    layer.msg(data.msg);
                    return false;
                }else if(data.code == 1){
                    layer.msg(data.msg,function(){
                        location.href = data.url
                    });
                    return false;
                }
            },
            error:function(){
                layer.msg('网络超时，请稍后重试');
                return false;
            }
        })
    })
</script>

</html>
