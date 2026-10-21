<?php
$errors = [];
$data = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Làm sạch và Validate các trường text (Tương tự 3.9)[cite: 43]
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['subject'] = trim($_POST['subject'] ?? '');
    $data['message'] = trim($_POST['message'] ?? '');

    if ($data['name'] === '') $errors['name'] = 'Vui lòng nhập họ tên.';
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Email không hợp lệ.';
    if ($data['message'] === '') $errors['message'] = 'Vui lòng nhập nội dung.';

    // Xử lý Upload File an toàn với 3 kiểm tra bắt buộc[cite: 41, 43]
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['avatar']['tmp_name'];
        $file_name = $_FILES['avatar']['name'];
        $file_size = $_FILES['avatar']['size'];
        
        // Lấy phần mở rộng của file
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        // Kiểm tra 1: Định dạng ảnh cho phép[cite: 41]
        if (!in_array($file_ext, $allowed_ext)) {
            $errors['avatar'] = 'Chỉ cho phép định dạng JPG, JPEG, PNG, GIF.';
        } 
        // Kiểm tra 2: Kích thước tối đa (VD: 2MB)[cite: 41]
        elseif ($file_size > 2 * 1024 * 1024) {
            $errors['avatar'] = 'Kích thước ảnh không được vượt quá 2MB.';
        } 
        else {
            // Kiểm tra 3: Đổi tên file mới an toàn (tránh ghi đè và tên nguy hiểm)[cite: 41]
            $new_file_name = uniqid('avatar_', true) . '.' . $file_ext;
            $upload_path = 'uploads/' . $new_file_name;
        }
    } else {
        $errors['avatar'] = 'Vui lòng chọn ảnh đại diện để tải lên.';
    }

    // Nếu không có lỗi, tiến hành lưu file và chuyển hướng[cite: 40, 41]
    if (empty($errors)) {
        // Di chuyển file từ thư mục tạm sang thư mục đích
        move_uploaded_file($file_tmp, $upload_path);
        header('Location: ../BT3.9/success.php');
        exit;
    }
}

function e($v) { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

require 'contact_upload_view.php';
?>