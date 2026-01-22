<?php include '../views/layout/header.php'; ?>

<h2>Tạo Đơn Hàng Mới</h2>
<form action="index.php?c=orders&a=store" method="POST">
    <div class="mb-3">
        <label class="form-label">Khách hàng:</label>
        <select name="customer_id" class="form-select" required>
            <?php foreach ($customers as $c): ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['full_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <h4>Sản phẩm</h4>
    <table class="table border">
        <thead class="table-light">
            <tr>
                <th>Tên sản phẩm</th>
                <th style="width: 150px;">Số lượng</th>
                <th style="width: 200px;">Giá bán</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="items[0][product_id]" class="form-select" required>
                        <?php foreach ($products as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?> (Kho: <?= $p['stock'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="number" name="items[0][qty]" class="form-control" min="1" value="1" required></td>
                <td><input type="number" name="items[0][price]" class="form-control" placeholder="Giá..." required></td>
            </tr>
        </tbody>
    </table>

    <button type="submit" class="btn btn-success">Lưu Đơn Hàng</button>
    <a href="index.php?c=orders&a=index" class="btn btn-secondary">Hủy</a>
</form>

<?php include '../views/layout/footer.php'; ?>