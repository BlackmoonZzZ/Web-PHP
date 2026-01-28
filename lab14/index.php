<?php
session_start();
require_once 'controllers/ItemController.php';
require_once 'helpers/FlashMessage.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Sách</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .header h1 {
            font-size: 28px;
        }
        
        .btn-add {
            background: white;
            color: #667eea;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .content {
            padding: 30px;
        }
        
        .form-container {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            font-size: 14px;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5568d3;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .info-bar {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .info-bar .page-info {
            color: #555;
            font-weight: 500;
        }
        
        .limit-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .limit-selector select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .list-container {
            margin: 30px 0;
        }
        
        .list-item {
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 5px;
            background: #f9f9f9;
            display: flex;
            gap: 20px;
            align-items: flex-start;
            transition: all 0.3s ease;
        }
        
        .list-item:hover {
            background: #f0f0f0;
            border-color: #667eea;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .list-item-image {
            width: 80px;
            height: 80px;
            border-radius: 5px;
            overflow: hidden;
            background: #ddd;
            flex-shrink: 0;
        }
        
        .list-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .list-item-content {
            flex: 1;
        }
        
        .list-item-id {
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
        }
        
        .list-item-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
            font-size: 16px;
        }
        
        .list-item-desc {
            color: #777;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .list-item-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-edit {
            background: #007bff;
            color: white;
        }
        
        .btn-edit:hover {
            background: #0056b3;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
        }
        
        .btn-delete:hover {
            background: #c82333;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .pagination a,
        .pagination span {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            background: white;
            color: #667eea;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .pagination a:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .pagination a.active,
        .pagination span.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .pagination span.disabled {
            cursor: not-allowed;
            opacity: 0.5;
            background: #f0f0f0;
        }
        
        .flash-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }
        
        .flash-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .flash-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .list-item {
                flex-direction: column;
            }
            
            .list-item-image {
                width: 100%;
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Quản Lý Danh Sách</h1>
            <?php if ($page === 'list'): ?>
                <a href="index.php?action=add" class="btn-add">➕ Thêm Mới</a>
            <?php endif; ?>
        </div>
        
        <div class="content">
            <?php
            FlashMessage::display();
            ?>
            
            <?php if ($page === 'add' || $page === 'edit'): ?>
                <!-- Form Thêm/Sửa -->
                <div class="form-container">
                    <h2><?php echo ($page === 'add') ? 'Thêm Sản Phẩm Mới' : 'Chỉnh Sửa Sản Phẩm'; ?></h2>
                    <br>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="<?php echo $page; ?>">
                        <?php if ($page === 'edit'): ?>
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="name">Tên Sản Phẩm *</label>
                            <input type="text" id="name" name="name" required value="<?php echo $page === 'edit' ? htmlspecialchars($item['name']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Mô Tả *</label>
                            <textarea id="description" name="description" required><?php echo $page === 'edit' ? htmlspecialchars($item['description']) : ''; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="image">Hình Ảnh</label>
                            <input type="file" id="image" name="image" accept="image/*">
                            <?php if ($page === 'edit' && $item['image']): ?>
                                <p style="color: #666; margin-top: 10px; font-size: 12px;">Hình ảnh hiện tại: <?php echo htmlspecialchars($item['image']); ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <?php echo ($page === 'add') ? 'Thêm' : 'Cập Nhật'; ?>
                            </button>
                            <a href="index.php" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <!-- Danh Sách -->
                <div class="info-bar">
                    <div class="page-info">
                        <strong>Trang <?php echo $currentPage; ?>/<?php echo $totalPages; ?></strong> 
                        – Tổng <?php echo $totalItems; ?> bản ghi
                    </div>
                    <div class="limit-selector">
                        <label for="limit">Bản ghi/trang:</label>
                        <select id="limit" onchange="changeLimit(this.value)">
                            <option value="5" <?php echo ($itemsPerPage == 5) ? 'selected' : ''; ?>>5</option>
                            <option value="10" <?php echo ($itemsPerPage == 10) ? 'selected' : ''; ?>>10</option>
                        </select>
                    </div>
                </div>
                
                <div class="list-container">
                    <?php foreach ($items as $item): ?>
                        <div class="list-item">
                            <?php if ($item['image']): ?>
                                <div class="list-item-image">
                                    <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                </div>
                            <?php else: ?>
                                <div class="list-item-image">
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80'%3E%3Crect fill='%23ddd' width='80' height='80'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%23999' font-size='12'%3ENo Image%3C/text%3E%3C/svg%3E" alt="No image">
                                </div>
                            <?php endif; ?>
                            <div class="list-item-content">
                                <div class="list-item-id">ID: #<?php echo $item['id']; ?></div>
                                <div class="list-item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                <div class="list-item-desc"><?php echo htmlspecialchars($item['description']); ?></div>
                                <div class="list-item-actions">
                                    <a href="index.php?action=edit&id=<?php echo $item['id']; ?>" class="btn-edit">✏️ Sửa</a>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="btn-delete">🗑️ Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Phân trang -->
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=1&limit=<?php echo $itemsPerPage; ?>" class="btn-first">⏮ First</a>
                        <a href="?page=<?php echo $currentPage - 1; ?>&limit=<?php echo $itemsPerPage; ?>" class="btn-prev">◀ Prev</a>
                    <?php else: ?>
                        <span class="disabled">⏮ First</span>
                        <span class="disabled">◀ Prev</span>
                    <?php endif; ?>
                    
                    <?php
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $currentPage + 2);
                    
                    if ($startPage > 1) {
                        echo '<a href="?page=1&limit=' . $itemsPerPage . '">1</a>';
                        if ($startPage > 2) {
                            echo '<span>...</span>';
                        }
                    }
                    
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        if ($i == $currentPage) {
                            echo '<span class="active">' . $i . '</span>';
                        } else {
                            echo '<a href="?page=' . $i . '&limit=' . $itemsPerPage . '">' . $i . '</a>';
                        }
                    }
                    
                    if ($endPage < $totalPages) {
                        if ($endPage < $totalPages - 1) {
                            echo '<span>...</span>';
                        }
                        echo '<a href="?page=' . $totalPages . '&limit=' . $itemsPerPage . '">' . $totalPages . '</a>';
                    }
                    ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?php echo $currentPage + 1; ?>&limit=<?php echo $itemsPerPage; ?>" class="btn-next">Next ▶</a>
                        <a href="?page=<?php echo $totalPages; ?>&limit=<?php echo $itemsPerPage; ?>" class="btn-last">Last ⏭</a>
                    <?php else: ?>
                        <span class="disabled">Next ▶</span>
                        <span class="disabled">Last ⏭</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        function changeLimit(limit) {
            window.location.href = '?page=1&limit=' + limit;
        }
    </script>
</body>
</html>
