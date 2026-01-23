<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sửa nhân viên</title>
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-header bg-warning">
            <h5 class="mb-0">CẬP NHẬT NHÂN VIÊN</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Họ tên</label>
                    <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($emp['full_name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($emp['phone']) ?>">
                </div>
                <div class="mb-3">
                    <label>Vị trí</label>
                    <input type="text" name="position" class="form-control" value="<?= htmlspecialchars($emp['position']) ?>">
                </div>
                <div class="mb-3">
                    <label>Lương</label>
                    <input type="number" name="salary" class="form-control" value="<?= $emp['salary'] ?>">
                </div>
                <button type="submit" class="btn btn-primary w-100">Lưu thay đổi</button>
                <a href="index.php?c=employee&a=index" class="btn btn-link w-100 mt-2">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>