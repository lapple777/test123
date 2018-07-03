<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"F:\gitcrm\admin\public/../app/admin\view\auth\auth-add.html";i:1530525635;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<title>添加权限</title>
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


	</style>

</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">


	<div class="row">


		<form action="" method="post"  id="form-group-conf">
			<table class="table table-bordered">
				<tr>
					<td>权限名：</td>
					<td>
						<input type="text" class="form-control" value="" placeholder="" id="authname" name="authname">
					</td>
				</tr>
				<tr>
					<td>权限标识：</td>
					<td>
						<input type="text" class="form-control" value="" placeholder="" id="auth" name="auth"><br/>
						<span class="f-12">输入模块/控制器/方法即可 例如 admin/Article/index</span>
					</td>
				</tr>
			</table>



			<div class="row cl">
				<div class="col-xs-3 col-sm-3 col-xs-offset-3 col-sm-offset-3">
					<input class="btn btn-primary radius sub_btn" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
<script src="/static/admin/js/plugins/jeditable/jquery.jeditable.js"></script>

<!-- Data Tables -->
<script src="/static/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/static/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- jQuery Validation plugin javascript-->
<script src="/static/admin/js/from_validate/jquery.validate.min.js"></script>
<script src="/static/admin/js/from_validate/messages_zh.min.js"></script>

<script src="/static/admin/js/from_validate/validate-methods.js"></script>


<script>

	$().ready(function() {
		$("#form-group-conf").validate({
			rules:{
				authname:{
					required:true,
				},
				auth:{
					required:true,
				}
			},
			onkeyup:false,
			focusCleanup:true,
			submitHandler: function(form)
			{
				$.ajax({
					url:'',
					type:'POST',
					data:$(form).serialize(),
					success:function(data){
						if(data.code == 1){
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



