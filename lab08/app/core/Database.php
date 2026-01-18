<?php
// app/core/Database.php

class Database {
    private $connection;

    public function __construct() {
        $config = require __DIR__ . '/../config/db.php';
        
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        
        try {
            $this->connection = new PDO($dsn, $config['username'], $config['password']);
            // Bật chế độ báo lỗi Exception như yêu cầu
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Thiết lập fetch mặc định là Object hoặc Assoc
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Kết nối CSDL thất bại: " . $e->getMessage());
        }
    }

    // Hàm trả về đối tượng kết nối PDO
    public function getConnection() {
        return $this->connection;
    }
}