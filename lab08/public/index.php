<?php
// public/index.php

// 1. Nạp các file cấu hình và core
require_once '../app/config/db.php';
require_once '../app/core/Database.php';
require_once '../app/core/BaseController.php';

// 2. Lấy tham số từ URL (Routing)
// Mặc định controller là Student, action là index
$controllerName = isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'StudentController';
$actionName = isset($_GET['a']) ? $_GET['a'] : 'index';

// 3. Gọi Controller tương ứng
if (file_exists("../app/controllers/$controllerName.php")) {
    require_once "../app/controllers/$controllerName.php";
    
    // Khởi tạo Controller
    $controller = new $controllerName();
    
    // Gọi Action
    if (method_exists($controller, $actionName)) {
        // Ví dụ: gọi hàm index() trong StudentController
        $controller->$actionName();
    } else {
        echo "Lỗi: Action '$actionName' không tồn tại!";
    }
} else {
    echo "Lỗi: Controller '$controllerName' không tồn tại! (Hãy chắc chắn bạn đã tạo file này)";
}