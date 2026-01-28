# Lab 14 - Phân Trang Danh Sách & CRUD

## Mô Tả
Ứng dụng quản lý danh sách với các tính năng:
- **Phân trang**: Hiển thị danh sách theo trang với N=5 hoặc 10 bản ghi/trang
- **Điều hướng**: First / Prev / Số trang / Next / Last
- **CRUD**: Thêm, sửa, xóa sản phẩm
- **Upload**: Hỗ trợ tải lên hình ảnh
- **Flash Message**: Hiển thị thông báo thành công/lỗi

## Yêu Cầu
- PHP 7.4+
- MySQL/MariaDB
- XAMPP hoặc web server tương tự

## Cài Đặt

### 1. Tạo Cơ Sở Dữ Liệu
```bash
# Mở phpMyAdmin tại http://localhost/phpmyadmin
# Import file db.sql
```

Hoặc chạy SQL trực tiếp:
```sql
CREATE DATABASE IF NOT EXISTS lab14;
USE lab14;
-- Chạy các lệnh từ file db.sql
```

### 2. Cấu Hình Kết Nối
File: `config/Database.php`

Điều chỉnh nếu cần:
```php
private $host = 'localhost';
private $dbname = 'lab14';
private $user = 'root';
private $password = '';  // Điều chỉnh password của MySQL
```

### 3. Chạy Ứng Dụng
```
URL: http://localhost/lab14/
```

## Cấu Trúc Thư Mục

```
lab14/
├── config/
│   └── Database.php       # Kết nối CSDL
├── controllers/
│   ├── ItemController.php # Xử lý logic CRUD
│   └── PaginationController.php
├── models/
│   └── Model.php          # Model dữ liệu
├── helpers/
│   └── FlashMessage.php   # Flash message helper
├── uploads/               # Thư mục lưu hình ảnh
├── index.php              # Trang chính
├── db.sql                 # SQL dump
└── README.md              # Tài liệu này
```

## Tính Năng Chi Tiết

### 📋 Danh Sách (Phân Trang)
- Hiển thị trang hiện tại và tổng số trang
- Hiển thị tổng số bản ghi
- Lựa chọn số bản ghi mỗi trang (5 hoặc 10)
- Điều hướng: First, Prev, Số trang, Next, Last
- Kiểm tra giới hạn trang (page < 1 → trang 1; page > max → trang cuối)

### ➕ Thêm Sản Phẩm
- Form nhập: Tên sản phẩm, Mô tả, Hình ảnh
- Upload hình ảnh tự động vào thư mục `uploads/`
- Flash message thành công/lỗi
- Quay về danh sách sau thêm

### ✏️ Chỉnh Sửa Sản Phẩm
- Điền thông tin hiện tại vào form
- Có thể thay đổi hình ảnh hoặc giữ nguyên
- Flash message thành công/lỗi
- Quay về danh sách sau sửa

### 🗑️ Xóa Sản Phẩm
- Xác nhận trước khi xóa
- Tự động xóa file ảnh cũ
- Flash message thành công/lỗi

## Cách Sử Dụng

### Danh Sách
1. Truy cập `http://localhost/lab14/`
2. Chọn số bản ghi/trang (5 hoặc 10)
3. Chuyển trang bằng các nút điều hướng

### Thêm Mới
1. Nhấn nút "➕ Thêm Mới"
2. Điền Tên & Mô tả (bắt buộc)
3. Chọn hình ảnh (tùy chọn)
4. Nhấn "Thêm"

### Chỉnh Sửa
1. Nhấn nút "✏️ Sửa" trên sản phẩm
2. Cập nhật thông tin
3. Nhấn "Cập Nhật"

### Xóa
1. Nhấn nút "🗑️ Xóa" trên sản phẩm
2. Xác nhận xóa

## Flash Message
Các thông báo sẽ hiển thị tự động:
- ✓ Thêm sản phẩm thành công!
- ✓ Cập nhật sản phẩm thành công!
- ✓ Xóa sản phẩm thành công!
- ⓘ Lỗi (nếu có)

## Công Nghệ
- **Backend**: PHP (PDO, OOP)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Vanilla PHP (MVC pattern)

## Lưu Ý
- Thư mục `uploads/` phải có quyền ghi (chmod 755)
- Database phải chạy trước khi dùng ứng dụng
- Tương thích với PHP 7.4+

## Tác Giả
Lab 14 - IT3220
