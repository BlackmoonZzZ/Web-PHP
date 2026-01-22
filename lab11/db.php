<?php
$host = '127.0.0.1';
$db   = 'lab11'; // Tên DB bạn tạo trong phpMyAdmin
$user = 'root';
$pass = 'Anhminh2k525@';

try {
    // Sửa lỗi: PDO::ERRMODE_EXCEPTION (bỏ chữ ATTR_ ở giữa)
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}

// Header dùng chung cho đẹp (Bootstrap 5)
function layout_header($title) {
    echo '<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>'.$title.'</title></head><body class="bg-light"><div class="container mt-5 p-4 bg-white shadow-sm">';
}

function layout_footer() {
    echo '</div></body></html>';
}