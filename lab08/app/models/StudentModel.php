<?php
class StudentModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Lấy danh sách sinh viên
    public function getAll() {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM students ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Thêm mới sinh viên
    public function create($code, $full_name, $email, $dob) {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO students (code, full_name, email, dob) VALUES (:code, :full_name, :email, :dob)";
        $stmt = $conn->prepare($sql);
        // Binding dữ liệu để bảo mật
        return $stmt->execute([
            ':code' => $code,
            ':full_name' => $full_name,
            ':email' => $email,
            ':dob' => $dob
        ]);
    }

    // Cập nhật thông tin
    public function update($id, $code, $full_name, $email, $dob) {
        $conn = $this->db->getConnection();
        $sql = "UPDATE students SET code=:code, full_name=:full_name, email=:email, dob=:dob WHERE id=:id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':code' => $code,
            ':full_name' => $full_name,
            ':email' => $email,
            ':dob' => $dob
        ]);
    }

    // Xóa sinh viên
    public function delete($id) {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM students WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Lấy thông tin 1 sinh viên (để sửa)
    public function getById($id) {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM students WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(); // Lấy 1 dòng
    }
}