<?php

/**
 * User: WispX
 * Date: 2018/1/6 0006
 * Time: 9:33
 * Link: http://gitee.com/wispx
 */

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

//error_reporting(0);

define('LSKY', 'LSKY');

// 定义根目录
define('ROOT_PATH', __DIR__ . '/');

// 数据库配置
require './config/db.php';

// 数据库操作类
require './vendor/Query.php';

// 实例化数据库
$db = new Query(DB_NAME);

// 工具方法
require './vendor/Tool.php';

// 其他配置
$config = require './config/config.php';

// 静态操作类
require './vendor/Operate.php';

// 系统配置
$conf = get_config();

// 接收数据
$action = Operate::param('action');
$post_type = Operate::param('type', 'POST', 'index');
$get_type = Operate::param('type', 'GET');
$page = Operate::param('page', 'GET', 1);

// 分页类
require './vendor/Page.php';