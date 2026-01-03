<?php
// Nhúng thư viện hàm
require_once "functions.php";

// Đọc tham số 'action' từ URL, mặc định là 'home' để tránh lỗi
$action = $_GET["action"] ?? "home";

// Hiển thị Menu liên kết theo yêu cầu
echo "<h2>LAB03 - Mini Utility</h2>";
echo "<p>
    <a href='?action=max&a=10&b=22'>Max</a> | 
    <a href='?action=min&a=10&b=22'>Min</a> | 
    <a href='?action=prime&n=17'>Prime</a> | 
    <a href='?action=fact&n=6'>Factorial</a> | 
    <a href='?action=gcd&a=12&b=18'>GCD</a>
</p>";
echo "<hr>";

// Đọc các tham số a, b, n từ URL (sử dụng ?? để tránh lỗi Notice/Warning)
$a = $_GET['a'] ?? 0;
$b = $_GET['b'] ?? 0;
$n = $_GET['n'] ?? 0;

// Xử lý switch-case theo action
switch ($action) {
    case "max":
        $result = max2($a, $b);
        echo "Số lớn nhất giữa $a và $b là: <b>$result</b>";
        break;

    case "min":
        $result = min2($a, $b);
        echo "Số nhỏ nhất giữa $a và $b là: <b>$result</b>";
        break;

    case "prime":
        $check = isPrime($n);
        echo "Số $n " . ($check ? "là <b>số nguyên tố</b>" : "<b>không phải</b> là số nguyên tố");
        break;

    case "fact":
        $result = factorial($n);
        if ($result === null) {
            echo "Không tính được giai thừa cho số âm.";
        } else {
            echo "Giai thừa của $n là: <b>$result</b>";
        }
        break;

    case "gcd":
        $result = gcd($a, $b);
        echo "Ước chung lớn nhất của $a và $b là: <b>$result</b>";
        break;

    case "home":
        echo "Chọn một chức năng phía trên để thực hiện.";
        break;

    default:
        echo "Chức năng không hợp lệ.";
        break;
}
?>