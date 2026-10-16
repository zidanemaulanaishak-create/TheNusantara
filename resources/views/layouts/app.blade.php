<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'PTN | Permainan Tradisional Nusantara')</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--brown:#58290D;--brown-dark:#3d1b08;--gold:#c8922a;--cream:#e4dcd1;--cream3:#FBF8F3}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;background:var(--cream);color:#1a0a02}
a{text-decoration:none;color:inherit}
.navbar{position:fixed;top:0;left:0;right:0;z-index:200;display:flex;justify-content:space-between;align-items:center;padding:14px 5%;background:rgba(228,220,209,.95);backdrop-filter:blur(16px);box-shadow:0 1px 0 rgba(88,41,13,.1)}
.logo{display:flex;align-items:center;gap:10px;color:var(--brown);font-size:18px;letter-spacing:2px;font-weight:600}
.logo img{width:40px;height:40px;border-radius:50%}
.navbar nav ul{display:flex;gap:28px;list-style:none}
.navbar nav ul a{font-size:13px;letter-spacing:.12em;text-transform:uppercase;font-weight:600;color:var(--brown)}
main{padding-top:70px;min-height:80vh}
.footer{background:#3d1b08;color:#ead3af;padding:50px 8% 20px;margin-top:60px}
.footer-top{display:flex;gap:40px;padding-bottom:25px;border-bottom:1px solid #ead3af;flex-wrap:wrap}
.footer-col h4{margin-bottom:10px}
.footer-col ul{list-style:none}
.footer-col li{margin-bottom:6px}
.footer-bottom{text-align:center;padding-top:15px;font-size:13px;opacity:.5}
.btn{display:inline-block;background:var(--brown-dark);color:#ead3af;padding:10px 26px;border-radius:50px;font-weight:600;border:1px solid var(--brown-dark)}
.container{max-width:1200px;margin:0 auto;padding:40px 5%}
.card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px}
.card{background:var(--cream3);border:1px solid rgba(88,41,13,.15);border-radius:14px;overflow:hidden}
.card img{width:100%;height:180px;object-fit:cover}
.card-body{padding:14px 16px}
.flash{background:#e6f5ec;color:#1a7a3f;padding:10px 16px;border-radius:10px;margin-bottom:16px}
</style>
@stack('styles')
</head>
<body>
<header class="navbar">
<div class="logo"><img src="{{ asset('images/logo.png') }}" alt="Logo">The Nusantara</div>
<nav><ul>
<li><a href="/#beranda">Beranda</a></li>
<li><a href="/#tentang">Tentang</a></li>
<li><a href="/#informasi">Pulau</a></li>
<li><a href="{{ route('galeri.index') }}">Galeri</a></li>
<li><a href="/#faq">FAQ</a></li>
<li><a href="/#kontak">Kontak</a></li>
</ul></nav>
</header>
<main>@yield('content')</main>
<footer class="footer">
<div class="footer-top">
<div style="flex:1.5"><h3>The Nusantara</h3><p>Ayo lestarikan permainan tradisional nusantara kita bersama.</p></div>
<div class="footer-col"><h4>Navigasi</h4><ul><li><a href="/#beranda">Beranda</a></li><li><a href="/#tentang">Tentang</a></li><li><a href="/#informasi">Pulau</a></li></ul></div>
<div class="footer-col"><h4>Jelajahi</h4><ul><li><a href="{{ route('galeri.index') }}">Galeri</a></li><li><a href="/#faq">FAQ</a></li></ul></div>
<div class="footer-col"><h4>Kontak</h4><ul><li><a href="mailto:thenusantara@gmail.com">Email Kami</a></li></ul></div>
</div>
<div class="footer-bottom"><p>&copy; 2025 The Nusantara.</p></div>
</footer>
@stack('scripts')
</body>
</html>
