<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sách Mới</title>
    <style>
        /* CSS dùng chung cho đẹp (giống bài 1) */
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; padding: 20px; }
        .container { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 600px; }
        h2 { text-align: center; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: 600; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        input:focus, select:focus { border-color: #3498db; outline: none; }
        .btn { width: 100%; padding: 12px; background: #3498db; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .btn:hover { background: #2980b9; }
        .btn-list { background: #27ae60; margin-top: 10px; display: block; text-align: center; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📚 Thêm Sách Vào Kho</h2>
        <form action="process_book.php" method="POST">
            <div class="form-group">
                <label>Mã sách (ISBN) *</label>
                <input type="text" name="masach" required placeholder="Ví dụ: B001">
            </div>
            
            <div class="form-group">
                <label>Tên sách *</label>
                <input type="text" name="tensach" required>
            </div>

            <div class="form-group">
                <label>Tác giả *</label>
                <input type="text" name="tacgia" required>
            </div>

            <div class="form-group">
                <label>Năm xuất bản *</label>
                <input type="number" name="namxb" required min="1900" max="<?php echo date('Y'); ?>" placeholder="1900 - Nay">
            </div>

            <div class="form-group">
                <label>Thể loại</label>
                <select name="theloai">
                    <option value="Giáo trình">Giáo trình</option>
                    <option value="Kỹ năng">Kỹ năng</option>
                    <option value="Văn học">Văn học</option>
                    <option value="Khoa học">Khoa học</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label>Số lượng *</label>
                <input type="number" name="soluong" required min="0" value="1">
            </div>

            <button type="submit" class="btn">Lưu Sách</button>
            <a href="list_books.php" class="btn btn-list">Xem Danh Sách Sách</a>
        </form>
    </div>
</body>
</html>