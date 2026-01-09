<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_book.php');
    exit();
}

// 1. Lấy dữ liệu
$masach  = trim($_POST['masach'] ?? '');
$tensach = trim($_POST['tensach'] ?? '');
$tacgia  = trim($_POST['tacgia'] ?? '');
$namxb   = (int)($_POST['namxb'] ?? 0);
$theloai = $_POST['theloai'] ?? 'Khác';
$soluong = (int)($_POST['soluong'] ?? 0);

$errors = [];

// 2. Validate cơ bản
if (empty($masach) || empty($tensach) || empty($tacgia)) {
    $errors[] = "Vui lòng nhập đầy đủ thông tin.";
}
if ($namxb < 1900 || $namxb > date('Y')) {
    $errors[] = "Năm xuất bản phải từ 1900 đến năm hiện tại.";
}
if ($soluong < 0) {
    $errors[] = "Số lượng không được âm.";
}

// 3. Xử lý File JSON
$file_path = '../data/books.json';

// Nếu file chưa có, tạo mảng rỗng
if (!file_exists($file_path)) {
    file_put_contents($file_path, '[]');
}

// Đọc nội dung file và chuyển thành mảng (decode)
$json_content = file_get_contents($file_path);
$books = json_decode($json_content, true) ?? [];

// 4. KIỂM TRA TRÙNG MÃ SÁCH (Quan trọng)
foreach ($books as $book) {
    if ($book['masach'] === $masach) {
        $errors[] = "Mã sách '$masach' đã tồn tại! Vui lòng chọn mã khác.";
        break;
    }
}

// 5. Kết quả
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xử lý thêm sách</title>
    <style>
        body { font-family: sans-serif; padding: 20px; text-align: center; }
        .error { color: red; background: #ffe6e6; padding: 15px; border: 1px solid red; display: inline-block; }
        .success { color: green; background: #e6ffe6; padding: 15px; border: 1px solid green; display: inline-block; }
        a { text-decoration: none; color: blue; font-weight: bold; }
    </style>
</head>
<body>

<?php if (!empty($errors)): ?>
    <div class="error">
        <h3>Lỗi:</h3>
        <?php foreach($errors as $err) echo "<p>$err</p>"; ?>
        <a href="javascript:history.back()">Quay lại sửa</a>
    </div>
<?php else: ?>
    <?php
    // Thêm sách mới vào mảng
    $new_book = [
        'masach'  => $masach,
        'tensach' => $tensach,
        'tacgia'  => $tacgia,
        'namxb'   => $namxb,
        'theloai' => $theloai,
        'soluong' => $soluong
    ];
    
    $books[] = $new_book; // Push vào mảng

    // Ghi lại vào file JSON (JSON_PRETTY_PRINT để file đẹp dễ đọc, UNESCAPED_UNICODE để không lỗi tiếng Việt)
    file_put_contents($file_path, json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    ?>

    <div class="success">
        <h3>Thêm sách thành công!</h3>
        <p>Sách "<?php echo htmlspecialchars($tensach); ?>" đã được lưu.</p>
        <br>
        <a href="add_book.php">Thêm sách khác</a> | 
        <a href="list_books.php">Xem danh sách</a>
    </div>
<?php endif; ?>

</body>
</html>