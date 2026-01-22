<?php
class Router {
    public static function route() {
        $controllerName = isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'ProductsController';
        $actionName = isset($_GET['a']) ? $_GET['a'] : 'index';

        $file = "../controllers/" . $controllerName . ".php";
        if (file_exists($file)) {
            require_once $file;
            $controller = new $controllerName();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                die("Action $actionName không tồn tại.");
            }
        } else {
            die("Controller $controllerName không tồn tại.");
        }
    }
}