<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính chỉ số BMI - Nguyễn Anh Minh</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            padding-top: 40px;
        }
        .container {
            background-color: white;
            width: 500px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box; /* Để padding không làm vỡ khung */
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #218838;
        }
        
        /* Phần hiển thị kết quả */
        .result-box {
            margin-top: 25px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f8f9fa;
            border-left: 5px solid #17a2b8;
        }
        .bmi-value {
            font-size: 24px;
            color: #d63384;
            font-weight: bold;
        }
        .error {
            color: #dc3545;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>CÔNG CỤ TÍNH BMI</h1>

    <form action="" method="GET">
        <div class="form-group">
            <label>Họ và tên:</label>
            <input type="text" name="name" placeholder="Nhập tên của bạn..." required>
        </div>

        <div class="form-group">
            <label>Chiều cao (m):</label>
            <input type="number" step="0.01" name="height" placeholder="Ví dụ: 1.75" required>
        </div>

        <div class="form-group">
            <label>Cân nặng (kg):</label>
            <input type="number" step="0.1" name="weight" placeholder="Ví dụ: 65" required>
        </div>

        <button type="submit" name="submit">TÍNH TOÁN NGAY</button>
    </form>

    <?php
    // --- XỬ LÝ PHP ---
    
    // Kiểm tra xem người dùng đã ấn nút Submit chưa
    // (Đây là phần BONUS: Nếu chưa ấn thì không chạy code bên dưới -> không lỗi)
    if (isset($_GET['submit'])) {
        
        // 1. Nhận dữ liệu
        $name = $_GET['name'] ?? ''; // Dấu ?? là toán tử kiểm tra null (PHP 7+)
        $height = $_GET['height'] ?? 0;
        $weight = $_GET['weight'] ?? 0;

        // 2. Validate (Kiểm tra dữ liệu hợp lệ: phải là số và > 0)
        if (is_numeric($height) && is_numeric($weight) && $height > 0 && $weight > 0) {
            
            // 3. Tính BMI
            // Công thức: Cân nặng / (Chiều cao * Chiều cao)
            $bmi = $weight / ($height * $height);
            $bmi = round($bmi, 2); // Làm tròn 2 chữ số thập phân

            // 4. Phân loại
            $phanLoai = "";
            $mauSac = ""; // Thêm màu cho sinh động

            if ($bmi < 18.5) {
                $phanLoai = "Gầy (Underweight)";
                $mauSac = "#ffc107"; // Vàng
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                $phanLoai = "Bình thường (Normal)";
                $mauSac = "#28a745"; // Xanh lá
            } elseif ($bmi >= 25 && $bmi <= 29.9) {
                $phanLoai = "Thừa cân (Overweight)";
                $mauSac = "#fd7e14"; // Cam
            } else {
                $phanLoai = "Béo phì (Obese)";
                $mauSac = "#dc3545"; // Đỏ
            }

            // 5. In kết quả
            echo "<div class='result-box'>";
            echo "<h3>Kết quả của: $name</h3>";
            echo "<p>Chiều cao: $height m | Cân nặng: $weight kg</p>";
            echo "<hr>";
            echo "<p>Chỉ số BMI: <span class='bmi-value'>$bmi</span></p>";
            echo "<p>Phân loại: <b style='color:$mauSac'>$phanLoai</b></p>";
            echo "</div>";

        } else {
            // Báo lỗi nếu nhập sai (số âm hoặc bằng 0)
            echo "<div class='error'>⚠️ Dữ liệu không hợp lệ! Chiều cao và cân nặng phải lớn hơn 0.</div>";
        }
    }
    ?>

</div>

</body>
</html>