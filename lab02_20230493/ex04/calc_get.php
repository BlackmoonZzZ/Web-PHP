<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4: Máy tính GET - Nguyễn Anh Minh</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }
        .container {
            background-color: white;
            width: 600px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 15px;
        }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 5px solid;
        }
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-color: #17a2b8;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #28a745;
            font-size: 24px;
            text-align: center;
            font-weight: bold;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #dc3545;
        }
        code {
            background-color: rgba(255,255,255,0.5);
            padding: 2px 5px;
            border-radius: 4px;
            font-weight: bold;
            color: #d63384;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>MÁY TÍNH CÁ NHÂN (GET)</h1>

    <?php
    // 1. Kiểm tra xem người dùng có truyền đủ 3 tham số a, b, op không
    if (isset($_GET['a']) && isset($_GET['b']) && isset($_GET['op'])) {
        
        // 2. Lấy dữ liệu và ép kiểu sang số (int hoặc float)
        $a = $_GET['a'] + 0; // Mẹo ép kiểu nhanh: cộng với 0 sẽ ra số
        $b = $_GET['b'] + 0;
        $op = $_GET['op'];
        
        $ketqua = "";
        $phepTinh = "";
        $coLoi = false; // Biến cờ đánh dấu lỗi

        // 3. Xử lý phép tính dựa vào tham số op
        switch ($op) {
            case 'add':
                $ketqua = $a + $b;
                $phepTinh = "+";
                break;
            case 'sub':
                $ketqua = $a - $b;
                $phepTinh = "-";
                break;
            case 'mul':
                $ketqua = $a * $b;
                $phepTinh = "×";
                break;
            case 'div':
                if ($b == 0) {
                    $ketqua = "Lỗi: Không thể chia cho 0";
                    $coLoi = true;
                } else {
                    $ketqua = $a / $b;
                    $phepTinh = "÷";
                }
                break;
            default:
                $ketqua = "Lỗi: Phép tính '$op' không hợp lệ (chỉ dùng: add, sub, mul, div)";
                $coLoi = true;
        }

        // 4. In kết quả
        if ($coLoi) {
            echo "<div class='alert alert-danger'>$ketqua</div>";
        } else {
            echo "<div class='alert alert-success'>";
            echo "$a $phepTinh $b = $ketqua";
            echo "</div>";
        }

    } else {
        // Nếu thiếu tham số -> Hiển thị hướng dẫn
        echo "<div class='alert alert-info'>";
        echo "<h4>⚠️ Thiếu tham số trên URL!</h4>";
        echo "<p>Vui lòng nhập đủ <b>a</b>, <b>b</b> và <b>op</b> (phép tính).</p>";
        echo "<hr>";
        echo "<p>📋 <b>Các phép tính hỗ trợ:</b></p>";
        echo "<ul>";
        echo "<li>Cộng: <code>op=add</code></li>";
        echo "<li>Trừ: <code>op=sub</code></li>";
        echo "<li>Nhân: <code>op=mul</code></li>";
        echo "<li>Chia: <code>op=div</code></li>";
        echo "</ul>";
        echo "<p>👉 <b>Ví dụ mẫu:</b> <a href='?a=10&b=5&op=add'>?a=10&b=5&op=add</a></p>";
        echo "</div>";
    }
    ?>

</div>

</body>
</html>