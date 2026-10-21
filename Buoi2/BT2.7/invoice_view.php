<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hóa đơn học liệu</title>
    <style>
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            padding: 36px 18px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #eff6ff, #f8fafc 58%, #ecfeff);
            color: #172033;
            font-family: "Segoe UI", Arial, sans-serif;
        }
        .invoice-card {
            width: min(100%, 500px);
            padding: 38px;
            border: 1px solid #e7edf5;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 22px 60px rgba(31, 41, 55, 0.1);
        }
        .eyebrow {
            margin: 0 0 9px;
            color: #0284c7;
            font-size: 0.76rem;
            font-weight: 750;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }
        h1 { margin: 0; font-size: clamp(1.7rem, 5vw, 2.15rem); letter-spacing: -0.04em; }
        .intro { margin: 11px 0 28px; color: #64748b; line-height: 1.6; }
        .form-group { margin-bottom: 20px; }
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
            border-color: #0ea5e9;
            outline: none;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.14);
        }
        button {
            width: 100%;
            min-height: 49px;
            margin-top: 4px;
            border: 0;
            border-radius: 11px;
            background: linear-gradient(100deg, #0284c7, #0ea5e9);
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(2, 132, 199, 0.2);
            transition: transform 160ms ease, box-shadow 160ms ease;
        }
        button:hover { transform: translateY(-1px); box-shadow: 0 13px 24px rgba(2, 132, 199, 0.27); }
        button:focus-visible { outline: 3px solid #7dd3fc; outline-offset: 3px; }
        .result {
            margin-top: 26px;
            padding: 20px;
            border: 1px solid #bae6fd;
            border-radius: 15px;
            background: #f0f9ff;
        }
        .result h2 { margin: 0 0 14px; color: #075985; font-size: 1.05rem; }
        .result p { margin: 9px 0 0; color: #334155; line-height: 1.5; }
        .total { color: #0369a1; font-size: 1.2rem; font-weight: 750; }
        @media (max-width: 520px) { .invoice-card { padding: 29px 22px; border-radius: 19px; } }
    </style>
</head>
<body>
    <main class="invoice-card">
        <p class="eyebrow">Công cụ tính nhanh</p>
        <h1>Tính tiền tài liệu</h1>
        <p class="intro">Nhập thông tin học liệu để xem tổng chi phí.</p>
        <form method="post">
            <!-- Đã bổ sung value để giữ lại dữ liệu khi nhấn Tính -->
            <div class="form-group">
                <label for="name">Tên tài liệu</label>
                <input id="name" name="name" placeholder="Ví dụ: Giáo trình Toán" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="form-group">
                <label for="qty">Số lượng</label>
                <input id="qty" name="qty" type="number" min="1" placeholder="Nhập số lượng" value="<?= $qty > 0 ? $qty : '' ?>">
            </div>
            <div class="form-group">
                <label for="price">Đơn giá (₫)</label>
                <input id="price" name="price" type="number" min="0" placeholder="Nhập đơn giá" value="<?= $price > 0 ? $price : '' ?>">
            </div>
            <button type="submit">Tính tổng tiền</button>
        </form>

    <?php if ($total > 0): ?>
        <section class="result" aria-live="polite">
            <h2>Kết quả thanh toán</h2>
            <!-- Mã hóa output khi in tên tài liệu để tránh XSS[cite: 26] -->
            <p><strong>Tên tài liệu:</strong> <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Tổng tiền:</strong> <span class="total"><?= money($total) ?></span></p>
        </section>
    <?php endif; ?>
    </main>
</body>
</html>