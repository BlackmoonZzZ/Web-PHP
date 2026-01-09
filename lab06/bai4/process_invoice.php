<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form_invoice.php');
    exit();
}

// 1. Nhận dữ liệu cơ bản
$hoten     = trim($_POST['hoten'] ?? '');
$sdt       = trim($_POST['sdt'] ?? '');
$email     = trim($_POST['email'] ?? '');
$giamgia   = (int)($_POST['giamgia'] ?? 0);
$vat       = (int)($_POST['vat'] ?? 0);
$hinhthuc  = $_POST['thanhtoan'] ?? 'Tiền mặt';
$ds_input  = $_POST['sanpham'] ?? []; // Mảng sản phẩm thô từ form

// 2. Validate & Tính toán chi tiết
$ds_hop_le = [];
$tong_tien_hang = 0;

foreach ($ds_input as $sp) {
    $ten = trim($sp['ten'] ?? '');
    $sl  = (int)($sp['soluong'] ?? 0);
    $gia = (int)($sp['dongia'] ?? 0);

    // Chỉ xử lý nếu có tên và số liệu hợp lệ
    if (!empty($ten) && $sl > 0 && $gia > 0) {
        $thanh_tien = $sl * $gia;
        $tong_tien_hang += $thanh_tien;
        
        // Thêm vào danh sách hợp lệ
        $ds_hop_le[] = [
            'ten' => $ten,
            'sl'  => $sl,
            'gia' => $gia,
            'tt'  => $thanh_tien
        ];
    }
}

// Kiểm tra: Phải có ít nhất 1 sản phẩm
if (empty($ds_hop_le)) {
    echo "<h3 style='color:red'>Lỗi: Vui lòng nhập ít nhất 1 sản phẩm hợp lệ!</h3>";
    echo "<a href='javascript:history.back()'>Quay lại</a>";
    exit();
}

// 3. Tính toán tổng kết
// Công thức: (Tổng hàng - Giảm giá) + VAT
$tien_giam   = $tong_tien_hang * ($giamgia / 100);
$sau_giam    = $tong_tien_hang - $tien_giam;
$tien_vat    = $sau_giam * ($vat / 100);
$tong_thanh_toan = $sau_giam + $tien_vat;

// 4. Lưu Hóa đơn vào JSON
$invoice_data = [
    'ma_hd'     => time(), // Dùng timestamp làm mã
    'ngay_tao'  => date('Y-m-d H:i:s'),
    'khach_hang'=> ['hoten' => $hoten, 'sdt' => $sdt, 'email' => $email],
    'san_pham'  => $ds_hop_le,
    'chi_tiet'  => [
        'tong_hang' => $tong_tien_hang,
        'giam_gia'  => $giamgia,
        'tien_giam' => $tien_giam,
        'vat_percent'=> $vat,
        'tien_vat'  => $tien_vat,
        'tong_cong' => $tong_thanh_toan
    ]
];

// Tạo folder nếu chưa có
if (!file_exists('../data/invoices')) {
    mkdir('../data/invoices', 0777, true);
}
// Tên file: invoice_<timestamp>.json
$filename = '../data/invoices/invoice_' . $invoice_data['ma_hd'] . '.json';
file_put_contents($filename, json_encode($invoice_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa Đơn #<?php echo $invoice_data['ma_hd']; ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; background: #eee; padding: 20px; }
        .invoice-box {
            background: #fff; max-width: 600px; margin: 0 auto; padding: 30px;
            border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        .header { text-align: center; border-bottom: 2px dashed #333; margin-bottom: 20px; padding-bottom: 10px; }
        .info-group { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { border-bottom: 2px solid #333; text-align: left; padding: 5px 0; }
        td { border-bottom: 1px solid #eee; padding: 8px 0; }
        .text-right { text-align: right; }
        .total-section { margin-top: 20px; border-top: 2px solid #333; padding-top: 10px; }
        .total-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .final-total { font-size: 1.2em; font-weight: bold; }
        .btn-print { display: block; width: 100%; padding: 10px; background: #333; color: #fff; text-align: center; text-decoration: none; margin-top: 20px; }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="header">
        <h2>HÓA ĐƠN BÁN LẺ</h2>
        <p>Mã HĐ: #<?php echo $invoice_data['ma_hd']; ?></p>
        <p>Ngày: <?php echo $invoice_data['ngay_tao']; ?></p>
    </div>

    <div class="info-group">
        <strong>Khách hàng:</strong> <?php echo htmlspecialchars($hoten); ?><br>
        <strong>SĐT:</strong> <?php echo htmlspecialchars($sdt); ?><br>
        <strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mặt hàng</th>
                <th class="text-right">SL</th>
                <th class="text-right">Đơn giá</th>
                <th class="text-right">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ds_hop_le as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['ten']); ?></td>
                <td class="text-right"><?php echo $item['sl']; ?></td>
                <td class="text-right"><?php echo number_format($item['gia']); ?></td>
                <td class="text-right"><?php echo number_format($item['tt']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <span>Tổng tiền hàng:</span>
            <span><?php echo number_format($tong_tien_hang); ?> đ</span>
        </div>
        <div class="total-row">
            <span>Chiết khấu (<?php echo $giamgia; ?>%):</span>
            <span>- <?php echo number_format($tien_giam); ?> đ</span>
        </div>
        <div class="total-row">
            <span>VAT (<?php echo $vat; ?>%):</span>
            <span>+ <?php echo number_format($tien_vat); ?> đ</span>
        </div>
        <div class="total-row final-total">
            <span>TỔNG THANH TOÁN:</span>
            <span><?php echo number_format($tong_thanh_toan); ?> đ</span>
        </div>
        <p><em>Hình thức: <?php echo $hinhthuc; ?></em></p>
    </div>
    
    <a href="form_invoice.php" class="btn-print">Tạo hóa đơn mới</a>
</div>

</body>
</html>