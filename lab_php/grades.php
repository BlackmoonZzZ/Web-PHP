<?php
require_once 'includes/header.php';
requireLogin();

$current_student_id = $_SESSION['user']['id'];
$courses = loadJson('courses.json');
$registrations = loadJson('registrations.json');

// Tạo map để lấy tên môn học dễ hơn
$course_map = [];
foreach ($courses as $c) {
    $course_map[$c['id']] = $c;
}
?>

<h2>Bảng điểm cá nhân</h2>
<table>
    <thead>
        <tr>
            <th>Môn học</th>
            <th>Số tín chỉ</th>
            <th>Điểm số</th>
            <th>Kết quả</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $has_data = false;
        foreach ($registrations as $reg): 
            if ($reg['student_id'] == $current_student_id):
                $has_data = true;
                $c_info = $course_map[$reg['course_id']] ?? ['name' => 'Unknown', 'credits' => 0];
                $grade = $reg['grade']; // Trong JSON có thể để null hoặc số
        ?>
            <tr>
                <td><?= $c_info['name'] ?> (<?= $reg['course_id'] ?>)</td>
                <td><?= $c_info['credits'] ?></td>
                <td><?= ($grade === null) ? 'Chưa có điểm' : $grade ?></td>
                <td>
                    <?php 
                        if ($grade === null) echo "-";
                        elseif ($grade >= 5) echo "<span style='color:green'>Đạt</span>";
                        else echo "<span style='color:red'>Học lại</span>";
                    ?>
                </td>
            </tr>
        <?php 
            endif;
        endforeach; 
        ?>
        
        <?php if(!$has_data): ?>
            <tr><td colspan="4" style="text-align:center;">Bạn chưa đăng ký môn học nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>