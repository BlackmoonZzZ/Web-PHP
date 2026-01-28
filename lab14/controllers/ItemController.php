<?php
require_once 'models/Model.php';
require_once 'helpers/FlashMessage.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$model = new Model();

// Xử lý thêm/sửa/xóa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $image = null;
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploads_dir = 'uploads';
                if (!is_dir($uploads_dir)) {
                    mkdir($uploads_dir, 0755, true);
                }
                
                $tmp_name = $_FILES['image']['tmp_name'];
                $name_file = time() . '_' . basename($_FILES['image']['name']);
                $destination = $uploads_dir . '/' . $name_file;
                
                if (move_uploaded_file($tmp_name, $destination)) {
                    $image = $name_file;
                }
            }
            
            if ($model->add($name, $description, $image)) {
                FlashMessage::add('Thêm sản phẩm thành công!', 'success');
            } else {
                FlashMessage::add('Thêm sản phẩm thất bại!', 'error');
            }
            header('Location: index.php');
            exit;
        } 
        elseif ($_POST['action'] === 'edit') {
            $id = $_POST['id'] ?? 0;
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $image = null;
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploads_dir = 'uploads';
                if (!is_dir($uploads_dir)) {
                    mkdir($uploads_dir, 0755, true);
                }
                
                $tmp_name = $_FILES['image']['tmp_name'];
                $name_file = time() . '_' . basename($_FILES['image']['name']);
                $destination = $uploads_dir . '/' . $name_file;
                
                if (move_uploaded_file($tmp_name, $destination)) {
                    $image = $name_file;
                }
            }
            
            if ($model->update($id, $name, $description, $image)) {
                FlashMessage::add('Cập nhật sản phẩm thành công!', 'success');
            } else {
                FlashMessage::add('Cập nhật sản phẩm thất bại!', 'error');
            }
            header('Location: index.php');
            exit;
        }
        elseif ($_POST['action'] === 'delete') {
            $id = $_POST['id'] ?? 0;
            if ($model->delete($id)) {
                FlashMessage::add('Xóa sản phẩm thành công!', 'success');
            } else {
                FlashMessage::add('Xóa sản phẩm thất bại!', 'error');
            }
            header('Location: index.php');
            exit;
        }
    }
}

// Xác định hành động
$page = 'list';
$item = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $page = 'edit';
    $item = $model->getById($_GET['id']);
} elseif ($action === 'add') {
    $page = 'add';
}

// Nếu là trang danh sách
if ($page === 'list') {
    $itemsPerPage = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $totalItems = $model->countAll();
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    if ($currentPage < 1) {
        $currentPage = 1;
        header('Location: ?page=1&limit=' . $itemsPerPage);
        exit;
    }
    
    if ($currentPage > $totalPages && $totalPages > 0) {
        $currentPage = $totalPages;
        header('Location: ?page=' . $totalPages . '&limit=' . $itemsPerPage);
        exit;
    }
    
    $offset = ($currentPage - 1) * $itemsPerPage;
    $items = $model->getPage($itemsPerPage, $offset);
}
?>
