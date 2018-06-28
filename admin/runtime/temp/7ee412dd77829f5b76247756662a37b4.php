<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"F:\gitcrm\admin\public/../app/ib\view\withdraw\withdraw-manage.html";i:1530171791;s:43:"F:\gitcrm\admin\app\ib\view\common\css.html";i:1530170161;s:46:"F:\gitcrm\admin\app\ib\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>出金管理</title>
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
    .page_css{
        margin-top:-65px;
    }
</style>
</head>
<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-6">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">出金申请</a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">出金记录</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <form class="form-horizontal m-t" method="post" id="withdrawFrom">
                                <table class="table">
                                    <tr>
                                        <td class="text-right">账户余额
                                            <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>"></td>
                                        <td><input id="wallet" name="wallet" type="text" class="form-control" value="<?=$user_config['wallet']?>" disabled></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">出金金额</td>
                                        <td><input id="outmoney" name="outmoney" type="text" class="form-control" value=""></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">出金汇率</td>
                                        <td><input id="out_rate" name="out_rate" type="text" class="form-control" value="<?=$out_rate?>" disabled=""></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">人民币</td>
                                        <td><input id="money" name="money" type="text" class="form-control" value="" disabled=""></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">收款人</td>
                                        <td><input id="name" name="name" value="<?=$user_config['name']?>" class="form-control" disabled=""></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">收款账户</td>
                                        <td><input id="bank_card" name="bank_card" value="<?=$user_config['bank_card']?>" class="form-control" disabled=""></td>
                                    </tr>
                                </table>
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-6">
                                        <button class="btn btn-primary withdraw">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>账单号</th>
                                    <th>出金金额(美元)</th>
                                    <th>人民币</th>
                                    <th>出金时间</th>
                                    <th>审核时间</th>
                                    <th>状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($withdraw_list as $value){?>
                                <tr>
                                    <td><?=$value['order_id']?></td>
                                    <td><?=$value['outmoney']?></td>
                                    <td><?=$value['money']?></td>
                                    <td><?=date('Y-m-d H:i:s',$value['add_time'])?></td>
                                    <td>
                                        <?php
                                                if($value['success_time']==0){
                                                ?>
                                        <span></span>
                                        <?php }
                                               else {
                                               ?>
                                        <span> <?=date('Y-m-d H:i:s',$value['success_time'])?></span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php
                                         $status = $value['order_status'];
                                         switch($status){
                                            case '0':
                                                $statusTxt = '审核中..';
                                                break;
                                            case '1':
                                                $statusTxt = '成功';
                                               break;
                                            case '2':
                                                $statusTxt = '失败';
                                                break;
                                          }
                                          ?>
                                        <?=$statusTxt?>
                                    </td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
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

<!-- jQuery Validation plugin javascript-->
<script src="/static/admin/js/from_validate/jquery.validate.min.js"></script>
<script src="/static/admin/js/from_validate/messages_zh.min.js"></script>

<script src="/static/admin/js/from_validate/validate-methods.js"></script>

<script>

    $('#outmoney').blur(function(){
        var outmoney = $('#outmoney').val();
        var out_rate = $('#out_rate').val();
        var money = (outmoney*out_rate).toFixed(2);
        $('#money').val(money)
    })
    $().ready(function() {
        $.validator.addMethod("positiveinteger", function(value, element) {
            var aint=parseInt(value);
            return aint>0&& (aint+"")==value;
        }, "Please enter a valid number.");
        $.validator.addMethod("amountLimit", function(value, element) {
            var returnVal = false;
            var wallet = $("#wallet").val();
            var outmoney = $("#outmoney").val();
            if(parseFloat(wallet)>=parseFloat(outmoney)){
                returnVal = true;
            }
            return returnVal;
        },"余额一定要大于或等于出金金额");

        $("#withdrawFrom").validate({
            rules:{
                outmoney:{
                    required:true,
                    digits:true,
                    positiveinteger:true,
                    amountLimit:true
                }
            },
            messages:{
                outmoney:{
                    required:'请填写金额',
                    digits:" * 请填写正确的出金金额（应为数字）",
                    positiveinteger:'请输入大于0的金额',
                    amountLimit:'余额不足,无法出金'
                }
            },
            onkeyup:false,
            focusCleanup:true,
            submitHandler: function(form){
                var index = '';
                index = layer.load();
                $.ajax({
                    url: '<?php echo url("/ib/Withdraw/ib_withdraw"); ?>',
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function (data) {
                        layer.close(index);
                        console.log('出金申请')
                        console.log(data);
                        if(data.code==1){
                            layer.msg(data.msg,{time:800},function () {
                                parent.location.reload();
                            });
                            return false;
                        }else if(data.code==0){
                            layer.msg(data.msg);
                            return false;
                        }
                    },
                    error:function (err) {
                        layer.close(index);
                        console.log('失败');
                        console.log(err);
                        layer.msg('网络错误,请稍后再试!');
                        return false;
                    }
                })
            }
        });

    })
</script>

</body>

</html>