-- Tạo database mới riêng cho Thư viện
CREATE DATABASE IF NOT EXISTS it3220_library CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE it3220_library;

-- Bảng Sách
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(20) NOT NULL UNIQUE,
    title VARCHAR(200) NOT NULL,
    author VARCHAR(100) NOT NULL,
    category VARCHAR(80) NULL,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng Độc giả (Làm sau khi xong sách)
CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_code VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dữ liệu mẫu
INSERT INTO books (isbn, title, author, quantity) VALUES 
('B001', 'Lập trình PHP', 'Nguyen Van A', 10),
('B002', 'Cấu trúc dữ liệu', 'Tran Thi B', 5);