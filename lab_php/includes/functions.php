<?php
session_start();

// 1. Hàm Đọc/Ghi JSON
function loadJson($filename) {
    $path = __DIR__ . '/../data/' . $filename;
    if (!file_exists($path)) return [];
    $content = file_get_contents($path);
    return json_decode($content, true) ?? [];
}

function saveJson($filename, $data) {
    $path = __DIR__ . '/../data/' . $filename;
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// 2. Hàm bảo vệ trang (Require Login)
function requireLogin() {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
}

// 3. Flash Message (Hiển thị 1 lần sau redirect)
function setFlash($message, $type = 'success') {
    $_SESSION['flash'] = ['msg' => $message, 'type' => $type];
}

function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']); // Xóa ngay sau khi lấy
        return "<div class='alert alert-{$flash['type']}'>{$flash['msg']}</div>";
    }
    return "";
}

// 4. CSRF Token (Bảo vệ form)
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function checkCsrfToken() {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token không hợp lệ!");
    }
}
?>