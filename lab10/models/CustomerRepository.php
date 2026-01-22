<?php
require_once '../app/config/db.php';
class CustomerRepository {
    private $db;
    public function __construct() { $this->db = Database::getConnection(); }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM customers ORDER BY full_name ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}