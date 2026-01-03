<?php
// Nhận a, b, op từ URL
$a  = (float)($_GET["a"] ?? 0);
$b  = (float)($_GET["b"] ?? 0);
$op = $_GET["op"] ?? "add"; // add|sub|mul|div

$result = null;
$symbol = "";
$error = "";

// Dùng switch-case để xử lý op, có break đầy đủ
switch ($op) {
    case "add":
        $result = $a + $b;
        $symbol = "+";
        break;
    case "sub":
        $result = $a - $b;
        $symbol = "-";
        break;
    case "mul":
        $result = $a * $b;
        $symbol = "*";
        break;
    case "div":
        $symbol = "/";
        // Trường hợp chia: nếu b = 0 thì báo lỗi
        if ($b == 0) {
            $error = "Không chia được cho 0";
        } else {
            $result = $a / $b;
        }
        break;
    default:
        $error = "Phép toán không hợp lệ";
        break;
}

// Hiển thị kết quả theo mẫu: "a op b = result"
if ($error != "") {
    echo $error;
} else {
    echo "$a $symbol $b = $result";
}
?>