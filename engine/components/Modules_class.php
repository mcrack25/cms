<?php

class Modules
{
    private $params = [];
    private $result = '';

    public static function getModule($module, $params = []){
        if(file_exists(Dirs::get('modules') . '/' . $module . '/index.php')){
            require_once Dirs::get('modules') . '/' . $module . '/index.php';
            if(class_exists($module)){
                $class = new $module;
                $class->setParams($params);
                $class->Run();
                return $class->showResult();
            }
        } else {
            return 'Модуль ' . $module . ' не найден';
        }
    }

    public function setParams($params){
        $this->params = $params;
    }

    public function Run(){
        /* Тут будет находиться вся реализация модуля */
    }

    public function showResult(){
        return $this->result;
    }

}