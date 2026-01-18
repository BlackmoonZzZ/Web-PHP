<?php
class BaseController {
    // Hàm gọi Model
    public function model($model) {
        // Kiểm tra file model có tồn tại không
        if (file_exists("../app/models/" . $model . ".php")) {
            require_once "../app/models/" . $model . ".php";
            return new $model();
        }
        die("Model $model not found!");
    }

    // Hàm gọi View
    public function view($view, $data = []) {
        // Kiểm tra file view có tồn tại không
        if (file_exists("../app/views/" . $view . ".php")) {
            require_once "../app/views/" . $view . ".php";
        } else {
            die("View $view not found!");
        }
    }
}