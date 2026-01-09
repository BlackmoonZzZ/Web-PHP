<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sách</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; padding: 20px; background: #f0f2f5; }
        .container { background: white; padding: 20px; border-radius: 8px; max-width: 900px; margin: 0 auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #3498db; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .btn-add { display: inline-block; padding: 10px 20px; background: #27ae60; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px; }
        .empty-msg { text-align: center; color: #777; font-style: italic; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kho Sách Hiện Có</h2>
        <a href="add_book.php" class="btn-add">+ Thêm sách mới</a>
        
        <?php
        $file_path = '../data/books.json';
        $books = [];
        if (file_exists($file_path)) {
            $json_content = file_get_contents($file_path);
            $books = json_decode($json_content, true);
        }
        ?>

        <?php if (!empty($books)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Mã sách</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                        <th>Năm XB</th>
                        <th>Thể loại</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['masach']); ?></td>
                        <td><?php echo htmlspecialchars($book['tensach']); ?></td>
                        <td><?php echo htmlspecialchars($book['tacgia']); ?></td>
                        <td><?php echo htmlspecialchars($book['namxb']); ?></td>
                        <td><?php echo htmlspecialchars($book['theloai']); ?></td>
                        <td><?php echo htmlspecialchars($book['soluong']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="empty-msg">Chưa có cuốn sách nào trong kho dữ liệu.</p>
        <?php endif; ?>
    </div>
</body>
</html>