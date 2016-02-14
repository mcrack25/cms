<?php

/* Абстрактный класс базы данных */

class ADataBase {

    protected $dbh = NULL;
    private $className = 'stdClass';

    public function __construct()
    {
        if ($this->dbh == NULL) {
            $this->dbh = $this->getConnection();
            return $this->dbh;
        } else {
            return $this->dbh;
        }
    }

    private function getConnection() {
        $type = Config::getBase('db_type');
        switch ($type) {
            case 1:
                $db = new PDO("mysql:host=" . Config::getBase('db_host_mysql') . ";dbname=" . Config::getBase('db_name_mysql'), Config::getBase('db_user_mysql'), Config::getBase('db_pass_mysql'));
                break;
            case 2:
                $db = new PDO("sqlite:" . Dirs::get('sqlite_db') . Config::getBase('db_name_sqlite'));
                break;
            default:
                return false;
        }
        $db->exec("SET NAMES " . Config::getBase('db_charset'));
        return $db;
    }

    public function setClassName($className){
        $this->className = $className;
    }

    public function query($sql,$params=[]){
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
    }
}
