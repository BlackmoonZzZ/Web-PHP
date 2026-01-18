<?php
// app/models/BookModel.php
class BookModel extends Database {
    
    // Lấy tất cả sách
    public function getAll() {
        $sql = "SELECT * FROM books ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 sách theo ID (QUAN TRỌNG CHO CHỨC NĂNG SỬA)
    public function getById($id) {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sách
    public function create($isbn, $title, $author, $category, $quantity) {
        $sql = "INSERT INTO books (isbn, title, author, category, quantity) VALUES (:isbn, :title, :author, :category, :quantity)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'isbn' => $isbn,
            'title' => $title,
            'author' => $author,
            'category' => $category,
            'quantity' => $quantity
        ]);
    }

    // Cập nhật sách (QUAN TRỌNG KHI BẤM LƯU SỬA)
    public function update($id, $isbn, $title, $author, $category, $quantity) {
        $sql = "UPDATE books SET isbn=:isbn, title=:title, author=:author, category=:category, quantity=:quantity WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'isbn' => $isbn,
            'title' => $title,
            'author' => $author,
            'category' => $category,
            'quantity' => $quantity
        ]);
    }

    // Xóa sách
    public function delete($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}