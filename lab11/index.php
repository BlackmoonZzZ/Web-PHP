<?php
require 'db.php';
session_start();
layout_header("Danh sách Nhân viên");

$keyword = trim($_GET['keyword'] ?? '');

if ($keyword !== '') {
    // Câu lệnh SQL có 2 vị trí :kw nên mảng execute phải map chính xác
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE full_name LIKE :kw OR email LIKE :kw ORDER BY id DESC");
    $stmt->execute(['kw' => "%$keyword%"]); 
} else {
    $stmt = $pdo->query("SELECT * FROM employees ORDER BY id DESC");
}
$employees = $stmt->fetchAll();
?>

<div class="d-flex justify-content-between mb-3">
    <h3>Quản lý Nhân viên</h3>
    <a href="create.php" class="btn btn-success">Thêm mới</a>
</div>

<?php if(isset($_SESSION['msg'])): ?>
    <div class="alert alert-info"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
<?php endif; ?>

<form class="d-flex mb-3">
    <input type="text" name="keyword" class="form-control me-2" placeholder="Tìm tên hoặc email..." value="<?= htmlspecialchars($keyword) ?>">
    <button type="submit" class="btn btn-primary">Tìm</button>
</form>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Họ tên</th><th>Email</th><th>Vị trí</th><th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $e): ?>
        <tr>
            <td><?= htmlspecialchars($e['full_name']) ?></td> <td><?= htmlspecialchars($e['email']) ?></td>
            <td><?= htmlspecialchars($e['position']) ?></td>
            <td>
                <a href="edit.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                <a href="delete.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php layout_footer(); ?>