<h1>Quản lý Đơn hàng</h1>
<a href="index.php?c=orders&a=create"> + Tạo đơn hàng mới</a>

<table border="1" cellpadding="10" style="margin-top: 20px; width: 100%">
    <thead>
        <tr>
            <th>Mã ĐH</th>
            <th>Khách hàng</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $o): ?>
        <tr>
            <td>#<?= $o['id'] ?></td>
            <td><?= htmlspecialchars($o['full_name']) ?></td>
            <td><?= $o['order_date'] ?></td>
            <td><?= number_format($o['total'], 0, ',', '.') ?> VNĐ</td>
            <td>
                <a href="index.php?c=orders&a=show&id=<?= $o['id'] ?>">Chi tiết</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>