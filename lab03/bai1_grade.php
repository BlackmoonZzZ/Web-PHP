<?php
// Nhận tham số score từ URL (GET) hoặc sử dụng khung gợi ý
$score = isset($_GET["score"]) ? (float)$_GET["score"] : null;

if ($score === null) {
    echo "Hãy truyền ?score=...";
    exit;
}

// Kiểm tra hợp lệ: 0 <= score <= 10
if ($score < 0 || $score > 10) {
    echo "Lỗi: Điểm số không hợp lệ (0 <= score <= 10).";
} else {
    // Phân loại điểm
    if ($score >= 8.5) {
        $rank = "Giỏi";
    } elseif ($score >= 7.0) {
        $rank = "Khá";
    } elseif ($score >= 5.0) {
        $rank = "Trung bình";
    } else {
        $rank = "Yếu";
    }

    // Hiển thị kết quả theo mẫu: "Điểm: X – Xếp loại: ..."
    echo "Điểm: $score – Xếp loại: $rank";
}
?>