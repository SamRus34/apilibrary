<?php

class Router
{
    private $routes; //массив для хранения маршрутов

    public function __construct() //метод конструктор в котором мы прочитаем и запомним роуты
    {
        $routesPath = ROOT.'/config/routes.php'; //путь к заданной директории (к роутам)
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() //метод run принимает отправления от фронт контроллера
    {
        //получить строку запроса
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
//                echo '<br> Где ищем (запрос, который набрал пользователь): '. $uri;
//                echo '<br> Что ищем (совпадение из правила): '.$uriPattern;
//                echo '<br> Кто обрабатывает: '.$path;

                //Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //определить какой контроллер и action обрабатывают запрос
                $segments = explode('/', $internalRoute);

                //получить имя контроллера
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName); // делает первую букву строки заглавной

                $actionName = 'action'.ucfirst(array_shift($segments));

//                echo '<br>Класс: '.$controllerName;
//                echo '<br>Метод: '.$actionName;
                $parameters = $segments;
//                echo '<pre>';
//                print_r($parameters);

                //подключить файл класса контроллера
                $controllerFile = ROOT . '/controllers/' .
                    $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once ($controllerFile);
                }

                //создать объект, вызвать метод т.е. action
                $controllerObject = new $controllerName;
                //$result = $controllerObject->$actionName();
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result !=null) {
                    break;
                }
            }
        }
    }

}