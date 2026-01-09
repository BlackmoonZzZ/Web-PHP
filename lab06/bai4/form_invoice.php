<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo Hóa Đơn Bán Hàng</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f8; padding: 20px; }
        .container { background: #fff; max-width: 800px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        
        .section-title { font-weight: bold; margin-top: 20px; color: #34495e; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        
        /* Grid layout cho form */
        .form-row { display: flex; gap: 15px; margin-bottom: 15px; }
        .col { flex: 1; }
        
        label { display: block; margin-bottom: 5px; font-weight: 500; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        
        /* Style cho bảng nhập hàng hóa */
        .product-row { display: flex; gap: 10px; margin-bottom: 10px; align-items: center; }
        .product-row input { margin-bottom: 0; }
        .num-col { width: 80px; } /* Ô số lượng nhỏ thôi */
        
        .btn { width: 100%; padding: 12px; background: #3498db; color: white; border: none; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer; margin-top: 20px; }
        .btn:hover { background: #2980b9; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🧾 Tạo Hóa Đơn Mini</h2>
        <form action="process_invoice.php" method="POST">
            
            <div class="section-title">Thông tin khách hàng</div>
            <div class="form-row">
                <div class="col">
                    <label>Họ tên khách:</label>
                    <input type="text" name="hoten" required>
                </div>
                <div class="col">
                    <label>Số điện thoại (*):</label>
                    <input type="text" name="sdt" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label>Email (Tùy chọn):</label>
                    <input type="email" name="email">
                </div>
            </div>

            <div class="section-title">Chi tiết đơn hàng</div>
            <div style="background: #f9f9f9; padding: 10px; border-radius: 4px;">
                <div style="display:flex; font-weight:bold; margin-bottom:5px;">
                    <span style="flex:3">Tên hàng hóa</span>
                    <span style="width:100px; text-align:center">Số lượng</span>
                    <span style="width:150px; text-align:center">Đơn giá (VNĐ)</span>
                </div>

                <?php for($i=0; $i<3; $i++): ?>
                <div class="product-row">
                    <div style="flex:3">
                        <input type="text" name="sanpham[<?php echo $i; ?>][ten]" placeholder="Sản phẩm <?php echo $i+1; ?>">
                    </div>
                    <div class="num-col">
                        <input type="number" name="sanpham[<?php echo $i; ?>][soluong]" placeholder="0" min="0">
                    </div>
                    <div style="width:150px">
                        <input type="number" name="sanpham[<?php echo $i; ?>][dongia]" placeholder="0" min="0">
                    </div>
                </div>
                <?php endfor; ?>
                <small style="color:gray">* Nhập ít nhất 1 sản phẩm để tạo hóa đơn.</small>
            </div>

            <div class="section-title">Thanh toán</div>
            <div class="form-row">
                <div class="col">
                    <label>Giảm giá (%):</label>
                    <input type="number" name="giamgia" min="0" max="30" value="0">
                </div>
                <div class="col">
                    <label>VAT (%):</label>
                    <input type="number" name="vat" min="0" max="15" value="8"> </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label>Phương thức thanh toán:</label>
                    <label style="display:inline; margin-right:15px;"><input type="radio" name="thanhtoan" value="Tiền mặt" checked> Tiền mặt</label>
                    <label style="display:inline;"><input type="radio" name="thanhtoan" value="Chuyển khoản"> Chuyển khoản</label>
                </div>
            </div>

            <button type="submit" class="btn">Xuất Hóa Đơn</button>
        </form>
    </div>
</body>
</html>