<?php
require_once 'includes/header.php';
requireLogin();

// Chỉ cho phép admin truy cập (Logic đơn giản: username là admin)
if ($_SESSION['user']['username'] !== 'admin') {
    die("Bạn không có quyền truy cập trang này!");
}

$users = loadJson('users.json');

// --- XỬ LÝ XÓA USER ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    checkCsrfToken(); // Bảo vệ CSRF
    $delete_id = $_POST['delete_id'];

    // Không cho phép tự xóa chính mình
    if ($delete_id == $_SESSION['user']['id']) {
        setFlash("Không thể xóa tài khoản đang đăng nhập!", "danger");
    } else {
        $new_users = [];
        $found = false;
        foreach ($users as $u) {
            if ($u['id'] == $delete_id) {
                $found = true; 
                continue; // Bỏ qua user này (Xóa)
            }
            $new_users[] = $u;
        }

        if ($found) {
            saveJson('users.json', $new_users);
            setFlash("Đã xóa sinh viên có ID: $delete_id", "success");
            // Reload lại dữ liệu để hiển thị
            $users = $new_users;
        }
    }
}
?>

<h2>Quản lý Sinh viên (CRUD)</h2>
<a href="user_form.php" style="background:#007bff; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">+ Thêm sinh viên mới</a>
<br><br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Họ và tên</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= $u['username'] ?></td>
            <td><?= $u['fullname'] ?></td>
            <td>
                <a href="user_form.php?id=<?= $u['id'] ?>" style="color:blue; margin-right:10px;">Sửa</a>
                
                <form method="POST" style="display:inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                    <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                    <input type="hidden" name="delete_id" value="<?= $u['id'] ?>">
                    <button type="submit" style="color:red; border:none; background:none; cursor:pointer; text-decoration:underline;">Xóa</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>