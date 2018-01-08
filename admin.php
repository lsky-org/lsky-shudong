<?php

/**
 * User: WispX
 * Date: 2018/1/6 0006
 * Time: 9:42
 * Link: http://gitee.com/wispx
 */
 
require __DIR__ . '/init.php';

if ($get_type == 'login') {
    $data = Operate::param();
    if ($data['username'] == $config['administrator']['username']) {
        if ($data['password'] == $config['administrator']['password']) {
            $_SESSION['login_status'] = base64_encode(md5(time() . uniqid()));
            return Operate::json(1, '登录成功');
        }
        return Operate::json(0, '密码不正确');
    }
    return Operate::json(0, '账号不存在');
}

if (!isset($_SESSION['login_status'])) die(require ROOT_PATH . 'view/login.php');

if ($get_type == 'logout') {
    $_SESSION['login_status'] = null;
    return Operate::json(1, '已注销账号');
}

if ($get_type == 'config') {
    $data = Operate::param();
    if (!isset($data['fast_delete'])) {
        $data['fast_delete'] = '0';
    }
    if ($db->update('config', $data, "id = 1")) {
        return Operate::json(1, '修改成功');
    }
    return Operate::json(0, '修改失败');
}

if ($get_type == 'blacklist_delete') {
    $id = Operate::param('id');
    if ($id) {
        if ($db->delete('blacklist', "id = {$id}")) {
            return Operate::json(1, '删除成功');
        }
        return Operate::json(0, '删除失败');
    }
    return Operate::json(0, '数据异常');
}

if ($get_type == 'blacklist_add') {
    $name = Operate::param('name');
    if ($name) {
        if ($db->add(['name' => base64_encode($name)], 'blacklist')) {
            return Operate::json(1, '添加成功');
        }
        return Operate::json(0, '添加失败');
    }
    return Operate::json(0, '数据异常');
}

if ($get_type == 'article_delete') {
    $id = Operate::param('id');
    if ($id) {
        if ($db->delete('article', "id = {$id}")) {
            return Operate::json(1, '删除成功');
        }
        return Operate::json(0, '删除失败');
    }
    return Operate::json('数据异常');
}

require ROOT_PATH . "view/". ($action ? "page/{$action}" : "admin") . ".php";