<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký sinh viên</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 32px 18px;
            display: grid;
            place-items: center;
            background:
                radial-gradient(ellipse at 15% 10%, rgba(129, 140, 248, 0.18), transparent 38%),
                radial-gradient(ellipse at 90% 90%, rgba(45, 212, 191, 0.14), transparent 36%),
                #f5f7fb;
            color: #172033;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .register-card {
            width: min(100%, 500px);
            padding: 40px;
            border: 1px solid #e8edf5;
            border-radius: 24px;
            background: #fff;
            box-shadow: 0 24px 64px rgba(31, 41, 55, 0.1);
        }

        .eyebrow {
            margin: 0 0 8px;
            color: #4f46e5;
            font-size: 0.76rem;
            font-weight: 750;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.7rem, 5vw, 2.1rem);
            letter-spacing: -0.04em;
        }

        .intro {
            margin: 11px 0 30px;
            color: #64748b;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 21px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 0.91rem;
            font-weight: 650;
        }

        input {
            width: 100%;
            min-height: 49px;
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

        input::-webkit-calendar-picker-indicator {
            cursor: pointer;
        }

        .has-error input {
            border-color: #fda4af;
        }

        .error {
            display: block;
            margin-top: 7px;
            color: #be123c;
            font-size: 0.83rem;
            line-height: 1.45;
        }

        button {
            width: 100%;
            min-height: 50px;
            margin-top: 5px;
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

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 13px 24px rgba(79, 70, 229, 0.27);
        }

        button:focus-visible {
            outline: 3px solid #a5b4fc;
            outline-offset: 3px;
        }

        @media (max-width: 520px) {
            .register-card {
                padding: 30px 23px;
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>
    <main class="register-card">
        <p class="eyebrow">Thông tin sinh viên</p>
        <h1>Đăng ký tài khoản</h1>
        <p class="intro">Vui lòng điền thông tin cá nhân của bạn vào biểu mẫu bên dưới.</p>

        <form method="post" action="register.php">
            <div class="form-group<?= !empty($errors['name']) ? ' has-error' : '' ?>">
                <label for="name">Họ và tên</label>
                <input id="name" type="text" name="name" value="<?= e($data['name']) ?>" autocomplete="name" aria-invalid="<?= !empty($errors['name']) ? 'true' : 'false' ?>" aria-describedby="name-error">
                <span class="error" id="name-error"><?= $errors['name'] ?? '' ?></span>
            </div>
            <div class="form-group<?= !empty($errors['email']) ? ' has-error' : '' ?>">
                <label for="email">Địa chỉ email</label>
                <input id="email" type="text" name="email" value="<?= e($data['email']) ?>" autocomplete="email" aria-invalid="<?= !empty($errors['email']) ? 'true' : 'false' ?>" aria-describedby="email-error">
                <span class="error" id="email-error"><?= $errors['email'] ?? '' ?></span>
            </div>
            <div class="form-group<?= !empty($errors['birthday']) ? ' has-error' : '' ?>">
                <label for="birthday">Ngày sinh</label>
                <input id="birthday" type="date" name="birthday" value="<?= e($data['birthday']) ?>" aria-invalid="<?= !empty($errors['birthday']) ? 'true' : 'false' ?>" aria-describedby="birthday-error">
                <span class="error" id="birthday-error"><?= $errors['birthday'] ?? '' ?></span>
            </div>
            <button type="submit">Đăng ký</button>
        </form>
    </main>
</body>
</html>