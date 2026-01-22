<?php
class Controller {
    public function render($view, $data = []) {
        extract($data); // Chuyển key mảng thành biến
        $viewPath = "../views/" . $view . ".php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View $view không tồn tại.");
        }
    }
}