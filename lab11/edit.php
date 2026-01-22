<?php
require 'db.php';
session_start();

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit; }

// 1. Lấy dữ liệu hiện tại của nhân viên để đổ vào Form
$stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$employee = $stmt->fetch();

if (!$employee) { die("Không tìm thấy nhân viên!"); }

$errors = [];
$old = $_POST ?: $employee; // Ưu tiên dữ liệu vừa nhập nếu có lỗi, không thì dùng dữ liệu DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $position = trim($_POST['position'] ?? '');
    $salary = $_POST['salary'] ?? 0;

    // 2. Validate Server-side
    if (empty($full_name) || strlen($full_name) < 3) {
        $errors['full_name'] = "Họ tên là bắt buộc và từ 3 ký tự.";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không đúng định dạng.";
    } else {
        // Kiểm tra Unique Email: Tìm email trùng nhưng không phải của ID hiện tại
        $st_email = $pdo->prepare("SELECT id FROM employees WHERE email = ? AND id != ?");
        $st_email->execute([$email, $id]);
        if ($st_email->fetch()) {
            $errors['email'] = "Email này đã được sử dụng bởi nhân viên khác.";
        }
    }

    // 3. Nếu không có lỗi thì cập nhật
    if (empty($errors)) {
        $sql = "UPDATE employees SET full_name = ?, email = ?, position = ?, salary = ? WHERE id = ?";
        $pdo->prepare($sql)->execute([$full_name, $email, $position, $salary, $id]);
        
        $_SESSION['msg'] = "Cập nhật nhân viên thành công!"; // Flash message
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Sửa nhân viên</title></head>
<body>
    <h2>Chỉnh sửa nhân viên: <?= htmlspecialchars($employee['full_name']) ?></h2>
    
    <form method="POST">
        <div>
            Họ tên: <input type="text" name="full_name" value="<?= htmlspecialchars($old['full_name']) ?>">
            <p style="color:red"><?= $errors['full_name'] ?? '' ?></p>
        </div>
        <div>
            Email: <input type="text" name="email" value="<?= htmlspecialchars($old['email']) ?>">
            <p style="color:red"><?= $errors['email'] ?? '' ?></p>
        </div>
        <div>
            Vị trí: <input type="text" name="position" value="<?= htmlspecialchars($old['position']) ?>">
        </div>
        <div>
            Lương: <input type="number" name="salary" value="<?= htmlspecialchars($old['salary']) ?>">
        </div>
        <br>
        <button type="submit">Lưu thay đổi</button>
        <a href="index.php">Quay lại (Back)</a> </form>
</body>
</html>