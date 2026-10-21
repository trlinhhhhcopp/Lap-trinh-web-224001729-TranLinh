<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gửi thành công</title>
    <style>
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            display: grid;
            place-items: center;
            background:
                radial-gradient(ellipse at 15% 10%, rgba(52, 211, 153, 0.16), transparent 38%),
                #f5f7fb;
            color: #172033;
            font-family: "Segoe UI", Arial, sans-serif;
        }
        .success-card {
            width: min(100%, 500px);
            padding: 44px 38px;
            border: 1px solid #e5eaf2;
            border-radius: 24px;
            background: #fff;
            text-align: center;
            box-shadow: 0 24px 64px rgba(31, 41, 55, 0.1);
        }
        .success-icon {
            width: 68px;
            height: 68px;
            margin: 0 auto 23px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #dcfce7;
            color: #15803d;
            font-size: 2rem;
            font-weight: 700;
        }
        h1 { margin: 0; font-size: clamp(1.65rem, 5vw, 2rem); letter-spacing: -0.035em; }
        p { margin: 13px 0 26px; color: #64748b; line-height: 1.65; }
        .back-link {
            min-height: 48px;
            padding: 13px 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #4f46e5;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 9px 18px rgba(79, 70, 229, 0.2);
            transition: transform 160ms ease, box-shadow 160ms ease;
        }
        .back-link:hover { transform: translateY(-1px); box-shadow: 0 12px 22px rgba(79, 70, 229, 0.26); }
        .back-link:focus-visible { outline: 3px solid #a5b4fc; outline-offset: 3px; }
        @media (max-width: 520px) { .success-card { padding: 36px 24px; border-radius: 20px; } }
    </style>
</head>
<body>
    <main class="success-card">
        <div class="success-icon" aria-hidden="true">✓</div>
        <h1>Gửi liên hệ thành công!</h1>
        <p>Cảm ơn bạn. Thông tin của bạn đã được ghi nhận. Chúng tôi sẽ liên hệ lại sớm nhất có thể.</p>
        <a class="back-link" href="contact.php">Quay lại form liên hệ</a>
    </main>
</body>
</html>