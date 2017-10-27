<?php defined('LSKY') or die('Illegal access!');

/**
 * Tools
 * User: WispX
 * Date: 2017/10/26 0026
 * Time: 9:54
 * Link: http://gitee.com/wispx
 */


/**
 * 输出json数据
 * @param $code 状态码
 * @param $msg 状态信息
 * @param array $data 额外数据
 */
function json($code, $msg, array $data = [])
{
    $result = ['code' => $code, 'msg' => $msg];
    if(count($data) > 0) $result['data'] = $data;
    echo json_encode($result);
}

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
