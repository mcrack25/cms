<?php

// Функция автозагрузки классов

function __autoload($class_name) {

    $component = Dirs::get('components') . '/' . ucfirst($class_name) . '_class.php';

    $controller = Dirs::get('controllers') . '/' . ucfirst($class_name) . '_class.php';
    $model = Dirs::get('models') . '/' . ucfirst($class_name) . '_class.php';
    $view = Dirs::get('views') . '/' . ucfirst($class_name) . '_class.php';

    $controller_module = Dirs::get('modules') . '/' . strtolower($class_name) . '/' . 'index.php';

    if (file_exists($component)) {
        $file_class = $component;
    } else if (file_exists($controller_module)) {
        $file_class = $controller_module;
    } else if (file_exists($controller)) {
        $file_class = $controller;
    } else if (file_exists($model)) {
        $file_class = $model;
    } else if (file_exists($view)) {
        $file_class = $view;
    } else {
        echo 'Не удалось найти файл, с классом ' . $class_name;
        die;
    }

    require_once $file_class;
}