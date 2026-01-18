<?php
class BookController extends BaseController {
    private $bookModel;

    public function __construct() {
        $this->bookModel = $this->model('BookModel');
    }

    // 1. Giao diện chính
    public function index() {
        $this->view('layout', ['page' => 'books/index']);
    }

    // 2. API: Lấy danh sách sách
    public function getList() {
        $data = $this->bookModel->getAll();
        echo json_encode(['success' => true, 'data' => $data]);
    }

    // 3. API: Thêm sách mới
    public function store() {
        $isbn = $_POST['isbn'] ?? '';
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $quantity = $_POST['quantity'] ?? 0;

        try {
            $this->bookModel->create($isbn, $title, $author, '', $quantity);
            echo json_encode(['success' => true, 'message' => 'Thêm sách thành công!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi: ISBN đã tồn tại hoặc lỗi hệ thống.']);
        }
    }

    // 4. API: Lấy thông tin 1 sách (để sửa)
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $book = $this->bookModel->getById($id);
        if ($book) {
            echo json_encode(['success' => true, 'data' => $book]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sách!']);
        }
    }

    // 5. API: Cập nhật sách
    public function update() {
        $id = $_POST['id'] ?? 0;
        $isbn = $_POST['isbn'] ?? '';
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $quantity = $_POST['quantity'] ?? 0;

        try {
            // Lưu ý: Hàm update trong Model phải khớp tham số
            $this->bookModel->update($id, $isbn, $title, $author, '', $quantity);
            echo json_encode(['success' => true, 'message' => 'Cập nhật thành công!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi cập nhật: ' . $e->getMessage()]);
        }
    }

    // 6. API: Xóa sách
    public function delete() {
        $id = $_POST['id'] ?? 0;
        try {
            $this->bookModel->delete($id);
            echo json_encode(['success' => true, 'message' => 'Đã xóa sách!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi xóa: ' . $e->getMessage()]);
        }
    }
}