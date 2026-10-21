<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bảng điểm sinh viên</title>
    <style>
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            padding: 48px 20px;
            background: #f4f7fb;
            color: #172033;
            font-family: "Segoe UI", Arial, sans-serif;
        }
        .page { width: min(100%, 1080px); margin: 0 auto; }
        .eyebrow {
            margin: 0 0 8px;
            color: #4f46e5;
            font-size: 0.76rem;
            font-weight: 750;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }
        h1 { margin: 0; font-size: clamp(1.8rem, 5vw, 2.35rem); letter-spacing: -0.04em; }
        .intro { margin: 10px 0 26px; color: #64748b; line-height: 1.6; }
        .table-card {
            overflow: hidden;
            border: 1px solid #e5eaf2;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 18px 48px rgba(31, 41, 55, 0.08);
        }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th, td { padding: 17px 20px; border-bottom: 1px solid #edf0f5; }
        th {
            background: #f8faff;
            color: #475569;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        td { color: #334155; }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #fafbff; }
        .dat, .truot {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .dat { background: #dcfce7; color: #166534; }
        .truot { background: #ffe4e6; color: #be123c; }
        @media (max-width: 640px) {
            body { padding: 32px 14px; }
            th, td { padding: 14px 16px; }
        }
    </style>
</head>
<body>
    <main class="page">
        <p class="eyebrow">Kết quả học tập</p>
        <h1>Bảng điểm lớp học</h1>
        <p class="intro">Tổng hợp điểm giữa kỳ, cuối kỳ và kết quả của từng sinh viên.</p>
        <section class="table-card" aria-label="Bảng điểm sinh viên">
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Điểm giữa kỳ</th>
                            <th>Điểm cuối kỳ</th>
                            <th>Điểm trung bình</th>
                            <th>Kết quả</th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <td><strong><?= number_format($avg, 1) ?></strong></td>
                            <td><span class="<?= $result_class ?>"><?= $result_text ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>