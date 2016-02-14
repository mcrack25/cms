<?php

/* Общий класс для работы с Моделями */

abstract class AModels
{
    protected $data = [];
    public static $count_items = 0;

    protected static function setTable($table){
        return Config::getBase('db_prefix') . $table;
    }

    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    public function __get($k)
    {
        return $this->data[$k];
    }

    public function __isset($k)
    {
        return isset($this->data[$k]);
    }

    public static function findAll()
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM ' . self::setTable(static::$table);
        echo $sql ;
        $db = new ADataBase();
        $db->setClassName($class);
        return $db->query($sql);
    }

    public static function findOneByPk($id)
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM ' . self::setTable(static::$table) . ' WHERE id = :id';
        $db = new ADataBase();
        $db->setClassName($class);
        $res = $db->query($sql, [':id'=>$id]);
        if (!empty($res)) {
            return $res[0];
        }
        return false;
    }

    public static function findOneByColumn($column, $value)
    {
        $db = new ADataBase();
        $db->setClassName(get_called_class());
        $sql = 'SELECT * FROM ' . self::setTable(static::$table) . ' WHERE ' . $column . '=:value';
        $res = $db->query($sql, [':value' => $value]);
        if (!empty($res)) {
            return $res[0];
        }
        return false;
    }

    protected function insert()
    {
        $cols = array_keys($this->data);
        $data = [];
        foreach ($cols as $col) {
            $data[':' . $col] = $this->data[$col];
        }
        $sql = '
          INSERT INTO ' . self::setTable(static::$table) . '
          (' . implode(', ', $cols). ')
          VALUES
          (' . implode(', ', array_keys($data)). ')
        ';
        $db = new ADataBase();
        $db->execute($sql, $data);
        $this->id = $db->lastInsertId();
    }

    protected function update()
    {
        $cols = [];
        $data = [];
        foreach ($this->data as $k => $v) {
            $data[':' . $k] = $v;
            if ('id' == $k) {
                continue;
            }
            $cols[] = $k . '=:' . $k;
        }
        $sql = '
            UPDATE ' . self::setTable(static::$table) . '
            SET ' . implode(', ', $cols) . '
            WHERE id=:id
        ';
        $db = new ADataBase();
        $db->execute($sql, $data);
    }

    public function save()
    {
        if (!isset($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /* Для настройки смещения страниц */
    protected static function getOffset($page, $count, $items_on_page) {
        if (empty($page) or ( $page <= 0)) {
            $page = 1;
        } else {
            $page = (int) $page; // Считывание текущей страницы
        }

        $pages_count = ceil($count / $items_on_page); // Количество страниц
        // Если номер страницы оказался больше количества страниц
        if ($page > $pages_count)
            $page = $pages_count;
        $start_pos = ($page - 1) * $items_on_page; // Начальная позиция, для запроса к БД
        return $start_pos;
    }

    /* Для настроки сортировки */
    protected static function getOrder($order = []){

        if(empty($order)){
            return '';
        }

        $order_mass_ins = [];
        foreach($order as $order_key => $order_val){

            $order_key = trim($order_key);
            $order_val = trim($order_val);

            if($order_val == 'DESC'){
                $desc = ' DESC';
            }
            $order_mass_ins[] = $order_key . $desc;
        }

        $order_ret = '';
        if(!empty($order_mass_ins)){
            $order_ret = ' ORDER BY ' . implode(", ", $order_mass_ins) . ' ';
        }

        return $order_ret;
    }

    /* Вывод всех статей или других таблиц, разбитый по страницам */
    public static function findAllOnPage($page, $items_on_page = 5, $where = [], $order = []){

        $where_exec = [];
        $where_insert = '';
        if((!empty($where)) and (is_array($where))){
            $where_ins = [];
            foreach ($where as $wkey=>$wval){
                $where_ins[] = $wkey . '=:' . $wkey;
                $where_exec[':' . $wkey] = $wval;
            }
            $where_insert = ' WHERE ' . implode(' AND ' , $where_ins);
        }

        $db = new ADataBase();
        $class = get_called_class();
        $db->setClassName($class);

        $sql_count = 'SELECT * FROM ' . self::setTable(static::$table) . $where_insert;
        $count_items = $db->getCountsql($sql_count, $where_exec);
        static::$count_items = $count_items;
        $start_pos = static::getOffset($page, $count_items, $items_on_page);
        $sql = $sql_count . static::getOrder($order) . ' LIMIT ' . $start_pos . ', ' . $items_on_page;
        $res = $db->query($sql, $where_exec);
        if (!empty($res)) {
            return $res;
        }
        return false;
    }
}