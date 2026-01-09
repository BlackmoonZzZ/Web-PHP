<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: borrow_form.php');
    exit();
}

$member_id = trim($_POST['member_id'] ?? '');
$book_id   = trim($_POST['book_id'] ?? '');
$borrow_date = $_POST['borrow_date'] ?? date('Y-m-d');
$duration  = (int)($_POST['duration'] ?? 7);

$errors = [];

// 1. KIỂM TRA THÀNH VIÊN (Đọc file CSV)
$member_exists = false;
$members_file = '../data/members.csv';
if (file_exists($members_file)) {
    $handle = fopen($members_file, "r");
    while (($data = fgetcsv($handle)) !== FALSE) {
        // Giả sử cột Email là cột thứ 2 (index 1) như bài 1
        if (isset($data[1]) && $data[1] === $member_id) {
            $member_exists = true;
            break;
        }
    }
    fclose($handle);
}
if (!$member_exists) {
    $errors[] = "Không tìm thấy độc giả có email: $member_id";
}

// 2. KIỂM TRA SÁCH (Đọc file JSON)
$books_file = '../data/books.json';
$books = [];
$book_index = -1; // Vị trí sách trong mảng

if (file_exists($books_file)) {
    $books = json_decode(file_get_contents($books_file), true) ?? [];
}

foreach ($books as $index => $book) {
    if ($book['masach'] === $book_id) {
        $book_index = $index;
        break;
    }
}

if ($book_index === -1) {
    $errors[] = "Mã sách '$book_id' không tồn tại.";
} elseif ($books[$book_index]['soluong'] <= 0) {
    $errors[] = "Sách này đã hết hàng.";
}

// 3. XỬ LÝ KẾT QUẢ
if (empty($errors)) {
    // A. Trừ số lượng sách và lưu lại
    $books[$book_index]['soluong']--;
    file_put_contents($books_file, json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // B. Tạo phiếu mượn và lưu vào borrows.json
    $borrows_file = '../data/borrows.json';
    $borrows = [];
    if (file_exists($borrows_file)) {
        $borrows = json_decode(file_get_contents($borrows_file), true) ?? [];
    }

    // Tính ngày trả = Ngày mượn + thời gian mượn
    $due_date = date('Y-m-d', strtotime($borrow_date . " + $duration days"));

    $new_loan = [
        'ma_phieu'    => uniqid('L'), // Tạo mã phiếu ngẫu nhiên
        'ma_thanhvien'=> $member_id,
        'ma_sach'     => $book_id,
        'ngay_muon'   => $borrow_date,
        'han_tra'     => $due_date,
        'trang_thai'  => 'Đang mượn'
    ];

    $borrows[] = $new_loan;
    file_put_contents($borrows_file, json_encode($borrows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo "<h3 style='color:green'>Mượn sách thành công!</h3>";
    echo "<p>Mã phiếu: <b>{$new_loan['ma_phieu']}</b> (Hãy nhớ mã này để trả sách)</p>";
    echo "<p>Hạn trả: $due_date</p>";
    echo "<a href='borrow_form.php'>Tiếp tục mượn</a> | <a href='return_form.php'>Trả sách</a>";
} else {
    echo "<h3 style='color:red'>Lỗi:</h3>";
    foreach ($errors as $err) echo "<p>- $err</p>";
    echo "<a href='javascript:history.back()'>Quay lại</a>";
}
?>