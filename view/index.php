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
<style>
    a, a:hover, a:focus, a:active { text-decoration: none; color: #333; }
    a { -webkit-transition: all 0.2s; -moz-transition: all 0.2s; -ms-transition: all 0.2s; -o-transition: all 0.2s; transition: all 0.2s; }
    body { background: #fcfcfd; }
    header {
        width: 100%;
        background: #01aaed;
        height: 300px;
        line-height: 290px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 64, 128, .1);
    }
    header span {
        font-size: 150px;
        color: #ffffff;
        text-shadow: -5px 5px 0 rgba(0,0,0,.1);
    }
    .menu {
        text-align: center;
        height: 50px;
        line-height: 50px;
        background: #ffffff;
        box-shadow: 0px 1px 10px rgba(0, 64, 128, .1);
        margin-bottom: 50px;
    }
    .menu a {
        margin: auto 10px;
        padding: 5px 10px;
    }
    .menu a:hover, .menu a:focus, .menu a.active {
        background: #01aaed;
        color: #ffffff;
        border-radius: 5px;
    }
    .panel {
        background: #fff;
        box-shadow: 0 0 8px rgba(0, 0, 0, .1);
        padding: 20px;
        border-radius: 4px;
    }
    footer {
        height: 50px;
        line-height: 20px;
        background: #ffffff;
        text-align: center;
        border-top: 1px solid #f5f5f5;
    }
</style>
<body>
    <header>
        <span><i class="fa fa-send"></i></span>
    </header>
    <div class="menu">
        <a class="active" href="/">首页</a>
        <a href="index.php?action=real">实名</a>
        <a href="index.php?action=anonymous">匿名</a>
        <a href="index.php?action=send">发表</a>
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
            $('.content').load($(this).attr('href'));
            menu.each(function() {
                $(this).removeClass('active');
            });
            $(this).addClass('active');
        });
    </script>
</html>