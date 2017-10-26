<?php defined('LSKY') or die('Illegal access!'); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>兰空树洞</title>
    <meta name="keywords" content="兰空,兰空树洞,树洞,小秘密">
    <meta name="description" content="在这里，你可以将你的小秘密说出来。">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/pace/1.0.2/themes/black/pace-theme-flash.min.css">
    <link rel="stylesheet" href="./static/css/main.css">
</head>
<body>
    <header>
        <span><i class="fa fa-send"></i></span>
    </header>
    <div class="menu">
        <a class="active" data-type="index" href="">首页</a>
        <a data-type="real" href="">实名</a>
        <a data-type="anonymous" href="">匿名</a>
        <a data-type="send" href="">发表</a>
    </div>
    <div class="content animated fadeInDown">

    </div>
    <footer>
        <p>&copy; 2017 <a href="http://www.xlogs.cn" target="_blank">WispX</a> 皖ICP备16011445号</p>
    </footer>
</body>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
    <script src="https://cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
    <script>
        var menu = $('.menu a');
        menu.click(function(e) {
            e.preventDefault();
            $('.content').load($(this).attr('href'), {'action': $(this).attr('data-type')});
            menu.each(function() {
                $(this).removeClass('active');
            });
            $(this).addClass('active');
        });
    </script>
</html>