<?php
// Tạo mảng dữ liệu sinh viên[cite: 27]
$students = [
    ['name' => 'Nguyễn Văn An', 'midterm' => 8.0, 'final' => 8.5],
    ['name' => 'Trần Thị Bình', 'midterm' => 4.0, 'final' => 4.5],
    ['name' => 'Lê Văn Chi <b>(Vắng mặt)</b>', 'midterm' => 5.0, 'final' => 6.0] 
];

// Hàm tính điểm trung bình[cite: 27]
function calculateAverage(float $mid, float $final): float {
    return ($mid + $final) / 2;
}

// Gọi file giao diện hiển thị
require 'score_table_view.php';
?>