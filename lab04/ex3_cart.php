<?php
// --- HÀM TIỆN ÍCH (Gợi ý cuối bài) ---
// Viết ngắn gọn hàm htmlspecialchars để dùng cho nhanh
function h($str) {
    return htmlspecialchars($str);
}

// --- BƯỚC 1: KHAI BÁO DỮ LIỆU ---
$products = [
    ['name' => 'iPhone 15',     'price' => 20000000, 'qty' => 2],
    ['name' => 'Samsung S24',   'price' => 18000000, 'qty' => 1],
    ['name' => 'Xiaomi Note',   'price' => 5000000,  'qty' => 5],
    ['name' => 'Oppo Find N3',  'price' => 40000000, 'qty' => 1],
];

// --- BƯỚC 2: TẠO CỘT AMOUNT (Thành tiền) ---
// Dùng array_map để đi qua từng sản phẩm và tính thêm cột 'amount'
$products = array_map(function($item) {
    $item['amount'] = $item['price'] * $item['qty'];
    return $item;
}, $products);

// --- BƯỚC 4: TÍNH TỔNG TIỀN (Dùng array_reduce) ---
// $carry là biến tích lũy, $item là từng sản phẩm
$total_bill = array_reduce($products, function($carry, $item) {
    return $carry + $item['amount'];
}, 0);

// --- BƯỚC 5: TÌM SẢN PHẨM CÓ AMOUNT LỚN NHẤT ---
// Cách logic: Giả sử phần tử đầu tiên là lớn nhất, rồi so sánh dần
$max_product = array_reduce($products, function($max, $item) {
    // Nếu chưa có $max hoặc item hiện tại lớn hơn $max thì lấy item hiện tại
    return ($max === null || $item['amount'] > $max['amount']) ? $item : $max;
});

// --- BƯỚC 6: SẮP XẾP THEO PRICE GIẢM DẦN (Dùng usort) ---
// Tạo một mảng copy để sắp xếp, giữ nguyên mảng gốc cho bảng hiển thị chính
$sorted_products = $products; 
usort($sorted_products, function($a, $b) {
    // So sánh giá: Trả về số dương, âm hoặc 0
    // Logic giảm dần: so sánh b với a
    return $b['price'] <=> $a['price']; 
});

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3: Giỏ hàng thông minh</title>
    <style>
        /* --- 1. CẤU TRÚC CHUNG --- */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #3498db;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .header-wrap { text-align: center; }

        /* --- 2. BẢNG (TABLE) --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 15px;
            overflow: hidden;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        table thead tr {
            background-color: #009879; /* Màu xanh lá đậm hiện đại */
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        table th, table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3; /* Màu xen kẽ cho dễ đọc */
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        
        table tbody tr:hover {
            background-color: #f1f8e9; /* Hiệu ứng khi di chuột */
            cursor: default;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .total-row td {
            font-weight: bold;
            font-size: 1.1em;
            color: #d35400;
            background-color: #fff8e1 !important;
        }

        /* --- 3. PHẦN THỐNG KÊ --- */
        .stats-box {
            background-color: #e8f6f3;
            border-left: 5px solid #009879;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }

        .stats-box h3 { margin-top: 0; color: #00796b; }
        
        ul.list-group {
            list-style: none;
            padding: 0;
        }
        
        ul.list-group li {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }
        
        ul.list-group li:last-child { border-bottom: none; }
        
        .badge {
            background: #3498db;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.85em;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header-wrap">
            <h2>🛒 Giỏ hàng của bạn</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th class="text-center">SL</th>
                    <th class="text-right">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $stt = 1;
                foreach ($products as $p): 
                ?>
                <tr>
                    <td class="text-center"><?php echo $stt++; ?></td>
                    <td><?php echo h($p['name']); ?></td>
                    <td><?php echo number_format($p['price']); ?> đ</td>
                    <td class="text-center"><?php echo $p['qty']; ?></td>
                    <td class="text-right"><?php echo number_format($p['amount']); ?> đ</td>
                </tr>
                <?php endforeach; ?>
                
                <tr class="total-row">
                    <td colspan="4" class="text-right">TỔNG CỘNG</td>
                    <td class="text-right"><?php echo number_format($total_bill); ?> đ</td>
                </tr>
            </tbody>
        </table>

        <div class="stats-box">
            <h3>📊 Thống kê & Xử lý</h3>
            
            <p>
                🔥 <strong>Sản phẩm giá trị nhất:</strong><br>
                <span style="font-size: 1.2em; color: #c0392b;">
                    <?php echo h($max_product['name']); ?> 
                </span>
                <span class="badge">Top 1</span>
                - (<?php echo number_format($max_product['amount']); ?> đ)
            </p>

            <hr style="border: 0; border-top: 1px dashed #ccc; margin: 15px 0;">

            <p>📉 <strong>Sắp xếp theo giá giảm dần:</strong></p>
            <ul class="list-group">
                <?php foreach ($sorted_products as $p): ?>
                    <li>
                        <span><?php echo h($p['name']); ?></span>
                        <strong><?php echo number_format($p['price']); ?> đ</strong>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</body>
</html>