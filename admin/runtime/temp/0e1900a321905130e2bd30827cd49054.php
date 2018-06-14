<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\PHP\PHPTutorial\WWW\test123\admin\public/../app/ib\view\login\login.html";i:1528948391;s:67:"D:\PHP\PHPTutorial\WWW\test123\admin\app\ib\view\common\script.html";i:1527327149;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>IB - 登录</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
        <link href="/static/admin/css/animate.css" rel="stylesheet">
        <link href="/static/admin/css/style.css" rel="stylesheet">
        <link href="/static/admin/css/login.css" rel="stylesheet">
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
        </style>
    </head>
<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="" id="login_form">
                <h4 class="no-margins">IB登录</h4>
                <input type="text" class="form-control uname" name="phone" value="" placeholder="手机号" />
                <input type="password" class="form-control pword m-b" name="password" placeholder="密码" />
                <input type="text" class="form-control pword m-b code" name="code" placeholder="验证码" /><img src="<?php echo captcha_src(); ?>" onclick="changeCode(this)" alt="">
                <span class="btn btn-success btn-block login_btn">登录</span>
            </form>
        </div>
    </div>

</div>
</body>

<!-- 全局js -->
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/static/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/static/admin/js/plugins/layer3.1/layer.js"></script>
<script src="/static/admin/js/demo/layer-demo.js"></script>
<script >
    function changeCode(that) {
        $(that).attr('src','<?php echo captcha_src(); ?>'+'?'+Math.random());
    }
    $('.login_btn').click(function () {
        var phone = $('input[name="phone"]').val();
        var password = $('input[name="password"]').val();
        var code = $('input[name="code"]').val();
        if(phone == ''){
            layer.msg('用户名不能为空');
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
            url:'<?php echo url("ib/Login/index"); ?>',
            type:'POST',
            timeout:5000,
            data:$('#login_form').serialize(),
            success:function (data) {
                console.log('请求数据返回');
                console.log(data)
                if(data.code==0){
                    layer.msg(data.msg);
                    return false;
                }else if(data.code==1){
                    layer.msg(data.msg,function () {
                        location.href=data.url;
                    });
                    return false;
                }
            },
            error:function () {
                layer.msg('网站超时,请稍后重试');
                return false;
            }
        })
    })
</script>
</html>