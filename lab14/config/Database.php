<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'lab14';
    private $user = 'root';
    private $password = 'Anhminh2k525@';
    private $conn;
    
    public function connect() {
        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbname,
                $this->user,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            return $this->conn;
        } catch (PDOException $e) {
            echo "Lỗi kết nối: " . $e->getMessage();
            return null;
        }
    }
    
    public function getConnection() {
        if (!$this->conn) {
            $this->connect();
        }
        return $this->conn;
    }
}
?>
