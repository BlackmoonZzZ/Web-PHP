<?php
require_once __DIR__ . '/../config/Database.php';

class Model {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    /**
     * Lấy tổng số bản ghi
     */
    public function countAll() {
        $sql = "SELECT COUNT(*) as total FROM items";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    /**
     * Lấy dữ liệu theo trang với LIMIT và OFFSET
     * @param int $limit - Số bản ghi trên mỗi trang
     * @param int $offset - Vị trí bắt đầu
     * @return array
     */
    public function getPage($limit, $offset) {
        $sql = "SELECT * FROM items ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Lấy item theo ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM items WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Thêm item mới
     */
    public function add($name, $description, $image = null) {
        $sql = "INSERT INTO items (name, description, image) VALUES (:name, :description, :image)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':image', $image);
        return $stmt->execute();
    }
    
    /**
     * Cập nhật item
     */
    public function update($id, $name, $description, $image = null) {
        if ($image) {
            $sql = "UPDATE items SET name = :name, description = :description, image = :image WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':image', $image);
        } else {
            $sql = "UPDATE items SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->db->prepare($sql);
        }
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Xóa item
     */
    public function delete($id) {
        $item = $this->getById($id);
        if ($item && $item['image'] && file_exists('uploads/' . $item['image'])) {
            unlink('uploads/' . $item['image']);
        }
        
        $sql = "DELETE FROM items WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
