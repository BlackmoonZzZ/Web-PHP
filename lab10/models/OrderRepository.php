<?php
require_once '../app/config/db.php';
class OrderRepository {
    private $db;
    public function __construct() { $this->db = Database::getConnection(); }

    public function saveOrder($customerId, $items) {
        try {
            $this->db->beginTransaction(); // Bắt đầu giao dịch
            // ... Logic lưu đơn hàng và trừ kho ...
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack(); // Hoàn tác nếu lỗi
            return false;
        }
    }
    
    public function getFormData() {
        return [
            'customers' => $this->db->query("SELECT * FROM customers")->fetchAll(PDO::FETCH_ASSOC),
            'products' => $this->db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC)
        ];
    }
}