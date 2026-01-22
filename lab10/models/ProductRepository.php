<?php
require_once '../app/config/db.php';
class ProductRepository {
    protected $db;
    public function __construct() { $this->db = Database::getConnection(); }

    public function getAll($search = '', $sort = 'name') {
        $allowed = ['name', 'price', 'stock']; // Whitelist bảo mật
        $sort = in_array($sort, $allowed) ? $sort : 'name';
        $sql = "SELECT * FROM products WHERE name LIKE :s ORDER BY $sort ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['s' => "%$search%"]);
        return $stmt->fetchAll();
    }
}