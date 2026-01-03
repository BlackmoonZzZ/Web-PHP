<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form Đăng Ký (POST)</title>
</head>
<body>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $gender = $_POST['gender'] ?? '';
   
    $hobbies = $_POST['hobby'] ?? [];

    
    if (empty($name) || empty($email)) {
        echo "<h3 style='color:red'>Lỗi: Vui lòng nhập Họ tên và Email!</h3>";
    } else {
       
        echo "<div style='border: 1px solid green; padding: 10px; margin-bottom: 20px;'>";
        echo "<h2>Dữ liệu đã nhận:</h2>";
        echo "<ul>";
        echo "<li><b>Họ tên:</b> " . htmlspecialchars($name) . "</li>";
        echo "<li><b>Email:</b> " . htmlspecialchars($email) . "</li>";
        echo "<li><b>Giới tính:</b> " . htmlspecialchars($gender) . "</li>";
        
       
        echo "<li><b>Sở thích:</b> " . implode(", ", $hobbies) . "</li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>

<h2>Form Đăng Ký</h2>
<form action="" method="POST">
    <label>Họ tên:</label><br>
    <input type="text" name="name" placeholder="Nhập họ tên..."><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" placeholder="Nhập email..."><br><br>

    <label>Giới tính:</label><br>
    <input type="radio" name="gender" value="Nam" checked> Nam
    <input type="radio" name="gender" value="Nữ"> Nữ <br><br>

    <label>Sở thích (chọn ít nhất 3):</label><br>
    <input type="checkbox" name="hobby[]" value="Đọc sách"> Đọc sách <br>
    <input type="checkbox" name="hobby[]" value="Du lịch"> Du lịch <br>
    <input type="checkbox" name="hobby[]" value="Chơi game"> Chơi game <br>
    <input type="checkbox" name="hobby[]" value="Ngủ nướng"> Ngủ nướng <br><br>

    <button type="submit">Gửi thông tin</button>
</form>

</body>
</html>