<?php

/**
 * User: WispX
 * Date: 2017/10/26 0026
 * Time: 9:02
 * Link: http://gitee.com/wispx
 */

//error_reporting(0);

define('LSKY', 'LSKY');

$action = isset($_POST['action']) ? $_POST['action'] : false;

require './vendor/Functions.php';

require './vendor/Query.php';

// 初始化数据库连接
/*$db = new Query(
    // mysql连接地址
    'localhost',
    // mysql连接用户名
    'root',
    // mysql连接密码
    'root',
    // mysql数据库名
    'test',
    // mysql连接端口
    '3306',
    // mysql数据库编码
    'utf8'
);*/

require "./view/". ($action ? "page/{$action}" : "index") . ".php";