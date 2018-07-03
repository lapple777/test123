<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"F:\gitcrm\admin\public/../app/admin\view\i_b_manage\ib-edit.html";i:1529054880;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 编辑IB</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    
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
    <style>

        .content_box{
            width:80%;
            height:900px;
            margin:0 auto;
            border:1px solid #ccc;
        }
        .box_left{
            border-right:1px solid #ccc;
            height:100%;
            width:20%;
            float:left;
        }
        .box_right{
            width:60%;
            height:100%;
            float:left;
        }
        .box_title{
            margin: 30px 0 0 0;
            height:45px;
            line-height:40px;
        }
        .id_card{
            width: 250px;
            height: 150px;
            background:#ccc;
            display:inline-block;
            margin-right:10px;
            -webkit-border-radius:10px;
            -moz-border-radius:10px;
            border-radius:10px;
        }
        .card_box{
            width:660px;
            padding-left: 15px;
        }
    </style>

</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">

                <form class="form-horizontal m-t" method="post" id="commentForm">
                    <table class="table">
                        <tr>
                            <td class="text-right">用户名</td>
                            <td><input id="username" name="username" type="text" class="form-control" value="<?=$ib['username']?>"></td>
                            <td class="text-right">姓名</td>
                            <td><input id="name" name="name" type="text" class="form-control" value="<?=$ib['name']?>"></td>
                        </tr>
                        <tr>
                            <td class="text-right">手机号</td>
                            <td><input id="phone" name="phone" type="text" class="form-control" value="<?=$ib['phone']?>"></td>
                            <td class="text-right">邮箱</td>
                            <td><input id="email" name="email" type="text" class="form-control" value="<?=$ib['email']?>"></td>
                        </tr>
                        <tr>
                            <td class="text-right">密码</td>
                            <td> <input id="password" type="password" class="form-control" name="password" placeholder="留空表示不修改密码"></td>
                            <td class="text-right">银行卡号</td>
                            <td> <input id="bank_card" type="text" class="form-control" name="bank_card" value="<?=$ib['bank_card']?>"></td>
                        </tr>
                        <tr>
                            <td class="text-right">身份证号</td>
                            <td> <input id="id_card" type="text" class="form-control" name="id_card" value="<?=$ib['id_card']?>"></td>
                            <td class="text-right">账户余额</td>
                            <td><input id="wallet" type="text" class="form-control" name="wallet" value="<?=$ib['wallet']?>"> </td>
                        </tr>
                        <tr>
                            <td class="text-right">状态</td>
                            <td>
                                <select name="ib_status" class="form-control m-b">
                                    <option <?php if($ib['ib_status'] == 1){?> selected <?php }?> value="1">启用</option>
                                    <option <?php if($ib['ib_status'] == 0){?> selected <?php }?> value="0">禁用</option>
                                </select>
                            </td>
                            <input type="hidden" name="ib_id" value="<?=$ib['id']?>">

                        </tr>
                    </table>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit">提交</button>
                        </div>
                    </div>
                </form>

        </div>

    </div>

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

    $().ready(function() {
        $("#commentForm").validate({
            rules:{
                username:{
                    required:true,
                },
                name:{
                    required:true,
                },
                phone:{
                    required:true,
                    isMobile:true
                },
                email:{
                    required:true,
                    email:true,
                },
                id_card:{
                    required:true,
//                    isIdCardNo:true
                },
                bank_card:{
                    required:true,
//                    creditcard:true
                }
            },
            onkeyup:false,
            focusCleanup:true,
            submitHandler: function(form)
            {
                $.ajax({
                    url:'<?php echo url("admin/IBManage/ib_edit"); ?>',
                    type:'POST',
                    data:$(form).serialize(),
                    success:function(data){
                        if(data.code == 1){
//                            var index = parent.layer.getFrameIndex(window.name);
//                            parent.layer.close(index);
                            layer.msg(data.msg,function(){
                                parent.location.reload();
                            });
                            return false;
                        }else if(data.code == 0){
                            layer.msg(data.msg);
                            return false;
                        }
                    },
                    error:function(){
                        layer.msg('网络错误，请稍后再试');
                        return false;
                    }
                })

            }
        });


});


</script>

</body>

</html>
