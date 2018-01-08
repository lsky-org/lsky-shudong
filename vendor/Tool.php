<?php defined('LSKY') or die('Illegal access!');

/**
 * Tools
 * User: WispX
 * Date: 2017/10/26 0026
 * Time: 9:54
 * Link: http://gitee.com/wispx
 */

/**
 * 打印数据
 * @param $data
 */
function dd($data)
{
    echo '<pre>';
    echo var_dump($data);
    echo '</pre>';
}

/**
 * 获取系统数据
 * @param string $name
 * @return array
 */
function get_config($name = '')
{
    global $db;
    $config = $db->table('config')
        ->where("id = 1")
        ->findRow();
    if (empty($name)) {
        return $config;
    }
    return $config[$name];
}

/**
 * 获取系统关键字
 * @return array
 */
function get_blacklist()
{
    global $db;
    $data = [];
    $blacklist = $db->table('blacklist')->order('id desc')->select();
    foreach ($blacklist as &$value) {
        $data[$value['id']] = base64_decode($value['name']);
        unset($value);
    }
    return $data;
}