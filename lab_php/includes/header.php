<?php require_once 'functions.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống Sinh Viên Mini</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .nav { margin-bottom: 20px; padding: 10px; background: #f0f0f0; border-bottom: 2px solid #ccc; }
        .nav a { margin-right: 15px; text-decoration: none; color: #333; font-weight: bold;}
        .nav a:hover { color: #007bff; }
        
        .alert { padding: 10px; margin-bottom: 15px; border: 1px solid transparent; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; border-color: #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border-color: #f5c6cb; }
        
        table { border-collapse: collapse; width: 100%; margin-top: 10px;}
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        
        button { padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>

<?php if(isset($_SESSION['user'])): ?>
    <div class="nav">
        Xin chào, <strong><?= $_SESSION['user']['fullname'] ?></strong> |
        
        <a href="index.php">Trang chủ</a>
        <a href="courses.php">Đăng ký học phần</a>
        <a href="grades.php">Xem điểm</a>

        <?php if ($_SESSION['user']['username'] === 'admin'): ?>
            <a href="admin.php" style="color: #d63384;">★ Quản lý Sinh viên</a>
        <?php endif; ?>
        <form action="logout.php" method="POST" style="display:inline; float:right;">
            <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
            <button type="submit">Đăng xuất</button>
        </form>
        <div style="clear:both;"></div>
    </div>
<?php endif; ?>

<?= getFlash() ?>