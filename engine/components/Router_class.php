<?php

/* Класс для перенаправления пользователя */

class Router {

    private $routes;

    public function __construct() {
        $this->routes = require_once Dirs::get('configs') . '/routes.php';
    }

    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {

        $uri = $this->getURI();

        $ok = '0';
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^$uriPattern$~", $uri)) {
                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);

                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action_' . ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerFile = Dirs::get('controllers') . '/' . $controllerName . '_class.php';

                if (file_exists($controllerFile)) {
                    include_once $controllerFile;
                }

                $controllerObject = new $controllerName;
                $result = call_user_func_array([$controllerObject, $actionName], $parameters);

                if (method_exists($controllerObject, $actionName)) {
                    $ok = '1';
                    break;
                }
            }
        }
    }
}