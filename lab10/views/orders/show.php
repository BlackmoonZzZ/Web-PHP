<?php
// Giả sử $order và $items đã được Controller nạp từ Model
?>
<h2>Chi tiết Đơn hàng #<?= (int)$order['id'] ?></h2>
<p><strong>Khách hàng:</strong> <?= htmlspecialchars($order['full_name']) ?></p>
<p><strong>Ngày đặt:</strong> <?= $order['order_date'] ?></p>

<table border="1" cellpadding="10" style="width: 100%">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['product_name']) ?></td>
            <td><?= $item['qty'] ?></td>
            <td><?= number_format($item['price']) ?></td>
            <td><?= number_format($item['qty'] * $item['price']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align: right">Tổng cộng:</th>
            <th><?= number_format($order['total']) ?> VNĐ</th>
        </tr>
    </tfoot>
</table>
<br>
<a href="index.php?c=orders&a=index">Quay lại danh sách</a>