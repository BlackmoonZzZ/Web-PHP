<?php
class EmployeeController extends Controller {
    private $model;

    public function __construct($db) {
        // Sử dụng đường dẫn tuyệt đối để tránh lỗi nạp file
        require_once __DIR__ . "/../Models/Employee.php";
        $this->model = new Employee($db);
    }

    public function index() {
        $q = $_GET['q'] ?? "";
        $employees = $this->model->getAll($q);
        $this->view("employees/index", ["employees" => $employees]);
    }

    public function create() {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['full_name'])) {
                $error = "Họ tên không được để trống!";
            } else {
                $this->model->insert($_POST);
                header("Location: index.php?c=employee&a=index");
                exit;
            }
        }
        $this->view("employees/create", ["error" => $error]);
    }

    // --- HÀM SỬA LỖI FATAL ERROR ---
    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?c=employee&a=index");
            exit;
        }

        $employee = $this->model->find($id); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header("Location: index.php?c=employee&a=index");
            exit;
        }

        $this->view("employees/edit", ["emp" => $employee]);
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header("Location: index.php?c=employee&a=index");
        exit;
    }
}