<?php
require_once 'includes/functions.php';

// Yêu cầu: Logout phải check CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCsrfToken(); // Kiểm tra token
    
    unset($_SESSION['user']);
    session_destroy();
    
    // Start session mới để gán flash message cho trang login
    session_start();
    $_SESSION['flash'] = ['msg' => 'Đã đăng xuất thành công.', 'type' => 'success'];
    
    header("Location: login.php");
    exit;
} else {
    // Nếu truy cập trực tiếp bằng GET thì chuyển về trang chủ
    header("Location: index.php");
    exit;
}