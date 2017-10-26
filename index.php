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
$post_type = isset($_POST['type']) ? $_POST['type'] : 'index';
$get_type = isset($_GET['type']) ? $_GET['type'] : false;

require './vendor/Functions.php';

require './config.php';

require './vendor/Query.php';

$db = new Query('test');

// 设置数据表
$db->table('article');

switch ($post_type) {
    case 'index':
        $list = $db->order('id desc')
            //->limit('0,3')
            ->select();
        break;
    case 'real_name':
        $list = $db->where('is_anonymous = 0')
            ->order('id desc')
            //->limit('0,3')
            ->select();
        break;
    case 'anonymous':
        $list = $db->where('is_anonymous = 1')
            ->order('id desc')
            //->limit('0,3')
            ->select();
        break;
    default:
        break;
}

if($get_type) {
    if($get_type == 'send') {
        $data = trimArray($_POST);
        $data['ip'] = getIp();
        $data['send_time'] = time();
        if($db->add($data, 'article')) {
            return json(1, '发布成功');
        }
        return json(0, '发布失败');
    }
}

require "./view/". ($action ? "page/{$action}" : "index") . ".php";