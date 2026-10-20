<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn học liệu</title>
    <style>body { font-family: Arial; margin: 20px; } input { margin-bottom: 10px; display: block; }</style>
</head>
<body>
    <h2>Tính tiền tài liệu</h2>
    <form method="post">
        <!-- Đã bổ sung value để giữ lại dữ liệu khi nhấn Tính -->
        <input name="name" placeholder="Tên tài liệu" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
        <input name="qty" type="number" min="1" placeholder="Số lượng" value="<?= $qty > 0 ? $qty : '' ?>">
        <input name="price" type="number" min="0" placeholder="Đơn giá" value="<?= $price > 0 ? $price : '' ?>">
        <button type="submit">Tính</button>
    </form>

    <?php if ($total > 0): ?>
        <hr>
        <!-- Mã hóa output khi in tên tài liệu để tránh XSS[cite: 26] -->
        <p><strong>Tên tài liệu:</strong> <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Tổng tiền:</strong> <?= money($total) ?></p>
    <?php endif; ?>
</body>
</html>