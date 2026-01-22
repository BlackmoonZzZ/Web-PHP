<?php
require_once '../core/Controller.php';
require_once '../models/ProductRepository.php';

class ProductsController extends Controller {
    private $repo;
    public function __construct() { $this->repo = new ProductRepository(); }

    public function index() {
        $search = $_GET['search'] ?? '';
        $sort = $_GET['sort'] ?? 'name';
        // Tiêu chí 3: Whitelist sort
        if (!in_array($sort, ['name', 'price', 'stock'])) $sort = 'name';
        
        $products = $this->repo->getAll($search, $sort);
        $this->render('products/index', ['products' => $products]);
    }

    public function create() { $this->render('products/create'); } // Sửa lỗi Action create
}