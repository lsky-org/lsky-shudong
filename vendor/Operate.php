<?php defined('LSKY') or die('Illegal access!');

/**
 * 静态操作类
 * User: WispX
 * Date: 2017/10/27
 * Time: 19:36
 * Link: http://gitee.com/wispx
 */

class Operate
{

    /**
     * 获取客户端IP地址
     * @param integer   $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param boolean   $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    public static function getIp($type = 0, $adv = false)
    {
        $type      = $type ? 1 : 0;
        static $ip = null;
        if (null !== $ip) {
            return $ip[$type];
        }

        if ($adv) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos = array_search('unknown', $arr);
                if (false !== $pos) {
                    unset($arr[$pos]);
                }
                $ip = trim(current($arr));
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u", ip2long($ip));
        $ip   = $long ? [$ip, $long] : ['0.0.0.0', 0];
        return $ip[$type];
    }

    /**
     * 二维数组去空格
     * @author WispX
     * @date 2017-09-04 9:44
     * @param array $array
     * @return string|boolean
     */
    public static function trimArray($array)
    {
        if(count($array) > 0) {
            foreach ($array as $key => &$val) {
                $array[$key] = trim($val);
            }
            return $array;
        }
        return false;
    }


    /**
     * 格式化时间
     * @param  [type] $unixTime [description]
     * @return [type]           [description]
     */
    public static function formatTime($unixTime)
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
                return '今天 ' . date('H:i', $unixTime);
            }
            if (date('n.j', ($unixTime + 86400)) == date('n.j')) {
                return "昨天 " . date('H:i', $unixTime);
            }
        }
        return $showTime;
    }

    /**
     * 替换数据为正则格式
     * @param array $data
     * @return array
     */
    public static function getPatternArray(array $data)
    {
        foreach ($data as $item => &$value) {
            $data[$item] = '/' . addslashes($value) . '/';
        }
        return $data;
    }

    /**
     * 过滤关键字，并替换为*
     * @param $content 要过滤的内容
     * @param array $blacklist 关键字，一维数组
     * @return mixed
     */
    public static function filter($content, array $blacklist)
    {
        return preg_replace(self::getPatternArray($blacklist), '*', $content);
    }

}