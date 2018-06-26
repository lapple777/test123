<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"F:\gitcrm\admin\public/../app/ib\view\center\ib-center.html";i:1529486675;s:43:"F:\gitcrm\admin\app\ib\view\common\css.html";i:1529054880;s:46:"F:\gitcrm\admin\app\ib\view\common\script.html";i:1529054880;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IB中心</title>
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
<div class="wrapper    wrapper-content animated fadeInRight">
    <div class="ibox-content">
        <div id="Ib_json"></div>
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
<script src="/static/admin/js/plugins/jsTree/jstree.min.js"></script>
<script>
    Array.prototype.distinct = function (){
        var arr = this,
            i,
            j,
            len = arr.length;
        for(i = 0; i < len; i++){
            for(j = i + 1; j < len; j++){
                if(arr[i].userId == arr[j].userId){
                    arr.splice(j,1);
                    len--;
                    j--;
                }
            }
        }
        return arr;
    };
    $(document).ready(function () {
        $.ajax({
            type:'GET',
            url:'<?php echo url("ib/Center/get_IbSubList"); ?>',
            success:function (data) {
//                console.log('获得参数')
//                console.log(data)
                var someKey = [];
                $.each(data.msg.data,function(i,data){
                    var part = {
                        userId:data.id,
                        userName:data.name
                    };
                    someKey.push(part);
                });
                var disSomkey  = someKey.distinct();
                var hahah = [];
                if(data.msg.data.length>0){
//                    console.log(data.msg.data)
                    for(var j = 0;j<disSomkey.length;j++){
                        var hh = [];
                        var childKey = [];
                        for(var i=0;i<data.msg.data.length;i++){
                            if(data.msg.data[i].id==disSomkey[j].userId){
                                var temp  = {
                                    childId:data.msg.data[i].tid,
                                    text:data.msg.data[i].account
                                };
                                hh.push(temp);
                                childKey.push(data.msg.data[i].account)
                            }
                        }
                        var getParent  ={
                            parentId:someKey[j].userId,
                            text:someKey[j].userName,
                            children:hh
                        };
                        hahah.push(getParent);
                    }
                }
                $('#Ib_json').jstree({
                    'core': {
                        'data':hahah
                    }
                })
            },
            error:function (data) {

            }
        });
    });
</script>

</body>
</html>