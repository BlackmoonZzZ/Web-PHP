<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm nhân viên mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">THÊM NHÂN VIÊN MỚI</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?c=employee&a=create">
                <div class="mb-3">
                    <label class="form-label">Họ tên nhân viên</label>
                    <input type="text" name="full_name" class="form-control" placeholder="Nhập họ tên...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" placeholder="090...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Vị trí công việc</label>
                    <input type="text" name="position" class="form-control" placeholder="Ví dụ: Bán hàng, Quản lý...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mức lương</label>
                    <input type="number" name="salary" class="form-control" value="0">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success w-100">Lưu lại</button>
                    <a href="index.php?c=employee&a=index" class="btn btn-secondary w-100">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>