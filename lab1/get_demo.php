<?php

if (isset($_GET['name']) && isset($_GET['age'])) {
    
    $name = htmlspecialchars($_GET['name']);
    $age = htmlspecialchars($_GET['age']);

    echo "<h1>Xin chào $name, tuổi: $age</h1>";
} else {
    
    echo "<h3 style='color:red'>Thiếu tham số trên URL!</h3>";
    echo "Vui lòng chạy thử với link mẫu: <br>";
    echo "<code>get_demo.php?name=An&age=20</code>";
}
?>