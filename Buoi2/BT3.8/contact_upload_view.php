<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liên hệ với chúng tôi</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 55%, #ecfeff 100%);
            color: #172033;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .contact-card {
            width: min(100%, 580px);
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 24px 70px rgba(30, 41, 59, 0.12);
        }

        .eyebrow {
            margin: 0 0 10px;
            color: #4f46e5;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.7rem, 5vw, 2.2rem);
            letter-spacing: -0.04em;
        }

        .intro {
            margin: 12px 0 30px;
            color: #64748b;
            line-height: 1.65;
        }

        .form-group {
            margin-bottom: 21px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 0.92rem;
            font-weight: 650;
        }

        .required {
            color: #e11d48;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid #dbe2ea;
            border-radius: 12px;
            background: #fff;
            color: #172033;
            font: inherit;
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }

        input[type="text"],
        input[type="email"] {
            min-height: 48px;
            padding: 0 14px;
        }

        input[type="file"] {
            padding: 10px;
            background: #f8fafc;
            font-size: 0.88rem;
        }

        input[type="file"]::file-selector-button {
            margin-right: 12px;
            padding: 8px 12px;
            border: 0;
            border-radius: 8px;
            background: #eef2ff;
            color: #4338ca;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        textarea {
            min-height: 135px;
            padding: 13px 14px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.14);
        }

        .hint {
            display: block;
            margin-top: 8px;
            color: #64748b;
            font-size: 0.82rem;
        }

        .error {
            display: block;
            margin-top: 7px;
            color: #be123c;
            font-size: 0.84rem;
            line-height: 1.45;
        }

        .has-error input,
        .has-error textarea {
            border-color: #fda4af;
        }

        button {
            width: 100%;
            min-height: 50px;
            margin-top: 5px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(100deg, #4f46e5, #6366f1);
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.22);
            transition: transform 160ms ease, box-shadow 160ms ease;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 13px 24px rgba(79, 70, 229, 0.28);
        }

        button:focus-visible {
            outline: 3px solid #a5b4fc;
            outline-offset: 3px;
        }

        @media (max-width: 520px) {
            body {
                padding: 20px 14px;
            }

            .contact-card {
                padding: 28px 22px;
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>
    <main class="contact-card">
        <p class="eyebrow">Chúng tôi luôn sẵn sàng hỗ trợ</p>
        <h1>Gửi lời nhắn cho chúng tôi</h1>
        <p class="intro">Điền thông tin bên dưới và chúng tôi sẽ phản hồi bạn sớm nhất có thể.</p>

        <form method="post" action="contact_upload.php" enctype="multipart/form-data">
            <div class="form-group<?= !empty($errors['name']) ? ' has-error' : '' ?>">
                <label for="name">Họ và tên <span class="required">*</span></label>
                <input id="name" type="text" name="name" value="<?= e($data['name']) ?>" autocomplete="name" required aria-invalid="<?= !empty($errors['name']) ? 'true' : 'false' ?>" aria-describedby="name-error">
                <span class="error" id="name-error"><?= $errors['name'] ?? '' ?></span>
            </div>
            <div class="form-group<?= !empty($errors['email']) ? ' has-error' : '' ?>">
                <label for="email">Địa chỉ email <span class="required">*</span></label>
                <input id="email" type="email" name="email" value="<?= e($data['email']) ?>" autocomplete="email" required aria-invalid="<?= !empty($errors['email']) ? 'true' : 'false' ?>" aria-describedby="email-error">
                <span class="error" id="email-error"><?= $errors['email'] ?? '' ?></span>
            </div>
            <div class="form-group<?= !empty($errors['message']) ? ' has-error' : '' ?>">
                <label for="message">Nội dung <span class="required">*</span></label>
                <textarea id="message" name="message" required aria-invalid="<?= !empty($errors['message']) ? 'true' : 'false' ?>" aria-describedby="message-error"><?= e($data['message']) ?></textarea>
                <span class="error" id="message-error"><?= $errors['message'] ?? '' ?></span>
            </div>
            <div class="form-group<?= !empty($errors['avatar']) ? ' has-error' : '' ?>">
                <label for="avatar">Ảnh đại diện <span class="required">*</span></label>
                <input id="avatar" type="file" name="avatar" accept=".jpg,.jpeg,.png,.gif" required aria-invalid="<?= !empty($errors['avatar']) ? 'true' : 'false' ?>" aria-describedby="avatar-hint avatar-error">
                <span class="hint" id="avatar-hint">JPG, JPEG, PNG hoặc GIF · Tối đa 2MB</span>
                <span class="error" id="avatar-error"><?= $errors['avatar'] ?? '' ?></span>
            </div>
            <button type="submit">Gửi liên hệ</button>
        </form>
    </main>
</body>
</html>