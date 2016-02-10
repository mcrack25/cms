<?php

/* Автор: Ахмедов Мурад Алилович */

// Устанавливаем кодировку
header('Content-Type: text/html; charset=utf-8');

// Запускаем сессию
session_start();

// Отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Дополнительные настройки
setlocale(LC_TIME, "ru_RU.utf8");
date_default_timezone_set('Europe/Kiev');

// Начальные параметры сессий
if(empty($_SESSION['group'])){
    $_SESSION['group'] = 5;
}

// Указываем для какого раздела
// установлены ткущие настройки сортировки
if(empty($_SESSION['sort_razdel'])){
    $_SESSION['sort_razdel'] = 'news';
}

// Указываем сортировку по возрастанию или убыванию
// для выбранного разделе сортировки
if(empty($_SESSION['sort_asc_desc'])){
    $_SESSION['sort_asc_desc'] = 'desc';
}

// Указываем по какому параметру сортировать
// в указанном разделе сортировки
if(empty($_SESSION['sort_type'])){
    $_SESSION['sort_type'] = 'data';
}

// Для URL главной страницы
define("HOST_URL", $_SERVER['HTTP_HOST']);

// Для пути к корневой директории
define("ROOT_DIR", str_replace('\\', '/', realpath(__DIR__)));

// Подключаем класс, отвечающий за вставку всех путей в коде
require_once ROOT_DIR . '/engine/components/Dirs_class.php';

// Подключаем файл автозагрузки классов
require_once Dirs::get('engine') . '/autoload.php';

// Подключаем класс роутинга
$router = new Router();
$router->run();