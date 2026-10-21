<?php
$errors = [];
$data = ['name' => '', 'email' => '', 'birthday' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Làm sạch dữ liệu[cite: 42]
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['birthday'] = trim($_POST['birthday'] ?? '');

    // Kiểm tra dữ liệu bắt buộc và hợp lệ[cite: 42]
    if ($data['name'] === '') $errors['name'] = 'Vui lòng nhập họ tên';
    
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ';
    }
    
    if ($data['birthday'] === '') $errors['birthday'] = 'Vui lòng nhập ngày sinh';

    // Chuyển hướng khi không có lỗi[cite: 42]
    if (!$errors) {
        header('Location: ../BT3.9/success.php'); // Dùng chung file success.php ở BT3.9
        exit;
    }
}

// Hàm hỗ trợ mã hóa output ngắn gọn theo slide[cite: 42]
function e($v) { 
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); 
}

require 'register_view.php';
?>