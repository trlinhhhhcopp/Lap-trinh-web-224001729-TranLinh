<?php
$errors = [];
$data = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];

// Chỉ xử lý khi người dùng nhấn gửi (phương thức POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitization: Làm sạch khoảng trắng thừa[cite: 35]
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['subject'] = trim($_POST['subject'] ?? '');
    $data['message'] = trim($_POST['message'] ?? '');

    // 2. Validation: Kiểm tra dữ liệu bắt buộc và tính hợp lệ[cite: 43]
    if ($data['name'] === '') {
        $errors['name'] = 'Vui lòng nhập họ tên.';
    }

    if ($data['email'] === '') {
        $errors['email'] = 'Vui lòng nhập email.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không đúng định dạng.'; // Bắt lỗi định dạng email[cite: 42]
    }

    if ($data['subject'] === '') {
        $errors['subject'] = 'Vui lòng chọn chủ đề.';
    }

    if ($data['message'] === '') {
        $errors['message'] = 'Vui lòng nhập nội dung.';
    } elseif (strlen($data['message']) < 10 || strlen($data['message']) > 500) {
        $errors['message'] = 'Nội dung phải từ 10 đến 500 ký tự.'; // Ràng buộc độ dài[cite: 43]
    }

    // 3. Nếu form hoàn toàn hợp lệ (không có lỗi)
    if (empty($errors)) {
        // Thực hiện chuyển hướng PRG (POST-Redirect-GET) để tránh submit lại khi F5[cite: 40]
        header('Location: success.php');
        exit;
    }
}

// Gọi file giao diện ra để hiển thị
require 'contact_view.php';
?>