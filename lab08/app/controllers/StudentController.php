<?php
// app/controllers/StudentController.php
class StudentController extends BaseController {
    private $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('StudentModel');
    }

    // Load giao diện chính
    public function index() {
        $this->view('layout', ['page' => 'students/index']);
    }

    // API: Lấy danh sách sinh viên (JSON)
    public function getList() {
        $data = $this->studentModel->getAll();
        echo json_encode(['success' => true, 'data' => $data]);
    }

    // API: Thêm mới (JSON)
    public function store() {
        $code = $_POST['code'] ?? '';
        $full_name = $_POST['full_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $dob = $_POST['dob'] ?? '';

        if (empty($code) || empty($full_name) || empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đủ thông tin!']);
            return;
        }

        try {
            $this->studentModel->create($code, $full_name, $email, $dob);
            echo json_encode(['success' => true, 'message' => 'Thêm thành công!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi: Mã SV hoặc Email đã tồn tại.']);
        }
    }

    // API: Lấy thông tin 1 sinh viên để sửa (JSON)
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $student = $this->studentModel->getById($id);
        echo json_encode(['success' => true, 'data' => $student]);
    }

    // API: Cập nhật (JSON)
    public function update() {
        $id = $_POST['id'] ?? 0;
        $code = $_POST['code'] ?? '';
        $full_name = $_POST['full_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $dob = $_POST['dob'] ?? '';

        try {
            $this->studentModel->update($id, $code, $full_name, $email, $dob);
            echo json_encode(['success' => true, 'message' => 'Cập nhật thành công!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi cập nhật: ' . $e->getMessage()]);
        }
    }

    // API: Xóa (JSON)
    public function delete() {
        $id = $_POST['id'] ?? 0;
        try {
            $this->studentModel->delete($id);
            echo json_encode(['success' => true, 'message' => 'Đã xóa thành công!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi xóa: ' . $e->getMessage()]);
        }
    }
}