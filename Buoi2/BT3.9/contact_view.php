<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ an toàn</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        .error { color: red; font-size: 0.9em; display: block; margin-top: 5px; }
        input, textarea { width: 300px; padding: 8px; border: 1px solid #ccc;}
    </style>
</head>
<body>
    <h2>Form Liên Hệ (Có Validation & Chống XSS)</h2>
    <!-- Gửi dữ liệu về lại file contact.php để xử lý -->
    <form method="post" action="contact.php">
        <div class="form-group">
            <label>Họ tên:</label><br>
            <!-- Dùng htmlspecialchars để mã hóa dữ liệu in ra[cite: 38] -->
            <input type="text" name="name" value="<?= htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') ?>">
            <span class="error"><?= $errors['name'] ?? '' ?></span>
        </div>
        
        <div class="form-group">
            <label>Email:</label><br>
            <input type="text" name="email" value="<?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') ?>">
            <span class="error"><?= $errors['email'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label>Chủ đề:</label><br>
            <input type="text" name="subject" value="<?= htmlspecialchars($data['subject'], ENT_QUOTES, 'UTF-8') ?>">
            <span class="error"><?= $errors['subject'] ?? '' ?></span>
        </div>

        <div class="form-group">
            <label>Nội dung (10 - 500 ký tự):</label><br>
            <textarea name="message" rows="5"><?= htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8') ?></textarea>
            <span class="error"><?= $errors['message'] ?? '' ?></span>
        </div>

        <button type="submit">Gửi liên hệ</button>
    </form>
</body>
</html>