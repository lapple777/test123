<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"F:\gitcrm\admin\public/../app/admin\view\config\config-info.html";i:1530080647;s:46:"F:\gitcrm\admin\app\admin\view\common\css.html";i:1530166755;s:49:"F:\gitcrm\admin\app\admin\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>网站配置</title>
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


</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">


        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <!--<div class="ibox-title">-->
                        <!--<h5>基本面板</h5>-->
                    <!--</div>-->
                    <div class="ibox-content">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> 止盈止损配置</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">手数关系配置</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">手续费设置</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">奖励设置</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#tab-5" aria-expanded="false">汇率设置</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <form class="form-horizontal m-t" method="post" id="commentForm">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">止盈：</label>
                                                <div class="col-sm-8">
                                                    <input id="stop_profit" name="stop_profit" minlength="2" type="text" class="form-control" required="" aria-required="true" value="<?=$config['stop_profit']?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">止损：</label>
                                                <div class="col-sm-8">
                                                    <input id="stop_loss" type="text" class="form-control" name="stop_loss" required="" aria-required="true" value="<?=$config['stop_loss']?>">
                                                    <input type="hidden" name="type" value="changePrice">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-3">
                                                    <button class="btn btn-primary" type="submit">提交</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <form class="form-horizontal m-t" method="post" id="shoushu">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">每手对应多少美元：</label>
                                                <div class="col-sm-8">
                                                    <input id="hand_price" type="text" class="form-control" name="handPrice" required="" aria-required="true" value="<?=$config['hand_price']?>">
                                                    <input type="hidden" name="type" value="handPrice">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-3">
                                                    <button class="btn btn-primary" type="submit">提交</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <form class="form-horizontal m-t" method="post" id="commission-form">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">手续费(美元)：</label>
                                                <div class="col-sm-8">
                                                    <input id="commission" type="text" class="form-control" name="commission" required="" aria-required="true" value="<?=$config['commission']?>">
                                                    <input type="hidden" name="type" value="commission">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-3">
                                                    <button class="btn btn-primary" type="submit">提交</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="tab-4" class="tab-pane">
                                    <div class="panel-body">
                                        <form class="form-horizontal m-t" method="post" id="award-form">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">每手奖励(美元)：</label>
                                                <div class="col-sm-8">
                                                    <input id="award" type="text" class="form-control" name="award" required="" aria-required="true" value="<?=$config['award']?>">
                                                    <input type="hidden" name="type" value="award">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-3">
                                                    <button class="btn btn-primary" type="submit">提交</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab-5" class="tab-pane">
                                    <div class="panel-body">
                                        <form class="form-horizontal m-t" method="post" id="rate-form">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">入金汇率：</label>
                                                <div class="col-sm-8">
                                                    <input id="rate" type="text" class="form-control" name="rate" required="" aria-required="true" value="<?=$config['rate']?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">出金汇率：</label>
                                                <div class="col-sm-8">
                                                    <input id="out_rate" type="text" class="form-control" name="out_rate" required="" aria-required="true" value="<?=$config['out_rate']?>">
                                                    <input type="hidden" name="type" value="rate">
                                                </div>
                                            </div>
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
                    </div>
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
<script src="/static/admin/js/plugins/jeditable/jquery.jeditable.js"></script>

<!-- jQuery Validation plugin javascript-->
<script src="/static/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="/static/admin/js/plugins/validate/messages_zh.min.js"></script>

<script src="/static/admin/js/demo/form-validate-demo.js"></script>
<script>
    $().ready(function() {
        $("#commentForm").validate({
            rules:{
                groupname:{
                    required:true,
                }
            },
            onkeyup:false,
            focusCleanup:true,
            submitHandler: function(form)
            {
                ajaxFrom('commentForm')

            }
        });
        $("#shoushu").validate({
            submitHandler: function(form)
            {
                ajaxFrom('shoushu')

            }
        });
        $('#commission-form').validate({
            submitHandler: function(form)
            {
                ajaxFrom('commission-form')

            }
        })
        $('#award-form').validate({
            submitHandler: function(form)
            {
                ajaxFrom('award-form')

            }
        })
        $('#rate-form').validate({
            submitHandler: function(form)
            {
                ajaxFrom('rate-form')

            }
        })
    });
    function ajaxFrom(from){
        $.ajax({
            type:'POST',
            url:'<?php echo url("admin/Config/config_info"); ?>',
            data:$('#'+from).serialize(),
            success:function(data){
                layer.msg(data.msg)
            },
            error:function(){
                layer.msg('网络错误请重试...');
                return false;
            }
        })
    }
    // 添加组
    function group_add(title,url,id,w,h){
        layer_show(title,url,w,h);
    }


</script>
</body>

</html>
