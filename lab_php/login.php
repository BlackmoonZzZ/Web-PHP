<?php
require_once 'includes/functions.php';

// Nếu đã đăng nhập thì chuyển về index
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// Xử lý Form Submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    $users = loadJson('users.json');
    $userFound = null;

    foreach ($users as $u) {
        if ($u['username'] === $username && $u['password'] === $password) {
            $userFound = $u;
            break;
        }
    }

    if ($userFound) {
        // Lưu Session
        $_SESSION['user'] = $userFound;

        // Xử lý Cookie "Remember me" (Yêu cầu bài lab)
        if ($remember) {
            // Lưu username trong 30 ngày, KHÔNG lưu password
            setcookie('username', $username, time() + (86400 * 30), "/"); 
        } else {
            // Nếu không tích thì xóa cookie cũ nếu có
            setcookie('username', '', time() - 3600, "/");
        }

        setFlash("Đăng nhập thành công!", "success");
        header("Location: index.php");
        exit;
    } else {
        setFlash("Sai tên đăng nhập hoặc mật khẩu!", "danger");
    }
}

// Lấy username từ cookie nếu có để điền sẵn
$saved_username = $_COOKIE['username'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <style>
        .login-box { width: 300px; margin: 50px auto; border: 1px solid #ccc; padding: 20px; }
        input { width: 100%; margin-bottom: 10px; padding: 5px; box-sizing: border-box; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Đăng nhập</h2>
        <?= getFlash() ?>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($saved_username) ?>" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <label>
                <input type="checkbox" name="remember" style="width:auto;"> Remember me
            </label>
            
            <button type="submit" style="width:100%; margin-top:10px;">Login</button>
        </form>
    </div>
</body>
</html>