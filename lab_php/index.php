<?php
require_once 'includes/header.php';
requireLogin(); // Bảo vệ trang
?>

<h1>Trang chủ sinh viên</h1>
<p>Chào mừng bạn đến với hệ thống quản lý học phần mini.</p>
<p>Hãy chọn chức năng trên thanh menu:</p>
<ul>
    <li><strong>Đăng ký học phần:</strong> Xem danh sách môn, đăng ký và hủy môn.</li>
    <li><strong>Xem điểm:</strong> Xem bảng điểm cá nhân (Giả lập).</li>
</ul>

<?php require_once 'includes/footer.php'; ?>