<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Nhân viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">DANH SÁCH NHÂN VIÊN</h5>
            <a href="index.php?c=employee&a=create" class="btn btn-light btn-sm">+ Thêm mới</a>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-2 mb-4">
                <input type="hidden" name="c" value="employee">
                <div class="col-auto">
                    <input type="text" name="q" class="form-control" placeholder="Tìm tên hoặc SĐT..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                </div>
            </form>

            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Họ tên</th><th>Số điện thoại</th><th>Vị trí</th><th>Lương</th><th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($employees)): ?>
                        <tr><td colspan="5" class="text-center text-muted">Không tìm thấy nhân viên nào</td></tr>
                    <?php else: foreach ($employees as $emp): ?>
                    <tr>
                        <td><?= htmlspecialchars($emp['full_name']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($emp['phone']) ?></td>
                        <td><?= htmlspecialchars($emp['position']) ?></td>
                        <td class="text-end text-danger fw-bold"><?= number_format($emp['salary'], 0, ',', '.') ?> VNĐ</td>
                        <td class="text-center">
                            <a href="index.php?c=employee&a=edit&id=<?= $emp['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="index.php?c=employee&a=delete&id=<?= $emp['id'] ?>" 
                               class="btn btn-danger btn-sm" onclick="return confirm('Xác nhận xóa?')">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>