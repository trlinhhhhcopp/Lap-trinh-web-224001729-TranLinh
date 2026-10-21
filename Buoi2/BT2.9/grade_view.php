<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Máy tính điểm học phần</title>
    <style>
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            padding: 36px 18px;
            display: grid;
            place-items: center;
            background:
                radial-gradient(ellipse at 12% 10%, rgba(129, 140, 248, 0.16), transparent 38%),
                #f5f7fb;
            color: #172033;
            font-family: "Segoe UI", Arial, sans-serif;
        }
        .grade-card {
            width: min(100%, 540px);
            padding: 38px;
            border: 1px solid #e7edf5;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 22px 60px rgba(31, 41, 55, 0.1);
        }
        .eyebrow {
            margin: 0 0 9px;
            color: #4f46e5;
            font-size: 0.76rem;
            font-weight: 750;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }
        h1 { margin: 0; font-size: clamp(1.7rem, 5vw, 2.1rem); letter-spacing: -0.04em; }
        .intro { margin: 11px 0 28px; color: #64748b; line-height: 1.6; }
        .form-group { margin-bottom: 19px; }
        label { display: block; margin-bottom: 8px; color: #334155; font-size: 0.91rem; font-weight: 650; }
        input {
            width: 100%;
            min-height: 48px;
            padding: 0 14px;
            border: 1px solid #dbe2ea;
            border-radius: 11px;
            background: #fff;
            color: #172033;
            font: inherit;
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }
        input:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.14);
        }
        .has-error input { border-color: #fda4af; }
        .error { display: block; margin-top: 7px; color: #be123c; font-size: 0.83rem; line-height: 1.45; }
        button {
            width: 100%;
            min-height: 50px;
            margin-top: 3px;
            border: 0;
            border-radius: 11px;
            background: linear-gradient(100deg, #4f46e5, #6366f1);
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
            transition: transform 160ms ease, box-shadow 160ms ease;
        }
        button:hover { transform: translateY(-1px); box-shadow: 0 13px 24px rgba(79, 70, 229, 0.27); }
        button:focus-visible { outline: 3px solid #a5b4fc; outline-offset: 3px; }
        .result {
            margin-top: 26px;
            padding: 21px;
            border: 1px solid #c7d2fe;
            border-radius: 15px;
            background: #f5f7ff;
        }
        .result h2 { margin: 0 0 14px; color: #3730a3; font-size: 1.05rem; }
        .result p { margin: 10px 0 0; color: #475569; line-height: 1.5; }
        .result strong { color: #334155; }
        .score { color: #4338ca; font-size: 1.4rem; font-weight: 800; }
        .grade-badge {
            display: inline-block;
            padding: 5px 11px;
            border-radius: 999px;
            background: #e0e7ff;
            color: #3730a3;
            font-size: 0.88rem;
            font-weight: 700;
        }
        @media (max-width: 520px) { .grade-card { padding: 29px 22px; border-radius: 19px; } }
    </style>
</head>
<body>
    <main class="grade-card">
        <p class="eyebrow">Công cụ học tập</p>
        <h1>Máy tính điểm học phần</h1>
        <p class="intro">Nhập điểm theo từng thành phần để tính điểm tổng kết và xếp loại.</p>
        <form method="post" action="">
            <div class="form-group<?= !empty($errors['name']) ? ' has-error' : '' ?>">
                <label for="name">Họ và tên</label>
                <input id="name" type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" autocomplete="name" aria-invalid="<?= !empty($errors['name']) ? 'true' : 'false' ?>" aria-describedby="name-error">
                <span class="error" id="name-error"><?= $errors['name'] ?? '' ?></span>
            </div>
            <div class="form-group<?= !empty($errors['cc']) ? ' has-error' : '' ?>">
                <label for="cc">Điểm chuyên cần <span>(10%)</span></label>
                <input id="cc" type="text" name="cc" inputmode="decimal" value="<?= htmlspecialchars($data['cc']) ?>" aria-invalid="<?= !empty($errors['cc']) ? 'true' : 'false' ?>" aria-describedby="cc-error">
                <span class="error" id="cc-error"><?= $errors['cc'] ?? '' ?></span>
            </div>
            <div class="form-group<?= !empty($errors['mid']) ? ' has-error' : '' ?>">
                <label for="mid">Điểm giữa kỳ <span>(30%)</span></label>
                <input id="mid" type="text" name="mid" inputmode="decimal" value="<?= htmlspecialchars($data['mid']) ?>" aria-invalid="<?= !empty($errors['mid']) ? 'true' : 'false' ?>" aria-describedby="mid-error">
                <span class="error" id="mid-error"><?= $errors['mid'] ?? '' ?></span>
            </div>
            <div class="form-group<?= !empty($errors['final']) ? ' has-error' : '' ?>">
                <label for="final">Điểm cuối kỳ <span>(60%)</span></label>
                <input id="final" type="text" name="final" inputmode="decimal" value="<?= htmlspecialchars($data['final']) ?>" aria-invalid="<?= !empty($errors['final']) ? 'true' : 'false' ?>" aria-describedby="final-error">
                <span class="error" id="final-error"><?= $errors['final'] ?? '' ?></span>
            </div>
            <button type="submit">Tính điểm</button>
        </form>

    <?php if ($final_score !== null): ?>
        <section class="result" aria-live="polite">
            <h2>Kết quả học phần</h2>
            <p><strong>Sinh viên:</strong> <?= htmlspecialchars($data['name']) ?></p>
            <p><strong>Điểm tổng kết:</strong> <span class="score"><?= number_format($final_score, 1) ?></span></p>
            <p><strong>Xếp loại:</strong> <span class="grade-badge"><?= $grade_class ?></span></p>
        </section>
    <?php endif; ?>
    </main>
</body>
</html>