<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Thẻ Thư Viện</title>
    <style>
        /* Reset cơ bản */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5; /* Màu nền xám nhẹ hiện đại */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        /* Khung chứa chính (Card) */
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Đổ bóng */
            width: 100%;
            max-width: 600px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            text-transform: uppercase;
            font-size: 24px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            display: inline-block;
            width: 100%;
        }
        /* Style các ô nhập liệu */
        .form-group { margin-bottom: 20px; }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #34495e;
        }
        label span { color: #e74c3c; } /* Dấu sao đỏ */
        
        input[type="text"], 
        input[type="email"], 
        input[type="date"], 
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        /* Hiệu ứng khi bấm vào ô */
        input:focus, textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        
        /* Style Radio button */
        .radio-group label {
            display: inline-block;
            margin-right: 20px;
            font-weight: normal;
            cursor: pointer;
        }
        .radio-group input { margin-right: 5px; }

        /* Nút bấm */
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-submit {
            background-color: #3498db;
            color: white;
        }
        .btn-submit:hover { background-color: #2980b9; }
        
        .btn-reset {
            background-color: #95a5a6;
            color: white;
        }
        .btn-reset:hover { background-color: #7f8c8d; }

    </style>
</head>
<body>

    <div class="container">
        <h2>Đăng ký Thẻ Thư Viện</h2>
        <form action="member_result.php" method="POST">
            
            <div class="form-group">
                <label>Họ và tên <span>*</span></label>
                <input type="text" name="hoten" placeholder="Nhập họ tên đầy đủ" required>
            </div>

            <div class="form-group">
                <label>Email <span>*</span></label>
                <input type="email" name="email" placeholder="example@email.com" required>
            </div>

            <div class="form-group">
                <label>Số điện thoại <span>*</span></label>
                <input type="text" name="sdt" placeholder="09xxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label>Ngày sinh <span>*</span></label>
                <input type="date" name="ngaysinh" required>
            </div>

            <div class="form-group">
                <label>Giới tính</label>
                <div class="radio-group">
                    <label><input type="radio" name="gioitinh" value="Nam" checked> Nam</label>
                    <label><input type="radio" name="gioitinh" value="Nữ"> Nữ</label>
                    <label><input type="radio" name="gioitinh" value="Khác"> Khác</label>
                </div>
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea name="diachi" rows="3" placeholder="Nhập địa chỉ liên hệ..."></textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-submit">Đăng ký</button>
                <button type="reset" class="btn btn-reset">Làm lại</button>
            </div>
        </form>
    </div>

</body>
</html>