<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trả Sách</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: #fff; max-width: 500px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔄 Trả Sách</h2>
        <form action="return_process.php" method="POST">
            <label>Nhập Mã phiếu mượn (được cấp khi mượn):</label>
            <input type="text" name="ma_phieu" required placeholder="VD: L65a...">
            
            <label>Ngày trả:</label>
            <input type="date" name="return_date" value="<?php echo date('Y-m-d'); ?>">

            <button type="submit">Xác nhận Trả</button>
        </form>
        <p style="text-align:center"><a href="borrow_form.php">Quay lại Mượn sách</a></p>
    </div>
</body>
</html>