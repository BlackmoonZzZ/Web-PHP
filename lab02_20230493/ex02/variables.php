<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập biến và hằng - Nguyễn Anh Minh</title>
    <style>
        /* CSS trang trí */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            background-color: white;
            width: 800px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        h3 {
            color: #2980b9;
            margin-top: 30px;
            border-left: 5px solid #2980b9;
            padding-left: 10px;
            background-color: #ecf0f1;
            padding: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            padding: 10px;
            border-bottom: 1px dashed #ddd;
            font-size: 16px;
        }
        ul li:last-child {
            border-bottom: none;
        }
        /* Style cho phần code debug */
        pre {
            background-color: #2d3436;
            color: #00cec9; /* Màu chữ xanh sáng */
            padding: 15px;
            border-radius: 5px;
            font-family: 'Consolas', 'Courier New', monospace;
            overflow-x: auto;
        }
        .note {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ffeeba;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // --- KHAI BÁO DỮ LIỆU ---
    $fullName = "Nguyễn Anh Minh"; 
    $age = 19;                     
    $gpa = 3.5;                    
    $isActive = true;              
    define("SCHOOL", "Đại học Công nghệ Đông Á (EAUT)");

    // --- HIỂN THỊ ---
    ?>

    <h1>BÀI TẬP EX02: BIẾN & HẰNG</h1>

    <h3>1. Thông tin sinh viên (Echo/Print)</h3>
    <ul>
        <li><b>Họ và tên:</b> <?php echo $fullName; ?></li>
        <li><b>Lớp:</b> DCCNTT14.1</li>
        <li><b>Mã SV:</b> 20230493</li>
        <li><b>Tuổi:</b> <?php echo $age; ?></li>
        <li><b>Trường:</b> <?php echo SCHOOL; ?></li>
        <li><b>Điểm GPA:</b> <?php echo $gpa; ?></li>
        <li><b>Trạng thái:</b> <?php echo $isActive ? "Đang học (True)" : "Đã nghỉ"; ?></li>
    </ul>

    <h3>2. Kiểm tra kiểu dữ liệu (Var_dump)</h3>
    <p><i>Phần này hiển thị cấu trúc kỹ thuật của biến:</i></p>
    <pre>
<?php 
// Đặt var_dump vào trong thẻ pre để giữ định dạng
var_dump($fullName);
var_dump($age);
var_dump($gpa);
var_dump($isActive);
?>
    </pre>

    <h3>3. So sánh Nháy đơn (') và Nháy kép (")</h3>
    
    <div class="note">
        <b>Trường hợp 1: Dùng Nháy Kép (Double Quotes)</b><br>
        Code: <code>echo "Tuoi: $age";</code><br>
        Kết quả: <b><?php echo "Tuoi: $age"; ?></b><br>
        ➔ <i>Giải thích: Nháy kép nhận diện và in ra giá trị của biến $age.</i>
    </div>
    
    <div class="note" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
        <b>Trường hợp 2: Dùng Nháy Đơn (Single Quotes)</b><br>
        Code: <code>echo 'Tuoi: $age';</code><br>
        Kết quả: <b><?php echo 'Tuoi: $age'; ?></b><br>
        ➔ <i>Giải thích: Nháy đơn coi $age là văn bản thuần túy, không xử lý biến.</i>
    </div>

</div>

</body>
</html>