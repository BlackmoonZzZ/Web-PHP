<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3: Toán tử PHP (Nâng cao) - Nguyễn Anh Minh</title>
    <style>
        /* --- PHẦN CSS: TRANG TRÍ GIAO DIỆN --- */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background-color: white;
            width: 700px;
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
        
        /* Hộp hướng dẫn màu xanh */
        .guide-box {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #bee5eb;
            margin-bottom: 25px;
            font-size: 15px;
        }
        .guide-box code {
            background-color: rgba(255,255,255,0.7);
            padding: 2px 5px;
            border-radius: 4px;
            color: #d63384;
            font-weight: bold;
        }

        /* Hộp kết quả màu xám nhẹ */
        .result-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #28a745; /* Viền xanh lá */
            margin-bottom: 20px;
        }
        .result-line {
            font-size: 18px;
            margin: 10px 0;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 5px;
        }
        
        /* Hộp so sánh màu vàng */
        .compare-section {
            background-color: #fff3cd;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #ffc107; /* Viền vàng */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>BÀI TẬP 3: TOÁN TỬ & NỐI CHUỖI</h1>

    <div class="guide-box">
        <h4>📚 Hướng dẫn đổi số tính toán:</h4>
        <p>Mặc định hệ thống tính: <b>a = 10</b> và <b>b = 3</b>.</p>
        <p>Để tính số khác, hãy thêm đoạn mã sau vào cuối đường dẫn trên trình duyệt:</p>
        <p><code>?a=SO_THU_NHAT&b=SO_THU_HAI</code></p>
        <p><i>Ví dụ muốn tính 100 và 20: .../calc_basic.php<code>?a=100&b=20</code></i></p>
    </div>

    <?php
    // =============================================
    // PHẦN XỬ LÝ PHP (LOGIC TÍNH TOÁN)
    // =============================================

    // 1. Kiểm tra xem người dùng có nhập a và b trên URL không (Dùng $_GET)
    if (isset($_GET['a']) && isset($_GET['b'])) {
        // Nếu có nhập -> Lấy giá trị đó
        $a = $_GET['a'];
        $b = $_GET['b'];
    } else {
        // Nếu không nhập -> Dùng giá trị mặc định theo đề bài
        $a = 10;
        $b = 3;
    }

    // 2. Thực hiện các phép tính toán học
    $tong = $a + $b;
    $hieu = $a - $b;
    $tich = $a * $b;

    // Xử lý phép chia (Tránh lỗi chia cho 0)
    if ($b != 0) {
        $thuong = $a / $b;
        $du = $a % $b; // % là chia lấy phần dư
        
        // Làm tròn thương số (2 chữ số thập phân) cho đẹp
        $thuong_dep = number_format($thuong, 2); 
    } else {
        $thuong_dep = "Không thể chia cho 0";
        $du = "N/A";
    }

    // 3. Thực hiện nối chuỗi (Dùng dấu chấm .)
    $tieuDe = "Kết quả tính toán với";
    $tieuDe .= " a = $a và b = $b"; // Nối thêm nội dung vào biến cũ
    ?>

    <div class="result-section">
        <h3><?php echo $tieuDe; ?>:</h3>
        
        <div class="result-line">➕ Tổng ($a + $b) = <b><?php echo $tong; ?></b></div>
        <div class="result-line">➖ Hiệu ($a - $b) = <b><?php echo $hieu; ?></b></div>
        <div class="result-line">✖️ Tích ($a * $b) = <b><?php echo $tich; ?></b></div>
        <div class="result-line">➗ Thương ($a / $b) = <b><?php echo $thuong_dep; ?></b></div>
        <div class="result-line">🔢 Số dư ($a % $b) = <b><?php echo $du; ?></b></div>
    </div>

    <div class="compare-section">
        <h3>So sánh chuỗi "5" và số 5:</h3>
        <?php
        $str = "5"; // Chuỗi
        $num = 5;   // Số

        // So sánh lỏng (==) -> Chỉ so giá trị
        $kq1 = ($str == $num) ? "Đúng (True)" : "Sai (False)";

        // So sánh chặt (===) -> So cả giá trị VÀ kiểu dữ liệu
        $kq2 = ($str === $num) ? "Đúng (True)" : "Sai (False)";
        ?>

        <p>
            1. So sánh bằng (<code>==</code>): <b><?php echo $kq1; ?></b><br>
            <i>(Giải thích: PHP tự chuyển chuỗi "5" thành số 5 để so sánh)</i>
        </p>
        <hr>
        <p>
            2. So sánh đồng nhất (<code>===</code>): <b style="color:red"><?php echo $kq2; ?></b><br>
            <i>(Giải thích: Vì một bên là String, một bên là Integer nên khác nhau)</i>
        </p>
    </div>

</div>

</body>
</html>