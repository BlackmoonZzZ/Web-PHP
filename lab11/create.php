<?php
require 'db.php';
session_start();
layout_header("Thêm Nhân viên Mới");

$errors = []; // Mảng chứa các thông báo lỗi
$old = $_POST; // Biến lưu lại dữ liệu người dùng đã nhập để hiển thị lại khi có lỗi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Thu thập dữ liệu từ Form
    $full_name = trim($_POST['full_name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $position  = trim($_POST['position'] ?? '');
    $salary    = $_POST['salary'] !== '' ? (int)$_POST['salary'] : null;

    // 2. Validate Server-side
    // Kiểm tra Họ tên: bắt buộc, từ 3-120 ký tự
    if (empty($full_name)) {
        $errors['full_name'] = "Họ tên không được để trống.";
    } elseif (mb_strlen($full_name) < 3 || mb_strlen($full_name) > 120) {
        $errors['full_name'] = "Họ tên phải từ 3 đến 120 ký tự.";
    }

    // Kiểm tra Email: đúng định dạng và duy nhất (unique)
    if (empty($email)) {
        $errors['email'] = "Email là bắt buộc.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Định dạng email không hợp lệ.";
    } else {
        // Kiểm tra email đã tồn tại trong DB chưa
        $stmt = $pdo->prepare("SELECT id FROM employees WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors['email'] = "Email này đã được sử dụng.";
        }
    }

    // Kiểm tra Vị trí: bắt buộc
    if (empty($position)) {
        $errors['position'] = "Vị trí công việc không được để trống.";
    }

    // Kiểm tra Lương: nếu nhập thì phải >= 0
    if ($salary !== null && $salary < 0) {
        $errors['salary'] = "Lương không được là số âm.";
    }

    // 3. Nếu không có lỗi thì tiến hành Lưu vào Database
    if (empty($errors)) {
        $sql = "INSERT INTO employees (full_name, email, phone, position, salary) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$full_name, $email, $phone, $position, $salary]);

        $_SESSION['msg'] = "Thêm nhân viên mới thành công!"; // Flash message
        header("Location: index.php");
        exit;
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8 shadow p-4 rounded bg-white">
        <h2 class="mb-4 text-center text-primary">Thêm Nhân viên</h2>
        
        <form action="create.php" method="POST" novalidate>
            <div class="mb-3">
                <label class="form-label fw-bold">Họ tên <span class="text-danger">*</span></label>
                <input type="text" name="full_name" class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>" 
                       value="<?= htmlspecialchars($old['full_name'] ?? '') ?>"> <div class="invalid-feedback"><?= $errors['full_name'] ?? '' ?></div> </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                       value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Vị trí <span class="text-danger">*</span></label>
                    <input type="text" name="position" class="form-control <?= isset($errors['position']) ? 'is-invalid' : '' ?>" 
                           value="<?= htmlspecialchars($old['position'] ?? '') ?>">
                    <div class="invalid-feedback"><?= $errors['position'] ?? '' ?></div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Lương (VNĐ)</label>
                <input type="number" name="salary" class="form-control <?= isset($errors['salary']) ? 'is-invalid' : '' ?>" 
                       value="<?= htmlspecialchars($old['salary'] ?? '') ?>">
                <div class="invalid-feedback"><?= $errors['salary'] ?? '' ?></div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Lưu (Save)</button>
                <a href="index.php" class="btn btn-outline-secondary px-4">Quay lại (Back)</a> </div>
        </form>
    </div>
</div>

<?php layout_footer(); ?>