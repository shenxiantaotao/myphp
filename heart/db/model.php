<?php


namespace heart\db;


use heart\conf;

class model extends \PDO
{

    protected $tableName = "";//存储表名
    protected $sql = "";//存储最后执行的SQL语句
    protected $limit = "";//存储limit条件
    protected $order = "";//存储order排序条件
    protected $field = "*";//存储要查询的字段
    protected $where = "";//存储where条件
    protected $allFields = [];//存储当前表的所有字段

    public function __construct($tableName)
    {
        $database=conf::get('database');
        $dsn='mysql:host='.$database['DB_HOST'].';port='.$database['DB_PORT'].';dbname='.$database['DB_NAME'].';charset=UTF8';
        $username=$database['DB_USERNAME'];
        $passwd=$database['DB_PASSWORD'];
        $options=$database['DB_OPTIONS'];
        try{
            parent::__construct($dsn, $username, $passwd, $options);
            $this->tableName=$tableName;
        }catch (\Exception $e){
            die($e->getMessage());
        }
    }

    /**
     * 获取数据表所有的列名组成的一维数组
     */
    public function getAllFields(){
        $sql='desc '.$this->tableName;
        $r=$this->query($sql);
        if($r){
            $arr=$r->fetchAll(\PDO::FETCH_ASSOC);
            $this->allFields=array_column($arr,'Field');
            return $this->allFields;
        }else{
            die('表'.$this->tableName.'不存在');
        }
    }

    /**
     * 查询单条数据
     * @return array 成功返回数组，失败返回空数组
     */
    public function find()
    {
        $sql = "select {$this->field} from {$this->tableName} {$this->where} limit 1";
        $this->sql = $sql;
        //执行SQL,结果集是一个对象
        $res = $this->query($sql);
        //判断是否查询成功,
        if ($res){
            //成功返回二维数组,索引为列名
            return $res->fetch(\PDO::FETCH_ASSOC);
        }
        //失败返回空数组
        return [];
    }

    /**
     * 查询多条数据
     * @return array 成功返回二维数组，失败返回空数组
     */
    public function select()
    {
        $sql = "select {$this->field} from {$this->tableName} {$this->where} {$this->order} {$this->limit}";
        $this->sql = $sql;
        //执行SQL,结果集是一个对象
        $res = $this->query($sql);
        //判断是否查询成功,
        if ($res){
            //成功返回二维数组,索引为列名
            return $res->fetchAll(\PDO::FETCH_ASSOC);
        }
        //失败返回空数组
        return [];
    }

    public function count(){
        $sql = "select count(*) from {$this->tableName} {$this->where} limit 1";
        $this->sql = $sql;
        //执行SQL,结果集是一个对象
        $res = $this->query($sql);
        //判断是否查询成功,
        if ($res){
            //成功返回二维数组,索引为列名
            return $res->fetch(\PDO::FETCH_ASSOC)['count(*)'];
        }
        //失败返回空数组
        return 0;
    }

    /**
     * 查询字段
     * @param string $field
     */
    public function field($field='*'){
        $this->field=$field;
        return $this;

    }

    /**
     * 条件
     * @param $where string|array,可以是二维数组如['name'=>['like','%s%']]
     */
    public function where($where){
        if(empty($where)){
            return $this;
        }
        if(is_string($where)){
            $this->where='where '.$where;
        }
        if(is_array($where)){
            $w='';
            foreach ($where as $k=>$v){
                if(empty($w)){
                    if(is_array($v)){
                        $w=$k.' '.$v[0].' '.'\''.$v[1].'\'';
                    }else{
                        $w=$k.'='.$v;
                    }
                }else{
                    if(is_array($v)){
                        $w=$w.' and '.$k.' '.$v[0].' '.'\''.$v[1].'\'';
                    }else{
                        $w=$w.' and '.$k.'='.$v;
                    }
                }
            }
            $this->where='where '.$w;
        }
        return $this;
    }

    /**
     * 分页
     * @param $page
     * @param $page_size
     */
    public function limit($page,$page_size){
        $page=!empty($page)?$page:1;
        $page_size=!empty($page_size)?$page_size:10;
        $page=($page-1)*$page_size;
        $this->limit='limit '.$page.','.$page_size;
        return $this;
    }

    /**
     * 排序
     * @param $order_str
     */
    public function order($order_str){
        $this->order='order by '.$order_str;
        return $this;

    }

    /**
     *获取最后一条sql
     * @return string
     */
    public function getLastSql(){
        return $this->sql;
    }

}