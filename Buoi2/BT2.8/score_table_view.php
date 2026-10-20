<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng điểm sinh viên</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin-top: 20px; font-family: sans-serif;}
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .dat { color: green; font-weight: bold; }
        .truot { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Bảng Điểm Lớp Học</h2>
    <table>
        <tr>
            <th>Họ Tên</th>
            <th>Điểm Giữa Kỳ</th>
            <th>Điểm Cuối Kỳ</th>
            <th>Điểm Trung Bình</th>
            <th>Kết Quả</th>
        </tr>
        <?php
        // Lặp qua mảng $students để in từng dòng HTML[cite: 27]
        foreach ($students as $student): 
            $avg = calculateAverage((float)$student['midterm'], (float)$student['final']);
            
            $result_text = ($avg >= 5) ? 'Đạt' : 'Không đạt';
            $result_class = ($avg >= 5) ? 'dat' : 'truot';
        ?>
        <tr>
            <!-- Mã hóa tên bằng htmlspecialchars chống XSS[cite: 27] -->
            <td><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= $student['midterm'] ?></td>
            <td><?= $student['final'] ?></td>
            <td><?= number_format($avg, 1) ?></td>
            <td class="<?= $result_class ?>"><?= $result_text ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>