<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - The Nusantara</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;min-height:100vh;display:flex;justify-content:center;align-items:center;background:#3d1b08}
.card{background:#faf6f0;border-radius:16px;padding:36px;width:400px}
input{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;margin:6px 0 12px}
button{width:100%;padding:12px;background:#3d1b08;color:#ead3af;border:none;border-radius:8px;cursor:pointer;font-weight:600}
.errors{background:#fdecea;color:#c0392b;padding:10px;border-radius:8px;margin-bottom:12px;font-size:13px}
</style>
</head>
<body>
<div class="card">
<h2>Register Admin</h2>
@if($errors->any())<div class="errors"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ route('register') }}">@csrf
<label>Nama</label><input type="text" name="name" value="{{ old('name') }}" required>
<label>Email</label><input type="email" name="email" value="{{ old('email') }}" required>
<label>Password</label><input type="password" name="password" required>
<label>Konfirmasi Password</label><input type="password" name="password_confirmation" required>
<button type="submit">Daftar</button>
</form>
<p style="margin-top:12px;font-size:13px"><a href="{{ route('login') }}">Sudah punya akun? Masuk</a></p>
</div>
</body>
</html>
