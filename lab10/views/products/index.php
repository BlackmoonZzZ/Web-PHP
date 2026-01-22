<?php include '../views/layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Sản phẩm</h2>
    <a href="index.php?c=products&a=create" class="btn btn-primary">+ Thêm mới</a>
</div>

<form method="GET" class="row g-3 mb-4">
    <input type="hidden" name="c" value="products">
    <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="Tìm theo tên hoặc SKU..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    </div>
    <div class="col-md-4">
        <select name="sort" class="form-select">
            <option value="name" <?= ($_GET['sort'] ?? '') == 'name' ? 'selected' : '' ?>>Sắp xếp: Tên</option>
            <option value="price" <?= ($_GET['sort'] ?? '') == 'price' ? 'selected' : '' ?>>Sắp xếp: Giá</option>
            <option value="stock" <?= ($_GET['sort'] ?? '') == 'stock' ? 'selected' : '' ?>>Sắp xếp: Tồn kho</option>
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-secondary w-100">Lọc</button>
    </div>
</form>

<table class="table table-hover table-bordered">
    <thead class="table-light">
        <tr>
            <th>SKU</th>
            <th>Tên sản phẩm</th>
            <th>Giá bán</th>
            <th>Tồn kho</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p): ?>
        <tr>
            <td><code><?= htmlspecialchars($p['sku']) ?></code></td>
            <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
            <td class="text-danger"><?= number_format($p['price']) ?> đ</td>
            <td>
                <span class="badge <?= $p['stock'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                    <?= $p['stock'] ?>
                </span>
            </td>
            <td>
                <a href="index.php?c=products&a=edit&id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../views/layout/footer.php'; ?>