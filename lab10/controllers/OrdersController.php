<?php
require_once '../core/Controller.php';
require_once '../models/OrderRepository.php';

class OrdersController extends Controller {
    private $orderRepo;
    public function __construct() { $this->orderRepo = new OrderRepository(); }

    public function create() {
        // Lấy dữ liệu cho dropdown khách hàng và sản phẩm
        $data = $this->orderRepo->getFormData();
        $this->render('orders/create', $data);
    }
}