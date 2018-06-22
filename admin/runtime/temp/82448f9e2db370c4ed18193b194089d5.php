<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"F:\gitcrm\admin\public/../app/trader\view\leave_message\leave-message.html";i:1529662105;s:47:"F:\gitcrm\admin\app\trader\view\common\css.html";i:1529054880;s:50:"F:\gitcrm\admin\app\trader\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>留言</title>
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
        .displsy_bl{
            display:block;
            width:100%;
            overflow: hidden;
            margin-bottom: 10px;

        }
        .displsy_bl .message {
            display: block;
            width: 60%;
            background: white;
            margin-top: 5px;
            padding: 5px 15px;

        }
        .message-content{
            display:block;
        }
        .h_left{
            margin-left:15px;
            float: left;
        }
        .h_right{
            margin-right:15px;
            float: right;
        }
        .message-author{
            margin-bottom: 5px;
            display: inline-block;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">

            <div class="ibox chat-view">

                <div class="ibox-title">
                    留言记录
                </div>


                <div class="ibox-content">

                    <div class="row">

                        <div class="col-md-12 ">

                            <div class="chat-discussion message_con" id="scrolldIV">





                            </div>

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="chat-message-form">

                                <div class="form-group">
                                    <form action="" id="message-form">
                                        <textarea class="form-control message-input" name="message" placeholder="留言内容"></textarea>
                                        <span class="btn btn-success btn-lg btn-block sub_btn" onclick="sub_form()">发送 </span>
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
</body>

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
<script>
    function div_bottom(){
        var div = document.getElementById('scrolldIV');
        div.scrollTop = div.scrollHeight;
    }
    function sub_form(){
        var message = $('textarea').val();
        if(message == ''){
            layer.msg('请填写留言');
            return false;
        }
        $.ajax({
            type:'POST',
            url:'',
            data:$('#message-form').serialize(),
            beforeSend:function(){
                $('.sub_btn').text('正在发送...');
            },
            success:function(data){
                $('.sub_btn').text('发送');

                if(data.code == 1){
                    layer.msg(data.msg,function(){
                        $('.message_con').html('');
                        $('textarea').val('')
                        getMessage(1)
                    })

                }
            },
            error:function(){
                $('.sub_btn').text('发送');
                layer.msg('网络错误，请稍后重试');
                return false;
            }
        })
    }
    var page = 0;
    //获取聊天记录
    function getMessage(currpage){
        page ++;
        var pa = '';
        if(currpage == 1){
            pa = currpage;
        }else{
            pa = page;
        }
        $.ajax({
            type:'GET',
            url:'',
            data:{'type':'message','page':pa},
            success:function(data){
                if(data.code == 1){
                    var html = '';
                    $.each(data.msg,function(i,item){

                        if(item.from_userid == 0){
                            //管理员回复
                            html +='<div class="chat-message ">' +
                                        '<div class="pull-left displsy_bl">' +
                                            '<div class="pull-left img_header "><img class="message-avatar " src="/static/index/images/my_touxiang.png" alt=""></div>' +
                                                '<div class="message text-left h_left">' +
                                                    '<a class="message-author" href="#"> 管理员 </a>' +
                                                    '<span class="message-date pull-right">  '+formatDate(item.add_time)+' </span>' +
                                                    '<span class="message-content">'+item.message+'</span>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';
                        }else{
                            //客户留言
                            html += '<div class="chat-message">' +
                                        '<div class="pull-right displsy_bl">' +
                                            '<div class="pull-right img_header"><img class="message-avatar pull-right" src="/static/index/images/my_touxiang.png" alt=""></div>' +
                                            '<div class="message text-right h_right">' +
                                                '<a class="message-author" href="#"> <?=session("traderUser")?> </a>' +
                                                '<span class="message-date pull-left">  '+formatDate(item.add_time)+' </span>' +
                                                '<span class="message-content"> '+item.message+'</span>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';
                        }

                    })
                    $('.message_con').html(html);
                    div_bottom();
                }
            },
            error:function(){
                layer.msg('网络错误，获取历史留言失败');
                return false;
            }
        })
    }
    getMessage();
    //格式化时间戳
    function formatDate(now) {
        var time = new Date(now*1000);
        var y = time.getFullYear();//年
        var m = time.getMonth() + 1;//月
        var d = time.getDate();//日
        var h = time.getHours();//时
        var mm = time.getMinutes();//分
        var s = time.getSeconds();//秒
        if(m < 10){
            m= '0'+m;
        }
        if(d < 10){
            d= '0'+d;
        }
        if(h < 10){
            h= '0'+h;
        }
        if(mm < 10){
            mm= '0'+mm;
        }
        if(s < 10){
            s= '0'+s;
        }
        return y+"-"+m+"-"+d+" "+h+":"+mm+":"+s;
    }
</script>
</html>