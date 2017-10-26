<?php defined('LSKY') or die('Illegal access!');

/**
 * Tools
 * User: WispX
 * Date: 2017/10/26 0026
 * Time: 9:54
 * Link: http://gitee.com/wispx
 */

/**
 * 格式化时间
 * @param  [type] $unixTime [description]
 * @return [type]           [description]
 */
function formatTime($unixTime)
{
    $showTime = date('Y', $unixTime) . "年" . date('n', $unixTime) . "月" . date('j', $unixTime) . "日";
    if (date('Y', $unixTime) == date('Y')) {
        $showTime = date('n', $unixTime) . "月" . date('j', $unixTime) . "日 " . date('H:i', $unixTime);
        if (date('n.j', $unixTime) == date('n.j')) {
            $timeDifference = time() - $unixTime + 1;
            if ($timeDifference < 30) {
                return "刚刚";
            }
            if ($timeDifference >= 30 && $timeDifference < 60) {
                return $timeDifference . "秒前";
            }
            if ($timeDifference >= 60 && $timeDifference < 3600) {
                return floor($timeDifference / 60) . "分钟前";
            }
            return date('H:i', $unixTime);
        }
        if (date('n.j', ($unixTime + 86400)) == date('n.j')) {
            return "昨天 " . date('H:i', $unixTime);
        }
    }
    return $showTime;
}