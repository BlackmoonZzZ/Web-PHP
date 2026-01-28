-- Database: lab14
-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS lab14;
USE lab14;

-- Bảng items
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert dữ liệu mẫu
INSERT INTO items (name, description) VALUES
('Sản phẩm 1', 'Mô tả sản phẩm số 1'),
('Sản phẩm 2', 'Mô tả sản phẩm số 2'),
('Sản phẩm 3', 'Mô tả sản phẩm số 3'),
('Sản phẩm 4', 'Mô tả sản phẩm số 4'),
('Sản phẩm 5', 'Mô tả sản phẩm số 5'),
('Sản phẩm 6', 'Mô tả sản phẩm số 6'),
('Sản phẩm 7', 'Mô tả sản phẩm số 7'),
('Sản phẩm 8', 'Mô tả sản phẩm số 8'),
('Sản phẩm 9', 'Mô tả sản phẩm số 9'),
('Sản phẩm 10', 'Mô tả sản phẩm số 10'),
('Sản phẩm 11', 'Mô tả sản phẩm số 11'),
('Sản phẩm 12', 'Mô tả sản phẩm số 12'),
('Sản phẩm 13', 'Mô tả sản phẩm số 13'),
('Sản phẩm 14', 'Mô tả sản phẩm số 14'),
('Sản phẩm 15', 'Mô tả sản phẩm số 15'),
('Sản phẩm 16', 'Mô tả sản phẩm số 16'),
('Sản phẩm 17', 'Mô tả sản phẩm số 17'),
('Sản phẩm 18', 'Mô tả sản phẩm số 18'),
('Sản phẩm 19', 'Mô tả sản phẩm số 19'),
('Sản phẩm 20', 'Mô tả sản phẩm số 20'),
('Sản phẩm 21', 'Mô tả sản phẩm số 21'),
('Sản phẩm 22', 'Mô tả sản phẩm số 22'),
('Sản phẩm 23', 'Mô tả sản phẩm số 23'),
('Sản phẩm 24', 'Mô tả sản phẩm số 24'),
('Sản phẩm 25', 'Mô tả sản phẩm số 25'),
('Sản phẩm 26', 'Mô tả sản phẩm số 26'),
('Sản phẩm 27', 'Mô tả sản phẩm số 27'),
('Sản phẩm 28', 'Mô tả sản phẩm số 28'),
('Sản phẩm 29', 'Mô tả sản phẩm số 29'),
('Sản phẩm 30', 'Mô tả sản phẩm số 30'),
('Sản phẩm 31', 'Mô tả sản phẩm số 31'),
('Sản phẩm 32', 'Mô tả sản phẩm số 32'),
('Sản phẩm 33', 'Mô tả sản phẩm số 33'),
('Sản phẩm 34', 'Mô tả sản phẩm số 34'),
('Sản phẩm 35', 'Mô tả sản phẩm số 35'),
('Sản phẩm 36', 'Mô tả sản phẩm số 36'),
('Sản phẩm 37', 'Mô tả sản phẩm số 37'),
('Sản phẩm 38', 'Mô tả sản phẩm số 38'),
('Sản phẩm 39', 'Mô tả sản phẩm số 39'),
('Sản phẩm 40', 'Mô tả sản phẩm số 40'),
('Sản phẩm 41', 'Mô tả sản phẩm số 41'),
('Sản phẩm 42', 'Mô tả sản phẩm số 42'),
('Sản phẩm 43', 'Mô tả sản phẩm số 43'),
('Sản phẩm 44', 'Mô tả sản phẩm số 44'),
('Sản phẩm 45', 'Mô tả sản phẩm số 45'),
('Sản phẩm 46', 'Mô tả sản phẩm số 46'),
('Sản phẩm 47', 'Mô tả sản phẩm số 47'),
('Sản phẩm 48', 'Mô tả sản phẩm số 48'),
('Sản phẩm 49', 'Mô tả sản phẩm số 49'),
('Sản phẩm 50', 'Mô tả sản phẩm số 50');
