<?php
//FRONT CONTROLLER
//1 общие настройки
//1.1 поиск ошибок во время разработки (потом удалить)
ini_set('display_errors',1);
error_reporting(E_ALL);

//2 подключение файлов системы
//2.1 подключение класса router
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');

//3 установка соединения с бд
require_once(ROOT.'/components/Db.php');

//4 вызов роутер
$router = new Router(); //экземпляр класса роутер
$router->run(); // метод будет принимать управление от фронтконтроллера