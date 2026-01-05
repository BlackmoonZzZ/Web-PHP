<?php
class Student {
    // 1. Thuộc tính private (bao đóng dữ liệu)
    private $id;
    private $name;
    private $gpa;

    // 2. Constructor (Hàm khởi tạo)
    public function __construct($id, $name, $gpa) {
        $this->id = $id;
        $this->name = $name;
        $this->gpa = $gpa;
    }

    // 3. Getter (Lấy dữ liệu ra)
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getGpa() {
        return $this->gpa;
    }

    // 4. Method xếp loại (Logic theo đề bài)
    public function rank() {
        if ($this->gpa >= 3.2) {
            return "Giỏi";
        } elseif ($this->gpa >= 2.5) {
            return "Khá";
        } else {
            return "Trung bình";
        }
    }
}
?>