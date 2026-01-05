<?php
// --- BƯỚC 1: IMPORT CLASS ---
require_once "Student.php";

// Khởi tạo các biến mặc định để form không bị lỗi undefined variable
$raw_data = "";
$threshold = "";
$is_sort = false;
$students = [];     // Danh sách kết quả
$errors = [];       // Mảng chứa lỗi
$processed = false; // Cờ đánh dấu đã submit form chưa

// --- BƯỚC 2: XỬ LÝ FORM KHI SUBMIT ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $processed = true;
    
    // Lấy dữ liệu từ form
    $raw_data = isset($_POST['raw_data']) ? $_POST['raw_data'] : '';
    $threshold = isset($_POST['threshold']) ? $_POST['threshold'] : '';
    $is_sort = isset($_POST['sort_desc']); // Checkbox trả về true nếu được tick

    // 1. PARSE DATA (Tách chuỗi -> Đối tượng)
    if (trim($raw_data) === '') {
        $errors[] = "Chưa nhập dữ liệu nguồn!";
    } else {
        // Tách các record bằng dấu chấm phẩy
        $records = explode(';', $raw_data);
        
        foreach ($records as $rec) {
            // Tách từng trường bằng dấu gạch ngang
            // Định dạng: ID-Name-GPA
            $parts = explode('-', trim($rec));
            
            // Validate: Phải đủ 3 phần và GPA phải là số
            if (count($parts) === 3 && is_numeric($parts[2])) {
                $id = trim($parts[0]);
                $name = trim($parts[1]);
                $gpa = (float)$parts[2];
                
                // Tạo đối tượng và thêm vào mảng
                $students[] = new Student($id, $name, $gpa);
            }
        }

        if (empty($students)) {
            $errors[] = "Dữ liệu nhập vào sai định dạng, không tìm thấy sinh viên hợp lệ nào!";
        }
    }

    // 2. FILTER (Lọc theo Threshold)
    if (empty($errors) && is_numeric($threshold)) {
        $students = array_filter($students, function($s) use ($threshold) {
            return $s->getGpa() >= (float)$threshold;
        });
    }

    // 3. SORT (Sắp xếp giảm dần nếu được chọn)
    if (empty($errors) && $is_sort && count($students) > 0) {
        usort($students, function($a, $b) {
            // So sánh GPA giảm dần (Số lớn đứng trước)
            return $b->getGpa() <=> $a->getGpa();
        });
    }
}

// --- HÀM HỖ TRỢ THỐNG KÊ ---
// (Chỉ chạy khi có students)
$stats = [
    'count' => 0, 'avg' => 0, 'max' => 0, 'min' => 0,
    'ranks' => ['Giỏi' => 0, 'Khá' => 0, 'Trung bình' => 0]
];

if (!empty($students)) {
    $gpas = array_map(function($s) { return $s->getGpa(); }, $students);
    
    $stats['count'] = count($students);
    $stats['avg'] = array_sum($gpas) / count($gpas);
    $stats['max'] = max($gpas);
    $stats['min'] = min($gpas);
    
    foreach ($students as $s) {
        $r = $s->rank();
        if (isset($stats['ranks'][$r])) $stats['ranks'][$r]++;
    }
}

function getRankColor($rank) {
    if ($rank == 'Giỏi') return '#27ae60';
    if ($rank == 'Khá') return '#2980b9';
    return '#e67e22';
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 5: Student Manager Pro</title>
    <style>
        /* CSS GIAO DIỆN HIỆN ĐẠI */
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; padding: 20px; color: #333; }
        .container { max-width: 1000px; margin: 0 auto; display: grid; grid-template-columns: 1fr 2fr; gap: 20px; }
        
        .box { background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h2 { margin-top: 0; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; font-size: 1.2rem; }
        
        /* FORM STYLE */
        label { font-weight: bold; display: block; margin-bottom: 5px; color: #555; }
        textarea { width: 100%; height: 120px; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: monospace; resize: vertical; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; margin-bottom: 15px; }
        .checkbox-group { margin: 15px 0; display: flex; align-items: center; gap: 10px; cursor: pointer; }
        input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; }
        
        button { background: #3498db; color: white; border: none; padding: 12px 20px; border-radius: 6px; width: 100%; cursor: pointer; font-size: 16px; font-weight: bold; transition: 0.3s; }
        button:hover { background: #2980b9; }

        /* ALERT STYLE */
        .alert { padding: 15px; border-radius: 6px; margin-bottom: 20px; }
        .alert-error { background: #fdecea; color: #c0392b; border: 1px solid #fadbd8; }
        .alert-info { background: #e8f8f5; color: #0f5132; border: 1px solid #d1e7dd; }

        /* TABLE STYLE */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #34495e; color: white; text-align: left; padding: 10px; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        tr:nth-child(even) { background: #f8f9fa; }
        .badge { padding: 4px 10px; border-radius: 12px; color: white; font-size: 0.85em; }

        /* STATS GRID */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 20px; }
        .stat-item { background: #ecf0f1; padding: 10px; border-radius: 6px; text-align: center; }
        .stat-val { font-size: 1.4rem; font-weight: bold; color: #2c3e50; display: block; }
        .stat-label { font-size: 0.8rem; color: #7f8c8d; text-transform: uppercase; }

        /* Responsive */
        @media (max-width: 768px) { .container { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <div class="container">
        
        <div class="box">
            <h2>🛠️ Công cụ xử lý</h2>
            
            <form method="POST" action="">
                <label>1. Nhập dữ liệu thô:</label>
                <div style="font-size: 0.85em; color: #777; margin-bottom: 5px;">Format: ID-Name-GPA;ID-Name-GPA...</div>
                <textarea name="raw_data" placeholder="Ví dụ: SV01-An-8.5;SV02-Binh-7.0"><?php echo htmlspecialchars($raw_data); ?></textarea>
                
                <label style="margin-top: 15px;">2. Lọc điểm (>=):</label>
                <input type="text" name="threshold" value="<?php echo htmlspecialchars($threshold); ?>" placeholder="Nhập điểm sàn (VD: 3.0)">
                
                <div class="checkbox-group">
                    <input type="checkbox" id="chkSort" name="sort_desc" <?php echo $is_sort ? 'checked' : ''; ?>>
                    <label for="chkSort" style="margin:0; cursor:pointer;">3. Sắp xếp điểm Giảm dần</label>
                </div>
                
                <button type="submit">🚀 Parse & Analyze</button>
            </form>
            
            <div style="margin-top: 20px; background: #fff3cd; padding: 10px; border-radius: 6px; font-size: 0.9em;">
                <strong>Dữ liệu mẫu (Copy):</strong><br>
                <code>SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5;SV004-Dung-3.8;SV005-Em-1.9</code>
            </div>
        </div>

        <div class="box">
            <h2>📊 Kết quả báo cáo</h2>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <strong>⚠️ Có lỗi xảy ra:</strong>
                    <ul style="margin: 5px 0 0 20px; padding: 0;">
                        <?php foreach($errors as $err) echo "<li>$err</li>"; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($processed && empty($errors) && !empty($students)): ?>
                
                <div class="alert alert-info">
                    Tìm thấy <strong><?php echo count($students); ?></strong> sinh viên hợp lệ 
                    <?php if($threshold != '') echo "có điểm >= $threshold"; ?>.
                </div>

                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-val"><?php echo number_format($stats['avg'], 2); ?></span>
                        <span class="stat-label">TB Lớp</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val"><?php echo $stats['max']; ?></span>
                        <span class="stat-label">Cao nhất</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val"><?php echo $stats['min']; ?></span>
                        <span class="stat-label">Thấp nhất</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val" style="color: #27ae60;"><?php echo $stats['ranks']['Giỏi']; ?></span>
                        <span class="stat-label">Giỏi</span>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ và Tên</th>
                            <th>GPA</th>
                            <th>Xếp loại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $s): $r = $s->rank(); ?>
                        <tr>
                            <td><?php echo $s->getId(); ?></td>
                            <td><?php echo $s->getName(); ?></td>
                            <td><strong><?php echo $s->getGpa(); ?></strong></td>
                            <td>
                                <span class="badge" style="background: <?php echo getRankColor($r); ?>">
                                    <?php echo $r; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php elseif ($processed && empty($errors) && empty($students)): ?>
                <p style="text-align: center; color: #777;">Không có kết quả nào phù hợp với bộ lọc.</p>
            <?php else: ?>
                <p style="text-align: center; color: #aaa; padding-top: 50px;">
                    Dữ liệu kết quả sẽ hiển thị ở đây sau khi bạn bấm nút xử lý.
                </p>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>