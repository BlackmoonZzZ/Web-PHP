<?php
require_once 'includes/header.php';
requireLogin();

$current_student_id = $_SESSION['user']['id'];
$courses = loadJson('courses.json');
$registrations = loadJson('registrations.json');

// --- XỬ LÝ POST (Đăng ký / Hủy) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCsrfToken(); // Quan trọng: Yêu cầu bài lab

    $course_id = $_POST['course_id'];
    $action = $_POST['action'];

    if ($action === 'register') {
        // Kiểm tra xem đã đăng ký chưa
        $exists = false;
        foreach ($registrations as $reg) {
            if ($reg['student_id'] == $current_student_id && $reg['course_id'] == $course_id) {
                $exists = true; break;
            }
        }

        if (!$exists) {
            // Thêm đăng ký mới (Điểm mặc định là null hoặc 0)
            $registrations[] = [
                'student_id' => $current_student_id,
                'course_id' => $course_id,
                'grade' => null 
            ];
            saveJson('registrations.json', $registrations);
            setFlash("Đăng ký môn $course_id thành công!");
        } else {
            setFlash("Bạn đã đăng ký môn này rồi!", "danger");
        }

    } elseif ($action === 'cancel') {
        // Lọc bỏ môn học này khỏi mảng
        $new_registrations = [];
        foreach ($registrations as $reg) {
            if (!($reg['student_id'] == $current_student_id && $reg['course_id'] == $course_id)) {
                $new_registrations[] = $reg;
            }
        }
        
        if (count($new_registrations) < count($registrations)) {
            saveJson('registrations.json', $new_registrations);
            setFlash("Đã hủy đăng ký môn $course_id.", "success");
        }
        // Cập nhật lại biến để hiển thị
        $registrations = $new_registrations; 
    }
    
    // Redirect để tránh resubmit form (PRG pattern)
    header("Location: courses.php");
    exit;
}

// --- CHUẨN BỊ DỮ LIỆU HIỂN THỊ ---
// Lấy danh sách ID các môn đã đăng ký của user này
$my_course_ids = [];
foreach ($registrations as $reg) {
    if ($reg['student_id'] == $current_student_id) {
        $my_course_ids[] = $reg['course_id'];
    }
}
?>

<h2>Đăng ký học phần</h2>

<h3>Danh sách môn học hiện có</h3>
<table>
    <thead>
        <tr>
            <th>Mã MH</th>
            <th>Tên môn học</th>
            <th>Số tín chỉ</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course): ?>
            <?php $is_registered = in_array($course['id'], $my_course_ids); ?>
            <tr>
                <td><?= $course['id'] ?></td>
                <td><?= $course['name'] ?></td>
                <td><?= $course['credits'] ?></td>
                <td>
                    <?= $is_registered ? '<span style="color:green;font-weight:bold;">Đã đăng ký</span>' : 'Chưa đăng ký' ?>
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                        
                        <?php if ($is_registered): ?>
                            <input type="hidden" name="action" value="cancel">
                            <button type="submit" style="background:#ffdddd; color:red; border:1px solid red; cursor:pointer;" onclick="return confirm('Bạn chắc chắn muốn hủy?')">Hủy đăng ký</button>
                        <?php else: ?>
                            <input type="hidden" name="action" value="register">
                            <button type="submit" style="background:#ddffdd; color:green; border:1px solid green; cursor:pointer;">Đăng ký</button>
                        <?php endif; ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>