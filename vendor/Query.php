<?php defined('LSKY') or die('Illegal access!');

/**
 * Class Query
 */

class Query
{
    protected $db;
    protected $_sql;
    protected $throw = 1; //抛出sql语句错误信息
    protected $_query;

    function __construct($db_name = NULL, $port = '3306')
    {
        if (!$db_name) {
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        } else {
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, $db_name, $port);
        }

        $this->db->set_charset(DB_CHARSET);

        if ($this->db->connect_error) {
            if ($this->throw) {
                throw new Exception($this->db->connect_error, $this->db->connect_errno);
            }
        }

    }

    /**
     * 查询字段
     * @param string $field 要查询的字段
     * @return Db
     */
    public function field($field)
    {
        $this->_query['field'] = "SELECT '{$field}''";
        return $this;
    }

    /**
     * 查询的表名
     * @param string $table 要查询的表名可以带别名，例如table as tab
     * @return Db
     */
    public function table($table)
    {
        $this->_query['table'] = "FROM {$table}";
        return $this;
    }

    /**
     * 联合查询
     * @param string $join 联合的表名可以带别名，必须加上关联的on语句
     * @return Db
     */
    public function join($join)
    {
        $this->_query['join'][] = $join;
        return $this;
    }

    /**
     * 条件语句
     * @param string $where sql条件语句不需加where关键字
     * @return Db
     */
    public function where($where)
    {
        $this->_query['where'] = "WHERE {$where}";
        return $this;
    }

    /**
     * 排序
     * @param string $order
     * @return Db
     */
    public function order($order)
    {
        if ($order != '') {
            $this->_query['order'] = "ORDER BY {$order}";
        }
        return $this;
    }

    /**
     * 获取条数
     * @param string $limit 格式0,5
     * @return Db
     */
    public function limit($limit)
    {
        if ($limit != '') {
            $this->_query['limit'] = "LIMIT {$limit}";
        }
        return $this;
    }

    /**
     * 构造sql语句
     * @return string 返回sql语句
     */
    private function buildsql()
    {

        $sql = !empty($this->_query['field']) ? $this->_query['field'] : 'SELECT *' . ' ' . $this->_query['table'];

        if (!empty($this->_query['join'])) {
            foreach ($this->_query['join'] as $join) {
                $sql .= " {$join}";
            };
        }

        if (isset($this->_query['del'])) {
            $sql = $this->_query['del'] . ' ' . $this->_query['table'];
        }

        if (!empty($this->_query['where'])) {
            $sql .= ' ' . $this->_query['where'];
        }

        if (isset($this->_query['order']) && !empty($this->_query['order'])) {
            $sql .= ' ' . $this->_query['order'];
        }

        if (!empty($this->_query['limit'])) {
            $sql .= ' ' . $this->_query['limit'];
        }
        unset($this->_query);

        return $sql;

    }

    /**
     * 执行select查询
     * @return bool|array    失败返回false，成功返回二维数组
     */
    public function select()
    {
        $sql = $this->buildsql();
        return $this->fetchAll($sql);
    }

    /**
     * 获取所有记录数
     *
     * @return int            返回所有记录数
     */
    public function findNumRows()
    {
        $sql = $this->buildsql();
        $res = $this->query($sql);
        return $res->num_rows;
    }

    /**
     * 删除一行记录
     * @return boolean
     */
    public function delRow()
    {
        $this->_query['del'] = "DELETE";
        $sql = $this->buildsql();
        $res = $this->query($sql);
        if ($res === false) {
            return false;
        }
        return true;
    }

    /**
     * 检查唯一性
     *
     * @param string $table 表名
     * @param string $where 查询条件
     * @param string $keyid 自动id
     * @return boolean            存在返回false,否则返回true
     */
    public function chkUnique($table, $where, $keyid = 'id')
    {

        $sql = "SELECT {$keyid} from {$table} WHERE {$where}";
        $num = $this->getNumRows($sql);
        if ($num > 0) {
            return false;
        }
        return true;
    }

    /**
     * 执行select查询
     * @return bool|array    失败返回false，成功返回一维数组
     */
    public function findRow()
    {
        $sql = $this->buildsql();
        return $this->fetchRow($sql);
    }

    /**
     * 执行sql语句查询
     * @param string $sql sql语句
     * @return mixed 返回资源结果集或布尔值
     */
    public function query($sql)
    {
        $this->_sql = $sql;
        $res = $this->db->query($sql);

        if ($res === false) {
            if ($this->throw) {
                throw new Exception("发生错误: 错误信息  {$this->getLastErr()} 相关sql语句 {$this->_sql}", $this->db->errno);
            } else {
                return false;
            }
        }
        return $res;
    }

    /**
     * 设置是否抛出sql异常
     * @param bool $bool
     */
    public function setThrow($bool = false)
    {
        $this->throw = $bool;
    }

    /**
     * 执行sql脚本从文件
     * @param file $sqlfile sql脚本文件路径
     * @return boolean
     */
    public function buildSqlfile($sqlfile)
    {
        $file = file($sqlfile);
        if ($file === false || empty($file)) {
            return false;
        }
        foreach ($file as $key => $val) {
            if (preg_match('/^(-|#)/', $val) || trim($val) == '') {
                continue;
            }
            $new[] = $val;
        }
        $sqls = split(';', join('', $new));
        foreach ($sqls as $sql) {
            $this->query($sql);
        }
        return true;
    }

    /**
     * 获取一条数据
     * @param string $sql sql语句
     * @return array 一维数组
     */
    public function fetchRow($sql)
    {
        $res = $this->query($sql);
        $result = @$res->fetch_assoc();
        return $result;
    }

    /**
     * 获取多条数据
     * @param string $sql
     * @return array 二维数组
     */
    public function fetchAll($sql, $key = '')
    {
        $res = $this->query($sql);
        $result = array();
        while ($row = $res->fetch_assoc()) {
            if ($key) {
                $result [$row[$key]] = $row;
            } else {
                $result [] = $row;
            }
        }
        return $result;
    }

    /**
     * 获取所有记录数
     *
     * @param string $sql sql语句
     * @return int            返回所有记录数
     */
    public function getNumRows($sql)
    {
        $res = $this->query($sql);
        return $res->num_rows;
    }

    /**
     * 返回最后查询自动生成的id
     */
    public function getLastId()
    {
        return $this->db->insert_id;
    }

    /**
     * 返回最后查询出现的错误信息
     */
    public function getLastErr()
    {
        return $this->db->error;
    }

    /**
     * 获取最后一次执行的sql语句
     *
     * @return string sql
     */
    public function getLastSql()
    {
        return $this->_sql;
    }

    /**
     * 锁定表
     * @param string $tabname 表名
     * @param string $mode 模式
     */
    public function locktab($tabname, $mode = 'READ')
    {
        $this->query("LOCK TABLE {$tabname} {$mode}");
        return $this;
    }

    /**
     * 解锁表
     */
    public function unlocktab()
    {
        $this->query("UNLOCK TABLES");
    }

    /**
     * 执行锁定查询
     */
    public function execlockquery()
    {
        $sql = $this->buildsql();

    }

    /**
     * 执行添加记录操作
     * @param $data        要增加的数据，参数为数组。数组key为字段值，数组值为数据取值 格式:array('字段名' => 值);
     * @param $table        数据表
     * @return boolean
     */
    public function add($data, $table, $replace = false)
    {
        if (!is_array($data) || $table == '' || count($data) == 0) {
            return false;
        }
        $fields = $values = array();
        //遍历记录, 格式化字段名称与值
        foreach ($data as $key => $val) {
            $fields[] = "`{$table}`.`{$key}`";
            $values[] = is_numeric($val) ? $val : "'{$val}'";
        }
        $field = join(',', $fields);
        $value = join(',', $values);
        unset($fields, $values);


        $cmd = $replace ? 'REPLACE INTO' : 'INSERT INTO';
        $sql = $cmd . ' `' . $table . '`(' . $field . ') VALUES (' . $value . ')';
        $this->query($sql);

        return $this->getLastId();
    }

    /**
     * 执行更新记录操作
     * @param $table        数据表
     * @param $data        要更新的数据内容，参数可以为数组也可以为字符串，建议数组。
     *      为数组时数组key为字段值，数组值为数据取值
     *      为字符串时[例：`name`='phpcms',`hits`=`hits`+1]。
     *      为数组时[例: array('name'=>'phpcms','password'=>'123456')]
     *      数组可使用array('name'=>'+=1', 'base'=>'-=1');程序会自动解析为`name` = `name` + 1, `base` = `base` - 1
     *
     * @param $where        更新数据时的条件
     * @return boolean
     */
    public function update($table, $data, $where = '')
    {
        if ($table == '' or $where == '') {
            return false;
        }

        $where = ' WHERE ' . $where;
        $field = '';
        if (is_string($data) && $data != '') {
            $field = $data;
        } elseif (is_array($data) && count($data) > 0) {
            $fields = array();
            foreach ($data as $k => $v) {
                switch (substr($v, 0, 2)) {
                    case '+=':
                        $v = substr($v, 2);
                        if (is_numeric($v)) {
                            $fields[] = "`{$k}`=`{$k}` + '$v'";
                        } else {
                            continue;
                        }

                        break;
                    case '-=':
                        $v = substr($v, 2);
                        if (is_numeric($v)) {
                            $fields[] = "`{$k}`=`{$k}` - '$v'";
                        } else {
                            continue;
                        }
                        break;
                    default:
                        $fields[] = "`{$k}`= '$v'";
                }
            }
            $field = implode(',', $fields);
        } else {
            return false;
        }

        $sql = 'UPDATE `' . $table . '` SET ' . $field . $where;
        return $this->query($sql);
    }

    /**
     * 执行删除记录操作
     * @param $table        数据表
     * @param $where        删除数据条件,不充许为空。
     *                        如果要清空表，使用empty方法
     * @return boolean
     */
    public function delete($table, $where = null)
    {
        if ($table == '') {
            return false;
        }

        $sql = 'DELETE FROM `' . $table . '`';
        if ($where) {
            $sql .= " WHERE {$where}";
        }

        return $this->query($sql);
    }

    /**
     * 自动提交
     * @param BOOL $status 默认false关闭自动提交，设置为true时打开自动提交
     */
    public function autocommit($status = false)
    {
        $this->db->autocommit($status);
    }

    /**
     * 提交事务
     */
    public function commit()
    {
        $this->db->commit();
    }

    /**
     * 回滚事务
     */
    public function rollback()
    {
        $this->db->rollback();
    }


    public function __destruct()
    {
        $this->db->close();
    }

}