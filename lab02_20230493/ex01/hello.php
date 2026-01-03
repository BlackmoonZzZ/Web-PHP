<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sinh viên</title>
    <style>
        /* CSS để trang trí */
        body {
            background-color: #f0f2f5; /* Màu nền xám nhẹ */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center; /* Căn giữa chiều ngang */
            align_items: center; /* Căn giữa chiều dọc */
            height: 100vh; /* Chiều cao full màn hình */
            margin: 0;
        }

        .card {
            background-color: white;
            padding: 40px;
            border-radius: 15px; /* Bo tròn góc */
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); /* Đổ bóng nhẹ */
            text-align: center; /* Căn giữa nội dung text */
            width: 400px;
            border-top: 5px solid #007bff; /* Viền xanh trên cùng */
        }

        h1 {
            color: #007bff;
            margin-bottom: 10px;
            font-size: 28px;
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        ul {
            list-style: none; /* Bỏ dấu chấm đầu dòng */
            padding: 0;
            margin-bottom: 30px;
        }

        ul li {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            color: #555;
            font-weight: 500;
        }

        .time-box {
            font-size: 14px;
            color: #888;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="card">
        <?php
        // Thiết lập múi giờ
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Thông tin sinh viên
        $ten = "Nguyễn Anh Minh";
        $mssv = "20230493";
        $lop = "DCCNTT14.1";
        ?>

        <h1>Hello PHP!</h1>
        <h3>THẺ SINH VIÊN</h3>
        
        <ul>
            <li>Họ tên: <?php echo $ten; ?></li>
            <li>MSSV: <?php echo $mssv; ?></li>
            <li>Lớp: <?php echo $lop; ?></li>
        </ul>

        <div class="time-box">
            Truy cập lúc: <?php echo date("H:i:s - d/m/Y"); ?>
        </div>
    </div>

</body>
</html>