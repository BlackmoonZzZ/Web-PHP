<?php
// 1. KHỞI TẠO GIÁ TRỊ MẶC ĐỊNH
$kw = '';
$category = 'all';
$year_from = '';
$year_to = '';
$results = []; // Mảng chứa kết quả tìm kiếm

// 2. ĐỌC DỮ LIỆU TỪ FILE JSON
$file_path = '../data/books.json';
$books = [];
if (file_exists($file_path)) {
    $books = json_decode(file_get_contents($file_path), true) ?? [];
} else {
    // Nếu chưa có file data, giả lập dữ liệu mẫu để test giao diện
    $books = []; 
}

// 3. XỬ LÝ LỌC (Khi có method GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Lấy dữ liệu từ URL (dùng ?? để tránh lỗi nếu không có tham số)
    $kw = trim($_GET['kw'] ?? '');
    $category = $_GET['category'] ?? 'all';
    $year_from = $_GET['year_from'] ?? '';
    $year_to = $_GET['year_to'] ?? '';

    // Duyệt qua từng cuốn sách để kiểm tra
    foreach ($books as $book) {
        $is_match = true;

        // A. Lọc theo Từ khóa (Tên sách hoặc Tác giả)
        if (!empty($kw)) {
            // Dùng stripos để tìm không phân biệt hoa thường
            $check_ten = stripos($book['tensach'], $kw);
            $check_tacgia = stripos($book['tacgia'], $kw);
            
            if ($check_ten === false && $check_tacgia === false) {
                $is_match = false;
            }
        }

        // B. Lọc theo Thể loại
        if ($category !== 'all' && $book['theloai'] !== $category) {
            $is_match = false;
        }

        // C. Lọc theo Năm (Từ năm)
        if (!empty($year_from) && $book['namxb'] < $year_from) {
            $is_match = false;
        }

        // D. Lọc theo Năm (Đến năm)
        if (!empty($year_to) && $book['namxb'] > $year_to) {
            $is_match = false;
        }

        // Nếu thỏa mãn tất cả điều kiện thì thêm vào kết quả
        if ($is_match) {
            $results[] = $book;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm kiếm Sách</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f8; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        
        /* Style khung tìm kiếm */
        .search-box { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .search-form { display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end; }
        .form-group { flex: 1; min-width: 150px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        
        .btn-search { padding: 10px 20px; background-color: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; height: 38px; }
        .btn-search:hover { background-color: #2980b9; }

        /* Style bảng kết quả */
        .result-box { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border-bottom: 1px solid #eee; padding: 10px; text-align: left; }
        th { background-color: #f8f9fa; color: #333; }
        tr:hover { background-color: #fafafa; }
        .no-result { text-align: center; color: #777; font-style: italic; padding: 20px; }
        .highlight { color: #e74c3c; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2 style="text-align:center; color:#2c3e50">🔍 Tra Cứu Sách</h2>
    
    <div class="search-box">
        <form action="" method="GET" class="search-form">
            <div class="form-group">
                <label>Từ khóa:</label>
                <input type="text" name="kw" value="<?php echo htmlspecialchars($kw); ?>" placeholder="Tên sách, tác giả...">
            </div>

            <div class="form-group">
                <label>Thể loại:</label>
                <select name="category">
                    <option value="all">-- Tất cả --</option>
                    <?php 
                    $categories = ['Giáo trình', 'Kỹ năng', 'Văn học', 'Khoa học', 'Khác'];
                    foreach($categories as $cat) {
                        $selected = ($category === $cat) ? 'selected' : '';
                        echo "<option value='$cat' $selected>$cat</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group" style="flex:0.6">
                <label>Từ năm:</label>
                <input type="number" name="year_from" value="<?php echo htmlspecialchars($year_from); ?>" placeholder="1900">
            </div>

            <div class="form-group" style="flex:0.6">
                <label>Đến năm:</label>
                <input type="number" name="year_to" value="<?php echo htmlspecialchars($year_to); ?>" placeholder="<?php echo date('Y'); ?>">
            </div>

            <button type="submit" class="btn-search">Tìm kiếm</button>
            <a href="search.php" style="margin-left:10px; padding:10px; text-decoration:none; color:#555; background:#eee; border-radius:4px;">Xóa lọc</a>
        </form>
    </div>

    <div class="result-box">
        <h3>Kết quả tìm kiếm: <span class="highlight"><?php echo count($results); ?></span> cuốn sách</h3>
        
        <?php if (!empty($results)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Mã sách</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                        <th>Năm XB</th>
                        <th>Thể loại</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['masach']); ?></td>
                        <td><?php echo htmlspecialchars($book['tensach']); ?></td>
                        <td><?php echo htmlspecialchars($book['tacgia']); ?></td>
                        <td><?php echo htmlspecialchars($book['namxb']); ?></td>
                        <td>
                            <span style="background:#eee; padding:3px 8px; border-radius:10px; font-size:0.9em">
                                <?php echo htmlspecialchars($book['theloai']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($book['soluong']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-result">Không tìm thấy cuốn sách nào phù hợp với điều kiện lọc.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>