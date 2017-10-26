<?php defined('LSKY') or die('Illegal access!');

/**
 * 数据库连接静态类
 * User: WispX
 * Date: 2017/10/24 0024
 * Time: 9:22
 * Link: http://gitee.com/wispx and http://www.xlogs.cn
 */

class Query
{

    // 指定数据表
    private $table;
    // 指定主键
    private $pk = 'id';
    // 条件
    private $where = false;
    // 数据库实例
    private $db;
    // 连接错误信息
    private $error;
    // 数据库配置
    private $config = [
        // 数据库连接地址
        'db_host'   => 'localhost',
        // 数据库账号
        'db_user'   => 'root',
        // 数据库密码
        'db_pass'   => 'root',
        // 数据库名
        'db_base'   => 'test',
        // 数据库连接端口
        'db_port'   => 3306,
        // 数据库编码
        'db_code'   => 'utf8',
    ];

    /**
     * 初始化数据库连接，连接成功返回实例，失败返回false
     * Connect constructor.
     * @param $db_host 数据库连接地址
     * @param $db_user 数据库用户名
     * @param $db_pass 数据库密码
     * @param $db_base 数据库名
     * @param $db_port 数据库连接端口
     * @param string $db_code 数据库编码
     */
    public function __construct($db_host = null, $db_user = null, $db_pass = null, $db_base = null, $db_port = null, $db_code = null)
    {
        @$this->db = new mysqli(
            $db_host ? $db_host : $this->config['db_host'],
            $db_user ? $db_user : $this->config['db_user'],
            $db_pass ? $db_pass : $this->config['db_pass'],
            $db_base ? $db_base : $this->config['db_base']
        );
        @$this->db->set_charset($db_code ? $db_code : $this->config['db_code']);

        if (mysqli_connect_errno()) {
            $this->error = mysqli_connect_error();
            return false;
        }
        return $this->db;
    }

    /**
     * 设置数据表名
     * @param $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * 设置条件
     * @param $where 条件
     * @return $this
     */
    public function where($where)
    {
        $this->where = " WHERE {$where}";
        return $this;
    }

    /**
     * 关闭数据库连接
     * @return bool
     */
    public function close()
    {
        return $this->db->close();
    }

    /**
     * 获取数据库连接失败的错误信息
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->error;
    }

    /**
     * 插入数据
     * @param array $data
     * @return bool
     */
    public function insert(array $data)
    {
        if($this->table) {
            $keys = '';
            $values = '';
            foreach ($data as $key => $value) {
                $keys .= $key . ", ";
                $values .= "'{$value}', ";
            }
            $keys = rtrim($keys, ', ');
            $values = rtrim($values, ', ');
            $sql = "INSERT INTO {$this->table}($keys) VALUES ($values)";
            return $this->db->query($sql);
        }
        return false;
    }

    /**
     * 根据主键删除数据
     * @param $key
     * @return bool
     */
    public function delete($key = null)
    {
        if($this->table) {
            $sql = "DELETE FROM {$this->table}";
            if($this->where) {
                $sql .= $this->where;
            }
            if($key) {
                $sql .= " WHERE {$this->pk} = {$key}";
            }
            return $this->db->query($sql);
        }
        return false;
    }

    /**
     * 更新数据
     * @param array $data
     * @return bool|mysqli_result
     */
    public function update(array $data)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "{$key} = {$value}, ";
        }
        $set = rtrim($set, ', ');
        if($this->table) {
            $sql = "UPDATE {$this->table} SET {$set}";
            if($this->where) {
                $sql .= $this->where;
            }
        } else {
            // 缺少表名
            return false;
        }
        return $this->db->query($sql);
    }

    /**
     * 查找数据
     * @param array $column 查询字段 空数组则查询全部字段
     * @param bool $array 是否返回数组  默认true  返回对象
     * @return mixed|object|stdClass
     */
    public function select(array $column = [], $array = true)
    {
        if($this->table) {
            if(count($column) > 0) {
                $column = implode(", ", $column);
            } else {
                $column = '*';
            }
            $sql = "SELECT {$column} FROM {$this->table}";
            if($this->where) {
                $sql .= $this->where;
            }
            $result = $this->db->query($sql);
            return $result ? ($array ? $result->fetch_array() : $result->fetch_object()) : false;
        }
        return false;
    }

    /**
     * 直接执行sql语句
     * @param $sql
     * @return bool
     */
    public function query($sql)
    {
        return $this->db->query($sql);
    }

    /**
     * 设置主键
     * @param $pk
     * @return $this
     */
    public function setPk($pk)
    {
        $this->pk = $pk;
        return $this;
    }

    /**
     * 根据主键获取数据
     * @param $key 主键值
     * @param $array 是否返回数组  false返回object   默认true
     * @return bool|array|mysqli_result
     */
    public function get($key, $array = true)
    {
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE {$this->pk} = {$key}");
        if($result) {
            if($array) {
                return $result->fetch_array();
            }
            return $result->fetch_object();
        }
        return false;
    }

}