<?php defined('LSKY') or die('Illegal access!');

/**
 * 数据库配置
 * User: WispX
 * Date: 2017/10/26
 * Time: 21:31
 * Link: http://gitee.com/wispx
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'test');
define('DB_PORT', '3306');
define('DB_CHARSET', 'utf8');

return [
    // 非法关键字
    'blacklist' => [
        '死', '滚', 'http:', 'https:', 'av', '奶子', '操', '垃圾', '杀', 'www.', '根治', '阴茎', '子宫', '阴道', '淫荡',
        '销售发票', '买卖发票', '代售发票', '代为发票', '代购发票', '求购发票', '毒', '赌', '博彩', 'XXX', '盘口', '下注', '足彩',
        '偏方', '秘方', '根治', '根除', '治愈', '走私', '水货', '盗版', '口岸价', '港行', '外挂', 'QQ尾巴', '木马病毒', '枪', '武器',
        '管制刀具', '电鱼机', '网络钓鱼', '翻转车牌', '车牌隐形', '车牌隐型',
    ]
];