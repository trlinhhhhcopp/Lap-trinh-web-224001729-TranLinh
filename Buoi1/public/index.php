<?php
$name = $_GET['name'] ?? 'Trần Thục Linh';
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Trang PHP đầu tiên</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Xin chào Lập trình web</h1>
    <h2>Xin chào, <?= $name ?>!</h2>
</body>
</html>