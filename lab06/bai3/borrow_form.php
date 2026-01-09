<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lập Phiếu Mượn Sách</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: #fff; max-width: 500px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
        .link { text-align: center; margin-top: 15px; display: block; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📝 Lập Phiếu Mượn</h2>
        <form action="borrow_process.php" method="POST">
            <div class="form-group">
                <label>Email độc giả (Mã thành viên) *</label>
                <input type="email" name="member_id" required placeholder="Nhập email đã đăng ký...">
            </div>

            <div class="form-group">
                <label>Mã sách *</label>
                <input type="text" name="book_id" required placeholder="Nhập mã sách (VD: B001)...">
            </div>

            <div class="form-group">
                <label>Ngày mượn *</label>
                <input type="date" name="borrow_date" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="form-group">
                <label>Số ngày mượn (1-30 ngày) *</label>
                <input type="number" name="duration" min="1" max="30" value="7" required>
            </div>

            <button type="submit">Xác nhận mượn</button>
        </form>
        <a href="return_form.php" class="link">Chuyển sang Trả sách</a>
    </div>
</body>
</html>