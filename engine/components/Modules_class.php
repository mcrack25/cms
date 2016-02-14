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

    public static function showModules(){

        $folders = scandir(Dirs::get('modules'));
        foreach ($folders as $folder){
            if((in_array($folder, ['.','..'])) or (preg_match('/\./', $folder))){
                array_shift($folders);
            }
        }
        return $folders;
    }

    public static function showRazdel($module){
        $module_mass = preg_match('#^([a-zA-Z0-9]+)_([a-zA-Z0-9]+)$#', $module);
        if(!empty($module_mass[1])){
            return $module_mass[1];
        } else {
            return 'main';
        }
    }


}