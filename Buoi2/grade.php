<?php
// Khởi tạo mảng lưu lỗi và dữ liệu mặc định
$errors = [];
$data = ['name' => '', 'cc' => '', 'mid' => '', 'final' => ''];
$final_score = null;
$grade_class = '';

// Hàm kiểm tra điểm hợp lệ (từ 0 đến 10)
function isValidScore($score) {
    if (!is_numeric($score)) return false;
    $score = (float)$score;
    return $score >= 0 && $score <= 10;
}

// Hàm tính điểm tổng kết (10% CC, 30% Giữa kỳ, 60% Cuối kỳ)
function finalScore($cc, $mid, $final) {
    return ($cc * 0.10) + ($mid * 0.30) + ($final * 0.60);
}

// Xử lý khi người dùng nhấn nút Gửi (phương thức POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu và loại bỏ khoảng trắng
    $data['name'] = trim($_POST['name'] ?? '');
    $data['cc'] = trim($_POST['cc'] ?? '');
    $data['mid'] = trim($_POST['mid'] ?? '');
    $data['final'] = trim($_POST['final'] ?? '');

    // Validation phía server
    if ($data['name'] === '') {
        $errors['name'] = 'Vui lòng nhập họ tên';
    }

    $scores_to_check = ['cc' => 'chuyên cần', 'mid' => 'giữa kỳ', 'final' => 'cuối kỳ'];
    foreach ($scores_to_check as $key => $label) {
        if ($data[$key] === '') {
            $errors[$key] = "Vui lòng nhập điểm $label";
        } elseif (!isValidScore($data[$key])) {
            $errors[$key] = "Điểm $label phải là số từ 0 đến 10";
        }
    }

    // Nếu không có lỗi thì tiến hành tính toán và xếp loại
    if (empty($errors)) {
        $final_score = finalScore((float)$data['cc'], (float)$data['mid'], (float)$data['final']);
        
        if ($final_score >= 8) {
            $grade_class = 'Giỏi';
        } elseif ($final_score >= 6.5) {
            $grade_class = 'Khá';
        } elseif ($final_score >= 5) {
            $grade_class = 'Trung bình';
        } else {
            $grade_class = 'Chưa đạt';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Máy tính điểm học phần</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .error { color: red; font-size: 0.9em; margin-left: 10px; }
        .form-group { margin-bottom: 15px; }
        .result { margin-top: 20px; padding: 15px; border: 1px solid green; background-color: #f0fff0; width: fit-content; }
    </style>
</head>
<body>
    <h2>Máy Tính Điểm Học Phần</h2>
    <form method="post" action="">
        <div class="form-group">
            <label>Họ tên:</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>">
            <span class="error"><?= $errors['name'] ?? '' ?></span>
        </div>
        <div class="form-group">
            <label>Điểm chuyên cần (10%):</label><br>
            <input type="text" name="cc" value="<?= htmlspecialchars($data['cc']) ?>">
            <span class="error"><?= $errors['cc'] ?? '' ?></span>
        </div>
        <div class="form-group">
            <label>Điểm giữa kỳ (30%):</label><br>
            <input type="text" name="mid" value="<?= htmlspecialchars($data['mid']) ?>">
            <span class="error"><?= $errors['mid'] ?? '' ?></span>
        </div>
        <div class="form-group">
            <label>Điểm cuối kỳ (60%):</label><br>
            <input type="text" name="final" value="<?= htmlspecialchars($data['final']) ?>">
            <span class="error"><?= $errors['final'] ?? '' ?></span>
        </div>
        <button type="submit">Tính Điểm</button>
    </form>

    <?php if ($final_score !== null): ?>
        <div class="result">
            <p><strong>Sinh viên:</strong> <?= htmlspecialchars($data['name']) ?></p>
            <p><strong>Điểm tổng kết:</strong> <?= number_format($final_score, 1) ?></p>
            <p><strong>Xếp loại:</strong> <?= $grade_class ?></p>
        </div>
    <?php endif; ?>
</body>
</html>