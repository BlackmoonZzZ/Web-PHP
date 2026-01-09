<?php
// --- GIỮ NGUYÊN PHẦN XỬ LÝ PHP (LOGIC) ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register_member.php");
    exit();
}
$hoten    = trim($_POST['hoten'] ?? '');
$email    = trim($_POST['email'] ?? '');
$sdt      = trim($_POST['sdt'] ?? '');
$ngaysinh = $_POST['ngaysinh'] ?? '';
$gioitinh = $_POST['gioitinh'] ?? 'Nam';
$diachi   = trim($_POST['diachi'] ?? '');

$errors = [];
if (empty($hoten)) $errors[] = "Họ tên không được để trống.";
if (empty($email)) $errors[] = "Email không được để trống.";
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không đúng định dạng.";
if (empty($sdt))   $errors[] = "Số điện thoại không được để trống.";
elseif (!preg_match('/^[0-9]{9,11}$/', $sdt)) $errors[] = "Số điện thoại phải từ 9-11 số.";
if (empty($ngaysinh)) $errors[] = "Ngày sinh không được để trống.";
// --- HẾT PHẦN LOGIC ---
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả Đăng ký</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 700px;
        }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        
        /* Style thông báo lỗi */
        .alert { padding: 15px; border-radius: 6px; margin-bottom: 20px; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        
        ul { margin-left: 20px; }
        
        /* Style bảng hiển thị */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; text-align: left; }
        th { background-color: #f8f9fa; width: 35%; color: #555; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background-color: #fafafa; }

        .btn-back {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn-back:hover { background-color: #2980b9; }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <h3>⚠️ Đã có lỗi xảy ra:</h3>
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?php echo htmlspecialchars($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div style="text-align: center;">
                <a href="javascript:history.back()" class="btn-back" style="background:#e74c3c">Quay lại sửa</a>
            </div>
        <?php else: ?>
            <?php
            // Lưu file
            $file_path = '../data/members.csv';
            if (!file_exists('../data')) mkdir('../data', 0777, true);
            $fp = fopen($file_path, 'a');
            fputcsv($fp, [$hoten, $email, $sdt, $ngaysinh, $gioitinh, $diachi]);
            fclose($fp);
            ?>

            <div class="alert alert-success">
                <h3>✅ Đăng ký thành công!</h3>
                <p>Dữ liệu thành viên đã được lưu trữ.</p>
            </div>

            <h2>Thông tin đăng ký</h2>
            <table>
                <tr><th>Họ và tên</th><td><?php echo htmlspecialchars($hoten); ?></td></tr>
                <tr><th>Email</th><td><?php echo htmlspecialchars($email); ?></td></tr>
                <tr><th>Số điện thoại</th><td><?php echo htmlspecialchars($sdt); ?></td></tr>
                <tr><th>Ngày sinh</th><td><?php echo date("d-m-Y", strtotime($ngaysinh)); ?></td></tr>
                <tr><th>Giới tính</th><td><?php echo htmlspecialchars($gioitinh); ?></td></tr>
                <tr><th>Địa chỉ</th><td><?php echo nl2br(htmlspecialchars($diachi)); ?></td></tr>
            </table>

            <div style="text-align: center;">
                <a href="register_member.php" class="btn-back">Đăng ký thêm</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>