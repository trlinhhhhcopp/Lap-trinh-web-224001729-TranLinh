<?php
// Hàm định dạng tiền tệ có dấu phân cách hàng nghìn[cite: 26]
function money(float $value): string {
    return number_format($value, 0, ',', '.') . ' ₫';
}

// Đọc dữ liệu từ form POST và ép kiểu cơ bản[cite: 26]
$name = $_POST['name'] ?? '';
$qty  = (int)($_POST['qty'] ?? 0);
$price = (float)($_POST['price'] ?? 0);
$total = $qty * $price; // Tính thành tiền[cite: 26]

require 'invoice_view.php';
?>
