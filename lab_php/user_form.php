<?php
require_once 'includes/header.php';
requireLogin();

if ($_SESSION['user']['username'] !== 'admin') {
    die("Bạn không có quyền!");
}

$users = loadJson('users.json');
$id = $_GET['id'] ?? ''; // Lấy ID từ URL nếu đang sửa
$is_edit = !empty($id);

// Biến chứa dữ liệu form (để điền sẵn)
$form_data = ['id' => '', 'username' => '', 'fullname' => '', 'password' => ''];

// Nếu là chế độ Sửa, tìm user cũ để điền vào form
if ($is_edit) {
    foreach ($users as $u) {
        if ($u['id'] == $id) {
            $form_data = $u;
            break;
        }
    }
    if (empty($form_data['id'])) die("Không tìm thấy User!");
}

// --- XỬ LÝ LƯU DỮ LIỆU ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCsrfToken();
    
    $input_id = $_POST['id'];
    $input_user = $_POST['username'];
    $input_pass = $_POST['password'];
    $input_name = $_POST['fullname'];

    if ($is_edit) {
        // --- LOGIC CẬP NHẬT (UPDATE) ---
        foreach ($users as &$u) { // Dùng tham chiếu & để sửa trực tiếp
            if ($u['id'] == $id) {
                $u['username'] = $input_user;
                $u['fullname'] = $input_name;
                // Nếu nhập pass mới thì đổi, không thì giữ nguyên
                if (!empty($input_pass)) {
                    $u['password'] = $input_pass;
                }
                break;
            }
        }
        saveJson('users.json', $users);
        setFlash("Cập nhật thông tin thành công!", "success");
    } else {
        // --- LOGIC THÊM MỚI (CREATE) ---
        // Kiểm tra trùng ID
        $exists = false;
        foreach ($users as $u) {
            if ($u['id'] == $input_id || $u['username'] == $input_user) {
                $exists = true; break;
            }
        }

        if ($exists) {
            setFlash("ID hoặc Username đã tồn tại!", "danger");
        } else {
            $users[] = [
                'id' => $input_id,
                'username' => $input_user,
                'password' => $input_pass, // Lưu ý: Nên hash password trong thực tế
                'fullname' => $input_name
            ];
            saveJson('users.json', $users);
            setFlash("Thêm sinh viên mới thành công!", "success");
            header("Location: admin.php"); // Thêm xong quay về danh sách
            exit;
        }
    }
    
    // Sau khi xử lý xong (nếu chưa redirect)
    if($is_edit) header("Location: admin.php");
}
?>

<h2><?= $is_edit ? 'Cập nhật Sinh viên' : 'Thêm Sinh viên mới' ?></h2>

<form method="POST" style="width: 50%; border: 1px solid #ccc; padding: 20px;">
    <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
    
    <label>Mã SV (ID):</label><br>
    <input type="text" name="id" value="<?= $form_data['id'] ?>" <?= $is_edit ? 'readonly style="background:#eee;"' : 'required' ?>><br><br>
    
    <label>Tên đăng nhập:</label><br>
    <input type="text" name="username" value="<?= $form_data['username'] ?>" required><br><br>
    
    <label>Họ và tên:</label><br>
    <input type="text" name="fullname" value="<?= $form_data['fullname'] ?>" required><br><br>
    
    <label>Mật khẩu <?= $is_edit ? '(Để trống nếu không đổi)' : '' ?>:</label><br>
    <input type="password" name="password" <?= $is_edit ? '' : 'required' ?>><br><br>
    
    <button type="submit"><?= $is_edit ? 'Lưu thay đổi' : 'Thêm mới' ?></button>
    <a href="admin.php" style="margin-left:10px;">Hủy</a>
</form>

<?php require_once 'includes/footer.php'; ?>