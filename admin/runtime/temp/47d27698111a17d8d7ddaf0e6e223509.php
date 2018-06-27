<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"F:\gitcrm\admin\public/../app/ib\view\user\user-info.html";i:1530000739;s:43:"F:\gitcrm\admin\app\ib\view\common\css.html";i:1529054880;s:46:"F:\gitcrm\admin\app\ib\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IB用户信息</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    
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
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="col-sm-6">
       <form class="form-horizontal m-t" method="post" id="userForm">
           <table class="table">
               <tr>
                   <td class="text-right">用户名</td>
                   <td><input id="username" name="username" type="text" class="form-control" value="<?=$user_info['username']?>"></td>
               </tr>
               <tr>
                   <td class="text-right">姓名</td>
                   <td><input id="name" name="name" type="text" class="form-control" value="<?=$user_info['name']?>"></td>
               </tr>
               <tr>
                   <td class="text-right">手机号</td>
                   <td> <input id="phone" name="phone" type="text" class="form-control" value="<?=$user_info['phone']?>"></td>
               </tr>
               <tr>
                   <td class="text-right">邮箱</td>
                   <td><input id="email" name="email" type="text" class="form-control" value="<?=$user_info['email']?>"></td>
               </tr>
               <!--<tr>-->
                   <!--<td class="text-right">密码</td>-->
                   <!--<td><input id="password" name="password" type="text" class="form-control" placeholder="留空表示不修改密码"></td>-->
               <!--</tr>-->
               <tr>
                   <td class="text-right">银行卡号</td>
                   <td><input id="bank_card"  name="bank_card" type="text" class="form-control" value="<?=$user_info['bank_card']?>"></td>
               </tr>
               <tr>
                   <td class="text-right">身份证号</td>
                   <td><input id="id_card" name="id_card" type="text" class="form-control" value="<?=$user_info['id_card']?>"></td>
               </tr>
               <tr>
                   <td></td>
                   <td></td>
               </tr>
           </table>
           <div class="form-group">
               <div class="col-sm-6 col-sm-offset-6">
                   <button class="btn btn-primary" type="submit">提交</button>
               </div>
           </div>
       </form>
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
<script src="/static/admin/js/content.js?v=1.0.0"></script>

<!-- jQuery Validation plugin javascript-->
<script src="/static/admin/js/from_validate/jquery.validate.min.js"></script>
<script src="/static/admin/js/from_validate/messages_zh.min.js"></script>

<script src="/static/admin/js/from_validate/validate-methods.js"></script>

<script>
    $().ready(function () {
        $('#userForm').validate({
            rules:{
                username:{
                    required:true,
                },
                name:{
                    required:true
                },
                phone:{
                    required:true,
                    isMobile:true,
                },
                email:{
                    required:true,
                    email:true,
                },
                id_card:{
                    required:true,
                },
                bank_card:{
                    required:true,
                }
            },
            onkeyup:false,
            focusCleanup:true,
            submitHandler:function (form) {
               layer.confirm('确定修改?',function () {
                   $.ajax({
                       url:'<?php echo url("ib/User/ib_edit"); ?>',
                       type:"POST",
                       data:$(form).serialize(),
                       success:function (data) {
                           console.log('修改ib信息')
                           console.log(data);
                           if(data.code==1){
                               layer.msg(data.msg);
                               return false;
                           }else if(data.code==0){
                               layer.msg(data.msg);
                               return false;
                           }
                       },
                       error:function () {
                           layer.msg('网络错误,请稍后再试!');
                           return false;
                       }
                   })
               })
            }
        })
    })
</script>
</body>
</html>