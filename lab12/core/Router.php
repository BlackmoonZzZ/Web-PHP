<?php
class Router {
    public static function run($db) {
        $c = $_GET['c'] ?? 'employee';
        $a = $_GET['a'] ?? 'index';
        $controllerName = ucfirst($c) . "Controller";
        
        require_once "../app/Controllers/" . $controllerName . ".php";
        $controller = new $controllerName($db);
        $controller->$a();
    }
}