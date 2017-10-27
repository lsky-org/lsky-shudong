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
