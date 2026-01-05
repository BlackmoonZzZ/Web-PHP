<?php
// --- BƯỚC 1: KHAI BÁO MẢNG ---
// Khai báo mảng điểm số theo đề bài
$scores = [8.5, 7.0, 9.25, 6.5, 8.0, 5.75];

// --- BƯỚC 2: TÍNH ĐIỂM TRUNG BÌNH ---
// Tính tổng các phần tử trong mảng
$sum = array_sum($scores);
// Đếm số lượng phần tử
$count = count($scores);
// Tính trung bình
$average = $sum / $count;

// --- BƯỚC 3: XỬ LÝ ĐIỂM GIỎI (>= 8.0) ---
// Dùng array_filter để lọc ra các điểm >= 8.0
$good_scores = array_filter($scores, function($score) {
    return $score >= 8.0;
});

// --- BƯỚC 4: TÌM MAX, MIN ---
$max_score = max($scores);
$min_score = min($scores);

// --- BƯỚC 5: SẮP XẾP (KHÔNG MẤT MẢNG GỐC) ---
// PHP sắp xếp sẽ làm thay đổi mảng gốc (tham chiếu).
// Vì vậy, cần copy mảng gốc sang mảng mới trước khi sắp xếp.

// a. Sắp xếp tăng dần
$scores_asc = $scores; // Copy mảng
sort($scores_asc);     // Sắp xếp tăng dần

// b. Sắp xếp giảm dần
$scores_desc = $scores; // Copy mảng
rsort($scores_desc);    // Sắp xếp giảm dần
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 2: Thống kê điểm số</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .section { margin-bottom: 20px; border-bottom: 1px dashed #ccc; padding-bottom: 10px; }
        strong { color: #2c3e50; }
    </style>
</head>
<body>

    <h2>Báo cáo thống kê điểm số</h2>

    <div class="section">
        <p><strong>1. Mảng điểm gốc:</strong> [ <?php echo implode(', ', $scores); ?> ]</p>
    </div>

    <div class="section">
        <p><strong>2. Điểm trung bình:</strong> <?php echo number_format($average, 2); ?></p>
    </div>

    <div class="section">
        <p><strong>3. Thống kê điểm Giỏi (>= 8.0):</strong></p>
        <ul>
            <li>Số lượng: <?php echo count($good_scores); ?> bạn</li>
            <li>Danh sách: <?php echo implode(', ', $good_scores); ?></li>
        </ul>
    </div>

    <div class="section">
        <p><strong>4. Điểm cao nhất / Thấp nhất:</strong></p>
        <ul>
            <li>Cao nhất (Max): <?php echo $max_score; ?></li>
            <li>Thấp nhất (Min): <?php echo $min_score; ?></li>
        </ul>
    </div>

    <div class="section">
        <p><strong>5. Sắp xếp dữ liệu:</strong></p>
        <ul>
            <li>Tăng dần: [ <?php echo implode(', ', $scores_asc); ?> ]</li>
            <li>Giảm dần: [ <?php echo implode(', ', $scores_desc); ?> ]</li>
        </ul>
        <p><em>(Kiểm tra lại mảng gốc vẫn giữ nguyên: [ <?php echo implode(', ', $scores); ?> ])</em></p>
    </div>

</body>
</html>