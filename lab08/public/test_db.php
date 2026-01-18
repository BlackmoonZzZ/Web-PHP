<?php
// public/test_db.php
require_once __DIR__ . '/../app/core/Database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();
    echo "<h1>Kết nối CSDL thành công! ✅</h1>";
} catch (Exception $e) {
    echo "<h1>Lỗi: " . $e->getMessage() . " ❌</h1>";
}