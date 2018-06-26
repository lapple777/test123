<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"F:\gitcrm\admin\public/../app/trader\view\index\index_v1.html";i:1529922324;s:47:"F:\gitcrm\admin\app\trader\view\common\css.html";i:1529054880;s:50:"F:\gitcrm\admin\app\trader\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 主页信息</title>
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
</style>
    <style>
        .dataTables_paginate{
            text-align:right;
        }
        .dataTables_filter{
            text-align:right;
        }
        .order_title{
            line-height:45px;
        }
        #tab-1 .order_title span{
            display:inline-block;
            border:1px solid #ccc;
            border-radius:50px;
            margin-right:50px;
            width:200px;
            padding:10px 0 10px 20px;
        }
        #tab-1 .order_title span i{
            font-size:20px;

        }
        .icon_size{
            font-size:18px;
            width:25px;
        }
        .icon_border{
            border:2px solid #ccc;
            width:50px;
            height:50px;
            border-radius:50%;
            line-height:50px;
            margin:0 30px 0 0;

        }
        #tab-1 span:nth-child(1) .icon_border{
            border-color:#26c126;
        }
        #tab-1 span:nth-child(1) h1{
            color:#26c126;
        }
        #tab-1 span:nth-child(2) .icon_border{
            border-color:#4c4cd6;
        }
        #tab-1 span:nth-child(2) h1{
            color:#4c4cd6;
        }
        #tab-1 span:nth-child(3) .icon_border{
            border-color:#cece51;
        }
        #tab-1 span:nth-child(3) h1{
            color:#cece51;
        }
        #tab-1 span:nth-child(4) h1{
            color: #A5DC;
        }
        #tab-2 .order_title{
            margin: 0 0 20px 0;
        }
        .mony_box{
            line-height: 15px;
        }
        .mony_box h1{
            margin:0;
        }
        .data_list p{
            background:#f4f4f5;
            margin-bottom:15px;
            line-height:35px;
        }
        .data_list p span{
            display:inline-block;
            width:12%;
            font-size:16px;
        }
        .zhu_right{
            width:60%;
        }
        .order_etail{
            width:40%;
        }
        .order_etail .row{
            margin:60px 0 0 30px;
        }

    </style>
    <style>

        .content_box{
            width:80%;
            height: 1000px;
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
            display: inline-block;
            position: relative;
            overflow: hidden;
            width: 250px;
            height: 150px;
            background:#ccc;
            margin-right:10px;
            -webkit-border-radius:10px;
            -moz-border-radius:10px;
            border-radius:10px;
        }
        .id_card div{
            position: relative;
            display:inline-block;
        }
        .card_box{
            width:660px;
            padding-left: 15px;
        }
        .typeFile{
            position: absolute;
            top: 0;
            right: 0;
            font-size: 14px;
            /*background-color: #fff;*/
            transform: translate(-300px, 0px) scale(4);
            display: flex;
            padding: 36px 0px;
            /*opacity: 0;*/
            -ms-filter: 'alpha(opacity=0)';
        }
        .id_card img{
            width: 249px;
            height: 149px;
        }
        .input-group{
            width: 63%;
            margin-left: 210px;
            display: block;
        }
    </style>
</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1" aria-expanded="true">
                            账户信息
                        </a>
                    </li>
                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">基本信息</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="order_title">
                                <span>
                                    <p class="pull-left icon_border text-center">
                                        <i class="fa fa-database"></i>
                                    </p>
                                    <div class="pull-left mony_box">
                                       <h1 ><?=$user_wallet['wallet'] ?></h1>
                                        账户资金
                                    </div>

                                </span>
                                <span>
                                     <p class="pull-left icon_border text-center">
                                         <i class="fa fa-cubes"></i>
                                     </p>
                                    <div class="pull-left mony_box">
                                        <h1 ><?=$profitTotal?></h1>
                                        账户盈利
                                    </div>
                                </span>
                                <span>
                                     <p class="pull-left icon_border text-center">
                                         <i class="fa  fa-calculator"></i>
                                     </p>
                                    <div class="pull-left mony_box">
                                         <h1 ><?=$resSuccess?></h1>
                                        成功次数
                                    </div>
                                </span>

                                <span>
                                     <p class="pull-left icon_border text-center">
                                         <i class="fa fa-server"></i>
                                     </p>
                                    <div class="pull-left mony_box">
                                       <h1 ><?=$resLotNum?></h1>
                                        交易手数
                                    </div>
                                </span>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div id="container" style="height: 350px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="content_box">
                                <div class="box_left text-center">
                                    <p class="box_title btn btn-w-m btn-primary btn-block">
                                        基本信息
                                    </p>

                                </div>
                                <div class="box_right">
                                    <div class="">
                                        <form class="form-horizontal m-t" action="<?php echo url('trader/Account/edit_account'); ?>" method="post" enctype="multipart/form-data" id="signupForm">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">ID：</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control"  name="id" type="text" value="<?=$account['id']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">账户余额：</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="text"  value="<?=$account['wallet']?>" readonly>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">用户名：</label>
                                                <div class="col-sm-8">
                                                    <input id="username"  name="username" class="form-control" value="<?=$account['username']?>" type="text" aria-required="true" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">姓名：</label>
                                                <div class="col-sm-8">
                                                    <input id="name"  name="name" class="form-control" value="<?=$account['name']?>" type="text" aria-required="true"  >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">姓别：</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control user_input" name="male"  value="<?=$account['male']?>">
                                                        <option value="1">男</option>
                                                        <option value="2">女</option>
                                                    </select>
                                                    <!--<input id="male"  name="male" class="form-control" value="<?=$account['male']?>" type="text" aria-required="true"  >-->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">手机号：</label>
                                                <div class="col-sm-8">
                                                    <input id="phone"  name="phone" class="form-control " value="<?=$account['phone']?>" type="text" aria-required="true" aria-invalid="true" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">邮箱：</label>
                                                <div class="col-sm-8">
                                                    <input id="email"  name="email" class="form-control" aria-required="true" value="<?=$account['email']?>" type="email">
                                                </div>
                                            </div>
                                            <!--<div class="form-group" id="data_1">-->
                                            <!--<div class="input-group date">-->
                                            <!--<div class="input-group-addon user">生日</div>-->
                                            <!--<input type="text"  class="form-control user_input" name="birthday"  datatype="*" nullmsg="请选择生日！" value="2014-11-11">-->
                                            <!--</div>-->
                                            <!--</div>-->
                                            <div class="form-group"  id="data_1">
                                                <label class="col-sm-3 control-label">生日：</label>
                                                <div class="col-sm-7 input-group date">
                                                    <div class="input-group-addon user" style="display: none">生日</div>
                                                    <input name="birthday" value="<?=$account['birthday']?>" class="form-control" aria-required="true" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">身份证号：</label>
                                                <div class="col-sm-8">
                                                    <input id="id_card" name="id_card" value="<?=$account['id_card']?>" class="form-control" aria-required="true" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="card_box col-sm-offset-3">
                                                    <div  class="id_card">
                                                        <input name="idZm" style="display: none" value="<?=$account['id_card_zm']?>"/>
                                                        <div id="id_card_zm">
                                                            <?php
                                                             if($account['id_card_zm']==0){
                                                                ?>
                                                                 <span></span>
                                                                <?php }
                                                              else {
                                                                ?>
                                                              <img src="/uploads/<?=$account['id_card_zm']?>">
                                                            <?php }?>

                                                        </div>
                                                        <input type="file" class="typeFile" onchange="id_card_zm(this)" name="IdCardZm"/>
                                                    </div>

                                                    <div class="id_card" >
                                                        <input name="idFm" style="display: none" value="<?=$account['id_card_fm']?>"/>
                                                        <div id="id_card_fm">
                                                            <?php
                                                             if($account['id_card_fm']==0){
                                                                ?>
                                                            <span></span>
                                                            <?php }
                                                              else {
                                                                ?>
                                                            <img src="/uploads/<?=$account['id_card_fm']?>">
                                                            <?php }?>
                                                        </div>
                                                        <input type="file" class="typeFile"  name="IdCardFm" onchange="id_card_fm(this)" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">银行卡号：</label>
                                                <div class="col-sm-8">
                                                    <input id="bank_card" name="bank_card" value="<?=$account['bank_card']?>"  class="form-control" aria-required="true" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="card_box col-sm-offset-3">
                                                    <div class="id_card" >
                                                        <input name="barkZm" style="display: none" value="<?=$account['bank_card_zm']?>"/>
                                                        <div id="bank_card_zm">
                                                            <?php
                                                             if($account['bank_card_zm']==0){
                                                                ?>
                                                            <span></span>
                                                            <?php }
                                                              else {
                                                                ?>
                                                            <img src="/uploads/<?=$account['bank_card_zm']?>">
                                                            <?php }?>
                                                        </div>
                                                        <input type="file" class="typeFile" name="bankCardZm" id="file" onchange="bank_card_zm(this)" />
                                                    </div>
                                                    <div class="id_card">
                                                        <div id="bank_card_fm">
                                                            <input name="barkFm" style="display: none" value="<?=$account['bank_card_fm']?>"/>
                                                            <?php
                                                             if($account['bank_card_fm']==0){
                                                                ?>
                                                            <span></span>
                                                            <?php }
                                                              else {
                                                                ?>
                                                            <img src="/uploads/<?=$account['bank_card_fm']?>">
                                                            <?php }?>
                                                        </div>
                                                        <input type="file" class="typeFile" name="bankCardFm" onchange="bank_card_fm(this)" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">开户行：</label>
                                                <div class="col-sm-8">
                                                    <input  class="form-control"  value="<?=$account['open_bank']?>" name="open_bank">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">地址：</label>
                                                <div class="col-sm-8">
                                                    <input  class="form-control"  value="<?=$account['address']?>" name="address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">创建时间：</label>
                                                <div class="col-sm-8">
                                                    <input  class="form-control"  value="<?=date('Y-m-d H:i:s',$account['add_time'])?>" readonly>
                                                </div>
                                            </div>

                                            <!--<div class="form-group">-->
                                            <!--<label class="col-sm-3 control-label">登录密码：</label>-->
                                            <!--<div class="col-sm-8">-->
                                            <!--<input id="password" name="password" class="form-control" aria-required="true" type="password">-->
                                            <!--</div>-->
                                            <!--</div>-->

                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-3">
                                                    <button class="btn btn-primary" type="submit" >提交</button>
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


<!-- Data Tables -->
<script src="/static/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/static/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!--Echats-->
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/simplex.js"></script>


<script>
    var xAxisData = [];
    var seriesData  = [];
    $(document).ready(function () {
        $('.dataTables-example').dataTable({

        });

    });
    $(document).ready(function () {
        $('.account_history').dataTable({

        });

        $.ajax({
            url:'<?php echo url("trader/Index/getDate_List"); ?>',
            timeout:5000,
            type:'GET',
            success:function (data) {
                console.log('获得') ;
                console.log(data);
                var x = [];
                var  y = [];
                if(data){
                    for(var i=0;i<data.msg.length;i++){
                        x.push(data.msg[i].time);
                        y.push(data.msg[i].total);
                    }
                }
                xAxisData = x;
                seriesData = y;
                //折线图
                var dom = document.getElementById("container");
                var myChart = echarts.init(dom);
                option = null;
                option = {
                    xAxis: {
                        type: 'category',
                        boundaryGap: false,
                        data: xAxisData
                    },
                    yAxis: {
                        type: 'value'
                    },
                    title:{
                        text:'账户盈利资金曲线图',
                        textStyle:{
                            color:'#4c4cd6'
                        }
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    series: [{
                        data: seriesData,
                        itemStyle : { normal: {label : {show: true}}},
                        type: 'line',
                        areaStyle: {}
                    }]
                };

                if (option && typeof option === "object") {
                    myChart.setOption(option, true);
                }
                console.log('x') ;
                console.log(xAxisData);
                console.log(seriesData);
            },
            error:function () {
                console.log('网络超时,请稍后再试!');
            }
        })
    });
</script>

<script src="/static/index/js/bootstrap.min.js"></script>
<script src="/static/admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>

    function id_card_zm(file) {
        var prevDiv = document.getElementById('id_card_zm');
        if (file.files && file.files[0]) {
            var reader = new FileReader();
            reader.onload = function(evt) {
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
            }
            reader.readAsDataURL(file.files[0]);
        } else {
            prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
        }
    }

    function id_card_fm(file) {
        var prevDiv = document.getElementById('id_card_fm');
        if (file.files && file.files[0]) {
            var reader = new FileReader();
            reader.onload = function(evt) {
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
            }
            reader.readAsDataURL(file.files[0]);
        } else {
            prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
        }
    }

    function bank_card_zm(file) {
        var prevDiv = document.getElementById('bank_card_zm');
        if (file.files && file.files[0]) {
            var reader = new FileReader();
            reader.onload = function(evt) {
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
            }
            reader.readAsDataURL(file.files[0]);
        } else {
            prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
        }
    }

    function bank_card_fm(file) {
        var prevDiv = document.getElementById('bank_card_fm');
        if (file.files && file.files[0]) {
            var reader = new FileReader();
            reader.onload = function(evt) {
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
            }
            reader.readAsDataURL(file.files[0]);
        } else {
            prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
        }
    }
</script>

<script>
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

</script>

</body>

</html>
