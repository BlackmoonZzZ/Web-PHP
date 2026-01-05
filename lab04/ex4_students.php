<?php
// --- BƯỚC 1: IMPORT CLASS ---
// Lệnh này bắt buộc để dùng được class Student bên file kia
require_once "Student.php"; 

// --- BƯỚC 2: TẠO DỮ LIỆU (Mảng đối tượng) ---
$students = [
    new Student("SV001", "Nguyễn Văn An", 3.5),  // Giỏi
    new Student("SV002", "Trần Thị Bích", 2.8),  // Khá
    new Student("SV003", "Lê Văn Cường", 2.0),   // TB
    new Student("SV004", "Phạm Thị Dung", 3.9),  // Giỏi
    new Student("SV005", "Hoàng Văn Em", 2.6),   // Khá
];

// --- BƯỚC 3: XỬ LÝ THỐNG KÊ ---

// a. Tính điểm trung bình lớp
// Dùng array_map để lấy ra một mảng chỉ chứa điểm GPA
$gpa_list = array_map(function($s) {
    return $s->getGpa();
}, $students);

$avg_gpa = array_sum($gpa_list) / count($gpa_list);

// b. Thống kê số lượng theo xếp loại
$stats = [
    'Giỏi' => 0,
    'Khá' => 0,
    'Trung bình' => 0
];

foreach ($students as $s) {
    $rank = $s->rank();
    // Tăng biến đếm tương ứng
    if (isset($stats[$rank])) {
        $stats[$rank]++;
    }
}

// Hàm hỗ trợ render màu sắc cho Rank (Làm đẹp thêm)
function getRankColor($rank) {
    if ($rank == 'Giỏi') return '#27ae60'; // Xanh lá
    if ($rank == 'Khá') return '#2980b9';  // Xanh dương
    return '#e67e22';                      // Cam
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 4: Quản lý sinh viên (OOP)</title>
    <style>
        /* --- CSS GIAO DIỆN ĐẸP (Giống bài trước) --- */
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #2c3e50; border-bottom: 2px solid #8e44ad; padding-bottom: 10px; display: inline-block; }
        .header-wrap { text-align: center; margin-bottom: 20px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; overflow: hidden; border-radius: 8px 8px 0 0; }
        table thead tr { background-color: #8e44ad; color: white; } /* Màu tím cho khác biệt chút */
        table th, table td { padding: 12px 15px; border-bottom: 1px solid #ddd; text-align: left; }
        table tbody tr:nth-child(even) { background-color: #f3f3f3; }
        table tbody tr:hover { background-color: #f1f8e9; }
        
        .badge { padding: 5px 10px; border-radius: 15px; color: white; font-weight: bold; font-size: 0.9em; display: inline-block; min-width: 80px; text-align: center; }
        
        .stats-box { margin-top: 30px; display: flex; gap: 20px; justify-content: space-around; }
        .card { background: #f9f9f9; padding: 15px; border-radius: 8px; flex: 1; text-align: center; border: 1px solid #eee; }
        .card h4 { margin: 0 0 10px 0; color: #555; }
        .big-number { font-size: 24px; font-weight: bold; color: #2c3e50; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header-wrap">
            <h2>🎓 Danh sách sinh viên</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã SV (ID)</th>
                    <th>Họ và tên</th>
                    <th>GPA</th>
                    <th>Xếp loại</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $stt = 1;
                foreach ($students as $s): 
                    $r = $s->rank();
                ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td><b><?php echo $s->getId(); ?></b></td>
                    <td><?php echo $s->getName(); ?></td>
                    <td><?php echo $s->getGpa(); ?></td>
                    <td>
                        <span class="badge" style="background-color: <?php echo getRankColor($r); ?>">
                            <?php echo $r; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="stats-box">
            <div class="card">
                <h4>Điểm TB Lớp</h4>
                <div class="big-number" style="color: #8e44ad;">
                    <?php echo number_format($avg_gpa, 2); ?>
                </div>
            </div>
            <div class="card">
                <h4>Giỏi</h4>
                <div class="big-number" style="color: #27ae60;">
                    <?php echo $stats['Giỏi']; ?> <small>sv</small>
                </div>
            </div>
            <div class="card">
                <h4>Khá</h4>
                <div class="big-number" style="color: #2980b9;">
                    <?php echo $stats['Khá']; ?> <small>sv</small>
                </div>
            </div>
            <div class="card">
                <h4>Trung bình</h4>
                <div class="big-number" style="color: #e67e22;">
                    <?php echo $stats['Trung bình']; ?> <small>sv</small>
                </div>
            </div>
        </div>

    </div>

</body>
</html>