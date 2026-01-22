<?php
require_once '../core/Router.php';
// Bật hiển thị lỗi để debug nhưng ghi log khi nộp bài
ini_set('display_errors', 1); 
error_reporting(E_ALL);

Router::route();