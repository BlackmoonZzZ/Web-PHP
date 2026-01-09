<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: return_form.php');
    exit();
}

$ma_phieu = trim($_POST['ma_phieu'] ?? '');
$errors = [];

// 1. Load dữ liệu
$borrows_file = '../data/borrows.json';
$books_file   = '../data/books.json';

$borrows = file_exists($borrows_file) ? json_decode(file_get_contents($borrows_file), true) : [];
$books   = file_exists($books_file) ? json_decode(file_get_contents($books_file), true) : [];

$loan_index = -1;

// 2. Tìm phiếu mượn
foreach ($borrows as $index => $loan) {
    if ($loan['ma_phieu'] === $ma_phieu) {
        $loan_index = $index;
        break;
    }
}

if ($loan_index === -1) {
    $errors[] = "Không tìm thấy mã phiếu mượn: $ma_phieu";
} elseif ($borrows[$loan_index]['trang_thai'] !== 'Đang mượn') {
    $errors[] = "Phiếu này đã được trả hoặc không hợp lệ.";
}

// 3. Xử lý trả sách
if (empty($errors)) {
    // A. Cập nhật trạng thái phiếu
    $borrows[$loan_index]['trang_thai'] = 'Đã trả';
    $book_id_to_return = $borrows[$loan_index]['ma_sach'];
    
    // B. Tăng số lượng sách trong kho
    $book_found = false;
    foreach ($books as &$book) { // Dùng tham chiếu & để sửa trực tiếp
        if ($book['masach'] === $book_id_to_return) {
            $book['soluong']++;
            $book_found = true;
            break;
        }
    }
    
    // Lưu lại cả 2 file
    file_put_contents($borrows_file, json_encode($borrows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    file_put_contents($books_file, json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<h3 style='color:green'>Trả sách thành công!</h3>";
    echo "<p>Đã cập nhật trạng thái phiếu <b>$ma_phieu</b> thành 'Đã trả'.</p>";
    echo "<p>Số lượng sách trong kho đã được +1.</p>";
    echo "<a href='return_form.php'>Trả tiếp</a>";

} else {
    echo "<h3 style='color:red'>Lỗi:</h3>";
    foreach ($errors as $err) echo "<p>- $err</p>";
    echo "<a href='javascript:history.back()'>Quay lại</a>";
}
?>