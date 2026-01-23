<?php
class Database {
    public function getConnection() {
        try {
            // Sửa tên dbname cho đúng với database bạn đã tạo
            $conn = new PDO("mysql:host=localhost;dbname=lab12_mvc", "root", "Anhminh2k525@"); 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            die("Lỗi kết nối: " . $e->getMessage());
        }
    }
}