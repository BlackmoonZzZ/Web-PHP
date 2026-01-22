<?php
class Database {
    private static $conn = null;
    public static function getConnection() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=localhost;dbname=lab10_sales;charset=utf8mb4", "root", "Anhminh2k525@");
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) { die("Lỗi kết nối: " . $e->getMessage()); }
        }
        return self::$conn;
    }
}