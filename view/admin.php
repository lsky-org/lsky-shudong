<?php defined('LSKY') or die('Illegal access!'); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>兰空树洞 - 后台管理</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css">
    <link rel="stylesheet" href="/static/css/admin.css">
</head>
<body>
<body class="mdui-appbar-with-toolbar mdui-theme-primary-indigo mdui-theme-accent-purple mdui-loaded mdui-drawer-body-left">
<header class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-theme">
        <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></span>
        <a href="" class="mdui-typo-headline mdui-hidden-xs">兰空树洞</a>
        <a href="" class="mdui-typo-title">后台管理</a>
        <div class="mdui-toolbar-spacer"></div>
        <a href="http://www.wispx.cn" target="_blank" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content: '作者博客'}"><i class="mdui-icon material-icons">&#xe838;</i></a>
        <a href="/" target="_blank" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content: '前台首页'}"><i class="mdui-icon material-icons">&#xe88a;</i></a>
        <a href="javascript:logout()" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-tooltip="{content: '退出账号'}"><i class="mdui-icon material-icons">&#xe879;</i></a>
    </div>
</header>
<div class="mdui-drawer mdui-drawer-open" id="main-drawer">
    <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
        <div class="mdui-collapse-item">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">near_me</i>
                <div class="mdui-list-item-content">悄悄话管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-collapse-item-body mdui-list">
                <a href="" data-json="{'action': 'article'}" class="mdui-list-item mdui-ripple ">悄悄话列表</a>
            </div>
        </div>

        <div class="mdui-collapse-item">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-deep-orange">&#xe0b9;</i>
                <div class="mdui-list-item-content">评论管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-collapse-item-body mdui-list">
                <a href="" data-json="{'action': 'comment'}" class="mdui-list-item mdui-ripple ">评论列表</a>
            </div>
        </div>

        <div class="mdui-collapse-item">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-red">&#xe8b8;</i>
                <div class="mdui-list-item-content">系统设置</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-collapse-item-body mdui-list">
                <a href="" data-json="{'action': 'blacklist'}" class="mdui-list-item mdui-ripple ">系统关键字</a>
                <a href="" data-json="{'action': 'system'}" class="mdui-list-item mdui-ripple ">系统参数</a>
            </div>
        </div>
    </div>
</div>

<div class="mdui-container main animated fadeInDown" style="padding-top: 15px;">
    <div class="mdui-m-t-5 mdui-valign">
        <h1 class="mdui-center" style="font-family: '宋体';font-size: 50px;color: #01aaed;">兰空树洞 1.1</h1>
    </div>
</div>

<!-- Loading -->
<div class="loading-shade">
    <span></span>
</div>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
<script src="/static/js/common.js"></script>
<script>
    $(function () {
        $('.mdui-list a').click(function (e) {
            e.preventDefault();
            var obj = getStrToJson($(this).attr('data-json'));
            loading(true);
            $('.main').load(this.href, obj, function () {
                loading(false);
            });
        });
    });
    function logout() {
        ajax('?type=logout', null, function () {
            history.go(0);
        });
    }
</script>
</body>
</html>