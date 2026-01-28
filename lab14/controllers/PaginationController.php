<?php
require_once 'models/Model.php';

class PaginationController {
    private $model;
    private $itemsPerPage;
    private $currentPage;
    private $totalItems;
    private $totalPages;
    
    public function __construct() {
        $this->model = new Model();
        $this->itemsPerPage = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
        
        // Xác định trang hiện tại từ query string
        $this->currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        // Lấy tổng số bản ghi
        $this->totalItems = $this->model->countAll();
        
        // Tính tổng số trang
        $this->totalPages = ceil($this->totalItems / $this->itemsPerPage);
        
        // Kiểm tra và điều chỉnh trang
        if ($this->currentPage < 1) {
            $this->currentPage = 1;
            header('Location: ?page=1&limit=' . $this->itemsPerPage);
            exit;
        }
        
        if ($this->currentPage > $this->totalPages && $this->totalPages > 0) {
            $this->currentPage = $this->totalPages;
            header('Location: ?page=' . $this->totalPages . '&limit=' . $this->itemsPerPage);
            exit;
        }
    }
    
    /**
     * Lấy dữ liệu trang hiện tại
     */
    public function getData() {
        $offset = ($this->currentPage - 1) * $this->itemsPerPage;
        return $this->model->getPage($this->itemsPerPage, $offset);
    }
    
    /**
     * Lấy thông tin phân trang
     */
    public function getPaginationInfo() {
        return [
            'currentPage' => $this->currentPage,
            'totalPages' => $this->totalPages,
            'totalItems' => $this->totalItems,
            'itemsPerPage' => $this->itemsPerPage
        ];
    }
    
    /**
     * Tạo URL với trang số
     */
    public function getPageUrl($page) {
        return '?page=' . $page . '&limit=' . $this->itemsPerPage;
    }
    
    /**
     * Kiểm tra có trang trước không
     */
    public function hasPrevious() {
        return $this->currentPage > 1;
    }
    
    /**
     * Kiểm tra có trang sau không
     */
    public function hasNext() {
        return $this->currentPage < $this->totalPages;
    }
}
?>
