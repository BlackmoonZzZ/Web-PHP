<?php
// --- BƯỚC 1: NHẬN DỮ LIỆU INPUT ---
// Kiểm tra xem biến 'names' có tồn tại trên URL không
$raw_input = isset($_GET['names']) ? $_GET['names'] : '';

// --- BƯỚC 2: XỬ LÝ DỮ LIỆU ---
// Mảng chứa tên hợp lệ
$valid_names = [];

// Chỉ xử lý nếu chuỗi gốc không rỗng
if ($raw_input !== '') {
    // a. Tách chuỗi bằng dấu phẩy -> tạo thành mảng
    $parts = explode(',', $raw_input);

    // b. Trim từng phần tử (cắt bỏ khoảng trắng thừa đầu/đuôi)
    // Dùng array_map để áp dụng hàm 'trim' cho tất cả phần tử trong mảng $parts
    $trimmed_parts = array_map('trim', $parts);

    // c. Loại phần tử rỗng
    // Dùng array_filter để loại bỏ các phần tử có giá trị rỗng hoặc false
    // Hàm callback function($val) { return $val !== ''; } đảm bảo chỉ giữ lại chuỗi khác rỗng
    $valid_names = array_filter($trimmed_parts, function($value) {
        return $value !== '';
    });
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 1: Xử lý chuỗi tên</title>
</head>
<body>

    <h3>Kết quả xử lý:</h3>

    <p><strong>Chuỗi gốc:</strong> "<?php echo htmlspecialchars($raw_input); ?>"</p>

    <?php if (empty($valid_names)): ?>
        <p style="color: red;">Chưa có dữ liệu hợp lệ</p>
    <?php else: ?>
        <p><strong>Số lượng tên hợp lệ:</strong> <?php echo count($valid_names); ?></p>

        <ol>
            <?php foreach ($valid_names as $name): ?>
                <li>
                    <?php echo htmlspecialchars($name); ?>
                </li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>

</body>
</html>