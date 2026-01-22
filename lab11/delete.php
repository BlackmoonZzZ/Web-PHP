<?php
require 'db.php';
session_start();

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['msg'] = "Đã xóa nhân viên có ID $id thành công!"; // Flash message
    } catch (Exception $e) {
        $_SESSION['msg'] = "Lỗi khi xóa: " . $e->getMessage();
    }
}

header("Location: index.php");
exit;