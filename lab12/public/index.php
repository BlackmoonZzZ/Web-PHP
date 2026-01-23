<?php
require_once '../core/Database.php';
require_once '../core/Controller.php';

$database = new Database();
$db = $database->getConnection();

$c = $_GET['c'] ?? 'employee';
$a = $_GET['a'] ?? 'index';

$controllerName = ucfirst($c) . "Controller"; // Ví dụ: EmployeeController
$controllerFile = "../app/Controllers/" . $controllerName . ".php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName($db);
    $controller->$a();
} else {
    die("Lỗi: Không tìm thấy Controller $controllerName");
}