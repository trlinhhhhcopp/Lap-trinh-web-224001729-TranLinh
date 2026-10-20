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