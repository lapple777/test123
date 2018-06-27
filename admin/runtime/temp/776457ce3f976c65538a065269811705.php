<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"F:\gitcrm\admin\public/../app/index\view\index\register.html";i:1530067899;s:46:"F:\gitcrm\admin\app\index\view\common\css.html";i:1529054880;s:49:"F:\gitcrm\admin\app\index\view\common\script.html";i:1529054880;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>注册</title>
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
        .login_main {
            width: auto;
            margin-top: 0px;

        }
        .login_main_bottom .row{
            margin:0 0 15px 0;
        }
        .user{
            color:white;
        }
        .bank_border{
            margin: 0 auto;
            width: 270px;
            height: 150px;
            background:#ccc;
        }
        .login_main_bottom .form-group{
            display: inline-block;
            width: 49%;
        }
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
        .user {
            background: #868ec5;
        }
        .login_main_bottom button {
            background: #868ec5;
        }
        .no_color{
            color:black !important;
            margin-bottom:20px;
        }
    </style>
</head>
<body>
<div id="bg_color"></div>
<div class="container-fluid login_box" >
	<div class="login">

		<form action="<?php echo url('index/Register/register'); ?>" method="post" class="registerform">
	        <div class="login_main">
	            <div class="login_main_bottom">
                    <h1 class="no_color">注册</h1>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon user">用户名</div>
                            <input class="form-control user_input" type="text" name="username" datatype="*" nullmsg="请输入用户名！" placeholder="">
                            <input type="hidden" name="orangeKey" value="<?=$_GET['orangeKey']?>">
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon user">姓名</div>
                                <input class="form-control user_input required" type="text" name="name" datatype="*"  nullmsg="请输入姓名！" placeholder="">
                                <div class="Validform_checktip"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon user">手机号</div>
                                <input class="form-control user_input" type="text"  name="phone" datatype="*" nullmsg="请输入手机号！" placeholder="">
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon user">邮箱</div>
                            <input class="form-control user_input" type="text" name="email" datatype="e" nullmsg="请输入邮箱！" errormsg="邮箱格式不正确" placeholder="">
                        </div>
                    </div>



                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon user">银行卡号</div>
                                <input class="form-control user_input" type="text" name="bank_card" datatype="*" nullmsg="请输入银行卡号！" placeholder="">
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon user">身份证号</div>
                            <input class="form-control user_input" type="text" name="id_card" datatype="*" nullmsg="请输入身份证号！"  placeholder="">
                        </div>
                    </div>
                    <div class="form-group" id="data_1">
                        <div class="input-group date">
                            <div class="input-group-addon user">生日</div>
                            <input type="text"  class="form-control user_input" name="birthday"  datatype="*" nullmsg="请选择生日！" value="2014-11-11">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon user">性别</div>
                            <!--<input class="form-control user_input" type="male" name="male" nullmsg="请选择性别！" placeholder="">-->
                            <select class="form-control user_input" name="male" datatype="*"  nullmsg="请选择性别！">
                                <option value="1">男</option>
                                <option value="2">女</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon user">地址</div>
                            <input class="form-control user_input" type="address" datatype="*"  name="address" nullmsg="请输入地址！" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon user">密码</div>
                            <input class="form-control user_input" type="password" name="password" datatype="*" nullmsg="请输入密码！" placeholder="">
                        </div>
                    </div>
                    <br/>

                    <!--<div class="form-group">-->
                        <!--<div class="bank_border">-->
                            <!--身份证正面-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <!--<div class="bank_border">-->
                            <!--身份证背面-->
                        <!--</div>-->
                    <!--</div>-->








                  <button type="submit">提交注册</button>
	            </div>
	        </div>
		</form>
    </div>

</div>

</body>
<script src="/static/index/js/Validform.min.js"></script>
<script src="/static/index/js/bootstrap.min.js"></script>
<script src="/static/admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
</script>
<script>
    $(function(){
        //$(".registerform").Validform();  //就这一行代码！;


        $(".registerform").Validform({
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
