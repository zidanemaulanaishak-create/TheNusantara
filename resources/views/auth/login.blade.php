<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - The Nusantara</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fefefe;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(26, 10, 2, 0.55);
            backdrop-filter: blur(3px);
        }

        .login-container {
            position: relative;
            z-index: 1;
            display: flex;
            width: 900px;
            min-height: 560px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(26, 10, 2, 0.45);
        }

        /* ====== SISI KIRI ====== */
        .login-left {
            flex: 1;
            background-color: #3d1b08;
            padding: 52px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(200, 146, 42, 0.08);
            bottom: -80px;
            left: -80px;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(200, 146, 42, 0.06);
            top: -40px;
            right: -40px;
        }

        .login-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .login-brand img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1.5px solid rgba(234, 211, 175, 0.4);
        }

        .login-brand span {
            font-size: 16px;
            font-weight: 600;
            color: #ead3af;
            letter-spacing: 1.5px;
        }

        .login-left-body {
            position: relative;
            z-index: 1;
        }

        .login-left-body h2 {
            font-size: 32px;
            font-weight: 700;
            color: #ead3af;
            line-height: 1.25;
            margin-bottom: 16px;
        }

        .login-left-body p {
            font-size: 14px;
            color: rgba(234, 211, 175, 0.6);
            line-height: 1.75;
            max-width: 280px;
        }

        .login-left-footer {
            font-size: 12px;
            color: rgba(234, 211, 175, 0.35);
            position: relative;
            z-index: 1;
        }

        /* ====== SISI KANAN ====== */
        .login-right {
            width: 400px;
            background-color: #faf6f0;
            padding: 52px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right-header {
            margin-bottom: 36px;
        }

        .login-right-header .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #c8922a;
            background: rgba(200, 146, 42, 0.1);
            border-radius: 4px;
            padding: 3px 10px;
            margin-bottom: 12px;
        }

        .login-right-header h3 {
            font-size: 24px;
            font-weight: 700;
            color: #3d1b08;
            margin-bottom: 6px;
        }

        .login-right-header p {
            font-size: 13px;
            color: #9c7355;
        }

        /* ====== FORM ====== */
        .login-field {
            margin-bottom: 20px;
        }

        .login-field label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #58290D;
            margin-bottom: 8px;
        }

        .login-input-wrap {
            display: flex;
            align-items: center;
            border-bottom: 1.5px solid #58290D;
            transition: border-color .2s;
        }

        .login-input-wrap:focus-within {
            border-bottom-color: #c8922a;
        }

        .login-input-wrap i {
            font-size: 14px;
            color: #9c7355;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .login-input-wrap input {
            flex: 1;
            padding: 10px 0;
            border: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: #3d1b08;
            outline: none;
        }

        .login-input-wrap input::placeholder {
            color: #c4a882;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background-color: #3d1b08;
            color: #ead3af;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.06em;
            transition: background .2s, transform .15s;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-btn:hover {
            background-color: #58290D;
            transform: translateY(-1px);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Error / pesan */
        .login-error {
            background: rgba(192, 57, 43, 0.08);
            border: 1px solid rgba(192, 57, 43, 0.25);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #c0392b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 700px) {
            .login-container { flex-direction: column; width: 92%; min-height: auto; }
            .login-left { padding: 32px 28px; }
            .login-left-body h2 { font-size: 24px; }
            .login-right { width: 100%; padding: 36px 28px; }
        }
    </style>
</head>
<body>
    <div class="login-container">

        <!-- KIRI -->
        <div class="login-left">
            <div class="login-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <span>The Nusantara</span>
            </div>
            <div class="login-left-body">
                <h2>Panel Admin<br>The Nusantara</h2>
                <p>Kelola konten permainan tradisional nusantara dengan mudah melalui panel administrasi ini.</p>
            </div>
            <div class="login-left-footer">
                &copy; 2025 The Nusantara. All rights reserved.
            </div>
        </div>

        <!-- KANAN -->
        <div class="login-right">
            <div class="login-right-header">
                <div class="badge">Admin Panel</div>
                <h3>Masuk ke Dashboard</h3>
                <p>Silakan masukkan kredensial Anda untuk melanjutkan.</p>
            </div>

            @if($errors->any())
                <div class="login-error">
                    <i class="fas fa-exclamation-circle"></i>
                    Email atau password salah. Silakan coba lagi.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-field">
                    <label>Email</label>
                    <div class="login-input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required>
                    </div>
                </div>
                <div class="login-field">
                    <label>Password</label>
                    <div class="login-input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" name="login" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>
        </div>

    </div>
</body>
</html>
