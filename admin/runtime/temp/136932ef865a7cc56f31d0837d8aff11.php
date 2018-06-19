<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"D:\PHP\PHPTutorial\WWW\test123\admin\public/../app/ib\view\center\ib-center.html";i:1528977982;s:64:"D:\PHP\PHPTutorial\WWW\test123\admin\app\ib\view\common\css.html";i:1528973180;s:67:"D:\PHP\PHPTutorial\WWW\test123\admin\app\ib\view\common\script.html";i:1527327149;}*/ ?>
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

        <div id="using_json"></div>
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

    $(document).ready(function () {

        $('#using_json').jstree({
            'core': {
                'data': [
                    'Empty Folder',
                    {
                        'text': 'Resources',
                        'state': {
                            'opened': true
                        },
                        'children': [
                            {
                                'text': 'css',
                                'children': [
                                    {
                                        'text': 'animate.css',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'bootstrap.css',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'main.css',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'style.css',
                                        'icon': 'none'
                                    }
                                ],
                                'state': {
                                    'opened': true
                                }
                            },
                            {
                                'text': 'js',
                                'children': [
                                    {
                                        'text': 'bootstrap.js',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'hplus.min.js',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'jquery.min.js',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'jsTree.min.js',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'custom.min.js',
                                        'icon': 'none'
                                    }
                                ],
                                'state': {
                                    'opened': true
                                }
                            },
                            {
                                'text': 'html',
                                'children': [
                                    {
                                        'text': 'layout.html',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'navigation.html',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'navbar.html',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'footer.html',
                                        'icon': 'none'
                                    },
                                    {
                                        'text': 'sidebar.html',
                                        'icon': 'none'
                                    }
                                ],
                                'state': {
                                    'opened': true
                                }
                            }
                        ]
                    },
                    'Fonts',
                    'Images',
                    'Scripts',
                    'Templates',
                ]
            }
        });

    });
</script>

</body>
</html>