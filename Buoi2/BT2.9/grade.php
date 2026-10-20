<?php
$errors = [];
$data = ['name' => '', 'cc' => '', 'mid' => '', 'final' => ''];
$final_score = null;
$grade_class = '';

function isValidScore($score) {
    if (!is_numeric($score)) return false;
    $score = (float)$score;
    return $score >= 0 && $score <= 10;
}

function finalScore($cc, $mid, $final) {
    return ($cc * 0.10) + ($mid * 0.30) + ($final * 0.60);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['name'] = trim($_POST['name'] ?? '');
    $data['cc'] = trim($_POST['cc'] ?? '');
    $data['mid'] = trim($_POST['mid'] ?? '');
    $data['final'] = trim($_POST['final'] ?? '');

    if ($data['name'] === '') $errors['name'] = 'Vui lòng nhập họ tên';

    $scores_to_check = ['cc' => 'chuyên cần', 'mid' => 'giữa kỳ', 'final' => 'cuối kỳ'];
    foreach ($scores_to_check as $key => $label) {
        if ($data[$key] === '') {
            $errors[$key] = "Vui lòng nhập điểm $label";
        } elseif (!isValidScore($data[$key])) {
            $errors[$key] = "Điểm $label phải là số từ 0 đến 10";
        }
    }

    if (empty($errors)) {
        $final_score = finalScore((float)$data['cc'], (float)$data['mid'], (float)$data['final']);
        if ($final_score >= 8) $grade_class = 'Giỏi';
        elseif ($final_score >= 6.5) $grade_class = 'Khá';
        elseif ($final_score >= 5) $grade_class = 'Trung bình';
        else $grade_class = 'Chưa đạt';
    }
}

// Gọi file thiết kế lên để kết xuất giao diện cùng với dữ liệu đã tính toán ở trên
require 'grade_view.php';
?>